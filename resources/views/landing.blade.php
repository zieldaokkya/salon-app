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
    font-family:sans-serif;
}

body{
    background:#fff;
}


/* NAVBAR */

.navbar{
    width:100%;
    height:90px;
    background:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 70px;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
    position:sticky;
    top:0;
    z-index:100;
}

.logo{
    font-size:32px;
    font-weight:bold;
    color:#d63384;
}

.nav-right{
    display:flex;
    gap:15px;
}

.btn-login{
    padding:12px 28px;
    border:2px solid #d63384;
    border-radius:10px;
    text-decoration:none;
    color:#d63384;
    font-weight:600;
    transition:0.2s;
}

.btn-login:hover{
    background:#fff0f6;
}

.btn-daftar{
    padding:12px 28px;
    border-radius:10px;
    text-decoration:none;
    background:#d63384;
    color:white;
    font-weight:600;
    transition:0.2s;
}

.btn-daftar:hover{
    background:#b0256d;
}


/* HERO */

.hero{
    min-height:90vh;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:70px;
    background:#fff0f6;
}

.hero-left{
    width:50%;
}

.hero-left h1{
    font-size:56px;
    line-height:1.2;
    margin-bottom:20px;
    color:#222;
}

.hero-left span{
    color:#d63384;
}

.hero-left p{
    font-size:18px;
    line-height:1.8;
    color:#666;
    margin-bottom:35px;
}

.hero-btn{
    display:inline-block;
    padding:16px 34px;
    background:#d63384;
    color:white;
    text-decoration:none;
    border-radius:12px;
    font-size:16px;
    font-weight:600;
    transition:0.2s;
}

.hero-btn:hover{
    background:#b0256d;
}

.hero-right{
    width:45%;
    display:flex;
    justify-content:center;
}

.hero-right img{
    width:100%;
    max-width:500px;
    height:500px;
    object-fit:cover;
    border-radius:24px;
    box-shadow:0 15px 30px rgba(0,0,0,0.08);
}


/* MITRA SECTION */

.mitra-section{
    background:white;
    padding:70px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-top:1px solid #eee;
}

.mitra-left{
    width:55%;
}

.mitra-left h2{
    font-size:42px;
    color:#222;
    margin-bottom:18px;
}

.mitra-left p{
    font-size:18px;
    color:#666;
    line-height:1.8;
}

.btn-mitra{
    display:inline-block;
    margin-top:22px;
    padding:10px 22px;
    background:#d63384;
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    transition:0.2s;
}

.btn-mitra:hover{
    background:#b0256d;
}

.mitra-right{
    width:35%;
}

.mitra-right img{
    width:100%;
    height:260px;
    object-fit:cover;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}


/* FOOTER */

.footer{
    background:#2b1020;
    color:white;
    text-align:center;
    padding:22px;
    font-size:14px;
}


/* RESPONSIVE */

@media(max-width:900px){

    .hero,
    .mitra-section{
        flex-direction:column;
        text-align:center;
    }

    .hero-left,
    .hero-right,
    .mitra-left,
    .mitra-right{
        width:100%;
    }

    .hero-left h1{
        font-size:42px;
    }

    .hero{
        padding:40px 25px;
    }

    .hero-right{
        margin-top:35px;
    }

    .hero-right img{
        height:350px;
    }

    .mitra-section{
        padding:50px 25px;
    }

    .mitra-right{
        margin-top:30px;
    }

    .navbar{
        padding:0 20px;
    }

}

</style>

</head>

<body>


<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        SalonKu
    </div>

    <div class="nav-right">

        <a href="/login" class="btn-login">
            Login
        </a>

        <a href="/register?role=customer" class="btn-daftar">
            Daftar
        </a>

    </div>

</div>



<!-- HERO -->

<section class="hero">

    <div class="hero-left">

        <h1>
            Booking Salon
            Jadi Lebih
            <span>Mudah</span>
        </h1>

        <p>
            Temukan salon terbaik dan nikmati pengalaman
            perawatan kecantikan tanpa ribet langsung dari rumah.
        </p>

        <a href="/login" class="hero-btn">
            Booking Sekarang
        </a>

    </div>

    <div class="hero-right">

        <!-- GANTI DENGAN FOTO KAMU -->
        <img src="/images/mitra.jpg">

    </div>

</section>



<!-- MITRA -->

<section class="mitra-section">

    <div class="mitra-left">

        <h2>
            Gabung Jadi Mitra Salon
        </h2>

        <p>
            Daftarkan salonmu dan jangkau lebih banyak pelanggan
            bersama platform SalonKu.
        </p>

        <a href="/register?role=mitra" class="btn-mitra">
            Daftar Jadi Mitra
        </a>

    </div>

    <div class="mitra-right">

        <img src="/images/salon.jpg">

    </div>

</section>



<!-- FOOTER -->

<div class="footer">

    © 2026 SalonKu. All rights reserved.

</div>

</body>
</html>