<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class viewController extends Controller{
    public function index(){
        $proses = new prosesController;
        $event = Event::orderBy('tanggal', 'desc')->take(2)->get();
        $sliderEvent = $proses->latestEvent();
        return view('home', ['event' => $event, 'sliderEvent' => $sliderEvent]);
    }
    public function event(){
        $event = Event::orderBy('tanggal', 'desc')->paginate(2);
        $arsipBulan = Event::select(
                DB::raw('YEAR(tanggal) as tahun'),
                DB::raw('MONTH(tanggal) as bulan_angka'),
                DB::raw("DATE_FORMAT(tanggal, '%M') as bulan_nama"),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tahun', 'bulan_angka', 'bulan_nama')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan_angka', 'desc')
            ->get();

        return view('event', compact('event', 'arsipBulan'));
    }
    public function detailEvent($id_with_slug){
        $event = Event::findOrFail($id_with_slug);
        $id = $event->id;
        $admin = Event::join('admin', 'event.admin_id', '=', 'admin.id')
        ->select('admin.nama as nama_penulis')->where('event.id', $id)->first();

        if ($admin) {
            $namaPenulis = $admin->nama_penulis;
        } else {
            $namaPenulis = "Admin / Penulis Tidak Ditemukan";
        }
        return view('detailEvent', compact('event', 'namaPenulis'));
    }
    public function arsipEvent($tahun, $bulan){
        $eventArsip = Event::whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)->orderBy('tanggal', 'desc')->paginate(2);
        $daftarBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $namaBulan = $daftarBulan[(int)$bulan] ?? 'Pilihan';
        return view('arsipEvent', compact('eventArsip', 'tahun', 'namaBulan'));
    }
    public function dashboard(){
        if (!session()->has('username') && Cookie::has('remember_username')){
            $usernameCookie = Cookie::get('remember_username');
            session(['username' => $usernameCookie]);
        }
        if (!session()->has('username')){
            return redirect('/login');
        }
        // Hitung jumlah kegiatan 1 bulan terakhir
        $sebulanTerakhir = Event::where('tanggal', '>=', now()->subMonth())->count();
        // Hitung jumlah kegiatan 1 tahun terakhir
        $setahunTerakhir = Event::where('tanggal', '>=', now()->subYear())->count();
        // Ambil data kegiatan dengan tanggal paling terbaru
        $kegiatanTerbaru = Event::orderBy('tanggal', 'desc')->first();

        $sebulanTerakhir = Event::where('tanggal', '>=', now()->subMonth())->count();

        // Hitung total kegiatan
        $totalKegiatan = Event::count();

        // Hitung total admin/user (opsional)
        $totalAdmin = Admin::count();

        $grafikKegiatan = Event::select(
            DB::raw("COUNT(*) as jumlah"), 
            DB::raw("MONTHNAME(tanggal) as bulan")
        )
        ->where('tanggal', '>=', now()->subMonths(6))
        ->groupBy('bulan', DB::raw("MONTH(tanggal)"))
        ->orderBy(DB::raw("MONTH(tanggal)"), 'asc')
        ->get();

        $labelBulan = $grafikKegiatan->pluck('bulan');
        $jumlahKegiatan = $grafikKegiatan->pluck('jumlah');

        $kegiatanTerbaru = Event::orderBy('tanggal', 'desc')->first();

        return view('dashboard/home', compact(
            'sebulanTerakhir', 
            'totalKegiatan', 
            'totalAdmin',
            'labelBulan', 
            'jumlahKegiatan', 
            'kegiatanTerbaru'
        ));
    }
    public function dashboardEvent(Request $request){
        if(session('username') == null){
            return redirect('/login');
        }
        $perPage = $request->query('per_page', 5);
        if (!in_array($perPage, [3, 5])) {
            $perPage = 5; 
        }
        $event = Event::orderBy('tanggal', 'desc')->paginate($perPage);
        return view('dashboard/event', ['event' => $event, 'perPage' => $perPage]);
    }
    public function about(){
        return view('about');
    }
    public function contact(){
        return view('contact');
    }
    public function login(){
        return view('FLogin');
    }
    public function forgot(){
        return view('forgot');
    }
    public function otp(){
        return view('otp');
    } 
    public function resetpassword(){
        return view('resetpassword');
    }
    public function EventTambah(){
        if(session('username') == null){
            return redirect('/login');
        }
        return view('dashboard/tambahEvent');
    }
    public function EventEdit(Request $request){
        if(session('username') == null){
            return redirect('/login');
        }
        $id = $request->id;
        $event = Event::where('id', $id)->get();
        return view('dashboard/editEvent',['event' => $event]);
    }
    public function profile(){
        if(session('username') == null){
            return redirect('/login');
        }
        $admin = Admin::where('username', session('username'))->first();
        return view('dashboard/profile', ['admin' => $admin]);
    }
    public function user(){
        if(session('username') == null){
            return redirect('/login');
        }
        $user = Admin::paginate(10);
        if (session('role') !== 'super admin') {
            return redirect('/dashboard')->with('error', 'Hak akses ditolak! Menu ini hanya untuk Super Admin.');
        }
        return view('dashboard/user', ['users'=> $user]);
    }
    public function tambahUser(){
        if(session('username') == null){
            return redirect('/login');
        }
        if (session('role') !== 'super admin') {
            return redirect('/dashboard')->with('error', 'Hak akses ditolak! Menu ini hanya untuk Super Admin.');
        }
        return view('dashboard/tambahUser');
    }
    public function editUser(Request $request){
        if(session('username') == null){
            return redirect('/login');
        }
        if (session('role') !== 'super admin') {
            return redirect('/dashboard')->with('error', 'Hak akses ditolak! Menu ini hanya untuk Super Admin.');
        }
        $user = Admin::find($request->id);
        return view('dashboard/editUser', ['user'=> $user]);
    }
}