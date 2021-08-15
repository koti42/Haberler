<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Permission=DB::table('permissions')->orderBy('id','DESC')->paginate(10);
        return view('admin.Permission.index',compact('Permission'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Permission.PermissionRegister');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PermissionRequest $permissionRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {

  $perm=Permission::whereName(slugify($request))->first();

  if(!$perm)
  {
      Permission::create([
         'name'=>slugify($request['name']),
         'guard_name'=>'web',
         'description'=>'New Create Permission'
      ]);
      return redirect()->route('permission.index')->with('success','Yetki Başarıyla Eklendi');
  }
  else
      return redirect()->route('permission.index')->with('error','Yetki Eklenemedi');

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
            $Per = Permission::findOrFail($id);
            $control=[1,2,3,4,5];
            foreach ($control as $cont)
            {
                if($cont==$id)
                {
                    return redirect()->route('permission.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
                }
            }
            return view('Admin.Permission.PermissionEdit', compact('Per'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('permission.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {//ModelNotFoundException metodu findOrFail'de karşılığı gelmeyen sorgularda Hata yakalar.

        try {
            $per=Permission::findOrFail($request->permission_id);
            $permission->name =slugify($request['name']);
            $permission->save();
            return redirect()->route('permission.index')->with('success', 'Yetki Günceleme İşlemi Başarıyla Tamamlandı!');
        }
        catch (ModelNotFoundException $exception){
            return redirect()->route('permission.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission,Request $request)
    {

        $permission->id = $request->id;
        if($permission->is_main!==1)
        $permission->delete();

        return redirect()->route('permission.index')->with('success', 'Kayıt Silme İşlemi Başarıyla Tamamlandı!');

    }
}
