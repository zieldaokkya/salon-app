<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;
use App\Models\Layanan;
use App\Models\Booking;

class CustomerController extends Controller
{
    // ======================
    // HOME CUSTOMER
    // ======================
    public function home()
    {
        $salons = Salon::all();
        return view('customer.home', compact('salons'));
    }

    // ======================
    // DETAIL SALON
    // ======================
    public function detailSalon($id)
    {
        $salon = Salon::findOrFail($id);
        $layanans = Layanan::where('salon_id', $id)->get();

        return view('customer.detailsalon', compact('salon', 'layanans'));
    }

    // ======================
    // TAMBAH KE KERANJANG (FIX TOTAL + FIX HARGA)
    // ======================
   public function addToCart($id)
{
    $layanan = Layanan::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        $cart[$id]['qty']++;

    } else {

        $cart[$id] = [
            'id' => $layanan->id,
            'salon_id' => $layanan->salon_id,
            'nama_layanan' => $layanan->nama_layanan,
            'harga' => (int) $layanan->harga,
            'durasi' => $layanan->durasi,
            'qty' => 1
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Berhasil ditambahkan ke keranjang');
}

    // ======================
    // HALAMAN KERANJANG
    // ======================
    public function cart()
{
    $cart = session()->get('cart', []);

    return view('customer.cart', compact('cart'));
}

    // ======================
    // TAMBAH QTY
    // ======================
    public function tambahQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += 1;
        }

        session()->put('cart', $cart);

        return back();
    }

    // ======================
    // KURANG QTY
    // ======================
    public function kurangQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            if ($cart[$id]['qty'] > 1) {
                $cart[$id]['qty'] -= 1;
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return back();
    }

    // ======================
    // HAPUS ITEM DARI CART
    // ======================
    public function hapusCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item dihapus');
    }

    // ======================
    // BOOKING
    // ======================

    public function jadwal()
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect('/cart')->with('error', 'Keranjang masih kosong.');
    }

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['harga'] * $item['qty'];
    }

    return view('customer.jadwal', compact('cart', 'total'));
}

    public function booking(Request $request)
    {
        $request->validate([
            'tanggal_booking' => 'required|date',
            'jam_booking' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Keranjang kosong');
        }

        foreach ($cart as $item) {

            Booking::create([
                'customer_id' => auth()->id(),
                'salon_id' => $item['salon_id'],
                'layanan_id' => $item['id'],
                'tanggal_booking' => $request->tanggal_booking,
                'jam_booking' => $request->jam_booking,
                'status' => 'pending'
            ]);

        }

        session()->forget('cart');

        return redirect('/home')->with('success', 'Booking berhasil dibuat');
    }
}