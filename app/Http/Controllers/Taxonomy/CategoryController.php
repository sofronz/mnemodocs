<?php
namespace App\Http\Controllers\Taxonomy;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\TaxonomyService;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuditResource;
use App\Builders\Taxonomy\CategoryQuery;
use App\Http\Resources\TaxonomyResource;
use App\Services\Taxonomy\CategoryService;
use App\Http\Requests\Taxonomy\CategoryRequest;

class CategoryController extends Controller
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
        $categories = CategoryQuery::apply($request)->paginate(10);

        return Inertia::render('Categories/Index', [
            'categories' => TaxonomyResource::collection($categories),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Categories/Form', [
            'category'   => null,
            'isEdit'     => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->fieldInputs();
        app(TaxonomyService::class)->store($data);

        return redirect()->route('categories.index')->with('success', 'Category Created!');
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
        $category   = app(TaxonomyService::class)->find('id', $id);
        $audits     = $category->audits()->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Categories/Form', [
            'category'     => new TaxonomyResource($category),
            'audits'       => AuditResource::collection($audits),
            'isEdit'       => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, string $id)
    {
        $data = $request->fieldInputs();
        app(TaxonomyService::class)->update($data, $id);

        return redirect()->route('categories.index')->with('success', 'Categories Updated!');
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
        app(CategoryService::class)->delete($id);

        return redirect()->route('categories.index')->with('success', 'Categories Deleted!');
    }
}
