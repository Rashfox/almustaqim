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
    .form-control::placeholder{
        color: #c4c4c4;
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
        cursor: pointer;
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

    /* --- OVERLAY LOG OUT STYLE (SWEETALERT SIMPEL) --- */
    .custom-overlay-logout {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        z-index: 99999;
    }
    .custom-overlay-logout.aktif {
        display: block;
    }
    .box-confirm-logout {
        max-width: 320px;
        width: 85%;
        margin: 15% auto;
        background: #ffffff;
        padding: 30px 20px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    .overlay-icon-logout-warning {
        width: 50px;
        height: 50px;
        border: 2px solid #facea8;
        color: #f8bb86;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 15px auto;
        font-family: Arial, sans-serif;
    }
    .box-confirm-logout h4 {
        font-size: 18px;
        font-weight: 500;
        color: #595959;
        margin-bottom: 15px;
    }
    .btn-logout-ya {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-logout-batal {
        background-color: #3085d6;
        color: white;
        border: none;
        padding: 8px 20px;
        font-size: 14px;
        font-weight: 500;
        border-radius: 4px;
        cursor: pointer;
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
            {{-- Fix Bug Array Key 0 --}}
            <h2>Hai, {{ $admin->nama }}</h2>
        </div>

        <div class="profile-card">
            
            <div class="profile-left">
                <div class="profile-avatar-wrapper">
                    <i class='bx bxs-user'></i>
                </div>
                <h3>{{ $admin->nama }}</h3>
            </div>

            <div class="profile-right">
                <form action="/dashboard/profile/update" method="post">
                    @csrf

                    <div class="form-group-profile">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ $admin->nama }}" required autocomplete="off">
                        <i class='bx bxs-pencil icon-edit-input'></i>
                    </div>

                    <div class="form-group-profile">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required autocomplete="off">
                        <i class='bx bxs-pencil icon-edit-input'></i>
                    </div>

                    <div class="form-group-profile">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin->email }}" readonly>
                    </div>

                    <div class="form-group-profile">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                        <i class='bx bxs-pencil icon-edit-input'></i>
                    </div>

                    <div class="btn-profile-action">
                        {{-- Tombol Log out bertipe button pemicu overlay JS --}}
                        <button type="button" id="triggerLogOut" class="btn-logout-prof">Log Out</button>
                        <button type="submit" class="btn-simpan-prof">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- HTML CUSTOM OVERLAY CONFIRMATION LOG OUT --}}
<div id="overlayLogOut" class="custom-overlay-logout">
    <div class="box-confirm-logout">
        <div class="overlay-icon-logout-warning">!</div>
        <h4>Yakin ingin keluar?</h4>
        
        <div class="d-flex gap-2 justify-content-center">
            <button type="button" id="btnYesLogOut" class="btn-logout-ya">Ya</button>
            <button type="button" id="btnCancelLogOut" class="btn-logout-batal">Batal</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const overlay = document.getElementById('overlayLogOut');
        const triggerBtn = document.getElementById('triggerLogOut');
        const cancelBtn = document.getElementById('btnCancelLogOut');
        const yesBtn = document.getElementById('btnYesLogOut');

        triggerBtn.addEventListener('click', function() {
            overlay.classList.add('aktif');
        });

        cancelBtn.addEventListener('click', function() {
            overlay.classList.remove('aktif');
        });

        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('aktif');
            }
        });

        yesBtn.addEventListener('click', function() {
            overlay.classList.remove('aktif');

            const logoutForm = document.createElement('form');
            logoutForm.method = 'POST';
            logoutForm.action = "{{ url('/logout') }}";
            logoutForm.style.display = 'none';

            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = "{{ csrf_token() }}";

            logoutForm.appendChild(csrfToken);
            document.body.appendChild(logoutForm);
            
            logoutForm.submit();
        });
    });
</script>
@endsection