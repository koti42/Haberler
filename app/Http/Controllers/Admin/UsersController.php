<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Throwable;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')
            ->paginate(12);
        //  $user=User::all()->load('roles');
        return view('admin.Users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.Users.register', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if(!$request->user()->roles->flatMap->permissions->contains('name', 'create-user')) {
            return redirect()
                ->route('users.create')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }

        $success = false;
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
                'google_id'=>null,

            ]);
            if ($user) {
                $role = Role::find($request->role_id);
                $Saverole = $user->assignRole($role);
                if ($Saverole)
                    $success = true;
                else
                    $success = false;

            } else
                $success = false;
        } catch (Throwable $exception) {
            $success = false;
            return redirect()->back()->with('error', 'Kayıt İşlemi Başarısız Lütfen Sistem Yöneticisine Başvurunuz!');

        }
        if ($success) {
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Kayıt İşlemi Başarılı');
        }


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
            $roles = Role::all();
            $user = User::findOrFail($id)->load('roles');
            return view('admin.Users.edit', compact('user', 'roles'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', 'Güncelleme İşlemi Şuanda Çalışmıyor, Lütfen Sistem Yöneticisine Başvurunuz!');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            // Kullanıcı birden fazla role sahip ise tüm yetkileri derlemeniz lazım
            if(!$request->user()->roles->flatMap->permissions->contains('name', 'edit-user')) {
                return redirect()
                    ->route('users.index')
                    ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return redirect()
                ->route('users.index')
                ->with('success', 'Kayıt günceleme işlemi başarıyla tamamlandı!');
        }
        catch (Throwable $exception){
            return redirect()
                ->route('users.index')
                ->with('error', 'Bilinmeyen Bir Hata  Oluştu Lütfen Sistem Yöneticisine Bildiriniz!');
        }

    //Bütün hataları yakalamak için Throwable kullanılıyor laravel de


}


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        if(!$request->user()->roles->flatMap->permissions->contains('name', 'delete-user')) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }
        $user->id = $request->id;
        $user->delete();
        return redirect()
            ->back()
            ->with('success', 'Kayıt Silme İşlemi Başarıyla Tamamlandı!');

    }
}
