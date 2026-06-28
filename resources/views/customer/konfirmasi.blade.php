<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#f5f6fa;
        }

        .container{
            max-width:700px;
            margin:auto;
            padding:20px;
        }

        .header{
            display:flex;
            align-items:center;
            gap:15px;
            margin-bottom:25px;
        }

        .back{
            width:42px;
            height:42px;
            border-radius:50%;
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
            text-decoration:none;
            color:#222;
            font-size:18px;
            font-weight:bold;
            box-shadow:0 4px 10px rgba(0,0,0,.08);
        }

        .title{
            font-size:24px;
            font-weight:700;
            color:#222;
        }

        .card{
            background:white;
            border-radius:18px;
            padding:20px;
            margin-bottom:18px;
            box-shadow:0 4px 12px rgba(0,0,0,.05);
        }

        .judul{
            font-size:17px;
            font-weight:700;
            margin-bottom:15px;
            color:#222;
        }

        .row{
            display:flex;
            justify-content:space-between;
            margin-bottom:12px;
            color:#444;
        }

        .line{
            border-top:1px solid #eee;
            margin:15px 0;
        }

        .layanan{
            display:flex;
            justify-content:space-between;
            margin-bottom:10px;
        }

        .nama{
            font-weight:600;
        }

        .harga{
            color:#ff4f8b;
            font-weight:600;
        }

        .radio{
            display:flex;
            gap:12px;
            align-items:center;
            border:1px solid #eee;
            border-radius:14px;
            padding:15px;
            margin-bottom:12px;
        }

        .radio input{
            accent-color:#ff4f8b;
        }

        .btn{
            width:100%;
            height:54px;
            border:none;
            border-radius:14px;
            background:#ff4f8b;
            color:white;
            font-size:16px;
            font-weight:700;
            cursor:pointer;
        }

        .btn:hover{
            background:#ff2d74;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="header">
        <a href="/booking/jadwal" class="back">←</a>
        <div class="title">Konfirmasi Booking</div>
    </div>

    <div class="card">

        <div class="judul">
            Ringkasan Pesanan
        </div>

        <div class="row">
            <span>Salon</span>
            <strong>{{ $cart[array_key_first($cart)]['nama_salon'] }}</strong>
        </div>

        <div class="line"></div>

        @foreach($cart as $item)

            <div class="layanan">

                <div>
                    <div class="nama">
                        {{ $item['nama_layanan'] }}
                    </div>

                    <small>
                        {{ $item['qty'] }} x
                    </small>
                </div>

                <div class="harga">
                    Rp{{ number_format($item['harga'] * $item['qty'],0,',','.') }}
                </div>

            </div>

        @endforeach

        <div class="line"></div>

        <div class="row">
            <span>Tanggal</span>
            <strong>{{ $tanggal_booking }}</strong>
        </div>

        <div class="row">
            <span>Jam</span>
            <strong>{{ $jam_booking }}</strong>
        </div>

        <div class="row">
            <span>Metode</span>

            <strong>

                {{ $metode=='home'
                    ? 'Home Service'
                    : 'Datang ke Salon' }}

            </strong>

        </div>

    </div>

    <div class="card">

        <div class="judul">
            Ringkasan Pembayaran
        </div>

        <div class="row">
            <span>Subtotal</span>
            <span>
                Rp{{ number_format($subtotal,0,',','.') }}
            </span>
        </div>

        <div class="row">
            <span>Biaya Admin</span>
            <span>
                Rp{{ number_format($biayaLayanan,0,',','.') }}
            </span>
        </div>

        @if($biayaHome>0)

        <div class="row">
            <span>Home Service</span>
            <span>
                Rp{{ number_format($biayaHome,0,',','.') }}
            </span>
        </div>

        @endif

        <div class="line"></div>

        <div class="row" style="font-weight:bold;font-size:18px;">
            <span>Total</span>

            <span style="color:#ff4f8b;">
                Rp{{ number_format($total,0,',','.') }}
            </span>
        </div>

    </div>

    <form action="/booking" method="POST">

        @csrf

        <input type="hidden"
               name="tanggal_booking"
               value="{{ $tanggal_booking }}">

        <input type="hidden"
               name="jam_booking"
               value="{{ $jam_booking }}">

        <input type="hidden"
               name="metode"
               value="{{ $metode }}">

        <input type="hidden"
                name="total"
                value="{{ $total }}">

        <div class="card">

            <div class="judul">
                Metode Pembayaran
            </div>

            <label class="radio">

                <input type="radio"
                       name="pembayaran"
                       value="cash"
                       checked>

                <div>

                    <strong>Cash</strong>

                    <div>
                        Bayar langsung di salon
                    </div>

                </div>

            </label>

            <label class="radio">

                <input type="radio"
                       name="pembayaran"
                       value="online">

                <div>

                    <strong>Pembayaran Online</strong>

                    <div>
                        QRIS / Transfer Bank / E-Wallet
                    </div>

                </div>

            </label>

        </div>

        <button class="btn">

            Pesan Sekarang

        </button>

    </form>

</div>

</body>
</html>