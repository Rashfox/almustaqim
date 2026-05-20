@extends('master')

@section('title', 'Tentang Kami - Majelis Al-Mustaqim')

@section('content')
<style>
    .section-about {
        background-color: var(--bg-terang); 
        padding: 60px 20px;
        min-height: 85vh;
        font-family: 'Inria Serif', serif;
        box-sizing: border-box;
    }
    .about-container {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    .about-header {
        text-align: center;
        margin-bottom: 20px;
    }
    .about-header h2 {
        font-size: 24px;
        font-weight: 700;
        text-transform: uppercase;
        margin: 0;
        color: var(--teks-gelap);
        letter-spacing: 1px;
    }
    .about-header h2::after {
        content: '';
        display: block;
        width: 40px;
        height: 3px;
        background-color: var(--hijau-toska);
        margin: 10px auto 0;
    }

    .about-content {
        display: flex;
        align-items: stretch; 
        gap: 40px;
        background-color: #ffffff;
        padding: 30px;
        border: 1px solid var(--border-color);
        border-bottom: 4px solid var(--hijau-utama);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
    }

    .about-image {
        flex: 1;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .about-image img {
        width: 100%;
        height: 100%;
        min-height: 280px;
        object-fit: cover;
        display: block;
    }

    .about-text {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .about-text h3 {
        font-size: 24px;
        color: var(--hijau-utama);
        margin-top: 0;
        text-align: center;
        margin-bottom: 15px;
        text-uppercase: uppercase;
        letter-spacing: 0.5px;
    }

    .about-text p {
        font-size: 15.5px;
        line-height: 1.7;
        text-align: justify;
        color: var(--teks-mutasi);
        margin: 0;
    }

    .vision-mission {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .box-info {
        background-color: #ffffff;
        padding: 35px;
        border: 1px solid var(--border-color);
        border-bottom: 4px solid var(--hijau-utama); 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
        display: flex;
        flex-direction: column;
    }

    .box-info h4 {
        font-size: 20px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 20px;
        color: var(--teks-gelap);
        text-align: center;
        letter-spacing: 1px;
    }

    .box-info p {
        font-size: 15px;
        line-height: 1.7;
        color: var(--teks-mutasi);
        margin: 0;
    }

    .box-info ul {
        padding-left: 20px;
        margin: 0;
        line-height: 1.8;
        color: var(--teks-mutasi);
        font-size: 15px;
    }

    .box-info li {
        margin-bottom: 8px;
    }
    
    .box-info li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .about-content {
            flex-direction: column;
        }
        .vision-mission {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .section-about {
            padding: 40px 15px;
        }
        .about-header h2 {
            font-size: 26px;
        }
        .about-content {
            padding: 20px;
            gap: 20px;
        }
        .about-image img {
            min-height: 200px;
            height: 220px;
        }
        .about-text h3 {
            font-size: 20px;
        }
        .box-info {
            padding: 25px;
        }
    }
</style>

<div class="section-about">
    <div class="about-container">
        <div class="about-header">
            <h2>Tentang Kami</h2>
        </div>

        <div class="about-content">
            <div class="about-image">
                <img src="https://idweb.tech/api/preview.php?file=ewwrltjb.jpg" alt="Profil UKM Majelis Al-Mustaqim">
            </div>
            <div class="about-text">
                <h3>UKM Majelis Al-Mustaqim</h3>
                <p>
                    UKM Majelis Al-Mustaqim merupakan organisasi mahasiswa di Politeknik Negeri Cilacap 
                    yang berfokus pada pengembangan spiritualitas, ukhuwah islamiyah, dan kreativitas 
                    mahasiswa muslim. Kami hadir sebagai wadah untuk memperdalam ilmu agama sekaligus 
                    membangun karakter yang berakhlakul karimah di lingkungan kampus.
                </p>
            </div>
        </div>

        <div class="vision-mission">
            <div class="box-info">
                <h4>VISI</h4>
                <p style="text-align: center;">
                    Menjadi organisasi dakwah kampus yang inklusif, unggul dalam intelektualitas, 
                    dan kokoh dalam spiritualitas demi terciptanya generasi rabbani.
                </p>
            </div>
            
            <div class="box-info">
                <h4>MISI</h4>
                <ul>
                    <li>Menyelenggarakan kajian keislaman yang rutin dan berkualitas.</li>
                    <li>Membangun solidaritas antar mahasiswa muslim kampus.</li>
                    <li>Mengembangkan potensi minat dan bakat melalui kegiatan kreatif.</li>
                    <li>Menanamkan nilai-nilai Islam dalam kehidupan sehari-hari.</li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection