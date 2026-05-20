@extends('dashboard/master')
@section('title', 'Profile - Majelis Al-Mustaqim')

@section('content')
<style>
    .section-profile {
        min-height: 85vh;
        background-color: #f4f6f9; /* Latar belakang abu terang standar dashboard */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 15px;
        box-sizing: border-box;
    }

    /* Container Judul Atas */
    .profile-greeting {
        width: 100%;
        max-width: 900px;
        margin-bottom: 25px;
        text-align: center;
    }
    .profile-greeting h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
    }

    /* Card Utama: Rounded Corners & Soft Shadow Khas Figma */
    .profile-card {
        display: flex;
        flex-direction: row;
        width: 100%;
        max-width: 900px;
        background-color: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid #e3e8ee;
        border-radius: 16px !important; /* Membuat lengkungan halus */
        overflow: hidden; /* Memastikan sisi kiri & kanan ikut melengkung */
    }

    /* Sesi Kiri: Detail Foto (Soft Gray) */
    .profile-left {
        flex: 1;
        min-width: 300px;
        background-color: #babcbe; /* Menyamakan abu-abu figma */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px;
        text-align: center;
    }

    /* Lingkaran Avatar Premium dengan Bayangan */
    .profile-avatar-wrapper {
        width: 160px;
        height: 160px;
        background-color: #ffffff;
        border-radius: 50% !important;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        margin-bottom: 20px;
    }

    /* Ganti ke Boxicons user agar seragam dengan navigasi utama */
    .profile-avatar-wrapper i {
        font-size: 5.5rem;
        color: #5c6470;
    }

    .profile-left h3 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
    }

    /* Sesi Kanan: Form Input Premium (Abu Gelap Khas Figma) */
    .profile-right {
        flex: 1.3;
        min-width: 320px;
        background-color: #323842; /* Menyalin tone warna gelap figma */
        padding: 45px 40px;
        color: #ffffff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    /* Group Form Input */
    .form-group-profile {
        margin-bottom: 22px;
        position: relative;
    }

    .form-group-profile label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 8px;
        text-transform: capitalize;
    }

    /* Input Minimalis Mengikuti Gambar */
    .form-group-profile .form-control {
        background-color: transparent;
        border: 1px solid rgba(255, 255, 255, 0.7);
        color: #ffffff !important;
        padding: 12px 45px 12px 15px;
        font-size: 0.95rem;
        border-radius: 8px !important; /* Input melengkung tipis */
        width: 100%;
        box-sizing: border-box;
    }

    .form-group-profile .form-control:focus {
        background-color: rgba(255, 255, 255, 0.03);
        border-color: #ebfb09; /* Warna kuning stabilo saat diklik */
        box-shadow: none;
    }

    /* Ikon Pensil Edit Menempel Manis di Dalam Input */
    .icon-edit-input {
        position: absolute;
        right: 15px;
        bottom: 12px;
        color: #ebfb09; /* Kuning cerah agar kelihatan kontras */
        font-size: 1.1rem;
        cursor: pointer;
        pointer-events: none; /* Biar gak nge-block klik input */
    }

    /* Baris Tombol Aksi */
    .btn-profile-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 35px;
        gap: 15px;
    }

    /* Tombol Log Out Merah Tegas */
    .btn-logout-prof {
        background-color: #dc3545;
        color: white !important;
        border: none;
        padding: 12px 28px;
        font-weight: 700;
        font-size: 0.95rem;
        border-radius: 8px !important;
        text-decoration: none;
        transition: background 0.2s;
        text-align: center;
    }

    .btn-logout-prof:hover {
        background-color: #bd2130;
    }

    /* Tombol Simpan Khas Elemen Figma */
    .btn-simpan-prof {
        background-color: #babcbe;
        color: #2d3748 !important;
        border: none;
        padding: 12px 35px;
        font-weight: 700;
        font-size: 0.95rem;
        border-radius: 8px !important;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-simpan-prof:hover {
        background-color: #a3a6a9;
    }

    /* --- RESPONSIVE ENGINE (Otomatis Atas-Bawah di HP) --- */
    @media (max-width: 768px) {
        .profile-card {
            flex-direction: column;
            border-radius: 12px !important;
        }
        .profile-left {
            padding: 30px 20px;
        }
        .profile-right {
            padding: 35px 25px;
        }
        .profile-avatar-wrapper {
            width: 130px;
            height: 130px;
        }
        .profile-avatar-wrapper i {
            font-size: 4.5rem;
        }
    }
</style>

<div class="section-profile">
    <div class="container d-flex flex-column align-items-center">
        
        <div class="profile-greeting">
            <h2>Hai, {{ $admin[0]->nama }}</h2>
        </div>

        <div class="profile-card">
            
            <div class="profile-left">
                <div class="profile-avatar-wrapper">
                    <i class='bx bxs-user'></i>
                </div>
                <h3>{{ $admin[0]->nama }}</h3>
            </div>

            <div class="profile-right">
                <form action="/dashboard/profile/update" method="post">
                    @csrf

                    <div class="form-group-profile">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $admin[0]->nama }}" required autocomplete="off">
                        <i class='bx bxs-pencil icon-edit-input'></i>
                    </div>

                    <div class="form-group-profile">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $admin[0]->username }}" required autocomplete="off">
                        <i class='bx bxs-pencil icon-edit-input'></i>
                    </div>

                    <div class="form-group-profile">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin[0]->email }}" readonly>
                    </div>

                    <div class="form-group-profile">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                        <i class='bx bxs-pencil icon-edit-input'></i>
                    </div>

                    <div class="btn-profile-action">
                        <a href="{{ url('/logout') }}" class="btn-logout-prof">Log Out</a>
                        <button type="submit" class="btn-simpan-prof">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection