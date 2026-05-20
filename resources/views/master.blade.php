<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="https://idweb.tech/api/preview.php?file=fdygtmrt.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Majelis Al-Mustaqim')</title>
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
            top: 20px;
            right: 20px;
            z-index: 99999;
            max-width: 350px;
            width: 100%;
        }
        .floating-toast {
            border-radius: 12px !important;
            border: none !important;
            animation: slideInRight 0.4s ease-outforward;
            margin-bottom: 10px;
        }

        /* Animasi muncul dari kanan layar */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

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
        .footer-right { flex: 40%; font-size: 16px;}
        .footer-text { font-size: 13px; }
        .kuning-ikon { color: #D4D925;}
        .footer-join { flex: 10%; text-align: center; margin: auto;}
        .footer-links { flex: 5%; margin-top: 50px; font-size: 16px; margin-left: 2%;}
        .footer-links h4 {font-size: 18px;}
        .footer-text { color: #fff;}
        .text-link, .footer-join h4,a{ color: #d9d9d9; text-decoration: none; font-size: 16px;}
        li a { text-decoration: none; font-size: 16px;}
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

            footer {
                padding: 30px 25px 15px !important;
            }

            .footer-content {
                flex-direction: row !important; 
                flex-wrap: wrap;
                justify-content: space-between;
                gap: 20px;
            }

            .footer-info {
                flex: 30%; 
                min-width: 220px;
                text-align: left;
            }

            .footer-join {
                flex: 25%; 
                min-width: 150px;
                text-align: center;
            }

            .footer-links{
                flex: 15% !important; 
                min-width: 130px;
                text-align: left;
            }

            .footer-links ul {
                display: flex;
                flex-direction: column; 
                padding: 0;
                gap: 8px;
            }
        }
        @media (max-width: 576px) {
            .footer-content {
                flex-direction: column !important; 
                text-align: center;
                gap: 30px;
            }

            .footer-info, .footer-join, .footer-links {
                flex: 100%;
                text-align: center;
                margin-top: 0;
            }
            .copyright div{
                margin: auto;
            }
            .footer-links ul {
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-section">
            <a href="/">
                <img src="https://idweb.tech/api/preview.php?file=fdygtmrt.png" style="height: 50px;" alt="Logo">
                <div class="logo-text">
                    Unit Kegiatan Mahasiswa<br><b style="color: #ebfb09;">Majelis Al-Mustaqim</b>
                </div>
            </a>
        </div>
        <nav>
            <a href="/">Home</a>
            <a href="/event">Event</a>
            <a href="/about">About</a>
            <a href="/contact">Contact</a>
            <div class="login-btn"><a href="/login"><i class='bx bxs-user'></i> Login</a></div>
        </nav>
    </header>

    {{-- KONTEN ALERT FLOATING GLOBAL --}}
    <div class="global-alert-wrapper">
        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show floating-toast shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-check-circle fs-4 me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Gagal / Eror --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show floating-toast shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-error-circle fs-4 me-2"></i>
                    <div>{{ session('error') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Validasi Form --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show floating-toast shadow-sm" role="alert">
                <div class="d-flex align-items-start">
                    <i class="bx bx-error-circle fs-4 me-2 mt-1"></i>
                    <div>
                        <strong class="d-block mb-1">Ada kesalahan:</strong>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @yield('content')

    <footer>
        <div class="footer-content">
            <div class="footer-right">
                <div class="footer-info">
                    <a href="/"><img src="https://idweb.tech/api/preview.php?file=fdygtmrt.png" alt="Logo" style="height: 50px; margin-bottom: 10px;"></a>
                </div>
                <div class="footer-text">
                    <p><i class='bx bxs-map kuning-ikon'></i> <a href="https://maps.app.goo.gl/CtKYpdYNf8XwdB466" target="_blank" class="text-link">Jl. Dr. Soetomo No. 1, Sidakaya, Kabupaten Cilacap, Jawa Tengah 53212, Indonesia</a></p>
                    <p><i class='bx bxs-envelope kuning-ikon'></i><a href="mailto:almustaqim@pnc.ac.id" class="text-link"> almustaqim@pnc.ac.id</a></p>
                </div>
            </div>
            <div class="footer-join">
                <h4>Tertarik Bergabung?</h4>
                <a href="https://forms.office.com/r/pHk8G7iTsH" target="_blank" class="kuning-ikon">Daftar Sekarang!</a>
            </div>
            <div class="footer-links">
                <h4>Lihat juga</h4>
                <ul>
                    <li><a class="text-link" href="/event">Kegiatan</a></li>
                    <li><a class="text-link" href="/about">Tentang Kami</a></li>
                    <li><a class="text-link" href="/contact">Kontak Kami</a></li>
                </ul>
            </div>
        </div>
        
    </footer>
    <footer class="copyright">
        <div>
            &copy; 2026 UKM Majelis Al-Mustaqim. All rights reserved
        </div>
    </footer>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cari semua elemen dengan class .floating-toast
        const alerts = document.querySelectorAll('.floating-toast');
        
        alerts.forEach(function(alertElement) {
            // Jalankan fungsi setelah 3000ms (3 detik)
            setTimeout(function() {
                // Gunakan class bawaan Bootstrap untuk memicu animasi fade-out
                alertElement.classList.remove('show');
                
                // Hapus elemen secara permanen dari HTML setelah animasi fade-out selesai (sekitar 150ms)
                setTimeout(function() {
                    alertElement.remove();
                }, 150);
            }, 3000); 
        });
    });
</script>
</body>
</html>