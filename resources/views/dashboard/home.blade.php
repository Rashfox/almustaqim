@extends('dashboard/master')
@section('title', 'Dashboard Statistik')

@section('content')
<style>
    .section-dashboard {
        min-height: 85vh;
        background-color: #f7f9fc;
        padding: 40px 20px;
        box-sizing: border-box;
    }
    .stats-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .card-stat-modern {
        background-color: #ffffff;
        border: 1px solid #e3e8ee;
        border-radius: 0px !important;
        padding: 24px;
        flex: 1;
        min-width: 250px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        display: flex;
        align-items: center;
        gap: 18px;
        box-sizing: border-box;
    }
    .icon-wrapper {
        width: 50px;
        height: 50px;
        background-color: #e6f3ec;
        color: #198754;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 0px !important;
    }
    .stat-info h6 {
        margin: 0;
        font-size: 0.75rem;
        text-uppercase: uppercase;
        letter-spacing: 0.8px;
        color: #718096;
        font-weight: 700;
    }
    .stat-info .stat-number {
        margin: 4px 0 0 0;
        font-size: 1.6rem;
        font-weight: 800;
        color: #1a202c;
        line-height: 1;
    }

    .stat-info small {
        color: #a0aec0;
        font-size: 0.72rem;
    }
    .chart-wrapper {
        background-color: #ffffff;
        border: 1px solid #e3e8ee;
        border-radius: 0px !important;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .chart-wrapper h5 {
        font-size: 1rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #2d3748;
        border-bottom: 2px solid #e6f3ec;
        padding-bottom: 12px;
        margin-bottom: 25px;
    }
    .btn-kotak {
        border-radius: 0px !important;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-kelola-user {
        border: 1px solid #cbd5e0;
        color: #4a5568 !important;
        background-color: transparent;
    }
    .btn-kelola-user:hover {
        background-color: #f7f9fc;
        border-color: #a0aec0;
    }

    .btn-tambah-event {
        background-color: #198754;
        color: #ffffff !important;
        border: none;
    }
    .btn-tambah-event:hover {
        background-color: #146c43;
    }
</style>

<div class="section-dashboard">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-3">
            <div>
                <h3 class="fw-bold mb-1" style="color: #1a202c;">Dashboard Statistik</h3>
                <p class="mb-0 text-muted" style="font-size: 0.9rem;">Visualisasi aktivitas dan dokumentasi kegiatan Majelis Al-Mustaqim.</p>
            </div>
            <div class="d-flex gap-2">
                @if(session('role') === 'super admin')
                    <a href="/dashboard/user" class="btn btn-kelola-user btn-kotak shadow-sm">
                        <i class="bx bx-group me-2"></i> Kelola Admin
                    </a>
                @endif
                <a href="/dashboard/event" class="btn btn-tambah-event btn-kotak shadow-sm">
                    <i class="bx bx-calendar me-2"></i> Kelola Event
                </a>
            </div>
        </div>

        <div class="stats-grid">
            
            <div class="card-stat-modern">
                <div class="icon-wrapper">
                    <i class="bx bx-calendar-event fs-3"></i>
                </div>
                <div class="stat-info">
                    <h6>30 Hari Terakhir</h6>
                    <p class="stat-number">{{ $sebulanTerakhir }}</p>
                    <small>Kegiatan Terlaksana</small>
                </div>
            </div>

            <div class="card-stat-modern">
                <div class="icon-wrapper">
                    <i class="bx bx-file-blank fs-3"></i>
                </div>
                <div class="stat-info">
                    <h6>Total Kegiatan</h6>
                    <p class="stat-number">{{ $totalKegiatan }}</p>
                    <small>Total Dokumentasi</small>
                </div>
            </div>

            <div class="card-stat-modern">
                <div class="icon-wrapper">
                    <i class="bx bx-bookmark-alt fs-3"></i>
                </div>
                <div class="stat-info">
                    <h6>Kegiatan Terkini</h6>
                    @if($kegiatanTerbaru)
                        <p class="stat-number" style="font-size: 1.1rem; max-width: 170px;" title="{{ $kegiatanTerbaru->nama }}">
                            {{ Str::limit($kegiatanTerbaru->nama, 20) }}
                        </p>
                        <small>Tanggal: <b>{{ $kegiatanTerbaru->tanggal }}</b></small>
                    @else
                        <p class="stat-number text-muted" style="font-size: 1rem;">N/A</p>
                        <small>Belum ada data</small>
                    @endif
                </div>
            </div>

        </div>

        <div class="chart-wrapper">
            <h5>Jumlah Kegiatan Per Bulan</h5>
            <div style="height: 300px;">
                <canvas id="kegiatanChart"></canvas>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // --- KONFIGURASI CHART.JS ---
    const ctx = document.getElementById('kegiatanChart').getContext('2d');
    
    // Ambil data label bulan dan jumlah kegiatan dari Controller
    const labelsMonth = {!! json_encode($labelBulan) !!};
    const dataJumlah = {!! json_encode($jumlahKegiatan) !!};

    const kegiatanChart = new Chart(ctx, {
        type: 'line', // Gunakan tipe grafik garis
        data: {
            labels: labelsMonth, // Bulan
            datasets: [{
                label: 'Jumlah Kegiatan',
                data: dataJumlah, // Angka kegiatan
                // Atur warna garis pakai palet Hijau Al-Mustaqim
                borderColor: '#198754',
                backgroundColor: 'rgba(25, 135, 84, 0.05)', // Background tipis di bawah garis
                borderWidth: 3,
                tension: 0.3, // Efek sedikit bergelombang biar modern
                fill: true, // Warna background diaktifkan
                pointBackgroundColor: '#198754',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Sembunyikan legenda biar bersih
                },
                tooltip: {
                    intersect: false, // Tooltip muncul walau gak pas di titik
                    mode: 'index',
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Y-axis mulai dari angka 0
                    ticks: {
                        stepSize: 1, // Angka Y melompat per 1 angka
                        color: '#718096',
                        font: {
                            family: 'Inter, system-ui',
                        }
                    },
                    grid: {
                        color: '#f0f0f0',
                    }
                },
                x: {
                    ticks: {
                        color: '#718096',
                        font: {
                            family: 'Inter, system-ui',
                        }
                    },
                    grid: {
                        display: false, // Sembunyikan garis vertikal grid
                    }
                }
            }
        }
    });
</script>
@endsection