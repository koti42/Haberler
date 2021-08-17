<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Roles = DB::table('roles')->orderBy('id', 'DESC')->paginate(10);

        return view('admin.Roles.index', compact('Roles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Roles.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        if(!$request->user()->roles->flatMap->permissions->contains('name', 'create-user')) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }

        $perm = Role::whereName(slugify($request))->first();

        if (!$perm) {
            Role::create([
                'name' => slugify($request['name']),
                'guard_name' => 'web',
                'description' => 'New Create Roles',
                'is_show_admin' => $request['role_id'],
                'slug' => 'undefined'
            ]);
            return redirect()->route('roles.index')->with('success', 'Rol Başarıyla Eklendi');
        } else
            return redirect()->route('roles.index')->with('error', 'Rol Eklenemedi');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $Rol = Role::findOrFail($id);
            $control = [1, 2, 3];
            foreach ($control as $cont) {
                if ($cont == $id) {
                    return redirect()->route('roles.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
                }
            }
            return view('Admin.Roles.edit', compact('Rol'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('roles.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Role $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$request->user()->roles->flatMap->permissions->contains('name', 'edit-user')) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }
        try {
            $role = Role::findOrFail($id);
            $role->name = slugify($request['name']);
            $role->is_show_admin = $request->is_show_admin;
            $role->save();
            return redirect()->route('roles.index')->with('success', 'Yetki Günceleme İşlemi Başarıyla Tamamlandı!');
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('roles.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if(!$request->user()->roles->flatMap->permissions->contains('name', 'delete-user')) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }
        $Rol = Role::findOrFail($id);
        if ($Rol->is_main !== 1)
            $Rol->delete();
        return redirect()->route('roles.index')->with('success', 'Kayıt Silme İşlemi Başarıyla Tamamlandı!');
    }

    public function ManagePermission($id)
    {
        $role=Role::find($id)->load('permissions');
        $permissions=Permission::all();

        return view('Admin.Permission-Role-Management.index',compact('role','permissions'));
    }
    public function ManagePermissionStore(Request $request)
    {
        if(!$request->user()->roles->flatMap->permissions->contains('name', 'create-permission')) {
            return redirect()
                ->route('roles.index')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }
//return $request->all();
        $role=Role::find($request->id);
        $permissions=Permission::all();
        foreach ($permissions as $permission) {
            $permission->removeRole($role);

        }
        $reqPermissions=$request->permissions;
        if($reqPermissions)
        {
            foreach ($reqPermissions as $key => $perm)
            {
                try {
                    $dbPerm=Permission::findOrFail($key);
                    $role->givePermissionTo($dbPerm);
                }
                catch (ModelNotFoundException $exception) {
                    return redirect()->route('roles.index')->with('error','Yetki Verme İşlemi Tamamlanamadı Sistem Yöneticisine Başvurunuz!');
                }

            }

        }
        return redirect()->route('roles.index')->with('success','Yetki Verme İşlemi Başarıyla Tamamlandı!');
    }
}
