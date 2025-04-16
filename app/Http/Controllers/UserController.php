<?php
namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Builders\User\UserQuery;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\AuditResource;
use App\Services\Taxonomy\RoleService;

class UserController extends Controller
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
        $users = UserQuery::apply($request)->paginate(10);

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection($users),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $roles = app(RoleService::class)->builder()->where('status', 1)->get();

        return Inertia::render('Users/Form', [
            'user'    => null,
            'roles'   => $roles,
            'isEdit'  => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->fieldInputs();
        app(UserService::class)->store($data);

        return redirect()->route('users.index')->with('success', 'User Created!');
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
        $user   = app(UserService::class)->find('id', $id);
        $roles  = app(RoleService::class)->builder()->where('status', 1)->get();
        $audits = $user->audits()->orderBy('created_at', 'DESC')->get();

        return Inertia::render('Users/Form', [
            'user'     => new UserResource($user),
            'roles'    => $roles,
            'audits'   => AuditResource::collection($audits),
            'isEdit'   => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, string $id)
    {
        $data = $request->fieldInputs();
        app(UserService::class)->update($data, $id);

        return redirect()->route('users.index')->with('success', 'User Updated!');
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
        app(UserService::class)->delete($id);

        return redirect()->route('users.index')->with('success', 'User Deleted!');
    }
}
