@extends('dashboard/master')
@section('title', 'Daftar Kegiatan - Majelis Al-Mustaqim')

@section('content')
<style>
    .section-list-event {
        min-height: 85vh;
        background-color: #f4f6f9;
        padding: 40px 15px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        box-sizing: border-box;
    }
    .card-tabel-kotak {
        background-color: #ffffff;
        border: 1px solid #e3e8ee;
        border-top: 4px solid #198754;
        border-radius: 0px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 35px;
        width: 100%;
        max-width: 1100px;
        box-sizing: border-box;
    }
    .tabel-kotak {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .tabel-kotak th {
        background-color: #f8fafc;
        color: #2d3748;
        font-weight: 700;
        text-uppercase: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border: 1px solid #e2e8f0;
        padding: 14px;
        text-align: left;
    }

    .tabel-kotak td {
        border: 1px solid #e2e8f0;
        padding: 12px 14px;
        font-size: 0.95rem;
        color: #4a5568;
        vertical-align: middle;
    }
    .tabel-kotak tbody tr:hover {
        background-color: #f8fafc;
    }

    .text-potong {
        max-width: 250px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .table-responsive {
        width: 100%;
        margin-bottom: 20px;
    }

    .btn-aksi-wrapper {
        display: flex;
        gap: 8px;
    }

    .btn-kotak-aksi {
        border-radius: 0px !important;
        padding: 8px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s;
    }

    .btn-aksi-tambah {
        background-color: #198754;
        color: white;
        padding: 12px 20px;
        font-weight: bold;
        text-uppercase: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        border-radius: 0px !important;
    }
    .btn-aksi-tambah:hover { background-color: #146c43; color: white; }
    .btn-aksi-edit { background-color: #ffc107; color: #212529; border: 1px solid #ffc107; }
    .btn-aksi-edit:hover { background-color: #ffca2c; color: #212529; }
    .btn-aksi-hapus { background-color: #dc3545; color: white; border: 1px solid #dc3545; }
    .btn-aksi-hapus:hover { background-color: #bb2d3b; color: white; }

    .img-thumb-event {
        width: 80px;
        height: 55px;
        object-fit: cover;
        border: 1px solid #cbd5e0;
    }
    .mobile-card-list {
        display: none;
    }
    .pagination-custom-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 25px;
        width: 100%;
    }

    .pagination-custom-wrapper nav {
        display: inline-flex;
        gap: 6px;
    }

    .pagination-custom-wrapper nav a,
    .pagination-custom-wrapper nav span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        text-uppercase: uppercase;
        color: #2d3748;
        background-color: #ffffff;
        border: 1px solid #cbd5e0;
        text-decoration: none;
        border-radius: 0px !important;
        transition: all 0.2s;
    }

    .pagination-custom-wrapper nav a:hover {
        background-color: #f8fafc;
        color: var(--hijau-utama);
        border-color: var(--hijau-utama);
    }

    .pagination-custom-wrapper nav .page-info {
        background-color: #f8fafc;
        color: #718096;
        cursor: default;
    }

    .pagination-custom-wrapper nav .disabled {
        color: #a0aec0;
        background-color: #f1f5f9;
        border-color: #e2e8f0;
        cursor: not-allowed;
    }
    @media (max-width: 991px) { 
        .section-list-event {
            padding: 20px 10px;
        }

        .card-tabel-kotak {
            padding: 25px 20px;
        }   

        @media (max-width: 576px) {
            .table-responsive {
                display: none;
            }
            .mobile-card-list {
                display: flex;
                flex-direction: column;
                gap: 15px;
                margin-bottom: 20px;
                width: 100%;
            }
            .btn-aksi-tambah {
                width: auto;
                justify-content: center;
                margin-bottom: 10px;
            }
        }
        @media (min-width: 577px) {
            .table-responsive {
                display: block;
                width: 100%;
                overflow-x: auto; 
                -webkit-overflow-scrolling: touch;
                border: 1px solid #e2e8f0;
            }
            .tabel-kotak {
                margin-top: 0; /* Biar rapi di dalam wrapper border */
            }
            .mobile-card-list {
                display: none;
            }
            .btn-aksi-tambah {
                width: auto !important;
                margin-bottom: 10px;
            }
        }
        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 15px;
        }

        .pagination-custom-wrapper nav a,
        .pagination-custom-wrapper nav span {
            padding: 8px 12px;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 767px) {
        .section-list-event {
            padding: 20px 10px;
        }

        .card-tabel-kotak {
            padding: 20px 15px;
        }

        .table-responsive {
            display: none;
        }
        .mobile-card-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 20px;
            width: 100%;
        }

        .mobile-event-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            display: flex;
            flex-direction: column;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .mobile-card-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .mobile-card-body {
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mobile-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #2d3748;
            margin: 0;
            text-decoration: none;
        }
        
        .mobile-card-title:hover {
            color: #198754;
        }

        .mobile-card-date {
            font-size: 0.8rem;
            color: #718096;
        }

        .mobile-card-desc {
            font-size: 0.85rem;
            color: #4a5568;
            text-align: justify;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .mobile-card-actions {
            margin-top: 5px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            gap: 10px;
        }

        .mobile-card-actions .btn-kotak-aksi {
            flex: 1;
            justify-content: center;
            padding: 10px;
        }

        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 15px;
        }

        .pagination-custom-wrapper nav a,
        .pagination-custom-wrapper nav span {
            padding: 8px 12px;
            font-size: 0.75rem;
        }
    }
</style>

<div class="section-list-event">
    <div class="card-tabel-kotak">
        
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h4 class="fw-bold text-dark mb-0 text-uppercase" style="letter-spacing: 0.5px; font-size: 1.1rem;">
                <i class="bx bx-calendar align-middle me-1"></i> Manajemen Kegiatan
            </h4>
            <a href="/dashboard/event/tambah" class="btn-aksi-tambah shadow-sm">
                <i class="bx bx-plus align-middle fs-5 me-1"></i> Tambah Kegiatan
            </a>
        </div>

        <div class="table-responsive">
            <table class="tabel-kotak">
                <thead>
                    <tr>
                        <th style="width: 20%;">Nama Kegiatan</th>
                        <th style="width: 35%;">Deskripsi</th>
                        <th style="width: 15%;">Gambar</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th style="width: 15%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($event) > 0)
                        @foreach($event as $e)
                        <tr>
                            <td class="fw-semibold text-dark">{{ $e->nama }}</td>
                            <td>
                                <div class="text-potong" title="{{ $e->deskripsi }}">
                                    {{ strip_tags($e->deskripsi) }}
                                </div>
                            </td>
                            <td>
                                <img src="{{ asset('img/'.$e->gambar) }}" alt="Gambar {{ $e->nama }}" class="img-thumb-event">
                            </td>
                            <td>
                                <i class="bx bx-time-five align-middle me-1 text-muted"></i>
                                {{ $e->tanggal }}
                            </td>
                            <td style="text-align: center;">
                                <div class="btn-aksi-wrapper justify-content-center">
                                    <a href="/dashboard/event/edit/{{ $e->id }}" class="btn-kotak-aksi btn-aksi-edit" title="Edit Data">
                                        <i class="bx bx-edit fs-6 me-1"></i> Edit
                                    </a>
                                    <a href="/dashboard/event/hapus/{{ $e->id }}" class="btn-kotak-aksi btn-aksi-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')" title="Hapus Data">
                                        <i class="bx bx-trash fs-6 me-1"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px;" class="text-muted">
                                <i class="bx bx-folder-open fs-3 d-block mb-2"></i> Belum ada data kegiatan tersedia.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mobile-card-list">
            @if(count($event) > 0)
                @foreach($event as $e)
                    <div class="mobile-event-card">
                        <img src="{{ asset('img/'.$e->gambar) }}" alt="{{ $e->nama }}" class="mobile-card-img">
                        
                        <div class="mobile-card-body">
                            <a href="/dashboard/event/edit/{{ $e->id }}" class="mobile-card-title">
                                {{ $e->nama }}
                            </a>
                            
                            <div class="mobile-card-date">
                                <i class="bx bx-calendar align-middle me-1"></i> {{ $e->tanggal }}
                            </div>
                            
                            <div class="mobile-card-desc">
                                {{ strip_tags($e->deskripsi) }}
                            </div>
                            
                            <div class="mobile-card-actions">
                                <a href="/dashboard/event/edit/{{ $e->id }}" class="btn-kotak-aksi btn-aksi-edit">
                                    <i class="bx bx-edit me-1"></i> Edit
                                </a>
                                <a href="/dashboard/event/hapus/{{ $e->id }}" class="btn-kotak-aksi btn-aksi-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                    <i class="bx bx-trash me-1"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center padding text-muted" style="padding: 20px 0;">
                    <i class="bx bx-folder-open fs-3 d-block mb-2"></i> Belum ada data kegiatan tersedia.
                </div>
            @endif
        </div>

        <div class="pagination-custom-wrapper">
            <nav>
                {{-- Tombol Sebelum/Previous --}}
                @if ($event->onFirstPage())
                    <span class="disabled">« Previous</span>
                @else
                    <a href="{{ $event->previousPageUrl() }}&per_page={{ $perPage }}">« Previous</a>
                @endif

                {{-- Loop Nomor Halaman Dinamis --}}
                @foreach ($event->getUrlRange(1, $event->lastPage()) as $page => $url)
                    @if ($page == $event->currentPage())
                        <span class="page-info" style="background-color: #198754; color: white; border-color: #198754;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}&per_page={{ $perPage }}">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Tombol Sesudah/Next --}}
                @if ($event->hasMorePages())
                    <a href="{{ $event->nextPageUrl() }}&per_page={{ $perPage }}">Next »</a>
                @else
                    <span class="disabled">Next »</span>
                @endif
            </nav>
        </div>

    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // DIUBAH: Jika layar di bawah 768px (Mobile/Vertical Tablet), set ke 3. 
        // Jika di atas 768px (Laptop/Tablet Landscape), set ke 5.
        const targetPerPage = window.innerWidth < 768 ? 3 : 5;

        const urlParams = new URLSearchParams(window.location.search);
        const currentUrlPerPage = urlParams.get('per_page') ? parseInt(urlParams.get('per_page')) : parseInt("{{ $perPage }}");

        if (targetPerPage !== currentUrlPerPage) {
            urlParams.set('per_page', targetPerPage);
            if (urlParams.has('page')) {
                urlParams.set('page', 1);
            }
            window.location.search = urlParams.toString();
        }
    });
</script>
@endsection