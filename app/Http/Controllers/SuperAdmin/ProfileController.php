<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //index
    public function index()
    {
        $user = Auth::user();

        return view('SuperAdmin.Profile.Index', compact(
            'user'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $userId = Auth::id();

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $userId)->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
