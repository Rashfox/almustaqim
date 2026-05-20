@extends('master')

@section('title', 'Home - Majelis Al-Mustaqim')

@section('content')
<style>
    

    body { 
        font-family: 'Inria Serif', Arial, sans-serif; 
        margin: 0; 
        padding: 0; 
        background-color: var(--bg-terang); 
    }

    /* 1. HERO BANNER UTAMA */
    .hero-banner {
        position: relative;
        width: 100%;
        height: 450px; 
        background: linear-gradient(rgba(27, 67, 20, 0.6), rgba(27, 67, 20, 0.75)), 
                    url('https://idweb.tech/api/preview.php?file=3cxdn4s5.jpg') no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-sizing: border-box;
    }

    .hero-banner h1 {
        font-family: 'Inria Serif', serif;
        font-size: 42px;
        font-weight: 700;
        color: #ffffff;
        text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        margin: 0;
        padding: 0 20px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .hero-banner h1 span {
        color: var(--kuning-lemon);
    }

    /* 2. AREA KHUSUS SLIDER BERGERAK (DI ATAS LIST) */
    .section-slider-kegiatan {
        max-width: 1100px;
        margin: 50px auto 20px auto;
        padding: 0 20px;
        box-sizing: border-box;
    }

    .section-slider-kegiatan h3 {
        font-family: 'Inria Serif', serif;
        font-size: 24px;
        color: var(--teks-gelap);
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .section-slider-kegiatan h3::after {
        content: '';
        display: block;
        width: 200px;
        height: 3px;
        background-color: var(--hijau-toska);
        margin: 10px 0 0;
    }
    .slider-container {
        position: relative;
        width: 100%;
        height: 380px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }
    .slider-item {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0; 
        visibility: hidden;
        transition: opacity 0.8s ease-in-out, visibility 0.8s ease-in-out; /* Animasi Smooth Fade */
        z-index: 1;
    }
    .slider-item.active {
        opacity: 1;
        visibility: visible;
        z-index: 2;
    }
    .slider-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .slider-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0, 0, 0, 0.75));
        padding: 30px 25px;
        color: #ffffff;
        z-index: 3;
    }
    .slider-caption h4 {
        margin: 0;
        font-family: 'Inria Serif', serif;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .btn-lihat-lainnya {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background-color: transparent;
        color: var(--hijau-toska);
        border: 2px solid var(--hijau-toska);
        padding: 12px 32px;
        font-family: 'Inria Serif', serif;
        font-size: 0.95rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        border-radius: 0px !important; /* Wajib Kotak Lancip */
        transition: all 0.25s ease-in-out;
    }

    .btn-lihat-lainnya:hover {
        background-color: var(--hijau-toska);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(0, 150, 136, 0.2);
    }

    @media (max-width: 768px) {
        .hero-banner { height: 300px; }
        .hero-banner h1 { font-size: 28px; }
        .slider-container { height: 240px; }
        .slider-caption h4 { font-size: 1.1rem; }
        .section-event { padding: 30px 15px; }
        .event-list { grid-template-columns: 1fr; gap: 20px; }
        .btn-lihat-lainnya { width: 100%; padding: 12px 20px; } /* Lebar penuh di HP */
    }
    @media (max-width: 576px) {
        span { display: flex;}
        .section-slider-kegiatan h3::after { width: 100px; }
    }
</style>

<div class="hero-banner">
    <h1>UKM MAJELIS <span>AL-MUSTAQIM</span></h1>
</div>

<div class="section-slider-kegiatan">
    <h3>Dokumentasi Kegiatan</h3>
    <div class="slider-container">
        @if(count($sliderEvent) > 0)
            @foreach($sliderEvent as $index => $se)
                <div class="slider-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('img/'.$se->gambar) }}" alt="{{ $se->nama }}">
                    <div class="slider-caption">
                        <h4>{{ $se->nama }}</h4>
                    </div>
                </div>
            @endforeach
        @else
            <div class="slider-item active" style="background-color: #cbd5e1; display:flex; align-items:center; justify-content:center;">
                <p style="color: #64748b; font-weight: bold;">Belum ada dokumentasi kegiatan.</p>
            </div>
        @endif
    </div>
</div>

<div class="section-event">
    <h2>Kegiatan Terbaru</h2>

    <div class="event-list">
        @if(count($event) > 0)
            @foreach($event as $e)
                <div class="event-card">
                    <div class="event-image-wrapper">
                        <a href="/event/{{ $e->id }}">
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
                        
                        <a href="/event/{{ $e->id }}" class="event-title-link">
                            <h3 class="event-title">{{ $e->nama }}</h3>
                        </a>
                        
                        <div class="desc-container">
                            <div class="desc-text" id="desc-{{ $e->id }}">
                                {{ $e->deskripsi }}
                            </div>
                        </div>

                        <a href="/event/{{ $e->id }}" class="btn-baca-detail">
                            Selengkapnya <i class='bx bx-right-arrow-alt align-middle fs-5'></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <p style="text-align: center; color: #64748b; font-weight: bold; padding: 40px 0; background: #fff; border: 1px solid var(--border-color);">
                Tidak ada data kegiatan saat ini.
            </p>
        @endif
    </div>
</div>

<script>
    // Slider Event
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slider-item');
        let currentSlideIndex = 0;

        function showNextSlide() {
            if (slides.length <= 1) return;

            slides[currentSlideIndex].classList.remove('active');
            currentSlideIndex = (currentSlideIndex + 1) % slides.length;
            slides[currentSlideIndex].classList.add('active');
        }

        setInterval(showNextSlide, 3500);
    });
</script>
@endsection