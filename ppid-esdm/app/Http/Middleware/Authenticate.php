<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Jika request bukan dari API dan tidak terotentikasi
        if (!$request->expectsJson()) {
            // Periksa guard yang sedang digunakan
            // Jika guard 'admin' yang gagal otentikasi, redirect ke login admin
            if (in_array('admin', $this->guards)) {
                return route('admin.login');
            }
            // Untuk guard 'web' atau lainnya, jika ada, bisa redirect ke rute login default
            // Karena user biasa tidak perlu login, kita bisa mengembalikan null atau rute lain
            return null; // Atau return route('information-requests.create'); jika ingin redirect ke halaman utama
        }

        return null;
    }
}
