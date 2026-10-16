@extends('layouts.admin')
@section('title', 'Kelola Informasi - The Nusantara')
@section('content')
<div class="main-content">
    <h1>Kelola Informasi</h1>
    <p class="page-sub">Tambah dan kelola informasi pulau.</p>

    <!-- TOOLBAR -->
    <div class="ki-toolbar">
        <a href="{{ route('admin.informasi.create') }}" class="ki-btn-tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
        <div class="ki-toolbar-right">
            <form method="GET" action="{{ route('admin.informasi.index') }}" id="filterForm" style="display:flex; gap:10px; align-items:center;">
                <select name="filter_pulau" class="ki-select" onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Pulau</option>
                    @foreach($pulauOptions as $p)
                        <option value="{{ $p['nama'] }}" {{ $filterPulau == $p['nama'] ? 'selected' : '' }}>
                            {{ $p['nama'] }}
                        </option>
                    @endforeach
                </select>
                <select name="per_page" class="ki-select" onchange="document.getElementById('filterForm').submit()">
                    @foreach([5, 10, 25, 50] as $n)
                        <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>{{ $n }} / halaman</option>
                    @endforeach
                </select>
                <div class="ki-search-wrap">
                    <i class="fas fa-search ki-search-icon"></i>
                    <input type="text" name="search" class="ki-search-input" placeholder="Cari judul, isi..."
                        value="{{ $search }}">
                </div>
                <input type="hidden" name="sort" value="{{ $sortBy }}">
                <input type="hidden" name="dir" value="{{ $sortDir }}">
            </form>
        </div>
    </div>

    @if(request('pesan'))
        <div class="ki-alert ki-alert-success">Data berhasil disimpan.</div>
    @endif

    <!-- TABEL -->
    <div class="ki-table-card">
        <table class="ki-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="?{!! $queryBase !!}&sort=judul&dir={{ $sortBy == 'judul' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Judul {{ $sortBy == 'judul' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>
                        <a href="?{!! $queryBase !!}&sort=pulau&dir={{ $sortBy == 'pulau' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Pulau {{ $sortBy == 'pulau' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>Keterangan</th>
                    <th>Gambar</th>
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
                        <tr data-judul="{{ $row['judul'] }}"
                            data-pulau="{{ $row['pulau'] }}"
                            data-pengertian="{{ $row['pengertian'] ?? '-' }}"
                            data-cara="{{ $row['cara_bermain'] ?? '-' }}"
                            data-filosofi="{{ $row['filosofi'] ?? '-' }}"
                            data-asal="{{ $row['asal_usul'] ?? '-' }}"
                            data-keterangan="{{ $row['keterangan'] ?? '-' }}"
                            data-gambar="{{ $row['gambar'] ?? '' }}"
                            data-gambar2="{{ $row['gambar2'] ?? '' }}"
                            data-gambar3="{{ $row['gambar3'] ?? '' }}"
                            data-gambar4="{{ $row['gambar4'] ?? '' }}"
                            data-caption2="{{ $row['caption2'] ?? '' }}"
                            data-caption3="{{ $row['caption3'] ?? '' }}"
                            data-caption4="{{ $row['caption4'] ?? '' }}">
                            <td>{{ $no++ }}</td>
                            <td><strong>{{ $row['judul'] }}</strong></td>
                            <td><span class="ki-badge">{{ $row['pulau'] }}</span></td>
                            <td class="td-isi">{{ mb_substr($row['keterangan'] ?? '-', 0, 60) }}...</td>
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
                                    <button class="ki-btn-detail" onclick="showDetail(this)">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('admin.informasi.destroy', $row['id']) }}" class="ki-btn-hapus"
                                        onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                    <a href="{{ route('admin.informasi.edit', $row['id']) }}" class="ki-btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="ki-empty">
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
                    <a href="?{!! $queryBase !!}&page_num=1" class="ki-page-btn">«</a>
                    <a href="?{!! $queryBase !!}&page_num={{ $halaman - 1 }}" class="ki-page-btn">‹</a>
                @endif
                @php
                    $start = max(1, $halaman - 2);
                    $end = min($totalPages, $halaman + 2);
                @endphp
                @for($i = $start; $i <= $end; $i++)
                    <a href="?{!! $queryBase !!}&page_num={{ $i }}"
                        class="ki-page-btn {{ $i == $halaman ? 'active' : '' }}">{{ $i }}</a>
                @endfor
                @if($halaman < $totalPages)
                    <a href="?{!! $queryBase !!}&page_num={{ $halaman + 1 }}" class="ki-page-btn">›</a>
                    <a href="?{!! $queryBase !!}&page_num={{ $totalPages }}" class="ki-page-btn">»</a>
                @endif
            </div>
        </div>
    @endif
</div>

<!-- ====== MODAL DETAIL ====== -->
<div class="ki-modal-overlay" id="modalDetail">
    <div class="ki-modal">
        <button class="ki-modal-close" onclick="closeDetail()">✕</button>
        <h2 class="ki-modal-title" id="d-judul"></h2>
        <span class="ki-modal-pulau" id="d-pulau"></span>
        <img class="ki-modal-img" id="d-gambar" src="" alt="" style="display:none;">
        <div class="ki-modal-extra-imgs" id="d-extra-imgs"></div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Pengertian</div>
            <p id="d-pengertian"></p>
        </div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Cara Bermain</div>
            <p id="d-cara"></p>
        </div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Filosofi</div>
            <p id="d-filosofi"></p>
        </div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Asal Usul</div>
            <p id="d-asal"></p>
        </div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Keterangan</div>
            <p id="d-keterangan"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const FOTO_URL = "{{ asset('storage/foto') }}";

    function showDetail(btn) {
        const tr = btn.closest('tr');
        document.getElementById('d-judul').textContent = tr.dataset.judul;
        document.getElementById('d-pulau').textContent = tr.dataset.pulau;
        document.getElementById('d-pengertian').textContent = tr.dataset.pengertian;
        document.getElementById('d-cara').textContent = tr.dataset.cara;
        document.getElementById('d-filosofi').textContent = tr.dataset.filosofi;
        document.getElementById('d-asal').textContent = tr.dataset.asal;
        document.getElementById('d-keterangan').textContent = tr.dataset.keterangan;

        const imgEl = document.getElementById('d-gambar');
        if (tr.dataset.gambar) {
            imgEl.src = FOTO_URL + '/' + tr.dataset.gambar;
            imgEl.style.display = 'block';
        } else {
            imgEl.style.display = 'none';
        }

        const extraWrap = document.getElementById('d-extra-imgs');
        extraWrap.innerHTML = '';
        [
            { file: tr.dataset.gambar2, cap: tr.dataset.caption2 },
            { file: tr.dataset.gambar3, cap: tr.dataset.caption3 },
            { file: tr.dataset.gambar4, cap: tr.dataset.caption4 },
        ].forEach(item => {
            if (!item.file) return;
            const div = document.createElement('div');
            div.style.flex = '1';
            div.style.minWidth = '80px';
            const img = document.createElement('img');
            img.src = FOTO_URL + '/' + item.file;
            img.style.cssText = 'width:100%;height:100px;object-fit:cover;border-radius:8px;display:block;';
            div.appendChild(img);
            if (item.cap) {
                const cap = document.createElement('p');
                cap.className = 'ki-modal-extra-cap';
                cap.textContent = item.cap;
                div.appendChild(cap);
            }
            extraWrap.appendChild(div);
        });

        document.getElementById('modalDetail').classList.add('active');
    }

    function closeDetail() {
        document.getElementById('modalDetail').classList.remove('active');
    }

    // Cek dulu sebelum addEventListener — biar tidak crash
    const modalEl = document.getElementById('modalDetail');
    if (modalEl) {
        modalEl.addEventListener('click', function(e) {
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
