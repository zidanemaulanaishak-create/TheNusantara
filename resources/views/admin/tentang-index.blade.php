@extends('layouts.admin')
@section('title', 'Kelola Tentang - The Nusantara')
@section('content')
<style>
    /* ====== MODAL DETAIL ====== */
    .ki-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(26, 10, 2, 0.5);
        z-index: 999;
        align-items: center;
        justify-content: center;
    }

    .ki-modal-overlay.active {
        display: flex;
    }

    .ki-modal {
        background: #fefefe;
        border-radius: 14px;
        border: 1.5px solid #58290D;
        padding: 32px 36px;
        max-width: 560px;
        width: 90%;
        position: relative;
        max-height: 85vh;
        overflow-y: auto;
    }

    .ki-modal-close {
        position: absolute;
        top: 14px;
        right: 16px;
        background: none;
        border: none;
        font-size: 18px;
        color: #58290D;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity .2s;
    }

    .ki-modal-close:hover {
        opacity: 1;
    }

    .ki-modal-title {
        font-size: 20px;
        font-weight: 500;
        color: #3d1b08;
        margin-bottom: 16px;
    }

    .ki-modal-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 12px;
        border: 0.5px solid #58290D;
    }

    .ki-modal-extra-imgs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .ki-modal-extra-imgs img {
        border: 0.5px solid #58290D;
        border-radius: 8px;
    }

    .ki-modal-section {
        margin-top: 14px;
    }

    .ki-modal-section-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        color: #58290D;
        margin-bottom: 10px;
    }

    .ki-modal-section-label::after {
        content: '';
        flex: 1;
        height: 0.5px;
        background: #58290D;
    }

    .ki-modal-section p {
        font-size: 14px;
        color: #58290D;
        line-height: 1.8;
    }
</style>

<div class="main-content">
    <h1>Kelola Tentang</h1>
    <p class="page-sub">Tambah dan kelola konten tentang website.</p>

    <!-- TOOLBAR -->
    <div class="ki-toolbar">
        <a href="{{ route('admin.tentang.create') }}" class="ki-btn-tambah">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
        <div class="ki-toolbar-right">
            <form method="GET" action="{{ route('admin.tentang.index') }}" id="filterForm" style="display:flex; gap:10px; align-items:center;">
                <div class="ki-search-wrap">
                    <i class="fas fa-search ki-search-icon"></i>
                    <input type="text" name="search" class="ki-search-input" placeholder="Cari judul, isi..."
                        value="{{ $search }}">
                </div>
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
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Gambar 1</th>
                    <th>Gambar 2</th>
                    <th>Gambar 3</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                    @php $no = 1; @endphp
                    @foreach($data as $row)
                        <tr data-judul="{{ $row['judul'] }}"
                            data-isi="{{ $row['isi'] ?? '-' }}"
                            data-gambar="{{ $row['gambar'] ?? '' }}"
                            data-gambar2="{{ $row['gambar2'] ?? '' }}"
                            data-gambar3="{{ $row['gambar3'] ?? '' }}">
                            <td>{{ $no++ }}</td>
                            <td><strong>{{ $row['judul'] }}</strong></td>
                            <td>{{ mb_substr($row['isi'] ?? '-', 0, 60) }}...</td>
                            <td>
                                @if(!empty($row['gambar']))
                                    <img src="{{ asset('storage/foto/'.$row['gambar']) }}" class="ki-thumb">
                                @else
                                    <span class="ki-no-img">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($row['gambar2']))
                                    <img src="{{ asset('storage/foto/'.$row['gambar2']) }}" class="ki-thumb">
                                @else
                                    <span class="ki-no-img">-</span>
                                @endif
                            </td>
                            <td>
                                @if(!empty($row['gambar3']))
                                    <img src="{{ asset('storage/foto/'.$row['gambar3']) }}" class="ki-thumb">
                                @else
                                    <span class="ki-no-img">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="ki-aksi">
                                    <button class="ki-btn-detail" onclick="showDetail(this)">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <a href="{{ route('admin.tentang.destroy', $row['id']) }}" class="ki-btn-hapus"
                                        onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                    <a href="{{ route('admin.tentang.edit', $row['id']) }}" class="ki-btn-edit">
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
</div>

<!-- ====== MODAL DETAIL ====== -->
<div class="ki-modal-overlay" id="modalDetail">
    <div class="ki-modal">
        <button class="ki-modal-close" onclick="closeDetail()">✕</button>
        <h2 class="ki-modal-title" id="d-judul"></h2>
        <img class="ki-modal-img" id="d-gambar" src="" alt="" style="display:none;">
        <div class="ki-modal-extra-imgs" id="d-extra-imgs"></div>
        <div class="ki-modal-section">
            <div class="ki-modal-section-label">Isi</div>
            <p id="d-isi"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const FOTO_URL = "{{ asset('storage/foto') }}";

    function showDetail(btn) {
        const tr = btn.closest('tr');

        document.getElementById('d-judul').textContent = tr.dataset.judul;
        document.getElementById('d-isi').textContent = tr.dataset.isi;

        const imgEl = document.getElementById('d-gambar');
        if (tr.dataset.gambar) {
            imgEl.src = FOTO_URL + '/' + tr.dataset.gambar;
            imgEl.style.display = 'block';
        } else {
            imgEl.style.display = 'none';
        }

        const extraWrap = document.getElementById('d-extra-imgs');
        extraWrap.innerHTML = '';
        [tr.dataset.gambar2, tr.dataset.gambar3].forEach(file => {
            if (!file) return;
            const img = document.createElement('img');
            img.src = FOTO_URL + '/' + file;
            img.style.cssText = 'width:100%;height:100px;object-fit:cover;border-radius:8px;display:block;';
            extraWrap.appendChild(img);
        });

        document.getElementById('modalDetail').classList.add('active');
    }

    function closeDetail() {
        document.getElementById('modalDetail').classList.remove('active');
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
