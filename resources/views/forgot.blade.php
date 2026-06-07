@extends('master')

@section('title', 'Forgot Password - Majelis Al-Mustaqim')

@section('content')
<style>
    * {
        box-sizing: border-box;
    }

    .section-login {
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), 
                    url('img/background.png');
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: 'Inria Serif', serif;
        padding: 40px 15px; /* Jarak aman atas bawah agar tidak menabrak header/footer */
    }

    /* Judul atas dibuat pop-out putih kontras */
    .section-login h2 {
        color: #ffffff; 
        font-weight: 700;
        margin-bottom: 25px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        text-align: center;
        font-size: 24px;
        text-uppercase: uppercase;
        letter-spacing: 1px;
    }

    /* --- OPSI 1: PREMIUM WHITE GLASSMORPHISM CARD --- */
    .login-box {
        background-color: rgba(255, 255, 255, 0.92); /* Putih kaca bersih */
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        width: 90%;
        max-width: 400px;
        padding: 40px;
        border-radius: 24px; /* Lengkungan halus khas modern UI */
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .login-box h3 {
        font-weight: 800;
        margin-bottom: 15px;
        color: #1a202c; /* Hitung pekat agar tajam */
        font-size: 22px;
    }

    .login-box p {
        font-size: 13px;
        line-height: 1.6;
        margin-bottom: 25px;
        color: #4a5568; /* Abu gelap teks isi agar nyaman dibaca */
        text-align: center;
    }

    .form-group {
        text-align: left;
        margin-bottom: 25px;
        width: 100%;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 14px;
        color: #2d3748;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #cbd5e0;
        border-radius: 10px;
        background-color: #f7fafc;
        outline: none;
        font-size: 15px;
        color: #2d3748;
        transition: all 0.2s;
    }

    .form-group input:focus {
        border-color: #2D5A27; /* Fokus warna hijau */
        background-color: #ffffff;
    }

    .btn-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
        width: 100%;
    }

    .btn-next {
        width: 100%;
        background-color: #2D5A27; 
        color: white;
        padding: 12px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
    }

    .btn-back {
        width: 100%;
        background-color: #718096; /* Pemilihan warna abu solid maskulin */
        color: white;
        padding: 12px;
        border: none;
        border-radius: 10px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
    }

    .btn-next:hover { background-color: #1e3d1a; }
    .btn-back:hover { background-color: #4a5568; }

    /* --- RESPONSIVE ENGINE MOBILE HP --- */
    @media (max-width: 576px) {
        .section-login h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .login-box {
            width: 92%;
            padding: 30px 20px;
            border-radius: 20px;
        }

        .login-box h3 {
            font-size: 18px;
        }

        .login-box p {
            font-size: 12px;
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 10px 12px;
            font-size: 14px;
        }
    }
</style>

<div class="section-login">
    <h2>Masuk Sebagai Admin</h2>

    <div class="login-box">
        <h3>Lupa Password</h3>
        <p>Untuk alasan keamanan kami akan mengirimkan kode 
           One Time Password (OTP) melalui email anda. 
           Silahkan masukkan alamat email yang terdaftar.</p>

        <form action="/forgot" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn-next">Next</button>
                <button type="button" class="btn-back" onclick="window.location.href='/login'">Kembali</button>
            </div>
        </form>
    </div>
</div>
@endsection