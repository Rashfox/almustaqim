@extends('master')

@section('title', 'Arsip Kegiatan - Majelis Al-Mustaqim')

@section('content')
<style>
    .section-arsip {
        background-color: var(--bg-terang);
        padding: 50px 20px;
        min-height: 85vh;
        box-sizing: border-box;
    }

    .arsip-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    /* Header Penanda Arsip Bulan Apa */
    .arsip-header {
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        border-left: 4px solid var(--hijau-utama);
        padding: 20px 25px;
        margin-bottom: 35px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .arsip-header h2 {
        font-family: 'Inria Serif', serif;
        font-size: 1.4rem;
        margin: 0;
        color: var(--teks-gelap);
        text-transform: uppercase;
    }

    .btn-kembali {
        color: #64748b;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-kembali:hover {
        color: var(--hijau-utama);
    }

    /* Grid Layout Konten Arsip */
    .arsip-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 30px;
    }

    .event-card {
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: transform 0.25s ease, border-color 0.25s ease;
    }

    .event-card:hover {
        transform: translateY(-3px);
        border-color: var(--hijau-utama);
    }

    .event-image-wrapper {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .event-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .event-info {
        padding: 20px;
        display: flex;
        flex-grow: 1;
        flex-direction: column;
    }

    .event-date {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .event-title {
        font-family: 'Inria Serif', serif;
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 10px 0;
        text-transform: uppercase;
        line-height: 1.4;
    }

    .event-title a {
        text-decoration: none;
        color: var(--teks-gelap);
    }

    .event-title a:hover {
        color: var(--hijau-utama);
    }

    .event-desc {
        font-family: 'Inria Serif', serif;
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        text-align: justify;
        margin-bottom: 15px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .btn-detail {
        margin-top: auto;
        color: var(--hijau-utama);
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    @media (max-width: 768px) {
        .arsip-header { flex-direction: column; align-items: flex-start; gap: 10px; }
        .arsip-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="section-arsip">
    <div class="arsip-container">
        
        <div class="arsip-header">
            <h2>Arsip: {{ $namaBulan }} {{ $tahun }}</h2>
            <a href="/event" class="btn-kembali">
                <i class='bx bx-left-arrow-alt fs-4 align-middle'></i> Semua Event
            </a>
        </div>

        <div class="arsip-grid">
            @if(count($eventArsip) > 0)
                @foreach($eventArsip as $e)
                    <div class="event-card">
                        <div class="event-image-wrapper">
                            <a href="/event/{{ $e->id }}">
                                <img src="{{ asset('img/'.$e->gambar) }}" alt="{{ $e->nama }}">
                            </a>
                        </div>
                        <div class="event-info">
                            <div class="event-date">
                                <i class='bx bx-calendar align-middle me-1'></i>
                                {{ \Carbon\Carbon::parse($e->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </div>
                            <h3 class="event-title">
                                <a href="/event/{{ $e->id }}">{{ $e->nama }}</a>
                            </h3>
                            <div class="event-desc">
                                {{ $e->deskripsi }}
                            </div>
                            <a href="/event/{{ $e->id }}" class="btn-detail">Selengkapnya →</a>
                        </div>
                    </div>
                @endforeach
            @else
                <p style="grid-column: 1/-1; text-align: center; color: #64748b; font-weight: bold; padding: 40px 0; background: #fff; border: 1px solid var(--border-color);">
                    Tidak ada kegiatan pada bulan ini.
                </p>
            @endif
        </div>

    </div>
</div>
@endsection