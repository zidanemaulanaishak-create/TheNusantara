<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $today = now()->toDateString();
        if (session('tracked_date') !== $today) {
            DB::statement(
                'INSERT INTO tb_pengunjung (tanggal, jumlah) VALUES (?, 1) ON DUPLICATE KEY UPDATE jumlah = jumlah + 1',
                [$today]
            );
            session(['tracked_date' => $today]);
        }

        return $next($request);
    }
}
