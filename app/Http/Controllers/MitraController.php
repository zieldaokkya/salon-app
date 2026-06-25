<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Salon;
use App\Models\Layanan;
use App\Models\Booking;
use App\Models\User;



class MitraController extends Controller
{

    // ======================
    // DASHBOARD
    // ======================

public function index()
{
    $user = auth()->user();

    $salon = Salon::where('user_id', $user->id)->first();

    // kalau belum punya salon
    if (!$salon) {
        return view('mitra.dashboard', compact('user'));
    }

    // jumlah layanan
    $jumlahLayanan = Layanan::where('salon_id', $salon->id)->count();

    // 🔥 ambil booking (INI YANG BIKIN REAL)
    $bookings = Booking::with(['customer','layanan'])
        ->where('salon_id', $salon->id)
        ->latest()
        ->take(5)
        ->get();

    // 🔥 statistik REAL dari database
    $total = Booking::where('salon_id', $salon->id)->count();

    $pending = Booking::where('salon_id', $salon->id)
        ->where('status', 'pending')
        ->count();

    $diproses = Booking::where('salon_id', $salon->id)
    ->where('status', 'confirmed')
    ->count();

    $selesai = Booking::where('salon_id', $salon->id)
    ->where('status', 'done')
    ->count();

    return view('mitra.dashboard', compact(
        'user',
        'salon',
        'jumlahLayanan',
        'bookings',
        'total',
        'pending',
        'diproses',
        'selesai'
    ));
}



    // ======================
    // SIMPAN SALON
    // ======================

    public function storeSalon(Request $request)
    {
        $request->validate([
            'nama_salon' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'deskripsi' => 'required'
        ]);

        $cekSalon = Salon::where('user_id', auth()->id())->first();

        if (!$cekSalon) {

            Salon::create([

                'user_id' => auth()->id(),

                'nama_salon' => $request->nama_salon,

                'alamat' => $request->alamat,

                'kota' => $request->kota,

                'deskripsi' => $request->deskripsi

            ]);
        }

        return redirect('/mitra/dashboard')
            ->with('success', 'Salon berhasil ditambahkan');
    }



    // ======================
    // HALAMAN LAYANAN
    // ======================

    public function layanan()
    {
        $user = auth()->user();

        $salon = Salon::where('user_id', $user->id)->first();

        $layanans = Layanan::where('salon_id', $salon->id)->get();

        return view('mitra.layanan', compact(
            'user',
            'salon',
            'layanans'
        ));
    }



    // ======================
    // SIMPAN LAYANAN
    // ======================

    public function storeLayanan(Request $request)
    {
        $salon = Salon::where('user_id', auth()->id())->first();

        $foto = null;

        if ($request->hasFile('foto')) {

            $foto = $request->file('foto')
                ->store('layanan', 'public');

        }

        Layanan::create([

            'salon_id' => $salon->id,

            'nama_layanan' => $request->nama_layanan,

            'varian' => $request->varian,

            'harga' => str_replace('.', '', $request->harga),

            'durasi' => $request->durasi,

            'deskripsi' => $request->deskripsi,

            'foto' => $foto

        ]);

        return back()->with(
            'success',
            'Layanan berhasil ditambahkan'
        );
    }



    // ======================
    // EDIT LAYANAN
    // ======================

    public function editLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);

        return view('mitra.editlayanan', compact('layanan'));
    }



    // ======================
    // UPDATE LAYANAN
    // ======================

    public function updateLayanan(Request $request, $id)
{
    $layanan = Layanan::findOrFail($id);

    $foto = $layanan->foto;

    if ($request->hasFile('foto')) {

        $foto = $request->file('foto')
            ->store('layanan', 'public');

    }

    $layanan->update([

        'nama_layanan' => $request->nama_layanan,

        'harga' => $request->harga,

        'durasi' => $request->durasi,

        'deskripsi' => $request->deskripsi,

        'foto' => $foto

    ]);

    return redirect('/mitra/layanan')
        ->with('success', 'Layanan berhasil diupdate');
}



    // ======================
    // HAPUS LAYANAN
    // ======================

    public function destroyLayanan($id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->delete();

        return redirect('/mitra/layanan')
            ->with('success', 'Layanan berhasil dihapus');
    }


      public function order()
{
    $salon = Salon::where('user_id', auth()->id())->first();

    if (!$salon) {
        return redirect('/mitra/dashboard')
            ->with('error', 'Kamu belum punya salon');
    }

    $bookings = Booking::with(['customer', 'layanan'])
        ->where('salon_id', $salon->id)
        ->latest()
        ->get();

    return view('mitra.order', compact('bookings'));
}

public function terima($id)
{
    $booking = Booking::findOrFail($id);

    $booking->update([
        'status' => 'confirmed'
    ]);

    return back()->with('success', 'Order diterima');
}


public function tolak($id)
{
    $booking = Booking::findOrFail($id);

    $booking->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Order ditolak');
}

public function pelanggan()
{
    $salon = Salon::where('user_id', auth()->id())->first();

    if (!$salon) {
        return redirect('/mitra/dashboard');
    }


    $pelanggan = User::whereHas('booking', function($query) use ($salon){

        $query->where('salon_id', $salon->id);

    })
    ->withCount(['booking as total_booking' => function($query) use ($salon){

        $query->where('salon_id', $salon->id);

    }])
    ->with(['booking' => function($query) use ($salon){

        $query->where('salon_id', $salon->id)
              ->latest();

    }])
    ->get();



    foreach($pelanggan as $p){

        $p->last_booking = $p->booking->first()->tanggal ?? '-';

    }



    return view('mitra.pelanggan', compact('pelanggan'));
}

public function riwayat()
{
    $salon = Salon::where('user_id', auth()->id())->first();

    $riwayat = Booking::with(['customer','layanan'])
        ->where('salon_id', $salon->id)
        ->whereIn('status', [
            'done',
            'rejected',
        ])
        ->latest()
        ->get();

    return view('mitra.riwayat', compact('riwayat'));
}

public function profile()
{
    $user = auth()->user();

    $salon = Salon::where('user_id', $user->id)->first();

    return view('mitra.profile', compact(
        'user',
        'salon'
    ));
}

public function editProfile()
{
    $user = auth()->user();

    $salon = Salon::where('user_id', $user->id)->first();

    return view('mitra.editprofile', compact(
        'user',
        'salon'
    ));
}

public function updateProfile(Request $request)
{
    $user = auth()->user();

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    $salon = Salon::where('user_id', $user->id)->first();

    if ($salon) {
        $salon->update([
            'nama_salon' => $request->nama_salon,
            'kota' => $request->kota,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi,
        ]);
    }

    return redirect('/mitra/profile')
        ->with('success', 'Profile berhasil diperbarui');
}

public function selesai($id)
{
    $booking = Booking::findOrFail($id);

    $booking->update([
        'status' => 'done' // 🔥 ganti ini
    ]);

    return back()->with('success', 'Booking selesai');
}

public function detailPelanggan($id)
{

    $pelanggan = User::findOrFail($id);


    $booking = Booking::where('customer_id',$id)
    ->with('layanan')
    ->get();


    return view('mitra.detail-pelanggan',
    compact(
        'pelanggan',
        'booking'
    ));

}

public function hapusPelanggan($id)
{

    $pelanggan = User::findOrFail($id);


    // hapus semua booking pelanggan
    Booking::where('customer_id', $id)->delete();


    // hapus akun pelanggan
    $pelanggan->delete();



    return redirect('/mitra/pelanggan')
        ->with('success', 'Pelanggan berhasil dihapus');

}

}