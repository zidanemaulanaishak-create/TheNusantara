<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search', '');

        $query = Tentang::query();
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('isi', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('id')->get()->toArray();

        return view('admin.tentang-index', compact('search', 'data'));
    }

    public function create()
    {
        $editData = null;

        return view('admin.tentang-form', compact('editData'));
    }

    public function edit($id)
    {
        $editData = Tentang::findOrFail($id)->toArray();

        return view('admin.tentang-form', compact('editData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['nullable', 'max:250'],
            'isi' => ['nullable'],
            'gambar' => ['nullable', 'image', 'max:3072'],
            'gambar2' => ['nullable', 'image', 'max:3072'],
            'gambar3' => ['nullable', 'image', 'max:3072'],
        ]);
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = basename($request->file($field)->store('foto', 'public'));
            }
        }
        Tentang::create($validated);

        return redirect()->route('admin.tentang.index', ['pesan' => 'tambah']);
    }

    public function update(Request $request, $id)
    {
        $tentang = Tentang::findOrFail($id);
        $validated = $request->validate([
            'judul' => ['nullable', 'max:250'],
            'isi' => ['nullable'],
            'gambar' => ['nullable', 'image', 'max:3072'],
            'gambar2' => ['nullable', 'image', 'max:3072'],
            'gambar3' => ['nullable', 'image', 'max:3072'],
        ]);
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if ($request->hasFile($field)) {
                if ($tentang->$field) Storage::disk('public')->delete('foto/'.$tentang->$field);
                $validated[$field] = basename($request->file($field)->store('foto', 'public'));
            } elseif ($request->has('existing_'.$field) && $request->input('existing_'.$field) === '' && $tentang->$field) {
                Storage::disk('public')->delete('foto/'.$tentang->$field);
                $validated[$field] = null;
            } else {
                unset($validated[$field]);
            }
        }
        $tentang->update($validated);

        return redirect()->route('admin.tentang.index', ['pesan' => 'edit']);
    }

    public function destroy($id)
    {
        $tentang = Tentang::findOrFail($id);
        foreach (['gambar', 'gambar2', 'gambar3'] as $field) {
            if ($tentang->$field) Storage::disk('public')->delete('foto/'.$tentang->$field);
        }
        $tentang->delete();

        return redirect()->route('admin.tentang.index');
    }
}
