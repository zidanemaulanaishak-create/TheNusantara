<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatatanController extends Controller
{
    public function handle(Request $request)
    {
        $action = $request->input('action');
        $email = $request->user()->email;

        if ($action === 'simpan') {
            DB::table('tb_catatan')->insert([
                'email' => $email,
                'isi' => $request->input('isi'),
                'dibuat' => now(),
            ]);

            return response()->json(['status' => 'ok']);
        }

        if ($action === 'hapus') {
            DB::table('tb_catatan')
                ->where('id', $request->input('id'))
                ->where('email', $email)
                ->delete();

            return response()->json(['status' => 'ok']);
        }

        if ($action === 'ambil') {
            $data = DB::table('tb_catatan')
                ->where('email', $email)
                ->orderByDesc('dibuat')
                ->get();

            return response()->json($data);
        }

        return response()->json(['status' => 'unknown'], 400);
    }
}
