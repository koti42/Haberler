<?php

namespace App\Http\Controllers\Admin;

use App\Events\UsersAdded;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestUpdate;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Nette\Utils\Random;
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
            ->paginate(100);
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
        if (!$request->user()->roles->flatMap->permissions->contains('name', 'create-user')) {
            return redirect()
                ->route('users.create')
                ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
        }

        $success = false;
        if ($request->hasFile('Image')) {
            $request->validate([
                'Image' => 'required|image|mimes:jpg,jpeg,png|max:5000'
            ]);
            $file_name = uniqid() . '.' . $request->Image->getClientOriginalExtension();
            $request->Image->move(public_path('back/images/Profiles'), $file_name);
        } else {
            $file_name = null;
        }
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'google_id' => null,
            'ProfilePicture' => $file_name,
        ]);
        if ($user) {
            $role = Role::find($request->role_id);
            $Saverole = $user->assignRole($role);
            if ($Saverole)
                $success = true;
            else
                $success = false;

            event(new UsersAdded($user));
        } else
            $success = false;

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

    public function twoFactory(Request $request)
    {

        $user = Auth::user()->id;
        $data = User::where('id', $user)->first();
        $otp = implode('', $request->input('pincode'));
        if($data)
        {
            $data->two_factory_verified_control =$otp;
            $data->save();
        }
        return redirect(route('admin.dashboard'));
        //TO DO LIST
        //random 6 haneli bir sayı oluşturulacak
        //random oluşturulan sayı veri tabanında two_factory_verified_success bölümüne kaydedilecek
        //ve bu oluşturulan sayı mail ile kullanıcıya iletilecek
        //ve bu işlem kullanıcı her yeni giriş yaptığın da tekrarlanacak
        //TO DO LIST
    }

    public function AccountVerified(Request $request)
    {
        $user = $request->token;
        $data = User::where('email_verified_control', $user)->first();
        $control_verified = User::where('email_verified_success', $user)->first();
        if ($control_verified) {
            return redirect(route('Admin.login'));
        }
        if ($data) {
            $data->email_verified_success = $request->token;
            $data->email_verified_at = now();
            $data->save();
            return redirect(route('Admin.login'))->with('success', 'Hesap Aktivasyon İşlemi Başarıyla Tamamlandı');
        }
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
    public function update(UserRequestUpdate $request, User $user)
    {
        try {
            // Kullanıcı birden fazla role sahip ise tüm yetkileri derlemeniz lazım
            if (!$request->user()->roles->flatMap->permissions->contains('name', 'edit-user')) {
                return redirect()
                    ->route('users.index')
                    ->with('error', 'Bunun için yetkiniz yok!, Lütfen sistem yöneticisine başvurunuz!');
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            if ($user) {
                return redirect()
                    ->route('users.index')
                    ->with('success', 'Kayıt günceleme işlemi başarıyla tamamlandı!');
            } else {
                return redirect()
                    ->route('users.index')
                    ->with('error', 'Kayıt Güncelleme İşlemi Tamamlanamadı!');

            }


        } catch (Throwable $exception) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Bilinmeyen Bir Hata  Oluştu Lütfen Sistem Yöneticisine Bildiriniz!');
        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        if (!$request->user()->roles->flatMap->permissions->contains('name', 'delete-user')) {
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
