<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Pulau;
use Illuminate\Http\Request;

class PulauController extends Controller
{
    public function show(Request $request, $id)
    {
        $pulau = Pulau::findOrFail($id);
        $pulau->increment('views');

        $search = $request->query('search', '');
        $query = Informasi::where('pulau_id', $id);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%")
                    ->orWhere('pengertian', 'like', "%{$search}%")
                    ->orWhere('cara_bermain', 'like', "%{$search}%");
            });
        }
        $infoData = $query->orderBy('id')->get()->toArray();
        $pulau = $pulau->toArray();
        $id = $pulau['id'];

        return view('pages.pulau-detail', compact('pulau', 'infoData', 'search', 'id'));
    }

    public function apiIndex()
    {
        return response()->json(Pulau::orderBy('nama')->get(['id', 'nama']));
    }
}
