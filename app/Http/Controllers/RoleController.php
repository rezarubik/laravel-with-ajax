<?php

namespace App\Http\Controllers;

use App\Role;
use Spatie\Permission\Models\Role as RoleSpatie;
use Spatie\Permission\Models\Permission as PermissionSpatie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function getPermission()
    {
        $users = User::with(['roles'])->find(Auth::id());
        $view_roles = $users->permission->where('name', 'view roles');
        return [
            'view roles' => $view_roles,
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * NOTE: Display in Dashboard
     */
    public function index()
    {
        if ($this->getPermission()['view roles']->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }
        try {
            DB::beginTransaction();
            $roles = Role::latest()->filter(request(['search']))->paginate(5)->withQueryString();
            DB::commit();
            return view('dashboard.roles.index', compact('roles'));
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = ['name' => $request->name, 'guard_name' => 'web'];
            Role::create($data);
            DB::commit();
            return redirect()->route('dashboard.role.index')->with('status', 'Success create new role');
        } catch (\Throwable $th) {
            //throw $th;
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
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * NOTE: Edit Permission
     */
    public function edit_permission(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = RoleSpatie::find($id);
            $role_permission = $role->getAllPermissions();
            $permissions = PermissionSpatie::all();
            // return [
            //     'role' => $role,
            //     'permissions' => $permissions,
            // ];
            DB::commit();
            return view('dashboard.roles.edit_permission', compact('role', 'permissions', 'role_permission'));
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, $id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->update(['name' => $request->name]);
            DB::commit();
            return redirect()->route('dashboard.role.index')->with('status', 'Success update role');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage(),
            ]);
        }
    }

    /**
     * NOTE: Update role permission
     */
    public function update_permission(Request $request, $id)
    {
        try {
            // return $request->all();
            DB::beginTransaction();
            $role = RoleSpatie::find($id);
            $role_permission = $role->getAllPermissions();
            $permissions = PermissionSpatie::all();
            $role->syncPermissions($request->to);

            DB::commit();
            return redirect()->route('dashboard.role.edit_permission', compact('id', 'role', 'permissions', 'role_permission'))->with('status', 'Success update role permission');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, $id)
    {
        try {
            DB::beginTransaction();
            // $role = Role::find($id);
            // $role->delete();
            $role = RoleSpatie::find($id);
            $users = User::whereHas('roles', function ($query) use ($id) {
                $query->where('id', $id);
            })->get();
            // return $users;
            $role->syncPermissions([]);
            foreach ($users as $user) {
                // return $user;
                $user->syncRoles([]);
            }
            $role->delete();

            DB::commit();
            return redirect()->route('dashboard.role.index')->with('status', 'Sukses delete role');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
