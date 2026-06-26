<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Booking</title>
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
            width:40px;
            height:40px;
            border-radius:50%;
            background:white;
            display:flex;
            justify-content:center;
            align-items:center;
            text-decoration:none;
            color:#222;
            font-size:18px;
            font-weight:bold;
            box-shadow:0 3px 10px rgba(0,0,0,.08);
        }

        .title{
            font-size:24px;
            font-weight:700;
            color:#222;
        }

        .card{
            background:white;
            border-radius:18px;
            padding:15px;
            margin-bottom:18px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 12px rgba(0,0,0,.05);
        }

        .item-left{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .item-img{
            width:70px;
            height:70px;
            border-radius:12px;
            object-fit:cover;
        }

        .item-info{
            display:flex;
            flex-direction:column;
        }

        .nama{
            font-size:16px;
            font-weight:600;
            color:#222;
        }

        .durasi{
            color:#888;
            font-size:13px;
        }

        .harga{
            color:#ff4f8b;
            font-weight:600;
            font-size:15px;
        }

        .qty-box{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .qty-btn{
            width:36px;
            height:36px;
            border-radius:10px;
            display:flex;
            justify-content:center;
            align-items:center;
            text-decoration:none;
            background:#f7f7f7;
            border:1px solid #ececec;
            color:#333;
            font-size:18px;
            font-weight:600;
        }

        .qty{
            min-width:20px;
            text-align:center;
            font-weight:600;
        }

        .summary{
            background:white;
            border-radius:18px;
            padding:20px;
            margin-top:20px;
        }

        .row{
            display:flex;
            justify-content:space-between;
            margin-bottom:15px;
            color:#444;
        }

        .row.total{
            margin-top:15px;
            padding-top:15px;
            border-top:1px solid #eee;
            font-size:18px;
            font-weight:700;
            color:#222;
        }

        .btn{
            width:100%;
            border:none;
            background:#ff4f8b;
            color:white;
            height:50px;
            border-radius:12px;
            font-size:15px;
            font-weight:600;
            margin-top:20px;
            cursor:pointer;
        }

        .empty{
            background:white;
            border-radius:18px;
            padding:50px;
            text-align:center;
            color:#888;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <a href="/home" class="back">←</a>
        <div class="title">Keranjang</div>
    </div>

    @php
        $total = 0;
    @endphp

    @if(count($cart) > 0)

        @foreach($cart as $item)

            @php
                $subtotal = $item['harga'] * $item['qty'];
                $total += $subtotal;
            @endphp

            <div class="card">

                <div class="item-left">

                    <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f"
                         class="item-img">

                    <div class="item-info">

                        <div class="nama">
                            {{ $item['nama_layanan'] }}
                        </div>

                        <div class="durasi">
                            {{ $item['durasi'] }} menit
                        </div>

                        <div class="harga">
                            Rp{{ number_format($item['harga'], 0, ',', '.') }}
                        </div>

                    </div>

                </div>

                <div class="qty-box">
                    <a href="/cart/decrease/{{ $item['id'] }}" class="qty-btn">-</a>
                    <div class="qty">{{ $item['qty'] }}</div>
                    <a href="/cart/increase/{{ $item['id'] }}" class="qty-btn">+</a>
                </div>

            </div>

        @endforeach

        <div class="summary">

            <div class="row">
                <span>Subtotal</span>
                <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <div class="row">
                <span>Biaya Layanan</span>
                <span>Rp5.000</span>
            </div>

            <div class="row total">
                <span>Total</span>
                <span>Rp{{ number_format($total + 5000, 0, ',', '.') }}</span>
            </div>

            <form action="/booking/jadwal" method="GET">
                <button class="btn">Tentukan Jadwal</button>
            </form>

        </div>

    @else

        <div class="empty">
            Keranjang masih kosong
        </div>

    @endif

</div>

</body>
</html>