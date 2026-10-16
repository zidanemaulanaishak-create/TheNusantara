@extends('layouts.admin')
@section('title', 'Kelola Pulau - The Nusantara')
@section('content')
<div class="main-content">
    <h1>Kelola Pulau</h1>
    <p class="page-sub">Tambah dan kelola data pulau.</p>

    <!-- TOOLBAR -->
    <div class="ki-toolbar">
        <a href="{{ route('admin.pulau.create') }}" class="ki-btn-tambah">
            <i class="fas fa-plus"></i> Tambah Pulau
        </a>
        <div class="ki-toolbar-right">
            <form method="GET" action="{{ route('admin.pulau.index') }}" id="filterForm" style="display:flex; gap:10px; align-items:center;">
                <select name="per_page" class="ki-select" onchange="document.getElementById('filterForm').submit()">
                    @foreach([5, 10, 25, 50] as $n)
                        <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>
                            {{ $n }} / halaman
                        </option>
                    @endforeach
                </select>
                <div class="ki-search-wrap">
                    <i class="fas fa-search ki-search-icon"></i>
                    <input type="text" name="search" class="ki-search-input" placeholder="Cari nama pulau..."
                        value="{{ $search }}">
                </div>
                <input type="hidden" name="sort" value="{{ $sortBy }}">
                <input type="hidden" name="dir" value="{{ $sortDir }}">
            </form>
        </div>
    </div>

    @if(request('pesan'))
        <div class="ki-alert ki-alert-success">
            {{ request('pesan') == 'tambah' ? 'Pulau berhasil ditambahkan.' : 'Pulau berhasil diperbarui.' }}
        </div>
    @endif

    <!-- TABEL -->
    <div class="ki-table-card">
        <table class="ki-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="?{!! $queryBase !!}&sort=nama&dir={{ $sortBy == 'nama' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Nama Pulau {{ $sortBy == 'nama' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>Keterangan</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Hero Section</th>
                    <th>
                        <a href="?{!! $queryBase !!}&sort=created_at&dir={{ $sortBy == 'created_at' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
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
                        <tr data-nama="{{ $row['nama'] }}"
                            data-keterangan="{{ $row['keterangan'] ?? '-' }}"
                            data-deskripsi="{{ $row['deskripsi'] ?? '-' }}"
                            data-gambar="{{ $row['gambar'] ?? '' }}"
                            data-hero="{{ $row['herosection'] ?? '' }}">
                            <td>{{ $no++ }}</td>
                            <td><strong>{{ $row['nama'] }}</strong></td>
                            <td class="td-isi">{{ mb_substr($row['keterangan'] ?? '-', 0, 60) }}...</td>
                            <td class="td-isi">{{ mb_substr($row['deskripsi'] ?? '-', 0, 60) }}...</td>
                            <td>
                                @if(!empty($row['gambar']))
                                    <img src="{{ asset('storage/foto/'.$row['gambar']) }}" class="ki-thumb"
                                        style="object-fit:contain;background:#f5f0e8;">
                                @else
                                    <span class="ki-no-img">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($row['herosection']))
                                    <img src="{{ asset('storage/foto/'.$row['herosection']) }}" class="ki-thumb"
                                        style="object-fit:cover;">
                                @else
                                    <span class="ki-no-img">-</span>
                                @endif
                            </td>
                            <td>
                                {{ isset($row['created_at'])
                                    ? date('d M Y', strtotime($row['created_at']))
                                    : '-' }}
                            </td>
                            <td>
                                <div class="ki-aksi">
                                    <button class="ki-btn-detail" onclick="showDetail(this)">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('admin.pulau.destroy', $row['id']) }}" class="ki-btn-hapus"
                                        onclick="return confirm('Hapus pulau ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                    <a href="{{ route('admin.pulau.edit', $row['id']) }}" class="ki-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="ki-empty">
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
                    <a href="{{ route('admin.pulau.index') }}?{!! $queryBase !!}&page_num=1" class="ki-page-btn">«</a>
                    <a href="{{ route('admin.pulau.index') }}?{!! $queryBase !!}&page_num={{ $halaman - 1 }}" class="ki-page-btn">‹</a>
                @endif
                @php
                    $start = max(1, $halaman - 2);
                    $end = min($totalPages, $halaman + 2);
                @endphp
                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ route('admin.pulau.index') }}?{!! $queryBase !!}&page_num={{ $i }}"
                        class="ki-page-btn {{ $i == $halaman ? 'active' : '' }}">{{ $i }}</a>
                @endfor
                @if($halaman < $totalPages)
                    <a href="{{ route('admin.pulau.index') }}?{!! $queryBase !!}&page_num={{ $halaman + 1 }}" class="ki-page-btn">›</a>
                    <a href="{{ route('admin.pulau.index') }}?{!! $queryBase !!}&page_num={{ $totalPages }}" class="ki-page-btn">»</a>
                @endif
            </div>
        </div>
    @endif
</div>

<!-- MODAL DETAIL -->
<div class="ki-modal-overlay" id="modalDetail">
    <div class="ki-modal">
        <button class="ki-modal-close" onclick="closeDetail()">✕</button>
        <h2 class="ki-modal-title" id="d-nama"></h2>
        <div style="display:flex;gap:12px;margin:12px 0;">
            <img id="d-gambar" src="" alt=""
                style="display:none;height:100px;object-fit:contain;border-radius:8px;background:#f5f0e8;padding:4px;">
            <img id="d-hero" src="" alt="" style="display:none;height:100px;object-fit:cover;border-radius:8px;flex:1;">
        </div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Keterangan</div>
            <p id="d-keterangan"></p>
        </div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Deskripsi</div>
            <p id="d-deskripsi"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const FOTO_URL = "{{ asset('storage/foto') }}";

    function showDetail(btn) {
        const tr = btn.closest('tr');
        document.getElementById('d-nama').textContent = tr.dataset.nama;
        document.getElementById('d-keterangan').textContent = tr.dataset.keterangan;
        document.getElementById('d-deskripsi').textContent = tr.dataset.deskripsi;

        const gEl = document.getElementById('d-gambar');
        if (tr.dataset.gambar) {
            gEl.src = FOTO_URL + '/' + tr.dataset.gambar;
            gEl.style.display = 'block';
        } else { gEl.style.display = 'none'; }

        const hEl = document.getElementById('d-hero');
        if (tr.dataset.hero) {
            hEl.src = FOTO_URL + '/' + tr.dataset.hero;
            hEl.style.display = 'block';
        } else { hEl.style.display = 'none'; }

        document.getElementById('modalDetail').classList.add('active');
    }

    function closeDetail() {
        document.getElementById('modalDetail').classList.remove('active');
    }

    const modalEl = document.getElementById('modalDetail');
    if (modalEl) {
        modalEl.addEventListener('click', function (e) {
            if (e.target === this) closeDetail();
        });
    }

    setTimeout(() => {
        const alert = document.querySelector('.ki-alert');
        if (alert) alert.style.display = 'none';
    }, 3000);
</script>
@endpush
@endsection
