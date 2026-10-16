@extends('layouts.admin')
@section('title', 'Kelola Galeri - The Nusantara')
@section('content')
<div class="main-content">
    <h1>Kelola Galeri</h1>
    <p class="page-sub">Tambah dan kelola galeri.</p>

    <!-- TOOLBAR -->
    <div class="ki-toolbar">
        <a href="#" class="ki-btn-tambah" onclick="toggleForm(); return false;">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
        <div class="ki-toolbar-right">
            <form method="GET" action="{{ route('admin.galeri.index') }}" id="filterForm" style="display:flex; gap:10px; align-items:center;">
                <select name="per_page" class="ki-select" onchange="document.getElementById('filterForm').submit()">
                    @foreach([5, 10, 25, 50] as $n)
                        <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>
                            {{ $n }} / halaman
                        </option>
                    @endforeach
                </select>
                <div class="ki-search-wrap">
                    <i class="fas fa-search ki-search-icon"></i>
                    <input type="text" name="search" class="ki-search-input" placeholder="Cari judul..."
                        value="{{ $search }}">
                </div>
                <input type="hidden" name="sort" value="{{ $sortBy }}">
                <input type="hidden" name="dir" value="{{ $sortDir }}">
            </form>
        </div>
    </div>

    <!-- FORM TAMBAH/EDIT (tetap inline seperti aslinya) -->
    <div class="ki-form-card" id="formTambah" style="display:{{ $edit ? 'block' : 'none' }}; margin-top:16px;">
        <form method="POST" action="{{ $edit ? route('admin.galeri.update', $editData['id']) : route('admin.galeri.store') }}"
            enctype="multipart/form-data" class="ki-form">
            @csrf
            @if($edit)
                @method('PUT')
            @endif

            <div class="ki-form-group">
                <label>Judul</label>
                <input type="text" name="judul" value="{{ $edit ? $editData['judul'] : '' }}"
                    placeholder="Masukkan judul..." required>
            </div>

            <div class="ki-form-group">
                <label>Gambar</label>
                @if($edit && !empty($editData['gambar']))
                    <div style="margin-bottom: 8px;">
                        <p style="font-size:13px; color:#666; margin-bottom:4px;">Gambar saat ini:</p>
                        <img src="{{ asset('storage/foto/'.$editData['gambar']) }}"
                            style="height:80px; border-radius:6px; object-fit:cover;">
                        <p style="font-size:12px; color:#999; margin-top:4px;">
                            Biarkan kosong jika tidak ingin mengganti gambar.
                        </p>
                    </div>
                @endif
                <input type="file" name="gambar" accept="image/*">
            </div>

            <div class="ki-form-actions">
                <button type="submit" name="{{ $edit ? 'update' : 'tambah' }}" class="ki-btn-add">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <button type="reset" class="ki-btn-cancel">
                    <i class="fas fa-times"></i> Reset
                </button>
            </div>
        </form>
    </div>

    @if(request('pesan'))
        <div class="ki-alert ki-alert-success">
            {{ request('pesan') == 'tambah' ? 'Data berhasil ditambahkan.' : 'Data berhasil diperbarui.' }}
        </div>
    @endif

    <!-- TABEL -->
    <div class="ki-table-card">
        <table class="ki-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&sort=judul&dir={{ $sortBy == 'judul' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Judul {{ $sortBy == 'judul' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>Gambar</th>
                    <th>
                        <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&sort=created_at&dir={{ $sortBy == 'created_at' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Tanggal {{ $sortBy == 'created_at' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                    @php $no = $offset + 1; @endphp
                    @foreach($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><strong>{{ $row['judul'] }}</strong></td>
                            <td>
                                @if(!empty($row['gambar']))
                                    <img src="{{ asset('storage/foto/'.$row['gambar']) }}" class="ki-thumb">
                                @else
                                    <span class="ki-no-img">-</span>
                                @endif
                            </td>
                            <td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
                            <td>
                                <div class="ki-aksi">
                                    <a href="{{ route('admin.galeri.destroy', $row['id']) }}" class="ki-btn-hapus"
                                        onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                    <a href="{{ route('admin.galeri.index') }}?edit={{ $row['id'] }}" class="ki-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="ki-empty">
                            <i class="fas fa-inbox"></i><br>Tidak ada data ditemukan.
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    @if($totalPages > 1)
        <div class="ki-pagination">
            <span class="ki-page-info">
                Menampilkan {{ $offset + 1 }}–{{ min($offset + $perPage, $total) }} dari {{ $total }} data
            </span>
            <div class="ki-page-btns">
                @if($halaman > 1)
                    <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&page_num=1" class="ki-page-btn">«</a>
                    <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&page_num={{ $halaman - 1 }}" class="ki-page-btn">‹</a>
                @endif
                @php
                    $start = max(1, $halaman - 2);
                    $end = min($totalPages, $halaman + 2);
                @endphp
                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&page_num={{ $i }}"
                        class="ki-page-btn {{ $i == $halaman ? 'active' : '' }}">{{ $i }}</a>
                @endfor
                @if($halaman < $totalPages)
                    <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&page_num={{ $halaman + 1 }}" class="ki-page-btn">›</a>
                    <a href="{{ route('admin.galeri.index') }}?{!! $queryBase !!}&page_num={{ $totalPages }}" class="ki-page-btn">»</a>
                @endif
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function toggleForm() {
        const form = document.getElementById('formTambah');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    setTimeout(() => {
        const alert = document.querySelector('.ki-alert');
        if (alert) alert.style.display = 'none';
    }, 3000);
</script>
@endpush
@endsection
