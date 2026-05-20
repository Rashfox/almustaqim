<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Event;
use App\Models\Admin;

class prosesController extends Controller {    
    public function latestEvent(){
        $latestevent = Event::orderBy('tanggal', 'desc')->limit(3)->get();
        return $latestevent;
    }

    public function EventUpdate(Request $request){
        $event = Event::find($request->id);
        
        if (!$event) {
            return redirect('/dashboard/event')->with('error', 'Data kegiatan tidak ditemukan!');
        }

        $filename = $event->gambar;

        if ($request->hasFile('gambar')){
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ], [
                'gambar.image' => 'File harus berupa gambar.',
                'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
                'gambar.max'   => 'Ukuran gambar maksimal adalah 2MB.'
            ]);

            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama,'_').'_'.$request->tanggal.'.'.$extension;
            
            if ($event->gambar && file_exists(public_path('img/'.$event->gambar))) {
                unlink(public_path('img/'.$event->gambar));
            }

            $file->move(public_path('img/'), $filename);
        }

        Event::where('id', $request->id)
        ->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $filename,
            'tanggal' => $request->tanggal
        ]);

        return redirect('/dashboard/event')->with('success', 'Data kegiatan berhasil diperbarui!');
    }

    public function EventHapus(Event $event){
        if (!$event) {
            return redirect('/dashboard/event')->with('error', 'Data kegiatan gagal dihapus karena tidak ditemukan!');
        }

        if ($event->gambar && file_exists(public_path('img/'.$event->gambar))){
            unlink(public_path('img/'.$event->gambar));
        }

        $event->delete();
        return redirect('/dashboard/event')->with('success', 'Data kegiatan berhasil dihapus!');
    }

    public function EventSimpan(Request $request){
        $request->validate([
            'nama'   => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'nama.required'   => 'Nama kegiatan wajib diisi.',
            'gambar.required' => 'Gambar kegiatan wajib diunggah.',
            'gambar.image'    => 'File harus berupa gambar.',
            'gambar.mimes'    => 'Format gambar harus jpeg, png, jpg, gif, atau svg.',
            'gambar.max'      => 'Ukuran gambar maksimal adalah 2MB.'
        ]);

        $filename = null;
        if ($request->hasFile('gambar')){
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($request->nama,'_').'_'.$request->tanggal.'.'.$extension;
            $file->move(public_path('img/'), $filename);
        }

        $admin = Admin::where('username', session('username'))->first();
        $adminId = $admin ? $admin->id : null;

        Event::create([
            'admin_id' => $adminId,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'gambar' => $filename,
            'tanggal' => $request->tanggal
        ]);

        return redirect('/dashboard/event')->with('success', 'Data kegiatan berhasil ditambahkan!');
    }

    public function updateProfile(Request $request) {
        $sessionUsername = session('username');
        if (!$sessionUsername) {
            return redirect('/login')->with('error', 'Sesi Anda telah habis, silakan login kembali.');
        }

        $admin = Admin::where('username', $sessionUsername)->first();
        if (!$admin) {
            return redirect('/login')->with('error', 'Data admin tidak ditemukan.');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin,username,' . $admin->id,
            'password' => 'nullable|string|min:8',
        ], [
            'nama.required'     => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique'   => 'Username sudah digunakan oleh orang lain.',
            'password.min'      => 'Password baru minimal harus 8 karakter.'
        ]);

        $admin->nama = $request->nama;
        $admin->username = $request->username;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password); 
        }

        $admin->save();
        session(['username' => $request->username]);

        return redirect('/dashboard/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}