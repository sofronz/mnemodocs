<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Jobs\ExportDataJob;
use Illuminate\Http\Request;
use App\Services\DataExportService;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DataExportResource;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $data = [
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
                'type' => 'roles',
            ],
        ];

        return Inertia::render('Dashboard', [
            'exports' => DataExportResource::collection($data),
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

        ExportDataJob::dispatch();

        return redirect()->back()->with('success', 'Export process still in progress..');
    }

    /**
     * @param string $filename
     *
     * @return \Illuminate\Http\Response
     */
    public function download(string $filename)
    {
        $filePath = storage_path('app/public/' . $filename);

        if (! file_exists($filePath)) {
            abort(404, 'File not found.');
        }

        return response()->download($filePath);
    }
}
