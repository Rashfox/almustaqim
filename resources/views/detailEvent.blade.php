@extends('master')

@section('title', $event->nama . ' - Majelis Al-Mustaqim')

@section('content')
<style>
    .section-detail-event {
        background-color: var(--bg-terang);
        padding: 40px 20px;
        min-height: 100vh;
    }
    .article-container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        border: 1px solid var(--border-color);
        padding: 40px;
        box-sizing: border-box;
    }

    /* Tombol Kembali dengan Model Kotak Lancip Minimalis */
    .btn-back-wrapper {
        margin-bottom: 25px;
    }

    .btn-kembali {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--teks-mutasi);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: color 0.2s;
    }

    .btn-kembali:hover {
        color: var(--hijau-utama);
    }
    .article-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .badge-kegiatan {
        background-color: var(--hijau-utama);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .article-date {
        color: var(--teks-mutasi);
        font-size: 0.85rem;
        font-weight: 600;
    }
    .penulis{
        font-size: 0.9rem;
        margin-top: 0;
    }
    .penulis i{
        font-weight: lighter;
        color: var(--teks-mutasi);
    }
    /* Judul Utama Artikel Kegiatan */
    .article-title {
        font-family: 'Inria Serif', serif;
        font-size: 32px;
        font-weight: 700;
        color: var(--teks-gelap);
        margin: 0 0 25px 0;
        line-height: 1.3;
        letter-spacing: 0.5px;
    }

    /* Frame Gambar Utama */
    .article-image-wrapper {
        width: 100%;
        max-height: 450px;
        overflow: hidden;
        background-color: #f1f5f9;
        margin-bottom: 30px;
        border: 1px solid var(--border-color);
    }

    .article-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Isi Teks Deskripsi / Dokumentasi Cerita */
    .article-content {
        font-family: 'Inria Serif', serif;
        font-size: 16px;
        line-height: 1.8; /* Dibuat agak renggang biar enak dibaca */
        color: #334155;
        text-align: justify;
    }

    /* Break kata jika ada teks/link yang terlalu panjang */
    .article-content p {
        margin-top: 0;
        margin-bottom: 20px;
        white-space: pre-line; /* Menjaga spasi enter baris baru dari database */
    }

    /* --- RESPONSIVITAS MOBILE --- */
    @media (max-width: 768px) {
        .section-detail-event {
            padding: 25px 12px;
        }

        .article-container {
            padding: 25px 20px;
        }

        .article-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .article-image-wrapper {
            max-height: 280px;
            margin-bottom: 20px;
        }

        .article-content {
            font-size: 15px;
            line-height: 1.7;
        }
    }
</style>
<div class="section-detail-event">
    <div class="article-container">
        
        <div class="btn-back-wrapper">
            <a href="/event" class="btn-kembali">
                <i class='bx bx-left-arrow-alt fs-4 align-middle'></i> Kembali ke Event
            </a>
        </div>

        <div class="article-meta">
            <span class="badge-kegiatan">Detail Kegiatan</span>
            <div class="article-date">
                <i class='bx bx-calendar align-middle me-1'></i>
                {{ \Carbon\Carbon::parse($event->tanggal)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </div>
        </div>
        <h4 class="penulis">Posted By: <i>{{ $namaPenulis }}</i></h4>

        <h1 class="article-title">{{ $event->nama }}</h1>

        <div class="article-image-wrapper">
            <img src="{{ asset('img/'.$event->gambar) }}" alt="{{ $event->nama }}">
        </div>

        <div class="article-content">
            <p>
                {{ $event->deskripsi }}
            </p>
        </div>

    </div>
</div>
@endsection