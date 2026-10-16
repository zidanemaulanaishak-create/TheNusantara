<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'pesan' => ['required', 'string'],
        ]);

        Laporan::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'pesan' => $data['pesan'],
            'status' => 'pending',
            'notif' => 0,
        ]);

        return redirect('/?pesan=sukses#kontak');
    }
}
