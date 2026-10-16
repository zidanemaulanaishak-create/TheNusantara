<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Support\Facades\DB;

class InformasiController extends Controller
{
    public function show($id)
    {
        $id = (int) $id;

        $info = DB::table('tb_informasi as ti')
            ->leftJoin('tb_pulau as tp', 'ti.pulau_id', '=', 'tp.id')
            ->select('ti.*', 'tp.nama as nama_pulau', 'tp.gambar as gambar_pulau', 'tp.deskripsi as deskripsi_pulau', 'tp.id as pulau_id')
            ->where('ti.id', $id)
            ->first();

        if (! $info) {
            return redirect('/');
        }

        $info = (array) $info;

        $permainanLain = Informasi::where('pulau_id', $info['pulau_id'])
            ->where('id', '!=', $id)
            ->orderBy('id')
            ->limit(5)
            ->get()
            ->toArray();

        return view('pages.informasi-detail', compact('id', 'info', 'permainanLain'));
    }
}
