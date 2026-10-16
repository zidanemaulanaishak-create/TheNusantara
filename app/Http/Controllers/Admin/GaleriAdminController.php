<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriAdminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage > 0 ? $perPage : 10;
        $halaman = max(1, (int) $request->query('page_num', 1));
        $offset = ($halaman - 1) * $perPage;

        $search = $request->query('search', '');

        $allowedSort = ['id', 'judul', 'created_at'];
        $sortBy = in_array($request->query('sort'), $allowedSort) ? $request->query('sort') : 'id';
        $sortDir = $request->query('dir') === 'desc' ? 'DESC' : 'ASC';

        $query = Galeri::query();
        if ($search !== '') {
            $query->where('judul', 'like', "%{$search}%");
        }

        $total = $query->count();
        $totalPages = (int) ceil($total / $perPage);

        $data = $query->orderBy($sortBy, $sortDir)->skip($offset)->take($perPage)->get()->toArray();

        $edit = false;
        $editData = null;
        if ($request->query('edit')) {
            $row = Galeri::find($request->query('edit'));
            if ($row) {
                $edit = true;
                $editData = $row->toArray();
            }
        }

        $queryBase = http_build_query(array_filter([
            'page' => 'galeri',
            'search' => $search,
            'sort' => $sortBy,
            'dir' => $sortDir,
            'per_page' => $perPage,
        ]));

        return view('admin.galeri-index', compact(
            'perPage', 'halaman', 'offset', 'search', 'sortBy', 'sortDir',
            'total', 'totalPages', 'data', 'edit', 'editData', 'queryBase'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'max:100'],
            'gambar' => ['nullable', 'image', 'max:3072'],
        ]);
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = basename($request->file('gambar')->store('foto', 'public'));
        }
        Galeri::create($validated);

        return redirect()->route('admin.galeri.index', ['pesan' => 'tambah']);
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        $validated = $request->validate([
            'judul' => ['required', 'max:100'],
            'gambar' => ['nullable', 'image', 'max:3072'],
        ]);
        if ($request->hasFile('gambar')) {
            if ($galeri->gambar) Storage::disk('public')->delete('foto/'.$galeri->gambar);
            $validated['gambar'] = basename($request->file('gambar')->store('foto', 'public'));
        } else {
            unset($validated['gambar']);
        }
        $galeri->update($validated);

        return redirect()->route('admin.galeri.index', ['pesan' => 'edit']);
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->gambar) Storage::disk('public')->delete('foto/'.$galeri->gambar);
        $galeri->delete();

        return redirect()->route('admin.galeri.index');
    }
}
