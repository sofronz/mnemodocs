<?php
namespace App\Http\Controllers\Taxonomy;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\TaxonomyService;
use App\Builders\Taxonomy\RoleQuery;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuditResource;
use App\Services\Taxonomy\RoleService;
use App\Http\Resources\TaxonomyResource;
use App\Http\Requests\Taxonomy\RoleRequest;

class RolesController extends Controller
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
        $roles = RoleQuery::apply($request)->paginate(10);

        return Inertia::render('Roles/Index', [
            'roles' => TaxonomyResource::collection($roles),
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Roles/Form', [
            'role'   => null,
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        $data = $request->fieldInputs();
        app(TaxonomyService::class)->store($data);

        return redirect()->route('roles.index')->with('success', 'Role Created!');
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
        $role   = app(TaxonomyService::class)->find('id', $id);
        $audits = $role->audits()->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Roles/Form', [
            'role'     => new TaxonomyResource($role),
            'audits'   => AuditResource::collection($audits),
            'isEdit'   => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, string $id)
    {
        $data = $request->fieldInputs();
        app(TaxonomyService::class)->update($data, $id);

        return redirect()->route('roles.index')->with('success', 'Role Updated!');
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
        app(RoleService::class)->delete($id);

        return redirect()->route('roles.index')->with('success', 'Role Deleted!');
    }
}
