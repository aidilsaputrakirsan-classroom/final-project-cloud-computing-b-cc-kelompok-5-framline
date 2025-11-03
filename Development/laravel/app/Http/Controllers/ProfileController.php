<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // tampilkan halaman profil (read-only)
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // form edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile-edit', compact('user'));
    }

    // update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->notify_email = $request->has('notify_email');
        $user->notify_push  = $request->has('notify_push');
        $user->notify_sms   = $request->has('notify_sms');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // update foto profil
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        // hapus file lama jika perlu (opsional)
        if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
            @unlink(public_path($user->profile_photo));
        }

        $user->profile_photo = '/storage/' . $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui.');
    }
}
