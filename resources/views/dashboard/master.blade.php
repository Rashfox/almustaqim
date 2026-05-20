<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="https://idweb.tech/api/preview.php?file=fdygtmrt.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Majelis Al-Mustaqim')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inria Serif', Arial, sans-serif; margin: 0; padding: 0; background-color: #A9A9A9; }
        :root {
            --hijau-utama: #1b4314;
            --hijau-toska: #009688;
            --bg-terang: #f8fafc;
            --teks-gelap: #1e293b;
            --kuning-lemon: #ebfb09;
            --border-color: #e2e8f0;
        }
        header {
            background-color: var(--hijau-utama) !important;
        }
        footer {
            background-color: var(--teks-gelap) !important;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
            padding: 10px 50px;
        }
        .logo-section a { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-section a img { height: 40px; }
        .logo-text { font-size: 16px; line-height: 1.5; color: #fff; }
        
        nav { display: flex; align-items: center; gap: 25px; }
        nav a { color: #fff; text-decoration: none; font-size: 16px; }
        .login-btn { background: none; border: none; color: white; display: flex; align-items: center; gap: 5px; cursor: pointer; }

        .global-alert-wrapper {
            position: fixed;
            top: 25px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999999;
            width: 90%;
            max-width: 480px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .custom-toast {
            display: flex;
            align-items: center;
            padding: 14px 40px 14px 16px;
            border-radius: 16px;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            animation: slideDownFade 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.1) forwards;
            transition: all 0.3s ease;
        }
        .toast-success { background-color: #c6ecd9; }
        .toast-success .toast-icon-box { background-color: #52c41a; color: #ffffff; }
        .toast-success .toast-content-text { color: #1e4620; font-weight: 600; font-size: 14px; }
        .toast-success .toast-btn-close { color: #1e4620; }

        .toast-error { background-color: #f5c6cb; }
        .toast-error .toast-icon-box { background-color: #ff4d4f; color: #ffffff; }
        .toast-error .toast-content-text { color: #611a1f; font-weight: 600; font-size: 14px; }
        .toast-error .toast-btn-close { color: #611a1f; }

        .toast-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: bold;
            flex-shrink: 0;
            margin-right: 12px;
        }
        .toast-content-text { text-align: left; line-height: 1.4; }
        .toast-list-errors { margin: 0; padding-left: 15px; }
        .toast-btn-close {
            position: absolute;
            top: 12px;
            right: 14px;
            background: none;
            border: none;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            opacity: 0.6;
            padding: 0;
            line-height: 1;
        }
        .toast-btn-close:hover { opacity: 1; }
        .toast-fade-out { opacity: 0; transform: translateY(-10px); margin-top: -50px; }

        @keyframes slideDownFade {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

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
            z-index: 1000000;
        }
        .custom-overlay-logout.aktif { display: block; }
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
        }
        .box-confirm-logout h4 { font-size: 18px; font-weight: 500; color: #595959; margin-bottom: 15px; }
        .btn-logout-ya { background-color: #dc3545; color: white; border: none; padding: 8px 20px; font-size: 14px; font-weight: 500; border-radius: 4px; cursor: pointer; }
        .btn-logout-batal { background-color: #3085d6; color: white; border: none; padding: 8px 20px; font-size: 14px; font-weight: 500; border-radius: 4px; cursor: pointer; }

        /* content event */
        .section-event {
            background-color: var(--bg-terang); 
            padding: 40px 20px 60px 20px;
            box-sizing: border-box;
        }
        .section-event h2 {
            font-family: 'Inria Serif', serif;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 35px;
            color: var(--teks-gelap);
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 1.5px;
        }
        .section-event h2::after {
            content: '';
            display: block;
            width: 40px;
            height: 3px;
            background-color: var(--hijau-toska);
            margin: 10px auto 0;
        }
        .event-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); 
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
            box-sizing: border-box;
        }
        .event-card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0px !important; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            overflow: hidden;
            display: flex;
            flex-direction: column; 
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-sizing: border-box;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(27, 67, 20, 0.08);
            border-color: var(--hijau-toska);
        }
        .event-image-wrapper {
            width: 100%;
            height: 220px;
            position: relative;
            overflow: hidden;
            background-color: #f1f5f9;
        }
        .event-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .event-info {
            background-color: #ffffff;
            padding: 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }        .event-date-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .badge-kegiatan {
            background-color: var(--hijau-toska);
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .event-date {
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .event-title {
            font-family: 'Inria Serif', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--teks-gelap);
            margin: 0 0 12px 0;
            line-height: 1.4;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .desc-container {
            font-family: 'Inria Serif', serif;
            font-size: 14.5px;
            line-height: 1.6;
            color: #475569;
            text-align: justify;
            margin-bottom: 15px;
        }
        .desc-text {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .btn-baca-detail {
            align-self: flex-start;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--hijau-utama);
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
            padding-bottom: 2px;
        }
        .btn-baca-detail:hover {
            color: #005b51;
            border-bottom-color: #005b51;
        }

        /* Footer */
        footer { color: #fff; padding: 10px 50px;}
        .footer-content {display: flex; justify-content: space-between;}
        .footer-right { flex: 80%;}
        .footer-text { font-size: 13px; }
        .kuning-ikon { color: #D4D925;}
        .footer-links { flex: 5%; margin-top: 50px; }
        .footer-links h4 {font-size: 18px;}
        .footer-text { color: #fff;}
        .text-link { color: #d9d9d9; text-decoration: none; font-size: 16px;}
        li a { text-decoration: none; font-size: 16px}
        .footer-links ul { list-style: none; padding: 0; font-size: 13px; }
        .footer-links li { margin-bottom: 8px; }
        .copyright { text-align: center; background-color: #282828; border-top: 1px solid rgba(255,255,255,0.1); padding: 10px 0; font-size: 12px; }
        
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                padding: 15px 20px;
                gap: 15px;
                text-align: center;
            }
            .logo-section a { flex-direction: column; gap: 5px; }
            nav {
                gap: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            footer { padding: 30px 25px 15px !important; }
            .footer-content { flex-direction: row !important; flex-wrap: wrap; justify-content: space-between; gap: 20px; }
            .footer-right { flex: 60% !important; min-width: 220px; text-align: left; }
            .footer-links { flex: 0% !important; text-align: left; }
            .footer-links ul { display: flex; flex-direction: column; padding: 0; gap: 8px; }
        }
        @media (max-width: 576px) {
            .footer-content { flex-direction: column !important; text-align: center; gap: 30px; }
            .footer-right, .footer-links { flex: 100%; text-align: center; margin-top: 0; }
            .copyright div{ margin: auto; }
            .footer-links ul { align-items: center; }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo-section">
            <a href="/dashboard">
                <img src="https://idweb.tech/api/preview.php?file=fdygtmrt.png" style="height: 50px;" alt="Logo">
                <div class="logo-text">
                    Unit Kegiatan Mahasiswa<br><b style="color: var(--kuning-lemon);">Majelis Al-Mustaqim</b>
                </div>
            </a>
        </div>
        <nav>
            <a href="/dashboard">Home</a>
            <a href="/dashboard/event">Event</a>
            @if(session('role') === 'super admin')
                <a href="/dashboard/user"><i class='bx bx-group align-middle me-1'></i> Kelola User</a>
            @endif
            <a href="/dashboard/profile"><i class='bx bxs-user-circle align-middle me-1'></i> {{ session('username') }}</a>
            <a href="javascript:void(0);" id="navTriggerLogOut" style="color: #ffc107;"><i class='bx bx-log-out align-middle me-1'></i> Logout</a>
        </nav>
    </header>

    <div class="global-alert-wrapper">
        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="custom-toast toast-success" role="alert">
                <div class="toast-icon-box"><i class="bx bx-check"></i></div>
                <div class="toast-content-text">{{ session('success') }}</div>
                <button type="button" class="toast-btn-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        {{-- Alert Gagal / Eror --}}
        @if (session('error'))
            <div class="custom-toast toast-error" role="alert">
                <div class="toast-icon-box"><i class="bx bx-x"></i></div>
                <div class="toast-content-text">{{ session('error') }}</div>
                <button type="button" class="toast-btn-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif

        {{-- Alert Validasi Form --}}
        @if ($errors->any())
            <div class="custom-toast toast-error" role="alert">
                <div class="toast-icon-box"><i class="bx bx-error"></i></div>
                <div class="toast-content-text">
                    @if($errors->count() == 1)
                        {{ $errors->first() }}
                    @else
                        <strong class="d-block mb-1">Ada kesalahan:</strong>
                        <ul class="toast-list-errors">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button type="button" class="toast-btn-close" onclick="this.parentElement.remove()">&times;</button>
            </div>
        @endif
    </div>

    @yield('content')

    <footer>
        <div class="footer-content">
            <div class="footer-right">
                <div class="footer-info">
                    <a href="/dashboard"><img src="https://idweb.tech/api/preview.php?file=fdygtmrt.png" alt="Logo" style="height: 50px; margin-bottom: 10px;"></a>
                </div>
                <div class="footer-text">
                    <p><i class='bx bxs-map kuning-ikon'></i><a href="https://maps.google.com" target="_blank" class="text-link">Jl. Dr. Soetomo No. 1, Sidakaya, Kabupaten Cilacap, Jawa Tengah 53212, Indonesia</a></p>
                    <p><i class='bx bxs-envelope kuning-ikon'></i><a href="mailto:almustaqim@pnc.ac.id" class="text-link"> almustaqim@pnc.ac.id</a></p>
                </div>
            </div>

            <div class="footer-links">
                <h4>Lihat juga</h4>
                <ul>
                    <li><a class="text-link" href="/dashboard/event">Kegiatan</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <footer class="copyright">
        <div>
            © 2026 UKM Majelis Al-Mustaqim. All rights reserved
        </div>
    </footer>
    
    <div id="masterOverlayLogOut" class="custom-overlay-logout">
        <div class="box-confirm-logout">
            <div class="overlay-icon-logout-warning">!</div>
            <h4>Yakin ingin keluar?</h4>
            
            <div class="d-flex gap-2 justify-content-center">
                <button type="button" id="masterBtnYesLogOut" class="btn-logout-ya">Ya</button>
                <button type="button" id="masterBtnCancelLogOut" class="btn-logout-batal">Batal</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const customToasts = document.querySelectorAll('.custom-toast');
            customToasts.forEach(function(toast) {
                setTimeout(function() {
                    toast.classList.add('toast-fade-out');
                    setTimeout(function() {
                        toast.remove();
                    }, 300);
                }, 3000);
            });

            const overlay = document.getElementById('masterOverlayLogOut');
            const triggerBtn = document.getElementById('navTriggerLogOut');
            const cancelBtn = document.getElementById('masterBtnCancelLogOut');
            const yesBtn = document.getElementById('masterBtnYesLogOut');

            if(triggerBtn && overlay) {
                // Buka overlay konfirmasi saat tombol Logout di klik
                triggerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    overlay.classList.add('aktif');
                });

                // Tutup saat tombol Batal di klik
                cancelBtn.addEventListener('click', function() {
                    overlay.classList.remove('aktif');
                });

                // Tutup otomatis jika admin mengklik area hitam blur di luar box putih
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) {
                        overlay.classList.remove('aktif');
                    }
                });

                // Eksekusi Submit Form POST Virtual saat mengklik "Ya" demi standard keamanan Laravel
                yesBtn.addEventListener('click', function() {
                    overlay.classList.remove('aktif');

                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ url('/logout') }}";
                    form.style.display = 'none';

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = "{{ csrf_token() }}";

                    form.appendChild(csrfToken);
                    document.body.appendChild(form);
                    form.submit();
                });
            }
        });
    </script>
</body>
</html>