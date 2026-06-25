<!DOCTYPE html>
<html>
<head>
    <title>{{ $salon->nama_salon }}</title>

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
            max-width:900px;
            margin:auto;
            padding:20px;
        }

        /* BANNER */

        .banner{
            position:relative;
            height:220px;
            border-radius:20px;
            overflow:hidden;
            margin-bottom:15px;
        }

        .banner img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

        .back{
            position:absolute;
            top:15px;
            left:15px;
            width:40px;
            height:40px;
            border-radius:50%;
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
            text-decoration:none;
            color:black;
            font-size:18px;
            box-shadow:0 3px 10px rgba(0,0,0,.15);
        }

        /* INFO */

        .info{
            background:white;
            border-radius:20px;
            padding:22px 28px;
            margin-bottom:25px;
        }

        .info h1{
            font-size:28px;
            color:#222;
            margin-bottom:10px;
        }

        .meta{
            display:flex;
            gap:20px;
            margin-bottom:15px;
            color:#666;
            font-size:14px;
        }

        .rating{
            color:#ffb400;
            font-weight:600;
        }

        .desc{
            color:#777;
            line-height:1.7;
            font-size:14px;
        }

        /* TITLE */

        .title{
            margin-bottom:15px;
        }

        .title h2{
            font-size:22px;
            color:#222;
        }

        /* SERVICES */

        .services{
            background:white;
            border-radius:20px;
            overflow:hidden;
            margin-bottom:100px;
            box-shadow:0 4px 15px rgba(0,0,0,.04);
        }

        .service{
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:5px 25px;
            border-bottom:1px solid #eee;
        }

        .service:last-child{
            border-bottom:none;
        }

        .service-left{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .service-left img{
            width:60px;
            height:60px;
            border-radius:10px;
            object-fit:cover;
        }

        .service-name{
            font-size:15px;
            font-weight:600;
            color:#222;
            margin-bottom:2px;
        }

        .service-duration{
            font-size:13px;
            color:#888;
        }

        .btn-add{
        width:80px;
        height:34px;
        border:none;
        background:#ff4f8b;
        color:white;
        border-radius:10px;
        font-weight:600;
        font-size:13px;
        cursor:pointer;
        transition:.3s;
    }

        .btn-add:hover{
        opacity:.9;
    }

        /* FLOATING CART */

        .cart{
            position:fixed;
            bottom:25px;
            right:25px;

            background:#ff4f8b;
            color:white;

            text-decoration:none;

            padding:14px 18px;

            border-radius:14px;

            display:flex;
            align-items:center;
            gap:10px;

           box-shadow:0 6px 18px rgba(255,79,139,.18);

            transition:.3s;
        }

        .cart:hover{
            transform:translateY(-2px);
        }

        .service-price{
            font-size:14px;
            font-weight:600;
            color:#ff4f8b;
        }

        .badge{
            min-width:24px;
            height:24px;

            padding:0 6px;

            border-radius:999px;

            background:white;
            color:#ff4f8b;

            display:flex;
            justify-content:center;
            align-items:center;

            font-size:12px;
            font-weight:bold;
        }

    </style>

</head>

<body>

@php

$cart = session('cart', []);

$jumlah = 0;

foreach($cart as $item)
{
    $jumlah += $item['qty'];
}

@endphp

<div class="container">

    <!-- BANNER -->

    <div class="banner">

        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035">

        <a href="/home" class="back">
            ←
        </a>

    </div>

    <!-- INFO SALON -->

    <div class="info">

        <h1>
            {{ $salon->nama_salon }}
        </h1>

        <div class="meta">

            <div class="rating">
                ⭐ 4.8
            </div>

            <div>
                📍 {{ $salon->kota }}
            </div>

        </div>

        <div class="desc">
            {{ $salon->deskripsi }}
        </div>

    </div>

    <!-- TITLE -->

    <div class="title">
        <h2>Layanan</h2>
    </div>

    <!-- LIST LAYANAN -->

    <div class="services">

        @foreach($layanans as $layanan)

        <div class="service">

            <div class="service-left">

                <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f">

                <div>

                    <div>

            <div class="service-name">
                {{ $layanan->nama_layanan }}
            </div>

            <div class="service-price">
                Rp{{ number_format($layanan->harga,0,',','.') }}
            </div>

            <div class="service-duration">
                {{ $layanan->durasi }} menit
            </div>

</div>

                </div>

            </div>

            <form action="/cart/add/{{ $layanan->id }}" method="POST">

                @csrf

                <button type="submit" class="btn-add">
                    Tambah
                </button>

            </form>

        </div>

        @endforeach

    </div>

</div>

@if($jumlah > 0)

<a href="/cart" class="cart">

    🛒 Keranjang

    <div class="badge">
        {{ $jumlah }}
    </div>

</a>

@endif

</body>
</html>