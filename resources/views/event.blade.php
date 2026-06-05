@extends('master')

@section('title', 'Kegiatan - Majelis Al-Mustaqim')

@section('content')
<style>
    .main-content-wrapper {
        display: flex;
        gap: 30px;
        max-width: 1100px;
        margin: 0 auto;
        align-items: flex-start;
    }
    
    .event-left-side {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    .terbaru h3 {
        font-family: 'Inria Serif', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--teks-gelap);
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 15px;
        letter-spacing: 0.5px;
    }
    .terbaru h3::after{
        content: '';
        display: block;
        width: 230px;
        height: 3px;
        background-color: var(--hijau-utama);
        margin-top: 8px;
    }

    .event-sidebar-right {
        width: 280px;
        flex-shrink: 0;
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        padding: 20px;
        box-sizing: border-box;
    }

    .sidebar-title {
        font-family: 'Inria Serif', serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--teks-gelap);
        text-transform: uppercase;
        margin-top: 0;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--hijau-utama);
        letter-spacing: 0.5px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        margin-bottom: 10px;
    }

    .sidebar-menu a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.95rem;
        color: #4a5568;
        text-decoration: none;
        padding: 8px 12px;
        transition: all 0.2s ease-in-out;
        border-left: 3px solid transparent;
    }

    .sidebar-menu a:hover {
        background-color: #f8fafc;
        color: var(--hijau-utama);
        border-left-color: var(--hijau-utama);
    }

    .sidebar-menu .count-badge {
        font-size: 0.75rem;
        background-color: #edf2f7;
        color: #4a5568;
        padding: 2px 8px;
        font-weight: 700;
    }
    .event-card {
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
        overflow: hidden;
        display: flex;
        flex-direction: column; 
        transition: transform 0.25s ease, border-color 0.25s ease;
        box-sizing: border-box;
    }

    .event-card:hover {
        transform: translateY(-3px);
        border-color: var(--hijau-utama);
    }

    .event-image-wrapper {
        width: 100%;
        height: 250px;
        overflow: hidden;
        background-color: #f1f5f9;
    }

    .event-image-wrapper a img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .event-info {
        padding: 25px;
        display: flex;
        flex-direction: column;
        box-sizing: border-box;
    }

    .event-date-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .badge-kegiatan {
        background-color: var(--hijau-utama);
        color: #ffffff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 3px 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .event-date {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Judul Event Bisa Diklik sebagai Link ke Detail */
    .event-title-link {
        text-decoration: none;
        color: var(--teks-gelap);
    }

    .event-title-link:hover h3 {
        color: var(--hijau-utama);
    }

    .event-title {
        font-family: 'Inria Serif', serif;
        font-size: 22px;
        font-weight: 700;
        margin: 0 0 12px 0;
        line-height: 1.4;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: color 0.2s;
    }

    .desc-container {
        font-family: 'Inria Serif', serif;
        font-size: 14.5px;
        line-height: 1.6;
        color: #475569;
        text-align: justify;
        margin-bottom: 20px;
    }

    .desc-text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
    }

    /* --- PAGINATION CUSTOM MODEL KOTAK --- */
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

    /* --- MEDIA QUERY RESPONSIF --- */
    @media (max-width: 768px) {
        .main-content-wrapper {
            flex-direction: column;
            gap: 40px;
        }
        .section-event h2 {
            margin-top: 0;
        }
        .event-sidebar-right {
            width: 100%;
        }
        .terbaru{
            margin-bottom: 0;
        }
        .terbaru h3 {
            font-size: 16px;
        }
        .terbaru h3::after {
            width: 150px;
        }
    }
</style>

<div class="section-event">
    <h2>KEGIATAN MAJELIS</h2>

    <div class="terbaru">
        <a href="{{ $event->url(1) }}">
            <h3>Kegiatan Terbaru</h3>
        </a>
    </div>
    <div class="main-content-wrapper">
        
        <div class="event-left-side">
            @if(count($event) > 0)
                @foreach($event as $e)
                    @if($loop->first && $event->onFirstPage())
                        <div class="spotlight-card">
                            <div class="event-image-wrapper">
                                <a href="{{ route('kegiatan.detail', $e->id . '-' . Str::slug($e->nama)) }}">
                                    <img src="{{ asset('img/'.$e->gambar) }}" alt="{{ $e->nama }}">
                                </a>
                            </div>
                            
                            <div class="event-info">
                                <div class="event-date-wrapper">
                                    <span class="badge-kegiatan" style="background-color: #dc3545;">Terbaru</span>
                                    <div class="event-date">
                                        <i class='bx bx-calendar align-middle me-1'></i>
                                        {{ \Carbon\Carbon::parse($e->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </div>
                                </div>
                                
                                <a href="{{ route('kegiatan.detail', $e->id . '-' . Str::slug($e->nama)) }}" class="event-title-link">
                                    <h3 class="event-title">{{ $e->nama }}</h3>
                                </a>
                                
                                <div class="desc-container">
                                    <div class="desc-text" style="-webkit-line-clamp: 4;">
                                        {{ $e->deskripsi }}
                                    </div>
                                </div>

                                <a href="{{ route('kegiatan.detail', $e->id . '-' . Str::slug($e->nama)) }}" class="btn-baca-detail">
                                    Baca Selengkapnya <i class='bx bx-right-arrow-alt align-middle fs-5'></i>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="event-card">
                            <div class="event-image-wrapper">
                                <a href="{{ route('kegiatan.detail', $e->id . '-' . Str::slug($e->nama)) }}" class="event-title-link">
                                    <img src="{{ asset('img/'.$e->gambar) }}" alt="{{ $e->nama }}">
                                </a>
                            </div>
                            
                            <div class="event-info">
                                <div class="event-date-wrapper">
                                    <span class="badge-kegiatan">Event</span>
                                    <div class="event-date">
                                        <i class='bx bx-calendar align-middle me-1'></i>
                                        {{ \Carbon\Carbon::parse($e->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </div>
                                </div>
                                
                                <a href="{{ route('kegiatan.detail', $e->id . '-' . Str::slug($e->nama)) }}" class="event-title-link">
                                    <h3 class="event-title">{{ $e->nama }}</h3>
                                </a>
                                
                                <div class="desc-container">
                                    <div class="desc-text">
                                        {{ $e->deskripsi }}
                                    </div>
                                </div>

                                <a href="{{ route('kegiatan.detail', $e->id . '-' . Str::slug($e->nama)) }}" class="btn-baca-detail">
                                    Selengkapnya <i class='bx bx-right-arrow-alt align-middle fs-5'></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <p style="text-align: center; color: #64748b; font-weight: bold; padding: 40px 0; background: #fff; border: 1px solid var(--border-color);">
                    Tidak ada data kegiatan saat ini.
                </p>
            @endif

            <div class="pagination-custom-wrapper">
                <nav>
                    @if ($event->onFirstPage())
                        <span class="disabled">« Previous</span>
                    @else
                        <a href="{{ $event->previousPageUrl() }}">« Previous</a>
                    @endif

                    <span class="page-info">Halaman {{ $event->currentPage() }}</span>

                    @if ($event->hasMorePages())
                        <a href="{{ $event->nextPageUrl() }}">Next »</a>
                    @else
                        <span class="disabled">Next »</span>
                    @endif
                </nav>
            </div>
        </div>

        <div class="event-sidebar-right">
            <h4 class="sidebar-title">Arsip Kegiatan</h4>
            <ul class="sidebar-menu">

                @if(isset($arsipBulan) && count($arsipBulan) > 0)
                    @foreach($arsipBulan as $ab)
                        <li>
                            <a href="/event/arsip/{{ $ab->tahun }}/{{ $ab->bulan_angka }}">
                                <span>{{ $ab->bulan_nama }} {{ $ab->tahun }}</span>
                                <span class="count-badge">{{ $ab->total }}</span>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li style="padding: 10px 12px; font-size: 0.9rem;" class="text-muted">Belum ada arsip bulanan.</li>
                @endif
            </ul>
        </div>

    </div>
</div>
@endsection