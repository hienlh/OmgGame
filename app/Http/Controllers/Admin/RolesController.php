<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Game;
use OmgGame\Models\Permission;
use OmgGame\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = Role::with('perms')->paginate();
        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:Roles'
        ]);
        $role = Role::create([
            'name' => $request->input(['name']),
            'display_name' => $request->input(['display_name']),
            'description' => $request->input(['description']),
        ]);

        if ($request->has('permissions')) {
            $role->perms()->attach($request->get('permissions'));
        }
        $role->save();
        return redirect()->route('admin.roles.index')->withFlashSuccess("The role <strong>$role->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.show', ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permissions = Permission::all();
        $role = Role::with('perms')->findOrFail($id);
        return view('admin.roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        if (!$role) {
            return redirect()->back()->withFlashDanger('The role you requested for has not been found');
        }

        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');

        if ($role->name != 'admin' && $request->has('permissions')) {
            $role->perms()->detach();
            if ($request->get('permissions')) {
                $role->perms()->attach($request->get('permissions'));
            }
        } else {
            $role->perms()->detach();
            $role->perms()->attach(Permission::all());
        }

        $role->save();
        return redirect()->route('admin.roles.index')->withFlashSuccess("The role <strong>$role->name</strong> has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->withFlashSuccess("The role <strong>$role->name</strong> has successfully been archived.");
    }
}
