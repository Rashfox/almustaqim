@extends('master')

@section('title', 'Login - Majelis Al-Mustaqim')

@section('content')
<style>
    *{
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
        padding: 20px 15px;
    }

    .section-login h2 {
        color: #000;
        font-weight: 700;
        margin-bottom: 25px;
        text-shadow: 1px 1px 2px rgba(255,255,255,0.8);
        text-align: center;
        font-size: 24px; /* Ukuran font judul diatur konstan aman */
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.92); /* Putih bersih transparan */
        backdrop-filter: blur(8px); /* Efek kaca blur di belakang box */
        -webkit-backdrop-filter: blur(8px);
        width: 90%;
        max-width: 400px;
        padding: 40px;
        border-radius: 24px; /* Sudut melengkung halus khas modern UI */
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .login-box h3 {
        font-weight: 800;
        margin-bottom: 30px;
        color: #000;
        font-size: 22px;
    }

    .form-group {
        text-align: left;
        margin-bottom: 20px;
        width: 100%;
    }

    .form-group label {
        display: block;
        font-weight: 700;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px; /* Sempurnakan ketebalan field */
        border: 1px solid #888;
        border-radius: 10px;
        background-color: #E8E8E8;
        outline: none;
        font-size: 15px;
    }

    .extra-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        margin-bottom: 25px;
        width: 100%;
    }

    .extra-options a {
        color: #d93025;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-signin {
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

    .btn-signin:hover {
        background-color: #1e3d1a;
    }

    @media (max-width: 576px) {
        .section-login h2 {
            font-size: 20px; 
            margin-bottom: 15px;
        }

        .login-box {
            padding: 25px 20px; 
            border-radius: 20px;
        }

        .login-box h3 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .form-group input {
            padding: 10px 12px;
            font-size: 14px;
        }

        .extra-options, a{
            font-size: 12px;
            flex-direction: row; /* Tetap horizontal kiri kanan */
        }
    }
</style>

<div class="section-login">
    <h2>Masuk Sebagai Admin</h2>

    <div class="login-box">
        <h3>Selamat datang</h3>

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter your username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="********" required>
            </div>

            <div class="extra-options">
                <label>
                    <input type="checkbox" name="remember"> remember me
                </label>
                <a href="forgot">Forgot password</a>
            </div>

            <button type="submit" class="btn-signin">Sign in</button>
        </form>
    </div>
</div>
@endsection