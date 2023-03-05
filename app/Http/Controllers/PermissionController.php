<?php

namespace App\Http\Controllers;

use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission as SpatiePermission;

class PermissionController extends Controller
{
    public function getPermission()
    {
        $users = User::with(['roles'])->find(Auth::id());
        $view_permissions = $users->permission->where('name', 'view permissions');
        return [
            'view permissions' => $view_permissions,
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->getPermission()['view permissions']->isEmpty()) {
            abort(403, 'Unauthorized action.');
        }
        try {
            DB::beginTransaction();
            $permissions = SpatiePermission::latest()->filter(request(['search']))->paginate(5)->withQueryString();
            DB::commit();
            return view('dashboard.permissions.index', compact('permissions'));
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
            $data = [
                'name' => $request->name,
                'guard_name' => 'web',
            ];
            SpatiePermission::create($data);
            DB::commit();
            return redirect()->route('dashboard.permission.index')->with('status', 'Success create new flag product');
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
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission, $id)
    {
        try {
            DB::beginTransaction();
            $permissions = SpatiePermission::find($id);
            $permissions->update(['name' => $request->name]);
            DB::commit();
            return redirect()->route('dashboard.permission.index')->with('status', 'Success update flag product');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' =>  $th->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission, $id)
    {
        try {
            DB::beginTransaction();
            $permissions = SpatiePermission::find($id);
            $permissions->delete();
            DB::commit();
            return redirect()->route('dashboard.permission.index')->with('status', 'Sukses delete flag product');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
