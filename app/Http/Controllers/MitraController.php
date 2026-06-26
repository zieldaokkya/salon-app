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
    public function index()
    {
        $user = auth()->user();
        $salon = Salon::where('user_id', $user->id)->first();

        if (!$salon) {
            return view('mitra.dashboard', compact('user'));
        }

        return view('mitra.dashboard', [
            'user' => $user,
            'salon' => $salon,
            'jumlahLayanan' => Layanan::where('salon_id', $salon->id)->count(),
            'bookings' => Booking::with(['customer','layanan'])
                ->where('salon_id', $salon->id)
                ->latest()->take(5)->get(),
            'total' => Booking::where('salon_id', $salon->id)->count(),
            'pending' => Booking::where('salon_id', $salon->id)->where('status', 'pending')->count(),
            'diproses' => Booking::where('salon_id', $salon->id)->where('status', 'confirmed')->count(),
            'selesai' => Booking::where('salon_id', $salon->id)->where('status', 'done')->count(),
        ]);
    }

    public function storeSalon(Request $request)
    {
        $request->validate([
            'nama_salon' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'deskripsi' => 'required'
        ]);

        if (!Salon::where('user_id', auth()->id())->exists()) {
            Salon::create([
                'user_id' => auth()->id(),
                'nama_salon' => $request->nama_salon,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'deskripsi' => $request->deskripsi
            ]);
        }

        return back()->with('success', 'Salon berhasil ditambahkan');
    }

    public function layanan()
    {
        $salon = Salon::where('user_id', auth()->id())->first();

        if (!$salon) return redirect('/mitra/dashboard')->with('error', 'Kamu belum punya salon');

        $layanans = Layanan::where('salon_id', $salon->id)->get();

        return view('mitra.layanan', compact('salon','layanans'));
    }

    // ======================
    // STORE LAYANAN (FIXED + RANGE)
    // ======================
    public function storeLayanan(Request $request)
{
    $request->validate([
        'nama_layanan' => 'required',
        'varian' => 'required',
        'harga' => 'required|numeric',
        'durasi' => 'required|numeric',
        'deskripsi' => 'required',
        'foto' => 'nullable|image'
    ]);

    $salon = Salon::where('user_id', auth()->id())->first();

    $data = [
        'salon_id' => $salon->id,
        'nama_layanan' => $request->nama_layanan,
        'varian' => $request->varian,
        'harga' => $request->harga,
        'durasi' => $request->durasi,
        'deskripsi' => $request->deskripsi,
    ];

    if ($request->hasFile('foto')) {
        $data['foto'] = $request->file('foto')->store('layanan', 'public');
    }

    Layanan::create($data);

    return back()->with('success');
}

    // ======================
    // UPDATE LAYANAN (FIX TOTAL)
    // ======================
public function updateLayanan(Request $request, $id)
{
    $layanan = Layanan::findOrFail($id);

    $request->validate([
        'nama_layanan' => 'required',
        'varian' => 'required',
        'harga' => 'required|numeric',
        'durasi' => 'required|numeric',
        'deskripsi' => 'required',
        'foto' => 'nullable|image'
    ]);

    $data = [
        'nama_layanan' => $request->nama_layanan,
        'varian' => $request->varian,
        'harga' => $request->harga,
        'durasi' => $request->durasi,
        'deskripsi' => $request->deskripsi,
    ];

    if ($request->hasFile('foto')) {

        if ($layanan->foto) {
            Storage::disk('public')->delete($layanan->foto);
        }

        $data['foto'] = $request->file('foto')->store('layanan', 'public');
    }

    $layanan->update($data);

    return redirect('/mitra/layanan')
        ->with('success');
}

    public function destroyLayanan($id)
    {
        Layanan::findOrFail($id)->delete();
        return redirect('/mitra/layanan');
    }

    public function editLayanan($id)
{
    $layanan = Layanan::findOrFail($id);
    return view('mitra.edit_layanan', compact('layanan'));
}

public function order()
{
    $salon = Salon::where('user_id', auth()->id())->first();

    if (!$salon) {
        return redirect('/mitra/dashboard')->with('error', 'Kamu belum punya salon');
    }

    $bookings = Booking::with(['customer', 'layanan'])
        ->where('salon_id', $salon->id)
        ->latest()
        ->get();

    return view('mitra.order', compact('bookings', 'salon'));
}
public function terima($id)
{
    $booking = Booking::findOrFail($id);
    $booking->status = 'confirmed';
    $booking->save();

    return back()->with('success', 'Booking diterima');
}
public function tolak($id)
{
    $booking = Booking::findOrFail($id);
    $booking->status = 'rejected';
    $booking->save();

    return back()->with('success', 'Booking ditolak');
}
public function selesai($id)
{
    $booking = Booking::findOrFail($id);
    $booking->status = 'done';
    $booking->save();

    return back()->with('success', 'Booking selesai');
}

public function pelanggan()
{
    $salon = Salon::where('user_id', auth()->id())->first();

    if (!$salon) {
        return redirect('/mitra/dashboard')->with('error', 'Kamu belum punya salon');
    }

    $pelanggan = Booking::with('customer')
        ->where('salon_id', $salon->id)
        ->select('user_id')
        ->distinct()
        ->get();

    return view('mitra.detailpelanggan', [
    'pelanggan' => $pelanggan,
    'booking' => $riwayat
]);
}
public function detailPelanggan($id)
{
    $salon = Salon::where('user_id', auth()->id())->first();

    if (!$salon) {
        return redirect('/mitra/dashboard');
    }

    $pelanggan = User::findOrFail($id);

    $riwayat = Booking::with('layanan')
        ->where('salon_id', $salon->id)
        ->where('customer_id', $id)
        ->latest()
        ->get();

    return view('mitra.detail-pelanggan', [
        'pelanggan' => $pelanggan,
        'booking' => $riwayat
    ]);
}
}