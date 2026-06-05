@extends('dashboard/master')
@section('title', 'Edit User - Majelis Al-Mustaqim')

@section('content')
<div class="section-tambah-user">
    <div class="card-form-kotak">
        
        <h4 class="fw-bold text-dark mb-4 text-uppercase" style="letter-spacing: 0.5px; font-size: 1.1rem; border-bottom: 2px solid #f4f6f9; padding-bottom: 10px;">
            <i class="bx bx-edit align-middle me-1"></i> Edit Data User
        </h4>

        @if ($errors->any())
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #842029; padding: 15px; border-radius: 0px; margin-bottom: 20px; border: 1px solid #f5c2c7;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li class="fw-bold" style="font-size: 0.9rem;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/dashboard/user/update/{{ $user->id }}" method="post">
            @csrf
            
            <div class="form-flex-wrapper">
                
                <div class="kolom-form-kiri">
                    <div class="form-group-kotak">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" name="nama" value="{{ old('nama', $user->nama) }}" placeholder="Masukkan nama lengkap user" required autocomplete="off">
                    </div>
                    
                    <div class="form-group-kotak">
                        <label for="email">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="contoh@almustaqim.pnc.ac.id" required autocomplete="off">
                    </div>
                    
                    <div class="form-group-kotak">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" placeholder="Masukkan username unik" required autocomplete="off">
                    </div>
                </div>

                <div class="kolom-form-kanan">
                    <div class="form-group-kotak">
                        <label for="password">Password Baru</label>
                        <div class="input-group-kotak">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah">
                            <button class="btn-toggle-eye" type="button" id="togglePassword">
                                <i class="bx bx-show fs-4" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-group-kotak">
                        <label for="confirm_password">Konfirmasi Password Baru</label>
                        <div class="input-group-kotak">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Ulangi password baru di atas">
                            <button class="btn-toggle-eye" type="button" id="toggleConfirmPassword">
                                <i class="bx bx-show fs-4" id="confirmEyeIcon"></i>
                            </button>
                        </div>
                        <small id="password-error" class="text-danger fw-bold mt-2 d-block" style="display: none;"></small>
                    </div>

                    <div class="form-group-kotak">
                        <label for="role">Hak Akses / Role</label>
                        @if ($user->id == 1)
                        <select class="form-control form-select" id="role" name="role" disabled style="border-radius: 0px !important; height: 48px;">
                            <option value="" disabled>-- Pilih Role Akses --</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super admin" {{ old('role', $user->role) == 'super admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        <input type="hidden" name="role" value="{{ $user->role }}">
                        @else
                        <select class="form-control form-select" id="role" name="role" required style="border-radius: 0px !important; height: 48px;">
                            <option value="" disabled>-- Pilih Role Akses --</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super admin" {{ old('role', $user->role) == 'super admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @endif
                    </div>
                </div>

            </div>

            <div class="tombol-wrapper-bawah">
                <a href="/dashboard/user" class="btn btn-batal btn-event">
                    <i class="bx bx-x align-middle fs-5 me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-simpan btn-event shadow-sm">
                    <i class="bx bx-check align-middle fs-5 me-1"></i> Perbarui
                </button>
            </div>

        </form>
    </div>
</div>

<style>
    .section-tambah-user {
        min-height: 85vh;
        background-color: #f4f6f9;
        padding: 40px 15px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        box-sizing: border-box;
    }

    .card-form-kotak {
        background-color: #ffffff;
        border: 1px solid #e3e8ee;
        border-top: 4px solid #198754; 
        border-radius: 0px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 35px;
        width: 100%;
        max-width: 1000px;
        box-sizing: border-box;
    }

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

    @media (min-width: 768px) {
        .kolom-form-kiri {
            border-right: 1px solid #e2e8f0;
            padding-right: 30px;
        }
    }

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

    .input-group-kotak {
        display: flex;
        width: 100%;
        box-sizing: border-box;
    }

    .input-group-kotak .form-control {
        flex: 1;
    }

    .input-group-kotak .btn-toggle-eye {
        border: 1px solid #cbd5e0;
        border-left: none;
        background: #ffffff;
        color: #718096;
        padding: 0 16px;
        border-radius: 0px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-sizing: border-box;
    }

    .input-group-kotak .btn-toggle-eye:hover {
        background-color: #f8f9fa;
        color: #1a202c;
    }

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

    .btn-simpan:hover { background-color: #146c43; }
    .btn-batal { background-color: #dc3545; color: white; }
    .btn-batal:hover { background-color: #bb2d3b; }
</style>

<script>
    const form = document.querySelector('form');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const errorContainer = document.getElementById('password-error');
    
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');
    
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmEyeIcon = document.getElementById('confirmEyeIcon');

    // Validasi kecocokan saat tombol perbarui ditekan
    form.addEventListener('submit', function(e) {
        if (passwordInput.value !== confirmPasswordInput.value) {
            e.preventDefault();
            errorContainer.textContent = 'Konfirmasi password baru tidak cocok. Silakan periksa kembali.';
            errorContainer.style.display = 'block'; 
            confirmPasswordInput.style.borderColor = '#dc3545';
        } else {
            errorContainer.style.display = 'none';
            confirmPasswordInput.style.borderColor = '#cbd5e0';
        }
    });

    confirmPasswordInput.addEventListener('input', function() {
        errorContainer.style.display = 'none';
        confirmPasswordInput.style.borderColor = '#cbd5e0';
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