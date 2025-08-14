<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index()
    {
        return view('Auth.Index');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string',
                'password' => 'required|string',
            ]);

            $credentials = $request->only('name', 'password');
            $remember    = $request->boolean('remember'); // aman kalau checkbox tidak ada

            if (!Auth::attempt($credentials, $remember)) {
                Log::warning('Login gagal: kredensial salah', [
                    'name' => $request->input('name'),
                    'ip'   => $request->ip(),
                ]);
                return back()->with('error', 'Username atau password salah.');
            }

            // sukses login
            $request->session()->regenerate();

            $user  = Auth::user();
            $level = (int) ($user->level ?? -1); // cast ke int supaya '0'/'1' juga kebaca

            Log::info('Login sukses', [
                'user_id'    => $user->id,
                'name'       => $user->name,
                'email'      => $user->email ?? null,
                'level_raw'  => $user->level,
                'level_cast' => $level,
                'ip'         => $request->ip(),
            ]);

            // arahkan langsung, jangan back() ke /login
            if ($level === 0) {
                return redirect()->route('Index.Dashboard.SA')
                    ->with('success', 'Selamat datang Superadmin!');
            }

            if ($level === 1) {
                return redirect()->route('Index.Dashboard.A')
                    ->with('success', 'Selamat datang Admin!');
            }

            // level tidak valid → keluar + log
            Log::error('Login ditolak: level tidak dikenali', [
                'user_id' => $user->id,
                'level'   => $user->level,
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->with('error', 'Akses ditolak. Level tidak dikenali.');
        } catch (\Throwable $e) {
            Log::error('Login error', ['exception' => $e]);
            return back()->with('error', 'Terjadi kesalahan saat login. Silakan coba lagi nanti.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('Index')->with('success', 'Berhasil logout.');
    }
}
