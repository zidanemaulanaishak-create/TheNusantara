@extends('layouts.admin')
@section('title', 'Laporan User - The Nusantara')
@section('content')
<div class="main-content">
    <h1>Laporan User</h1>
    <p class="page-sub">Daftar laporan yang masuk dari pengguna.</p>

    <!-- TOOLBAR -->
    <div class="ki-toolbar">
        <div></div>
        <div class="ki-toolbar-right">
            <form method="GET" action="{{ route('admin.laporan.index') }}" id="filterForm" style="display:flex; gap:10px; align-items:center;">

                <!-- Filter Status -->
                <select name="filter_status" class="ki-select"
                    onchange="document.getElementById('filterForm').submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ $filterStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="proses" {{ $filterStatus == 'proses' ? 'selected' : '' }}>Proses</option>
                </select>

                <!-- Per halaman -->
                <select name="per_page" class="ki-select" onchange="document.getElementById('filterForm').submit()">
                    @foreach([5, 10, 25, 50] as $n)
                        <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>
                            {{ $n }} / halaman
                        </option>
                    @endforeach
                </select>

                <!-- Search -->
                <div class="ki-search-wrap">
                    <i class="fas fa-search ki-search-icon"></i>
                    <input type="text" name="search" class="ki-search-input" placeholder="Cari nama, email, pesan..."
                        value="{{ $search }}">
                </div>

                <input type="hidden" name="sort" value="{{ $sortBy }}">
                <input type="hidden" name="dir" value="{{ $sortDir }}">
            </form>
        </div>
    </div>

    <!-- TABEL -->
    <div class="ki-table-card">
        <table class="ki-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&sort=nama&dir={{ $sortBy == 'nama' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Nama {{ $sortBy == 'nama' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>
                        <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&sort=created_at&dir={{ $sortBy == 'created_at' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Tanggal {{ $sortBy == 'created_at' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&sort=status&dir={{ $sortBy == 'status' && $sortDir == 'ASC' ? 'desc' : 'asc' }}&page_num=1"
                            style="color:white;text-decoration:none;">
                            Status {{ $sortBy == 'status' ? ($sortDir == 'ASC' ? '↑' : '↓') : '↕' }}
                        </a>
                    </th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                    @php $no = $offset + 1; @endphp
                    @foreach($data as $row)
                        <tr id="row-{{ $row['id'] }}">
                            <td>{{ $no++ }}</td>
                            <td>{{ $row['nama'] }}</td>
                            <td>{{ $row['email'] }}</td>
                            <td class="td-isi">{{ mb_substr($row['pesan'], 0, 60) }}...</td>
                            <td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
                            <td>
                                <span class="lap-status status-{{ $row['status'] }}" id="status-{{ $row['id'] }}">
                                    {{ ucfirst($row['status']) }}
                                </span>
                            </td>
                            <td>
                                <div class="ki-aksi">
                                    @if($row['status'] == 'pending')
                                        <button class="ki-btn-proses" onclick="ubahStatus({{ $row['id'] }}, 'proses')">
                                            <i class="fas fa-spinner"></i> Proses
                                        </button>
                                    @elseif($row['status'] == 'proses')
                                        <button class="ki-btn-selesai" onclick="ubahStatus({{ $row['id'] }}, 'selesai')">
                                            <i class="fas fa-check"></i> Selesai
                                        </button>
                                    @endif
                                    <a href="{{ route('admin.laporan.destroy', $row['id']) }}" class="ki-btn-hapus"
                                        onclick="return confirm('Hapus laporan ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="ki-empty">
                            <i class="fas fa-inbox"></i><br>Belum ada laporan masuk.
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
                    <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&page_num=1" class="ki-page-btn">«</a>
                    <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&page_num={{ $halaman - 1 }}" class="ki-page-btn">‹</a>
                @endif
                @php
                    $start = max(1, $halaman - 2);
                    $end = min($totalPages, $halaman + 2);
                @endphp
                @for($i = $start; $i <= $end; $i++)
                    <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&page_num={{ $i }}"
                        class="ki-page-btn {{ $i == $halaman ? 'active' : '' }}">{{ $i }}</a>
                @endfor
                @if($halaman < $totalPages)
                    <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&page_num={{ $halaman + 1 }}" class="ki-page-btn">›</a>
                    <a href="{{ route('admin.laporan.index') }}?{!! $queryBase !!}&page_num={{ $totalPages }}" class="ki-page-btn">»</a>
                @endif
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    function ubahStatus(id, status) {
        fetch("{{ route('admin.laporan.status') }}", {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}&status=${status}&_token=${encodeURIComponent(CSRF_TOKEN)}`
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (status === 'selesai') {
                        document.getElementById('row-' + id).remove();
                    } else {
                        document.getElementById('status-' + id).textContent = 'Proses';
                        document.getElementById('status-' + id).className = 'lap-status status-proses';
                        const aksi = document.querySelector('#row-' + id + ' .ki-aksi');
                        aksi.innerHTML = `
                        <button class="ki-btn-selesai" onclick="ubahStatus(${id}, 'selesai')">
                            <i class="fas fa-check"></i> Selesai
                        </button>
                        <a href="{{ url('/admin/laporan/hapus') }}/${id}" class="ki-btn-hapus"
                            onclick="return confirm('Hapus laporan ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>`;
                    }
                }
            });
    }
</script>
@endpush
@endsection
