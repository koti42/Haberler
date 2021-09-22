<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5000'
        ]);

        $user = $request->user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->position = $request->input('Position');
        $user->Experience = $request->input('experience');
        $user->Skills = $request->input('Skills');
        $user->two_factor_authentication = $request->input('TwoAuth2');


        if($image = $request->file('image')) {
            try {
                $oldFileName = $user->ProfilePicture;

                $fileName = uniqid().'.'.$image->getClientOriginalExtension();

                $image->storeAs('images/Profiles', $fileName, 'back');

                $user->ProfilePicture = $fileName;

                if($oldFileName != 'user2-160x160.jpg') {
                    Storage::disk('back')->delete("images/Profiles/{$oldFileName}");
                }

            } catch (Throwable $exception) {
                return redirect()->route('profiles')->withErrors($exception->getMessage());
            }
        }

        $user->save();

        return redirect()->route('profiles')->with('success', 'Düzenleme Başarıyla Tamamlandı');
    }
}
