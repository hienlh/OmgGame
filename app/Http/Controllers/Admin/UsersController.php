<?php

namespace OmgGame\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use OmgGame\Helpers\Firebase\FirebaseHelper;
use OmgGame\Http\Controllers\Controller;
use OmgGame\Models\Role;
use OmgGame\Models\User;

class UsersController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('permission:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate();
        $params = [
            'users' => $users,
        ];
        return view('admin.users.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        $params = [
            'roles' => $roles,
        ];
        return view('admin.users.create')->with($params);
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        return redirect()->route('admin.users.index')->withFlashSuccess("The user <strong>$user->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            $params = [
                'user' => $user,
            ];
            return view('admin.users.show')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            $roles = Role::all();
            $params = [
                'user' => $user,
                'roles' => $roles,
            ];
            return view('admin.users.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('error.' . '404');
            }
        }
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
        try {
            $user = User::findOrFail($id);
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|min:6|confirmed'
            ]);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->has('password')) {
                $user->password = bcrypt($request->get('password'));
            }
            if ($request->has('roles')) {
                $user->roles()->detach();
                if ($request->get('roles')) {
                    $user->roles()->attach($request->get('roles'));
                }
            }
            $user->save();
            return redirect()->route('admin.users.index')->withFlashSuccess("The user <strong>$user->name</strong> has successfully been updated.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', "The user <strong>$user->name</strong> has successfully been archived.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function showBanner()
    {
        $user = auth()->user();
        return view('admin.users.banner', ['user' => $user]);
    }

    public function updateBanner(Request $request)
    {
        $user = auth()->user();
//        dd($request->top_banner);

        $this->validate($request, [
            'top_banner' => 'image|mimes:jpeg,png,jpg|max:2048|nullable',
            'bottom_banner' => 'image|mimes:jpeg,png,jpg|max:2048|nullable'
        ]);

        $top_banner = $request->top_banner;
        $old_top = $user->top_banner;
        if($top_banner) {
            $user->top_banner = FirebaseHelper::getInstance()->upload($top_banner, 'banners');
            $user->save();
            // Delete old file on firebase storage
            if ($top_banner && $old_top && $old_top != $user->top_banner) {
                FirebaseHelper::getInstance()->delete($old_top);
            }
        }

        $bottom_banner = $request->bottom_banner;
        $old_bottom = $user->bottom_banner;
        if($bottom_banner) {
            $user->bottom_banner = FirebaseHelper::getInstance()->upload($bottom_banner, 'banners');
            $user->save();

            if ($bottom_banner && $old_bottom && $old_bottom != $user->bottom_banner) {
                FirebaseHelper::getInstance()->delete($old_bottom);
            }
        }

        return redirect()->route('admin.showBanner')->withFlashSuccess("The banner updated");
    }
}
