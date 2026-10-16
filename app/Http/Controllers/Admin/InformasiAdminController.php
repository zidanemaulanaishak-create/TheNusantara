<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Pulau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiAdminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage > 0 ? $perPage : 10;
        $halaman = max(1, (int) $request->query('page_num', 1));
        $offset = ($halaman - 1) * $perPage;

        $search = $request->query('search', '');
        $filterPulau = $request->query('filter_pulau', '');

        $allowedSort = ['id', 'judul', 'pulau', 'created_at'];
        $sortBy = in_array($request->query('sort'), $allowedSort) ? $request->query('sort') : 'id';
        $sortDir = $request->query('dir') === 'desc' ? 'DESC' : 'ASC';

        $query = Informasi::query();
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }
        if ($filterPulau !== '') {
            $pulauId = Pulau::where('nama', $filterPulau)->value('id');
            $query->where('pulau_id', $pulauId);
        }

        $total = $query->count();
        $totalPages = (int) ceil($total / $perPage);

        $data = $query->orderBy($sortBy, $sortDir)->skip($offset)->take($perPage)->get()->toArray();

        $pulauOptions = Pulau::orderBy('nama')->get(['nama'])->toArray();

        $queryBase = http_build_query(array_filter([
            'page' => 'kelolainformasi',
            'search' => $search,
            'filter_pulau' => $filterPulau,
            'sort' => $sortBy,
            'dir' => $sortDir,
            'per_page' => $perPage,
        ]));

        return view('admin.informasi-index', compact(
            'perPage', 'halaman', 'offset', 'search', 'filterPulau',
            'sortBy', 'sortDir', 'total', 'totalPages', 'data',
            'pulauOptions', 'queryBase'
        ));
    }

    public function create()
    {
        $edit = false;
        $editData = null;
        $pulauOptions = Pulau::orderBy('nama')->get(['nama'])->toArray();

        return view('admin.informasi-form', compact('edit', 'editData', 'pulauOptions'));
    }

    public function edit($id)
    {
        $edit = true;
        $editData = Informasi::findOrFail($id)->toArray();
        $pulauOptions = Pulau::orderBy('nama')->get(['nama'])->toArray();

        return view('admin.informasi-form', compact('edit', 'editData', 'pulauOptions'));
    }

    private function handleUploads(Request $request, $existing = null): array
    {
        $out = [];
        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $field) {
            if ($request->hasFile($field)) {
                if ($existing && ! empty($existing->$field)) {
                    Storage::disk('public')->delete('foto/'.$existing->$field);
                }
                $out[$field] = basename($request->file($field)->store('foto', 'public'));
            }
        }
        return $out;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'max:255'],
            'pulau' => ['required', 'max:100'],
            'pengertian' => ['required'],
            'cara_bermain' => ['required'],
            'filosofi' => ['nullable'],
            'asal_usul' => ['nullable'],
            'keterangan' => ['nullable'],
            'caption2' => ['nullable', 'max:255'],
            'caption3' => ['nullable', 'max:255'],
            'caption4' => ['nullable', 'max:255'],
            'gambar' => ['required', 'image', 'max:3072'],
            'gambar2' => ['nullable', 'image', 'max:3072'],
            'gambar3' => ['nullable', 'image', 'max:3072'],
            'gambar4' => ['nullable', 'image', 'max:3072'],
        ]);

        $validated['pulau_id'] = Pulau::where('nama', $request->input('pulau'))->value('id');
        $validated = array_merge($validated, $this->handleUploads($request));
        Informasi::create($validated);

        return redirect()->route('admin.informasi.index', ['pesan' => 'tambah']);
    }

    public function update(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);
        $validated = $request->validate([
            'judul' => ['required', 'max:255'],
            'pulau' => ['required', 'max:100'],
            'pengertian' => ['required'],
            'cara_bermain' => ['required'],
            'filosofi' => ['nullable'],
            'asal_usul' => ['nullable'],
            'keterangan' => ['nullable'],
            'caption2' => ['nullable', 'max:255'],
            'caption3' => ['nullable', 'max:255'],
            'caption4' => ['nullable', 'max:255'],
            'gambar' => ['nullable', 'image', 'max:3072'],
            'gambar2' => ['nullable', 'image', 'max:3072'],
            'gambar3' => ['nullable', 'image', 'max:3072'],
            'gambar4' => ['nullable', 'image', 'max:3072'],
        ]);

        $validated['pulau_id'] = Pulau::where('nama', $request->input('pulau'))->value('id');
        $validated = array_merge($validated, $this->handleUploads($request, $info));

        foreach (['gambar2', 'gambar3', 'gambar4'] as $field) {
            $flag = 'hapus_'.$field;
            if ($request->boolean($flag) && $info->$field) {
                Storage::disk('public')->delete('foto/'.$info->$field);
                $validated[$field] = null;
            }
        }

        $info->update($validated);

        return redirect()->route('admin.informasi.index', ['pesan' => 'edit']);
    }

    public function destroy($id)
    {
        $info = Informasi::findOrFail($id);
        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $field) {
            if ($info->$field) Storage::disk('public')->delete('foto/'.$info->$field);
        }
        $info->delete();

        return redirect()->route('admin.informasi.index');
    }
}
