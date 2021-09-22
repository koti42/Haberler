<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class DashbordController extends Controller
{
    public function index()
    {

        $finduser = Auth::user();
        return view('admin.component.dashboard',compact('finduser'));


    }
    public function exit()
    {
        Auth::logout();
        return redirect(route('Admin.login'))->with('success','Başarıyla Çıkış Yapıldı');
    }
}
