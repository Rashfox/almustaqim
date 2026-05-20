<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class mailerController extends Controller
{
    public function sendOTP(Request $request)
    {
        $email = $request->email;
        // Di sini biasanya kamu bikin kode OTP random
        $otp = rand(100000, 999999); 

        $mail = new PHPMailer(true);

        try {
            // Pengaturan Server SMTP (Contoh pakai Gmail)
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = '1f2876197f17dc'; // Ganti email majelis
            $mail->Password   = '****385f';    // Pakai App Password Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 2525;

            // Penerima
            $mail->setFrom('support@almustaqim.pnc.ac.id', 'Admin Majelis Al-Mustaqim');
            $mail->addAddress($email);

            // Konten Email
            $mail->isHTML(true);
            $mail->Subject = 'Kode OTP Lupa Password';
            $mail->Body    = "Halo, kode OTP kamu untuk reset password adalah: <b>$otp</b>. Kode ini berlaku selama 5 menit.";

            $mail->send();
            
            // Redirect ke halaman verifikasi OTP
            return redirect()->back()->with('success', 'Kode OTP telah dikirim ke email anda!');

        } catch (Exception $e) {
            return redirect()->back()->with('error', "Gagal mengirim email: {$mail->ErrorInfo}");
        }
    }
}