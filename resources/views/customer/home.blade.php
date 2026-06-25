<!DOCTYPE html>
<html>
<head>
    <title>SalonKu</title>
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
            display:flex;
        }

        /* SIDEBAR */

        .sidebar{
            width:240px;
            height:100vh;
            background:white;
            position:fixed;
            padding:30px 20px;
            border-right:1px solid #eee;
        }

        .logo{
            font-size:35px;
            font-weight:bold;
            color:#ff4f8b;
            margin-bottom:50px;
        }

        .menu a{
            display:block;
            text-decoration:none;
            color:#555;
            padding:14px;
            margin-bottom:10px;
            border-radius:12px;
            transition:.3s;
        }

        .menu a:hover{
            background:#ffe5ef;
            color:#ff4f8b;
        }

        /* CONTENT */

        .content{
            margin-left:240px;
            width:100%;
            padding:30px;
        }

        /* NAVBAR */

        .navbar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
        }

        .search{
            width:500px;
            height:50px;
            border:none;
            background:white;
            border-radius:12px;
            padding:0 20px;
            outline:none;
            box-shadow:0 2px 10px rgba(0,0,0,.05);
        }

        .nav-right{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .btn{
            border:none;
            background:#ff4f8b;
            color:white;
            padding:12px 20px;
            border-radius:10px;
            cursor:pointer;
        }

        /* HERO */

        .hero{
            background:white;
            border-radius:25px;
            padding:35px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:40px;
            overflow:hidden;
        }

        .hero-content{
            width:50%;
        }

        .hero-content h1{
            color:#ff4f8b;
            font-size:48px;
            margin-bottom:15px;
            line-height:1.2;
        }

        .hero-content p{
            color:#666;
            margin-bottom:25px;
            line-height:1.6;
        }

        .hero-btn{
            display:inline-block;
            background:#ff4f8b;
            color:white;
            text-decoration:none;
            padding:14px 25px;
            border-radius:12px;
        }

        .hero-image img{
            width:500px;
            border-radius:20px;
            object-fit:cover;
        }

        /* SECTION */

        .section-title{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .section-title h2{
            color:#333;
        }

        .section-title a{
            color:#ff4f8b;
            text-decoration:none;
        }

        /* CARDS */

        .cards{
            display:grid;
            grid-template-columns:
            repeat(auto-fill,minmax(260px,1fr));
            gap:20px;
            margin-bottom:40px;
        }

        .card-link{
            text-decoration:none;
        }

        .card{
            background:white;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 5px 15px rgba(0,0,0,.05);
            transition:.3s;
        }

        .card:hover{
            transform:translateY(-5px);
        }

        .card img{
            width:100%;
            height:220px;
            object-fit:cover;
        }

        .card-body{
            padding:15px;
        }

        .card-body h3{
            color:#333;
            margin-bottom:8px;
        }

        .rating{
            color:#ffb400;
            margin-bottom:8px;
            font-size:14px;
        }

        .location{
            color:#888;
            margin-bottom:8px;
            font-size:14px;
        }

        .desc{
            color:#666;
            font-size:13px;
            line-height:1.5;
        }

        /* PROMO */

        .promo{
            background:#ffe5ef;
            border-radius:20px;
            padding:25px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .promo h3{
            color:#ff4f8b;
            margin-bottom:10px;
        }

        .promo p{
            color:#666;
        }

        .promo img{
            width:180px;
            border-radius:15px;
        }

        @media(max-width:768px){

            .sidebar{
                display:none;
            }

            .content{
                margin-left:0;
            }

            .hero{
                flex-direction:column;
                gap:20px;
            }

            .hero-content{
                width:100%;
            }

            .hero-image img{
                width:100%;
            }

            .search{
                width:100%;
            }

        }

    </style>

</head>
<body>

<div class="container">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            SalonKu
        </div>

        <div class="menu">

            <a href="#">🏠 Beranda</a>
            <a href="#">📍 Salon Terdekat</a>
            <a href="#">🎁 Promo</a>
            <a href="#">📅 Pesanan Saya</a>
            <a href="#">❤️ Favorit</a>

        </div>

    </div>

    <!-- CONTENT -->

    <div class="content">

        <!-- NAVBAR -->

        <div class="navbar">

            <input
                type="text"
                class="search"
                placeholder="Cari salon atau layanan..."
            >

            <div class="nav-right">

                @auth

                    <span>
                        Hi, {{ auth()->user()->name }}
                    </span>

                    <form action="/logout" method="POST">

                        @csrf

                        <button class="btn">
                            Logout
                        </button>

                    </form>

                @else

                    <a href="/login">
                        Masuk
                    </a>

                @endauth

            </div>

        </div>

        <!-- HERO -->

        <div class="hero">

            <div class="hero-content">

                <h1>
                    Booking Salon
                    Jadi Lebih Mudah
                </h1>

                <p>
                    Temukan salon terbaik, layanan lengkap,
                    dan booking kapan saja dengan mudah.
                </p>

                <a href="#" class="hero-btn">
                    Cari Salon
                </a>

            </div>

            <div class="hero-image">

                <img src="https://images.unsplash.com/photo-1521590832167-7bcbfaa6381f">

            </div>

        </div>

        <!-- SALON TERDEKAT -->

        <div class="section-title">

            <h2>Salon Terdekat</h2>

            <a href="#">
                Lihat Semua
            </a>

        </div>

        <div class="cards">

            @foreach($salons as $salon)

                <a
                    href="/salon/{{ $salon->id }}"
                    class="card-link"
                >

                    <div class="card">

                        <img src="https://images.unsplash.com/photo-1560066984-138dadb4c035">

                        <div class="card-body">

                            <h3>
                                {{ $salon->nama_salon }}
                            </h3>

                            <div class="rating">
                                ⭐ 4.8
                            </div>

                            <div class="location">
                                📍 {{ $salon->kota }}
                            </div>

                            <div class="desc">
                                {{ Str::limit($salon->deskripsi,70) }}
                            </div>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

        <!-- PROMO -->

        <div class="section-title">

            <h2>Promo Menarik</h2>

            <a href="#">
                Lihat Semua
            </a>

        </div>

        <div class="promo">

            <div>

                <h3>
                    Diskon Hair Treatment
                </h3>

                <p>
                    Dapatkan diskon hingga 20%
                    untuk treatment pilihan.
                </p>

            </div>

            <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702">

        </div>

    </div>

</div>

</body>
</html>