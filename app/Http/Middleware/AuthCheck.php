<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AuthCheck
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // --- KUMPULKAN KONTEN KONTEKS UNTUK LOG ---
        $routeName = optional($request->route())->getName();
        $context = [
            'method'     => $request->getMethod(),
            'path'       => $request->path(),
            'full_url'   => $request->fullUrl(),
            'route'      => $routeName,
            'ip'         => $request->ip(),
            'user_id'    => optional(Auth::user())->id,
            'user_email' => optional(Auth::user())->email,
        ];

        Log::debug('AuthCheck: request masuk', $context);

        // --- CEK AUTENTIKASI ---
        if (!Auth::check()) {
            Log::warning('AuthCheck: user belum login → redirect ke login', $context);

            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user  = Auth::user();
        $level = (int) ($user->level ?? -1); // 0 = superadmin, 1 = admin

        // update konteks dengan info level
        $context['level'] = $level;

        $path = $request->path();

        // --- ATURAN AKSES ---
        // Superadmin (level 0) HANYA boleh ke prefix 'super-admin'
        if ($level === 0 && !Str::startsWith($path, 'super-admin')) {
            $context['deny_reason'] = 'superadmin_masuk_non_superadmin';
            $context['redirect_to'] = 'Index.Dashboard.SA';

            Log::warning('AuthCheck: akses ditolak untuk superadmin ke route non-superadmin', $context);

            return redirect()
                ->route('Index.Dashboard.SA')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Admin (level 1) HANYA boleh ke prefix 'admin'
        if ($level === 1 && !Str::startsWith($path, 'admin')) {
            $context['deny_reason'] = 'admin_masuk_non_admin';
            $context['redirect_to'] = 'Index.Dashboard.A';

            Log::warning('AuthCheck: akses ditolak untuk admin ke route non-admin', $context);

            return redirect()
                ->route('Index.Dashboard.A')
                ->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        Log::info('AuthCheck: akses diizinkan', $context);

        return $next($request);
    }
}
