<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Services\DocumentService;
use App\Http\Resources\AuditResource;
use App\Http\Requests\DocumentRequest;
use App\Builders\Document\DocumentQuery;
use App\Http\Resources\DocumentResource;
use App\Services\Taxonomy\CategoryService;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $documents = DocumentQuery::apply($request)->paginate(10);

        return Inertia::render('Documents/Index', [
            'documents' => DocumentResource::collection($documents),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     * 
     * @return \Inertia\Response
     */
    public function create()
    {
        $categories = app(CategoryService::class)->builder()->where('status', 1)->get();

        return Inertia::render('Documents/Form', [
            'document'     => null,
            'categories'   => $categories,
            'isEdit'       => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DocumentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DocumentRequest $request)
    {
        $data     = $request->fieldInputs();
        $document = app(DocumentService::class)->store($data);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $media = app(MediaService::class)->upload($request->file('file'));
            $document->attachMedia($media);
        }

        return redirect()->route('documents.index')->with('success', 'Document Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     *
     * @return \Inertia\Response
     */
    public function edit(string $id)
    {
        $document   = app(DocumentService::class)->find('id', $id);
        $categories = app(CategoryService::class)->builder()->where('status', 1)->get();
        $audits     = $document->audits()->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Documents/Form', [
            'document'       => new DocumentResource($document),
            'categories'     => $categories,
            'audits'         => AuditResource::collection($audits),
            'isEdit'         => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DocumentRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DocumentRequest $request, string $id)
    {
        $data     = $request->fieldInputs();
        $document = app(DocumentService::class)->update($data, $id);

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $media = app(MediaService::class)->upload($request->file('file'));

            $document->detachMedia();
            $document->attachMedia($media);
        }

        return redirect()->route('documents.index')->with('success', 'Document Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $document = app(DocumentService::class)->find('id', $id);
        $document->detachMedia();

        app(DocumentService::class)->delete($id);

        return redirect()->route('documents.index')->with('success', 'Document Deleted!');
    }
}
