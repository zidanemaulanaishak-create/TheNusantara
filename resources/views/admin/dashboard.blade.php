@extends('layouts.admin')
@section('title', 'Dashboard - The Nusantara')
@section('content')
<div class="main-content">
    <!-- ===== TOPBAR ===== -->
    <div class="topbar">
        <div class="topbar-left">
            <h1>Dashboard</h1>
            <p class="page-sub">Selamat datang kembali, Admin! Berikut update terbaru hari ini.</p>
        </div>
        <div class="topbar-right">

            <!-- Notifikasi -->
            <div class="topbar-notif" onclick="toggleNotif(event)">
                <i class="fas fa-bell"></i>
                @if($jumlahNotif > 0)
                    <span class="notif-badge">{{ $jumlahNotif }}</span>
                @endif

                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-header">
                        <span>Notifikasi</span>
                        <small>{{ $jumlahNotif }} baru</small>
                    </div>

                    @if(!empty($notifData))
                        @foreach($notifData as $notif)
                            <div class="notif-item unread">
                                <div class="notif-icon-wrap orange">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="notif-text">
                                    <p>{{ $notif->nama }} mengirim laporan</p>
                                    <small>{{ date('d M Y, H:i', strtotime($notif->created_at)) }}</small>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="notif-item">
                            <div class="notif-icon-wrap gray"><i class="fas fa-check"></i></div>
                            <div class="notif-text">
                                <p>Tidak ada notifikasi baru</p>
                                <small>Semua laporan sudah diproses</small>
                            </div>
                        </div>
                    @endif

                    <div class="notif-footer" onclick="tandaiSemua()">
                        Tandai semua sudah dibaca
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleNotif(e) {
            e.stopPropagation();
            document.getElementById('notifDropdown').classList.toggle('show');
        }

        document.addEventListener('click', function () {
            document.getElementById('notifDropdown').classList.remove('show');
        });

        function tandaiSemua() {
            fetch("{{ route('admin.notif.read') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: '_token=' + encodeURIComponent(CSRF_TOKEN)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.querySelectorAll('.notif-item.unread').forEach(el => el.classList.remove('unread'));
                    const badge = document.querySelector('.notif-badge');
                    if (badge) badge.style.display = 'none';
                    document.querySelector('.notif-header small').textContent = '0 baru';
                }
            });
        }
    </script>
    <div class="dashboard-grid">

        <div class="left-col">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
                        <span class="stat-label">Jumlah Informasi</span>
                    </div>
                    <span class="stat-value">{{ $jumlahArtikel }}</span>
                    <span class="stat-badge badge-up">{{ $persenLabel }}</span>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon"><i class="fas fa-images"></i></div>
                        <span class="stat-label">Jumlah Gambar</span>
                    </div>
                    <span class="stat-value">{{ $jumlahGaleri }}</span>
                    <span class="stat-badge badge-up">{{ $persenGaleri }}</span>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon"><i class="fas fa-eye"></i></div>
                        <span class="stat-label">Views Bulan Ini</span>
                    </div>
                    <span class="stat-value">{{ $viewsBulanIni }}</span>
                    <span class="stat-badge badge-up">{{ $persenViews }}</span>
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-header">
                    <h3>Statistik Pengunjung</h3>
                    <span class="chart-sub">7 hari terakhir</span>
                </div>
                <div style="position: relative; flex: 1;">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>
        </div>

        <div class="right-col">

            <div class="pulau-card">
                <div class="pulau-header">
                    <h3>Pulau Populer</h3>
                    <span>Bulan ini</span>
                </div>

                @php
                    $pulauList = $topPulau;
                    $maxViews = $pulauList->isNotEmpty() && $pulauList[0]['views'] > 0 ? $pulauList[0]['views'] : 1;
                @endphp

                @if($pulauList->isNotEmpty())
                    @php $rank = 1; @endphp
                    @foreach($pulauList as $p)
                        <div class="pulau-item">
                            <div class="pulau-rank {{ $rank <= 3 ? 'top' : '' }}">{{ $rank }}</div>
                            <div class="pulau-info">
                                <span class="pulau-nama">{{ $p['nama'] }}</span>
                            </div>
                            <div class="pulau-bar-wrap">
                                <div class="pulau-bar-bg">
                                    <div class="pulau-bar" style="width:{{ round(($p['views'] / $maxViews) * 100) }}%"></div>
                                </div>
                                <div class="pulau-views">{{ number_format($p['views']) }} views</div>
                            </div>
                        </div>
                        @php $rank++; @endphp
                    @endforeach
                @else
                    <p style="color:#999; font-size:13px; text-align:center; padding:20px 0;">Belum ada data views.</p>
                @endif

            </div>

            <div class="note-card">
                <div class="note-header">
                    <h3>Catatan</h3>
                </div>
                <textarea id="catatan" placeholder="Tulis catatan di sini..."></textarea>
                <button class="note-save-btn" onclick="simpanCatatan()">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <div class="note-list" id="noteList"></div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const existingChart = Chart.getChart('visitorChart');
    if (existingChart) existingChart.destroy();

    const ctx = document.getElementById('visitorChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! $visitorLabels !!},
            datasets: [{
                label: 'Pengunjung',
                data: {!! $visitorData !!},
                borderColor: '#3B1F0E',
                backgroundColor: 'rgba(59,31,14,0.08)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#3B1F0E',
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush
@endsection
