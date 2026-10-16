<?php

namespace App\Http\Controllers;

use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $gambarData = Galeri::whereNotNull('gambar')->where('gambar', '!=', '')->orderBy('id')->get()->toArray();

        return view('pages.galeri', compact('gambarData'));
    }
}
