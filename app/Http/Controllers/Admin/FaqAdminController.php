<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqAdminController extends Controller
{
    public function index(Request $request)
    {
        $edit = false;
        $editData = null;

        if ($request->query('edit')) {
            $row = Faq::find($request->query('edit'));
            if ($row) {
                $edit = true;
                $editData = $row->toArray();
            }
        }

        $search = $request->query('search', '');

        $query = Faq::query();
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                    ->orWhere('jawaban', 'like', "%{$search}%");
            });
        }

        $data = $query->orderBy('id')->get()->toArray();

        return view('admin.faq-index', compact('edit', 'editData', 'search', 'data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'max:255'],
            'jawaban' => ['required'],
        ]);
        Faq::create($validated);

        return redirect()->route('admin.faq.index', ['pesan' => 'tambah']);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $validated = $request->validate([
            'pertanyaan' => ['required', 'max:255'],
            'jawaban' => ['required'],
        ]);
        $faq->update($validated);

        return redirect()->route('admin.faq.index', ['pesan' => 'edit']);
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();

        return redirect()->route('admin.faq.index', ['pesan' => 'hapus']);
    }
}
