<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getPermission()
    {
        $users = User::with(['roles'])->find(Auth::id());
        $view_users = $users->permission->where('name', 'view users');
        $view_form_create_user = $users->permission->where('name', 'view form create user');
        return [
            'view users' => $view_users,
            'view form create user' => $view_form_create_user,
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->getPermission()['view users']->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }
        $users = User::with(['roleUser', 'roleUser.role'])->latest()->filter(request(['search']))->paginate(3)->withQueryString();
        $total_user = $users->total();
        // return $users->total();
        return view('dashboard.users.index', compact('users', 'total_user'));
    }

    public function index_operationals()
    {
        return view('dashboard.index_welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->getPermission()['view form create user']->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $check_user = User::where('email', $request->email)->first();
            if ($check_user) {
                return redirect()->route('dashboard.user.create')->with('error', 'User is exists')->withInput();
            }
            // return 'stop';
            if ($request->password !== $request->confirm) {
                return redirect()->route('dashboard.user.create')->with('error', 'Password not match')->withInput();
            }
            $data = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $new_user = User::create($data);

            $roles = $request->id_role;
            if ($roles) {
                $new_user->assignRole($roles);
            }
            DB::commit();
            return redirect()->route('dashboard.user.index')->with('status', 'Success create user');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            DB::beginTransaction();
            $user = User::with(['roleUser', 'roleUser.role'])->where('id', $id)->first();
            $role_users = $user->roles;
            $roles = Role::all();
            $id_roles = [];
            foreach ($role_users as $role_user) {
                // return $role_user;
                array_push($id_roles, $role_user->id);
            }
            DB::commit();
            return view('dashboard.users.edit', compact('user', 'id_roles', 'roles'));
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $roles = $request->id_role;
            if (!$roles) {
                return redirect()->route('dashboard.user.edit', $id)->with('error', 'Please choose the role');
            }
            $check_email_user = User::where('email', $request->email)->first();
            if ($check_email_user && $check_email_user->email !== $user->email) {
                return redirect()->route('dashboard.user.edit', $id)->with('error', 'Email already exists');
            }
            $data = [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
            ];
            $user->update($data);
            // todo: sync role / update role
            $user->syncRoles($request->id_role);
            DB::commit();
            return redirect()->route('dashboard.user.edit', $id)->with('status', 'Success update user');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->delete();
            DB::commit();
            return redirect()->route('dashboard.user.index')->with('status', 'Success delete user');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage()
            ]);
        }
    }

    public function verify(Request $request, $validation_code)
    {
        $code = $validation_code;
        if (!User::where('validation_code', $code)->exists()) {
            return Helper::error('Wrong validation code', '001');
        }
        $user = User::where('validation_code', $code)->first();
        $user->is_verify = true;
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('thanks');
    }
}
