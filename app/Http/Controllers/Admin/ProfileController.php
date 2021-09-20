<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $finduser = Auth::user();
        $data = User::where('email', $finduser->email)->first();
        if ($data) {
            return view('admin.profiles.index', compact('data'));
        } else
            return redirect(route('admin.dashboard'));

    }


    public function update(Request $request)
    {

        $finduser = Auth::user();
        $data = User::where('id', $finduser->id)->first();
        $td = Carbon::now('Europe/Istanbul')->format('Y-m-d H-i');
        $Active = 0;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5000'
            ]);
            $file_name = uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('back/images/Profiles'), $file_name);
        } else {
            $file_name = null;
        }

        if ($request->TwoAuth == "on")
            $Active = 1;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->position = $request->Position;
        $data->ProfilePicture = $file_name;
        $data->Experience = $request->experience;
        $data->Skils = $request->skils;
        $data->two_factor_authentication = $Active;
        $data->save();

        if ($data) {
            $path = 'back/images/Profiles/' . $request->old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
                //eski resmi silmek için unlink kullanıyoruz
            }
            return redirect(route('profiles'))->with('success', 'Düzenleme Başarıyla Tamamlandı');
        } else {
            return redirect(route('profiles'))->with('error', 'Düzenleme Tamamlanamadı');

        }

    }
}
