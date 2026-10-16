@extends('layouts.admin')
@section('title', 'Kelola FAQ - The Nusantara')
@section('content')
<div class="main-content">
    <h1>Kelola FAQ</h1>
    <p class="page-sub">Tambah dan kelola pertanyaan yang sering diajukan.</p>

    <!-- TOOLBAR -->
    <div class="ki-toolbar">
        <a href="#" class="ki-btn-tambah" onclick="toggleForm(); return false;">
            <i class="fas fa-plus"></i> Tambah FAQ
        </a>
        <div class="ki-toolbar-right">
            <form method="GET" action="{{ route('admin.faq.index') }}" id="filterForm" style="display:flex; gap:10px; align-items:center;">
                <div class="ki-search-wrap">
                    <i class="fas fa-search ki-search-icon"></i>
                    <input type="text" name="search" class="ki-search-input" placeholder="Cari pertanyaan..."
                        value="{{ $search }}">
                </div>
            </form>
        </div>
    </div>

    <!-- FORM TAMBAH / EDIT -->
    <div class="ki-form-card" id="formTambah" style="display:{{ $edit ? 'block' : 'none' }}; margin-top:16px;">
        <form method="POST" action="{{ $edit ? route('admin.faq.update', $editData['id']) : route('admin.faq.store') }}" class="ki-form">
            @csrf
            @if($edit)
                @method('PUT')
            @endif

            <div class="ki-form-group">
                <label>Pertanyaan</label>
                <input type="text" name="pertanyaan"
                    value="{{ $edit ? $editData['pertanyaan'] : '' }}"
                    placeholder="Masukkan pertanyaan..." required>
            </div>

            <div class="ki-form-group">
                <label>Jawaban</label>
                <textarea name="jawaban" rows="4"
                    placeholder="Masukkan jawaban...">{{ $edit ? $editData['jawaban'] : '' }}</textarea>
            </div>

            <div class="ki-form-actions">
                <button type="submit" name="{{ $edit ? 'update' : 'tambah' }}" class="ki-btn-add">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="button" class="ki-btn-cancel" onclick="toggleForm()">
                    <i class="fas fa-times"></i> Batal
                </button>
            </div>
        </form>
    </div>

    <!-- ALERT -->
    @if(request('pesan'))
        @php
            $pesan = [
                'tambah' => 'FAQ berhasil ditambahkan.',
                'edit' => 'FAQ berhasil diperbarui.',
                'hapus' => 'FAQ berhasil dihapus.',
            ];
        @endphp
        <div class="ki-alert ki-alert-success">
            {{ $pesan[request('pesan')] ?? 'Berhasil disimpan.' }}
        </div>
    @endif

    <!-- TABEL -->
    <div class="ki-table-card">
        <table class="ki-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Jawaban</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                    @php $no = 1; @endphp
                    @foreach($data as $row)
                        <tr data-pertanyaan="{{ $row['pertanyaan'] }}"
                            data-jawaban="{{ $row['jawaban'] }}">
                            <td>{{ $no++ }}</td>
                            <td style="text-align:left;">
                                <strong>{{ $row['pertanyaan'] }}</strong>
                            </td>
                            <td class="td-isi">
                                {{ mb_substr($row['jawaban'], 0, 80) }}...
                            </td>
                            <td>
                                <div class="ki-aksi">
                                    <button class="ki-btn-detail" onclick="showDetail(this)">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('admin.faq.index') }}?edit={{ $row['id'] }}" class="ki-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.faq.destroy', $row['id']) }}" class="ki-btn-hapus"
                                        onclick="return confirm('Hapus FAQ ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="ki-empty">
                            <i class="fas fa-inbox"></i><br>Belum ada data FAQ.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL DETAIL -->
<div id="modalDetail"
    style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div
        style="background:#fefefe; border-radius:14px; border:1.5px solid #58290D; padding:32px 36px; max-width:560px; width:92%; max-height:88vh; overflow-y:auto; position:relative; box-shadow:0 24px 64px rgba(26,10,2,0.2);">
        <button onclick="closeDetail()"
            style="position:absolute; top:14px; right:16px; background:none; border:none; font-size:20px; cursor:pointer; color:#58290D; opacity:0.6;">✕</button>
        <p
            style="font-size:14px; font-weight:500; text-transform:uppercase; color:#58290D; margin-bottom:8px; display:flex; align-items:center; gap:8px;">
            Pertanyaan <span style="flex:1; height:0.5px; background:#58290D; display:inline-block;"></span>
        </p>
        <p id="d-pertanyaan"
            style="font-size:17px; font-weight:700; color:#3d1b08; margin-bottom:24px; line-height:1.4;"></p>
        <p
            style="font-size:14px; font-weight:500; text-transform:uppercase; color:#58290D; margin-bottom:8px; display:flex; align-items:center; gap:8px;">
            Jawaban <span style="flex:1; height:0.5px; background:#58290D; display:inline-block;"></span>
        </p>
        <p id="d-jawaban" style="font-size:14px; line-height:1.75; color:#58290D; white-space:pre-line;"></p>
    </div>
</div>

@push('scripts')
<script>
    function toggleForm() {
        const form = document.getElementById('formTambah');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function showDetail(btn) {
        const tr = btn.closest('tr');
        document.getElementById('d-pertanyaan').textContent = tr.dataset.pertanyaan;
        document.getElementById('d-jawaban').textContent = tr.dataset.jawaban;
        const modal = document.getElementById('modalDetail');
        modal.style.display = 'flex';
    }

    function closeDetail() {
        document.getElementById('modalDetail').style.display = 'none';
    }

    document.getElementById('modalDetail').addEventListener('click', function (e) {
        if (e.target === this) closeDetail();
    });

    setTimeout(() => {
        const alert = document.querySelector('.ki-alert');
        if (alert) alert.style.display = 'none';
    }, 3000);
</script>
@endpush
@endsection
