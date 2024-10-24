<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SessionTimeoutMiddleware
{
    protected $timeout = 1200; // Timeout setelah 20 menit (dalam detik)

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $lastActivity = session('lastActivityTime');
            $currentTime = time();

            if ($lastActivity && ($currentTime - $lastActivity) > $this->timeout) {
                Auth::logout(); // Logout user jika waktu aktivitas terakhir melebihi batas timeout

                return redirect()->route('login')->with('warning', 'Sesi Anda telah berakhir. Silakan login kembali.');
            }

            // Simpan atau perbarui waktu aktivitas terakhir
            session(['lastActivityTime' => $currentTime]);
        }

        return $next($request);
    }
}
