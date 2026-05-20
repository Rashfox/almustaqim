@extends('master')

@section('title', 'Contact - Majelis Al-Mustaqim')

@section('content')
<style>
    .section-contact {
        background-color: var(--bg-terang); 
        padding: 60px 20px;
        min-height: 85vh;
        text-align: center;
        font-family: 'Inria Serif', serif;
        box-sizing: border-box;
    }

    .section-contact h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 45px;
        color: var(--teks-gelap);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 0;
    }

    .section-contact h2::after {
        content: '';
        display: block;
        width: 40px;
        height: 3px;
        background-color: var(--hijau-toska);
        margin: 10px auto 0;
    }

    .contact-container {
        background-color: #ffffff;
        max-width: 750px; 
        margin: 0 auto;
        padding: 45px 40px;
        text-align: left;
        border: 1px solid var(--border-color);
        border-bottom: 4px solid var(--hijau-utama); 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.01);
        box-sizing: border-box;
    }

    .contact-container h3 {
        font-size: 20px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 30px;
        color: var(--teks-gelap);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 15px;
    }

    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        box-sizing: border-box;
    }

    .contact-icon {
        font-size: 24px;
        color: var(--hijau-utama);
        background-color: #e0f2f1; 
        padding: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .contact-details {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .contact-details .title-label {
        font-size: 14px;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
    }

    .contact-details .info-text {
        font-size: 17px;
        color: var(--teks-gelap);
        font-weight: 400;
    }

    .text-link-contact {
        color: var(--teks-gelap);
        text-decoration: none;
        transition: color 0.2s;
    }

    .text-link-contact:hover {
        color: var(--hijau-utama);
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .section-contact {
            padding: 40px 15px;
        }
        .section-contact h2 {
            font-size: 26px;
            margin-bottom: 35px;
        }
        .contact-container {
            padding: 30px 20px;
        }
        .contact-container h3 {
            font-size: 17px;
            margin-bottom: 25px;
        }
        .contact-icon {
            font-size: 20px;
            padding: 8px;
        }
        .contact-details .info-text {
            font-size: 15px;
        }
    }
</style>

<div class="section-contact">
    <h2>Kontak Kami</h2>

    <div class="contact-container">
        <h3>Anda butuh bantuan? Hubungi kami:</h3>

        <div class="contact-list">
            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="contact-details">
                    <div class="title-label">Email Resmi</div>
                    <div class="info-text">
                        <a href="mailto:almustaqim@pnc.ac.id" class="text-link-contact">almustaqim@pnc.ac.id</a>
                    </div>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-icon">
                    <i class='bx bxs-phone'></i>
                </div>
                <div class="contact-details">
                    <div class="title-label">Telephone</div>
                    <div class="info-text">(0282) 533329</div>
                </div>
            </div>

            <div class="contact-item" style="margin-top: 10px; padding-top: 20px; border-top: 1px dashed var(--border-color);">
                <div class="contact-icon">
                    <i class='bx bxs-map'></i>
                </div>
                <div class="contact-details">
                    <div class="title-label">Alamat Sekretariat</div>
                    <div class="info-text" style="line-height: 1.6;">
                        <a href="https://maps.google.com/?q=Jl. Dr. Soetomo No.1, Sidakaya, Cilacap" target="_blank" class="text-link-contact" style="font-weight: bold;">
                            Jl. Dr. Soetomo No.1, Sidakaya, Cilacap, Jawa Tengah 53212
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection