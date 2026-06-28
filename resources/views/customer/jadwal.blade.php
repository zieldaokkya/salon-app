<!DOCTYPE html>
<html>
<head>
    <title>Tentukan Jadwal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#f3f4f6;
            min-height:100vh;
        }

        /* CONTAINER */
        .container{
            width:100%;
            max-width:680px;
            margin:0 auto;
            padding:14px 14px 120px;
        }

        /* HEADER */
        .header{
            display:flex;
            align-items:center;
            gap:14px;
            margin-bottom:18px;
        }

        .back{
            width:44px;
            height:44px;
            background:white;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
            color:#222;
            font-size:18px;
            box-shadow:0 6px 18px rgba(0,0,0,.05);
        }

        h2{
            font-size:24px;
            font-weight:700;
            color:#111827;
        }

        /* CARD */
        .card{
            background:white;
            border-radius:22px;
            padding:16px;
            margin-bottom:14px;
            box-shadow:0 8px 20px rgba(0,0,0,.04);
            width:100%;
        }

        .judul{
            font-size:14px;
            font-weight:700;
            margin-bottom:12px;
            color:#111827;
        }

        /* DATE */
        input[type=date]{
            width:100%;
            height:52px;
            border:1px solid #e5e7eb;
            border-radius:14px;
            padding:0 14px;
            font-size:14px;
            background:#fff;
        }

        /* JAM */
        .jam{
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:10px;
        }

        .jam label{
            cursor:pointer;
        }

        .jam input{
            display:none;
        }

        .jam span{
            display:block;
            text-align:center;
            padding:14px 8px;
            border-radius:14px;
            font-size:13px;
            font-weight:600;

            background:#ffffff;
            border:1px solid #f1f1f1;
            color:#111827;

            transition:.2s;
        }

        .jam input:checked + span{
            background:#ff4d8d;
            color:white;
            border-color:#ff4d8d;
            transform:scale(1.02);
            box-shadow:0 8px 18px rgba(255,77,141,.25);
        }

        /* METODE */
        .metode{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .opsi{
            border:1px solid #f1f1f1;
            border-radius:14px;
            padding:14px;
            display:flex;
            gap:12px;
            align-items:flex-start;
            cursor:pointer;
            background:#fff;
            transition:.2s;
        }

        .opsi input{
            width:18px;
            height:18px;
            margin-top:3px;
            accent-color:#d1d5db; /* default netral */
        }

        /* 🔥 SELECTED STATE */
        .opsi:has(input:checked){
            border:1px solid #ff4d8d;
            background:#fff5f8;
            box-shadow:0 6px 18px rgba(255,77,141,.08);
        }

        .opsi input:checked{
            accent-color:#ff4d8d;
        }

        .opsi b{
            font-size:14px;
            color:#111827;
        }

        .opsi p{
            font-size:12px;
            color:#6b7280;
            margin-top:3px;
        }

        /* BUTTON */
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

        .btn:hover{
            background:#ff2f76;
        }

    </style>
</head>

<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <a href="/cart" class="back">←</a>
        <h2>Tentukan Jadwal</h2>
    </div>

    <form action="/booking/konfirmasi" method="POST">
        @csrf

        <!-- TANGGAL -->
        <div class="card">
            <div class="judul">Pilih Tanggal</div>
            <input type="date" name="tanggal_booking" min="{{ date('Y-m-d') }}" required>
        </div>

        <!-- JAM -->
        <div class="card">
            <div class="judul">Pilih Jam</div>

            <div class="jam">
                @foreach([
                    '09:00','10:00','11:00',
                    '12:00','13:00','14:00',
                    '15:00','16:00','17:00',
                    '18:00','19:00','20:00'
                ] as $jam)

                <label>
                    <input type="radio" name="jam_booking" value="{{ $jam }}" required>
                    <span>{{ $jam }}</span>
                </label>

                @endforeach
            </div>

        </div>

        <!-- METODE -->
        <div class="card">
            <div class="judul">Metode Layanan</div>

            <div class="metode">

                <label class="opsi">
                    <input type="radio" name="metode" value="salon" checked>
                    <div>
                        <b>Datang ke Salon</b>
                        <p>Datang langsung sesuai jadwal booking.</p>
                    </div>
                </label>

                <label class="opsi">
                    <input type="radio" name="metode" value="home">
                    <div>
                        <b>Home Service</b>
                        <p>Beautician datang ke rumah (+Rp15.000)</p>
                    </div>
                </label>

            </div>
        </div>

        <button class="btn">konfirmasi</button>

    </form>

</div>

</body>
</html>