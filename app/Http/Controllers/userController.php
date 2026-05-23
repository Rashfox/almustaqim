<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\KodeOtp;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class userController extends Controller{
    public function Login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;
        $admin = Admin::where('username', $username)->first();
        $email = Admin::where('email', $username)->first();
        if ($admin && Hash::check($password, $admin->password)){
            if ($admin->email_verified_at == null) {
                return redirect('/login')->with('error', 'Akun Anda belum diaktivasi! Silakan cek email Anda untuk melakukan verifikasi.');
            }
            session(['username' => $admin->username,'role' => $admin->role]);
            $request->session()->regenerate();
            if ($remember){
                Cookie::queue('remember_username', $admin->username, 4320); // 3 hari
            }
            return redirect('/dashboard');
        }
        else if ($email && Hash::check($password, $email->password)){
            if ($email->email_verified_at == null) {
                return redirect('/login')->with('error', 'Akun Anda belum diaktivasi! Silakan cek email Anda untuk melakukan verifikasi.');
            }
            session(['username' => $email->username,'role' => $email->role]);
            $request->session()->regenerate();
            if ($remember){
                Cookie::queue('remember_username', $email->username, 4320); 
            }
            return redirect('/dashboard');
        }else {
            return redirect('/login')->with('error', 'Username atau password salah!');
        }
    }
    public function addUser(Request $request){
        if (session('role') !== 'super admin') {
            return redirect('/dashboard')->with('error', 'Hak akses ditolak! Menu ini hanya untuk Super Admin.');
        }
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:admin',
            'nama' => 'required|string|max:255',
            'role' => 'required|string|in:admin,super admin'
        ]);
        $password = $request->password;
        $newAdmin = Admin::create([
            'username' => $request->username,
            'password' => Hash::make($password),
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role
        ]);
        $this->sendVerifyCode($newAdmin, $password);
        return redirect('/dashboard/user')->with('success', 'User baru berhasil ditambahkan!');
    }
    public function updateUser(Request $request){
        if (session('role') !== 'super admin') {
            return redirect('/dashboard')->with('error', 'Hak akses ditolak! Menu ini hanya untuk Super Admin.');
        }
        $admin =  Admin::where('id', $request->id)->first();
        $subject = 'Pemberitahuan Perubahan Akun - Majelis Al-Mustaqim';
        $htmlContent = "
            <h3>Assalamualaikum, {$admin->nama}!</h3>
            <p>Kami ingin menginformasikan bahwa akun Anda pada sistem dashboard <b>UKM Majelis Al-Mustaqim</b> telah diganti oleh Super Admin.</p>
            <p>Mulai saat ini, Email anda sudah tidak memiliki akses untuk login ke dalam sistem dashboard admin.</p>
            <p>Jika Anda merasa ini adalah sebuah kesalahan, silakan hubungi pengurus divisi administrasi Majelis Al-Mustaqim.</p>
            <br>
            <p>Terima kasih atas dedikasi dan kontribusi yang telah Anda berikan selama ini.</p>
            <br>
            <p>Wassalamu'alaikum,<br><b>Admin UKM Majelis Al-Mustaqim</b></p>
        ";
        $emailLama = $admin->email;
        $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $admin->id,
            'email' => 'required|string|email|max:255|unique:admin,email,'. $admin->id,
            'nama' => 'required|string|max:255',
            'role' => 'required|string|in:admin,super admin',
            'password' => 'nullable|string|min:8',
        ]);
        $admin->nama = $request->nama;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->role = $request->role;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        if ($request->email != $emailLama) {
            $admin->email_verified_at = null;
            $passwordText = $request->filled('password') ? $request->password : '[Password Tidak Diubah]';
            $this->sendVerifyCode($admin, $passwordText);
            $this->sendNotify($emailLama,$subject,$htmlContent);
        }
        $admin->save();
        return redirect('/dashboard/user')->with('success', 'Data user berhasil diperbarui!');
    }
    public function deleteUser(Request $request){
        if (session('role') !== 'super admin') {
            return redirect('/dashboard')->with('error', 'Hak akses ditolak! Menu ini hanya untuk Super Admin.');
        }
        $admin = Admin::where('id', $request->id)->first();
        if (!$admin) {
            return redirect('dashboard/user')->with('error', 'Data user tidak ditemukan atau sudah dihapus!');
        }
        $subject = 'Pemberitahuan Penonaktifan Akun - Majelis Al-Mustaqim';
        $htmlContent = "
            <h3>Assalamualaikum, {$admin->nama}!</h3>
            <p>Kami ingin menginformasikan bahwa akun Anda pada sistem dashboard <b>UKM Majelis Al-Mustaqim</b> telah dinonaktifkan atau dihapus oleh Super Admin.</p>
            <p>Mulai saat ini, Anda sudah tidak memiliki akses untuk login kembali ke dalam sistem dashboard admin.</p>
            <p>Jika Anda merasa ini adalah sebuah kesalahan, silakan hubungi pengurus divisi administrasi Majelis Al-Mustaqim.</p>
            <br>
            <p>Terima kasih atas dedikasi dan kontribusi yang telah Anda berikan selama ini.</p>
            <br>
            <p>Wassalamu'alaikum,<br><b>Admin UKM Majelis Al-Mustaqim</b></p>
        ";
        $this->sendNotify($admin->email, $subject, $htmlContent);
        $admin->delete();
        return redirect('dashboard/user')->with('success', 'Data user telah berhasil dihapus');
    }
    private function sendNotify($user, $subjek, $body){
        try {
            $emailTujuan = $user;

            Mail::send([], [], function ($message) use ($emailTujuan, $subjek, $body) {
                $message->to($emailTujuan)
                        ->subject($subjek)
                        ->html($body);
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    private function sendVerifyCode($user, $password){
        $token = Str::random(64); 
        KodeOtp::where('email', $user->email)->where('action', 'register')->delete();
        KodeOtp::create([
            'email'      => $user->email,
            'otp'        => $token,
            'action'     => 'register',
            'expires_at' => now()->addHours(24),
        ]);
        $verificationUrl = url('/verify/' . $token);
        try {
            Mail::send([], [], function ($message) use ($user, $verificationUrl, $password) {
                $message->to($user->email)
                        ->subject('Aktivasi Akun Baru - Majelis Al-Mustaqim')
                        ->html("
                            <h3>Assalamualaikum, {$user->nama}!</h3>
                            <p>Akun Anda telah berhasil didaftarkan di sistem UKM Majelis Al-Mustaqim.</p>
                            <p>Login dengan username: <b>{$user->username}</b></p>
                            <p>Lalu Password: <b>{$password}</b></p>
                            <p>Silakan klik tombol di bawah ini untuk melakukan aktivasi akun Anda secara otomatis:</p>
                            <br>
                            <a href='{$verificationUrl}' style='display: inline-block; padding: 12px 24px; background-color: #198754; color: white; text-decoration: none; font-weight: bold; border-radius: 0px;'>
                                AKTIVASIKAN AKUN SAYA
                            </a>
                            <br><br>
                            <p>Jika tombol di atas tidak berfungsi, Anda juga bisa menyalin link berikut ke browser Anda:</p>
                            <p><a href='{$verificationUrl}'>{$verificationUrl}</a></p>
                            <p>Link ini hanya berlaku selama 24 jam.</p>
                            <br>
                            <p>Wassalamu'alaikum,<br><b>Admin UKM Majelis Al-Mustaqim</b></p>
                        ");
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function verify($token){
        $kodeOtp = KodeOtp::where('otp', $token)
                        ->where('action', 'register')
                        ->where('expires_at', '>', now())
                        ->first();
        if (!$kodeOtp) {
            return redirect('/login')->with('error', 'Token verifikasi tidak valid atau sudah kadaluarsa!');
        }
        $admin = Admin::where('email', $kodeOtp->email)->first();
        if ($admin) {
            $admin->update([
                'email_verified_at' => now()
            ]);
            $kodeOtp->delete();
            return redirect('/login')->with('success', 'Akun Anda telah berhasil diaktivasi! Silakan login.');
        }
        return redirect('/login')->with('error', 'Akun admin tidak ditemukan!');
    }
    private function sendOTP($email, $admin){
        $otp = rand(100000, 999999); 
        KodeOtp::where('email', $email)->where('action', 'forgot_password')->delete();
        KodeOtp::create([
            'email'      => $email,
            'otp'        => $otp,
            'action'     => 'forgot_password',
            'expires_at' => now()->addMinutes(5),
        ]);
        session([
            'otp' => $otp, 
            'otp_expiry' => now()->addMinutes(5),
            'email_reset' => $email
        ]);
        try {
            Mail::send([], [], function ($message) use ($email, $otp, $admin) {
                $message->to($email)
                        ->subject('Kode OTP Lupa Password - Majelis Al-Mustaqim')
                        ->html("Halo {$admin->nama}, kode OTP kamu untuk reset password adalah: <b>{$otp}</b>. Kode ini berlaku selama 5 menit.");
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;
        $admin = Admin::where('email', $email)->first();
        if ($admin){
            $kirimEmail = $this->sendOTP($email, $admin);
            if ($kirimEmail) {
                return redirect('/otp')->with('success', 'Kode OTP telah dikirim ke email anda!');
            } else {
                return redirect()->back()->with('error', 'Gagal mengirim email OTP. Coba lagi nanti.');
            }
        } else {
            return redirect('/forgot')->with('error', 'Alamat email tidak terdaftar!');
        }
    }
    public function verifyForgot(Request $request){
        $request->validate([
            'otp' => 'required|numeric'
        ]);
        $email = session('email_reset');
        $otp = $request->otp;
        $kodeOtp = KodeOtp::where('email', $email)
                        ->where('otp', $otp)
                        ->where('action', 'forgot_password')
                        ->where('expires_at', '>', now())
                        ->first();
        if (!$kodeOtp) {
            return redirect()->back()->with('error', 'Kode OTP tidak valid atau sudah kadaluarsa!');
        }
        $kodeOtp->delete();
        session(['otp_verified' => true]);
        return redirect('/resetpassword')->with('success', 'OTP Berhasil diverifikasi. Silakan buat password baru!');
    }
    public function resetPassword(Request $request){
        $email = session('email_reset');
        $newpassword = $request->password;
        if (!$email) {
            return redirect('/login')->with('error', 'Sesi reset password telah berakhir.');
        }
        $admin = Admin::where('email', $email)->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'Akun admin tidak ditemukan.');
        }
        if (Hash::check($newpassword, $admin->password)) {
            return redirect()->back()->with('error', 'Password baru tidak boleh sama dengan password lama!');
        }
        $admin->password = Hash::make($newpassword);
        $admin->save();
        session()->forget('email_reset');
        return redirect('/login')->with('success','Password anda telah direset');
    }
    public function logout(Request $request){
        $request->session()->forget('username');
        $request->session()->forget('role');
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (Cookie::has('remember_username')) {
            Cookie::queue(Cookie::forget('remember_username'));
        }
        if (Cookie::has('remember_email')) {
            Cookie::queue(Cookie::forget('remember_email'));
        }
        return redirect('/');
    }
}