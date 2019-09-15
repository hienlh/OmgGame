<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Permission;
use OmgGame\Models\Role;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:permissions');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $perms = Permission::all();
        return view('admin.permissions.index', ['permissions' => $perms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions'
        ]);
        $permission = Permission::create([
            'name' => $request->input(['name']),
            'display_name' => $request->input(['display_name']),
            'description' => $request->input(['description']),
        ]);
        return redirect()->route('admin.permissions.index')->withFlashSuccess("The permission <strong>$permission->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.show', ['permission' => $permission]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);

        if (!$permission) {
            return redirect()->back()->withFlashDanger('The permission you requested for has not been found');
        }

        $this->validate($request, [
            'name' => 'required|unique:Permissions'
        ]);

        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->description = $request->input('description');
        $permission->save();
        return redirect()->route('admin.permissions.index')->withFlashSuccess("The permission <strong>$permission->name</strong> has successfully been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index')->withFlashSuccess("The permission <strong>$permission->name</strong> has successfully been archived.");
    }
}
