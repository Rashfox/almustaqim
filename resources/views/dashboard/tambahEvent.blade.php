@extends('dashboard/master')
@section('title', 'Tambah Kegiatan - Majelis Al-Mustaqim')

@section('content')
<style>
    /* Kontainer utama halaman - PERSIS SEPERTI TAMBAH USER */
    .section-tambah-user {
        min-height: 85vh;
        background-color: #f4f6f9;
        padding: 40px 15px; 
        display: flex;
        justify-content: center;
        align-items: flex-start;
        box-sizing: border-box;
    }

    /* Card Utama Berbentuk Kotak Tegas Putih - PERSIS SEPERTI TAMBAH USER */
    .card-form-kotak {
        background-color: #ffffff;
        border: 1px solid #e3e8ee;
        border-top: 4px solid #198754; 
        border-radius: 0px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 35px;
        width: 100%;
        max-width: 1000px; /* Dikunci maksimal 1000px biar gak nembus layar */
        box-sizing: border-box;
    }

    /* Pembungkus Flexbox Utama */
    .form-flex-wrapper {
        display: flex;
        flex-direction: row;
        width: 100%;
        gap: 30px; 
        box-sizing: border-box;
    }

    .kolom-form-kiri, .kolom-form-kanan {
        flex: 1;
        width: 50%;
        box-sizing: border-box;
    }

    /* Border pembatas tengah khusus layar komputer */
    @media (min-width: 768px) {
        .kolom-form-kiri {
            border-right: 1px solid #e2e8f0;
            padding-right: 30px;
        }
    }

    /* STRUKTUR RESPONSIF: Otomatis berubah jadi 1 kolom di HP */
    @media (max-width: 767px) {
        .form-flex-wrapper {
            flex-direction: column; 
            gap: 10px;
        }
        .kolom-form-kiri, .kolom-form-kanan {
            width: 100%;
            padding: 0;
            border-right: none;
        }
        .card-form-kotak {
            padding: 20px; 
        }
    }

    /* Group Form Input */
    .form-group-kotak {
        margin-bottom: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group-kotak label {
        display: block;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 8px;
        font-size: 0.85rem;
        text-uppercase: uppercase;
        letter-spacing: 0.5px;
    }

    /* Input & Textarea Kotak Sempurna */
    .form-group-kotak .form-control {
        width: 100%;
        border: 1px solid #cbd5e0;
        padding: 12px 15px;
        font-size: 0.95rem;
        color: #2d3748;
        border-radius: 0px !important;
        box-sizing: border-box;
    }

    .form-group-kotak .form-control:focus {
        border-color: #198754;
        box-shadow: none;
        background-color: #fefefe;
    }

    /* Bingkai Preview Gambar Dashed Khas Figma */
    .kotak-preview {
        border: 2px dashed #cbd5e0;
        padding: 10px;
        background-color: #f8fafc;
        min-height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-sizing: border-box;
        width: 100%;
    }

    .kotak-preview img {
        max-width: 100%;
        max-height: 240px;
        object-fit: cover;
    }

    /* Wrapper Tombol Bawah */
    .tombol-wrapper-bawah {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
        box-sizing: border-box;
    }

    .btn-event {
        border-radius: 0px !important;
        padding: 12px 30px;
        font-weight: bold;
        text-uppercase: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    
    .btn-simpan {
        background-color: #198754;
        color: white;
        border: none;
        cursor: pointer;
    }

    .btn-simpan:hover {
        background-color: #146c43;
    }

    .btn-batal {
        background-color: #dc3545;
        color: white;
    }
    
    .btn-batal:hover {
        background-color: #bb2d3b;
    }
</style>

<div class="section-tambah-user">
    <div class="card-form-kotak">
        
        <h4 class="fw-bold text-dark mb-4 text-uppercase" style="letter-spacing: 0.5px; font-size: 1.1rem; border-bottom: 2px solid #f4f6f9; padding-bottom: 10px;">
            <i class="bx bx-calendar-plus align-middle me-1"></i> Tambah Kegiatan
        </h4>

        <form action="/dashboard/event/simpan" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="form-flex-wrapper">
                
                <div class="kolom-form-kiri">
                    <div class="form-group-kotak">
                        <label for="gambar">Pilih Gambar :</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*" required>
                    </div>

                    <div class="form-group-kotak">
                        <label>Preview :</label>
                        <div class="kotak-preview">
                            <img id="imgPreview" src="https://placehold.co/600x400/f8fafc/cbd5e0?text=Belum+Ada+Gambar" alt="Preview Gambar">
                        </div>
                    </div>
                </div>

                <div class="kolom-form-kanan">
                    <div class="form-group-kotak">
                        <label for="nama">Judul Kegiatan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan judul kegiatan..." required autocomplete="off">
                    </div>

                    <div class="form-group-kotak">
                        <label for="tanggal">Tanggal Pelaksanaan</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    
                    <div class="form-group-kotak">
                        <label for="deskripsi">Deskripsi Kegiatan</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="8" placeholder="Isi deskripsi kegiatan secara detail..." required></textarea>
                    </div>
                </div>

            </div>

            <div class="tombol-wrapper-bawah">
                <a href="/dashboard/event" class="btn btn-batal btn-event">
                    <i class="bx bx-x align-middle fs-5 me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-simpan btn-event shadow-sm">
                    <i class="bx bx-plus align-middle fs-5 me-1"></i> Tambah
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    // --- JAVASCRIPT LIVE PREVIEW GAMBAR ---
    const gambarInput = document.getElementById('gambar');
    const imgPreview = document.getElementById('imgPreview');

    gambarInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                imgPreview.setAttribute('src', this.result);
            });
            
            reader.readAsDataURL(file);
        } else {
            imgPreview.setAttribute('src', 'https://placehold.co/600x400/f8fafc/cbd5e0?text=Belum+Ada+Gambar');
        }
    });
</script>
@endsection