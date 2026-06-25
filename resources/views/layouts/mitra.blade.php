<!DOCTYPE html>
<html>
<head>
    <title>Mitra SalonKu</title>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            display:flex;
            background:#f4f6fb;
        }

        /* SIDEBAR */

        .sidebar{
            width:250px;
            height:100vh;
            background:#1f2937;
            color:white;
            padding:20px;
            position:fixed;
            left:0;
            top:0;
        }

        .sidebar h2{
            color:#ff4d6d;
            margin-bottom:30px;
            text-align:center;
            font-size:28px;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:8px;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:12px;
            padding:14px 15px;
            color:#d1d5db;
            text-decoration:none;
            border-radius:10px;
            transition:0.3s;
            font-size:15px;
            font-weight:500;
        }

        .menu a:hover{
            background:#374151;
            color:white;
            transform:translateX(4px);
        }

        .menu a i{
            width:22px;
            text-align:center;
            font-size:16px;
        }

        /* CONTENT */

        .content{
            flex:1;
            margin-left:250px;
            padding:30px;
        }

        /* LOGOUT */

        .logout-form{
            margin-top:10px;
        }

        .logout-menu{
            width:100%;
            display:flex;
            align-items:center;
            gap:12px;
            padding:14px 15px;
            background:none;
            border:none;
            color:#d1d5db;
            border-radius:10px;
            cursor:pointer;
            font-size:15px;
            font-weight:500;
            transition:0.3s;
        }

        .logout-menu:hover{
            background:#ef4444;
            color:white;
        }

        .logout-menu i{
            width:22px;
            text-align:center;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <h2>SalonKu</h2>

    <div class="menu">

        <a href="/mitra/dashboard">
            <i class="fa-solid fa-chart-line"></i>
            Dashboard
        </a>

        <a href="/mitra/layanan">
            <i class="fa-solid fa-scissors"></i>
            Daftar Layanan
        </a>

        <a href="/mitra/order">
            <i class="fa-solid fa-cart-shopping"></i>
            Kelola Order
        </a>

        <a href="/mitra/pelanggan">
            <i class="fa-solid fa-users"></i>
            Pelanggan
        </a>

        <a href="/mitra/riwayat">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat
        </a>

        <a href="/mitra/review">
            <i class="fa-solid fa-star"></i>
            Rating & Review
        </a>

        <a href="/mitra/profile">
            <i class="fa-solid fa-user"></i>
            Profile Mitra
        </a>

        <form action="/logout" method="POST" class="logout-form">

            @csrf

            <button type="submit" class="logout-menu">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>

        </form>

    </div>

</div>

<div class="content">

    @yield('content')

</div>

</body>
</html>