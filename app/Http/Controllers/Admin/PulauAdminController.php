<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pulau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PulauAdminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage > 0 ? $perPage : 10;
        $halaman = max(1, (int) $request->query('page_num', 1));
        $offset = ($halaman - 1) * $perPage;

        $search = $request->query('search', '');

        $allowedSort = ['id', 'nama', 'created_at'];
        $sortBy = in_array($request->query('sort'), $allowedSort) ? $request->query('sort') : 'id';
        $sortDir = $request->query('dir') === 'desc' ? 'DESC' : 'ASC';

        $query = Pulau::query();
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        $total = $query->count();
        $totalPages = (int) ceil($total / $perPage);

        $data = $query->orderBy($sortBy, $sortDir)->skip($offset)->take($perPage)->get()->toArray();

        $queryBase = http_build_query(array_filter([
            'page' => 'pulau',
            'search' => $search,
            'sort' => $sortBy,
            'dir' => $sortDir,
            'per_page' => $perPage,
        ]));

        return view('admin.pulau-index', compact(
            'perPage', 'halaman', 'offset', 'search', 'sortBy', 'sortDir',
            'total', 'totalPages', 'data', 'queryBase'
        ));
    }

    public function create()
    {
        $edit = false;
        $editData = null;

        return view('admin.pulau-form', compact('edit', 'editData'));
    }

    public function edit($id)
    {
        $edit = true;
        $editData = Pulau::findOrFail($id)->toArray();

        return view('admin.pulau-form', compact('edit', 'editData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'max:100'],
            'keterangan' => ['required'],
            'deskripsi' => ['required'],
            'gambar' => ['nullable', 'image', 'max:3072'],
            'herosection' => ['nullable', 'image', 'max:3072'],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = basename($request->file('gambar')->store('foto', 'public'));
        }
        if ($request->hasFile('herosection')) {
            $validated['herosection'] = basename($request->file('herosection')->store('foto', 'public'));
        }

        Pulau::create($validated);

        return redirect()->route('admin.pulau.index', ['pesan' => 'tambah']);
    }

    public function update(Request $request, $id)
    {
        $pulau = Pulau::findOrFail($id);
        $validated = $request->validate([
            'nama' => ['required', 'max:100'],
            'keterangan' => ['required'],
            'deskripsi' => ['required'],
            'gambar' => ['nullable', 'image', 'max:3072'],
            'herosection' => ['nullable', 'image', 'max:3072'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($pulau->gambar) Storage::disk('public')->delete('foto/'.$pulau->gambar);
            $validated['gambar'] = basename($request->file('gambar')->store('foto', 'public'));
        } else {
            unset($validated['gambar']);
        }
        if ($request->hasFile('herosection')) {
            if ($pulau->herosection) Storage::disk('public')->delete('foto/'.$pulau->herosection);
            $validated['herosection'] = basename($request->file('herosection')->store('foto', 'public'));
        } else {
            unset($validated['herosection']);
        }

        $pulau->update($validated);

        return redirect()->route('admin.pulau.index', ['pesan' => 'edit']);
    }

    public function destroy($id)
    {
        $pulau = Pulau::findOrFail($id);
        if ($pulau->gambar) Storage::disk('public')->delete('foto/'.$pulau->gambar);
        if ($pulau->herosection) Storage::disk('public')->delete('foto/'.$pulau->herosection);
        $pulau->delete();

        return redirect()->route('admin.pulau.index');
    }
}
