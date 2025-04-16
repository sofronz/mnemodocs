<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Jobs\ExportDataJob;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\DocumentService;
use App\Services\DataExportService;
use App\Services\Taxonomy\RoleService;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DataExportResource;
use App\Services\Taxonomy\CategoryService;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $data = collect([
            [
                'name' => 'Categories',
                'type' => 'category',
            ],
            [
                'name' => 'Documents',
                'type' => 'document',
            ],
            [
                'name' => 'Users',
                'type' => 'user',
            ],
            [
                'name' => 'Roles',
                'type' => 'role',
            ],
        ]);

        return Inertia::render('Dashboard', [
            'dataExports' => DataExportResource::collection($data),
            'counter'     => [
                'categories' => app(CategoryService::class)->builder()->count(),
                'roles'      => app(RoleService::class)->builder()->count(),
                'users'      => app(UserService::class)->builder()->count(),
                'documents'  => app(DocumentService::class)->builder()->count(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);

        app(DataExportService::class)->detach($request->type, $request->user()->id);
        app(DataExportService::class)->store([
            'type'        => $request->type,
            'exported_by' => $request->user()->id,
        ]);

        ExportDataJob::dispatch($request->type, $request->user()->id);

        return redirect()->back()->with('success', 'Export process still in progress..');
    }

    /**
     * @param string $id
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(string $id)
    {
        $data = app(DataExportService::class)->find('id', $id);

        // Pastikan file ada di disk public
        if (! Storage::disk('public')->exists($data->file_path)) {
            abort(404, 'File not found.');
        }

        // Ambil path file yang lengkap di disk public
        $filePath = storage_path('app/public/' . $data->file_path);

        // Cek apakah file benar-benar ada dan dapat diakses
        if (! file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        // Gunakan response()->download untuk memulai unduhan
        return response()->download($filePath);
    }
}
