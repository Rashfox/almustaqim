@extends('master')

@section('title', 'Reset Password - Majelis Al-Mustaqim')

@section('content')
<style>
    *{
        box-sizing: border-box;
    }
    .section-login {
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), 
                    url('https://www.combotour.it/public/immagini/d24/f37/web/Abu-dhabi.jpg');
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
        font-size: 24px;
    }

    .login-box {
        background-color: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        width: 90%;
        max-width: 400px;
        padding: 40px;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .login-box h3 {
        font-weight: 800;
        margin-bottom: 10px;
        color: #000;
        font-size: 22px;
    }

    .login-box p {
        font-size: 14px;
        color: #555;
        margin-bottom: 25px;
        line-height: 1.4;
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

    .input-password-wrapper {
        position: relative;
        width: 100%;
    }

    .form-group input {
        width: 100%;
        padding: 12px 45px 12px 15px;
        border: 1px solid #888;
        border-radius: 10px;
        background-color: #E8E8E8;
        outline: none;
        font-size: 15px;
        transition: border-color 0.2s;
    }

    /* CSS Tombol Mata di dalam form */
    .btn-toggle-eye {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 0;
        color: #666;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
    }

    .btn-toggle-eye:hover {
        color: #000;
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
        margin-top: 10px;
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
            padding: 10px 40px 10px 12px;
            font-size: 14px;
        }
        
        .btn-toggle-eye {
            right: 12px;
        }
    }
</style>

<div class="section-login">
    <h2>Masuk Sebagai Admin</h2>

    <div class="login-box">
        <h3>Lupa Password</h3>
        <p>Ubah password anda agar sulit ditebak dan ingatlah password ini.</p>

        <form action="/resetpassword" method="POST">
            @csrf
            <div class="form-group">
                <label>Password Baru</label>
                <div class="input-password-wrapper">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Pasword Baru">
                    <button class="btn-toggle-eye" type="button" id="togglePassword">
                        <i class="bx bx-show fs-4" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-password-wrapper">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi password baru di atas">
                    <button class="btn-toggle-eye" type="button" id="toggleConfirmPassword">
                        <i class="bx bx-show fs-4" id="confirmEyeIcon"></i>
                    </button>
                </div>
            </div>
            
            <small id="password-error" class="text-danger fw-bold mb-3 d-block" style="display: none; text-align: left;"></small>
            <button type="submit" class="btn-signin">Simpan</button>
        </form>
    </div>
</div>

<script>
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const errorContainer = document.getElementById('password-error');
    
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');
    
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmEyeIcon = document.getElementById('confirmEyeIcon');

    form.addEventListener('submit', function(e) {
        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            errorContainer.textContent = 'Konfirmasi password baru tidak cocok. Silakan periksa kembali.';
            errorContainer.style.display = 'block'; 
            confirmPasswordInput.style.borderColor = '#dc3545';
        } else {
            errorContainer.style.display = 'none';
            confirmPasswordInput.style.borderColor = '#888';
        }
    });

    confirmPasswordInput.addEventListener('input', function() {
        errorContainer.style.display = 'none';
        confirmPasswordInput.style.borderColor = '#888';
    });

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('bx-show');
        eyeIcon.classList.toggle('bx-hide');
    });
    
    toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        confirmEyeIcon.classList.toggle('bx-show');
        confirmEyeIcon.classList.toggle('bx-hide');
    });
</script>
@endsection