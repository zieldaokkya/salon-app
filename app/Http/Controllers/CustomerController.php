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

        return view('customer.detailsalon', compact(
            'salon',
            'layanans'
        ));
    }



    // ======================
    // TAMBAH KE KERANJANG
    // ======================

    public function addToCart($id)
    {
        $layanan = Layanan::findOrFail($id);

        $cart = session()->get('cart', []);

        $found = false;

        foreach ($cart as $key => $item) {

            if ($item['id'] == $layanan->id) {

                $cart[$key]['qty'] += 1;

                $found = true;
            }
        }

        if (!$found) {

           $cart[] = [

            'id' => $layanan->id,

            'salon_id' => $layanan->salon_id,

            'nama_layanan' => $layanan->nama_layanan,

            'harga' => $layanan->harga,

            'durasi' => $layanan->durasi,

            'qty' => 1

        ];
    }

        session()->put('cart', $cart);

        return back();
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

        foreach ($cart as $key => $item) {

            if ($item['id'] == $id) {

                $cart[$key]['qty'] += 1;
            }
        }

        session()->put('cart', $cart);

        return back();
    }



    // ======================
    // KURANGI QTY
    // ======================

    public function kurangQty($id)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {

            if ($item['id'] == $id) {

                if ($cart[$key]['qty'] > 1) {

                    $cart[$key]['qty'] -= 1;

                } else {

                    unset($cart[$key]);
                }
            }
        }

        session()->put('cart', $cart);

        return back();
    }

    public function booking()
    {
        $cart = session()->get('cart', []);

        foreach($cart as $item){

            Booking::create([

                'customer_id' => auth()->id(),

                'salon_id' => $item['salon_id'],

                'layanan_id' => $item['id'],

                'tanggal_booking' => now()->toDateString(),

                'jam_booking' => now()->format('H:i:s'),

                'status' => 'pending'

            ]);
        }

        session()->forget('cart');

        return redirect('/home')
            ->with('success', 'Booking berhasil');
    }

}