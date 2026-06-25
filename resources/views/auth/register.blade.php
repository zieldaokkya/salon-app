<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#fff0f6;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:30px;
}

.wrapper{
    width:100%;
    max-width:1100px;
    display:flex;
    overflow:hidden;
    border-radius:25px;
    background:white;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
}

/* LEFT */

.left{
    width:40%;
    background:linear-gradient(
        135deg,
        #d63384,
        #ff4d6d
    );

    color:white;
    padding:50px 40px;
}

.left h1{
    font-size:40px;
    margin-bottom:15px;
}

.left p{
    line-height:1.7;
    margin-bottom:40px;
}

.feature{
    background:rgba(255,255,255,.15);
    padding:18px;
    border-radius:15px;
    margin-bottom:15px;
}

.feature h4{
    margin-bottom:5px;
}

/* RIGHT */

.right{
    flex:1;
    padding:50px;
    overflow-y:auto;
}

.right h2{
    color:#d63384;
    margin-bottom:10px;
}

.subtitle{
    color:#777;
    margin-bottom:30px;
}

.alert{
    background:#ffe3ec;
    color:#d63384;
    padding:12px;
    border-radius:10px;
    margin-bottom:20px;
}

.row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
}

.form-group{
    margin-bottom:15px;
}

input,
textarea{
    width:100%;
    border:1px solid #eee;
    border-radius:12px;
    padding:14px;
    outline:none;
    font-size:15px;
}

input:focus,
textarea:focus{
    border-color:#d63384;
    box-shadow:0 0 0 4px rgba(214,51,132,.08);
}

textarea{
    resize:none;
    height:100px;
}

button{
    width:100%;
    border:none;
    background:#d63384;
    color:white;
    height:50px;
    border-radius:12px;
    cursor:pointer;
    font-size:16px;
    font-weight:600;
    margin-top:10px;
}

button:hover{
    background:#b0256d;
}

.login{
    text-align:center;
    margin-top:20px;
}

.login a{
    color:#d63384;
    text-decoration:none;
    font-weight:bold;
}

@media(max-width:900px){

    .wrapper{
        flex-direction:column;
    }

    .left{
        width:100%;
    }

    .row{
        grid-template-columns:1fr;
    }

    .right{
        padding:30px;
    }
}

</style>
</head>

<body>

<div class="wrapper">

    <!-- KIRI -->
    <div class="left">

        <h1>SalonKu</h1>

        <p>
            Bergabung menjadi mitra salon dan
            kelola bisnis salon Anda dengan
            lebih mudah.
        </p>

        <div class="feature">
            <h4>📅 Kelola Booking</h4>
            <small>Atur jadwal pelanggan secara online</small>
        </div>

        <div class="feature">
            <h4>💇 Kelola Layanan</h4>
            <small>Tambah dan ubah layanan salon</small>
        </div>

        <div class="feature">
            <h4>📈 Tingkatkan Pendapatan</h4>
            <small>Dapatkan lebih banyak pelanggan</small>
        </div>

    </div>


    <!-- KANAN -->
    <div class="right">

        <h2>Register</h2>

        <div class="subtitle">
            Register sebagai
            <b>{{ ucfirst($role) }}</b>
        </div>

        @if ($errors->any())
        <div class="alert">
            {{ $errors->first() }}
        </div>
        @endif

    <form method="POST"
        action="/register"
        autocomplete="off">

    @csrf

    <!-- anti autofill -->
    <input type="text"
           style="display:none">

    <input type="password"
           style="display:none">

    <input type="hidden"
           name="role"
           value="{{ $role }}">

            @csrf

            <input type="hidden"
                   name="role"
                   value="{{ $role }}">

            <div class="row">

                <div class="form-group">
                    <input type="text"
                           name="name"
                           placeholder="Nama Lengkap"
                           required>
                </div>

                <div class="form-group">
                    <input type="email"
                        name="email"
                        placeholder="Email"
                        autocomplete="off"
                        required>
                </div>

            </div>


            @if($role == 'mitra')

            <div class="form-group">
                <input type="text"
                       name="nama_salon"
                       placeholder="Nama Salon"
                       required>
            </div>

            <div class="row">

                <div class="form-group">
                    <input type="text"
                           name="kota"
                           placeholder="Kota"
                           required>
                </div>

                <div class="form-group">
                    <input type="text"
                           name="alamat"
                           placeholder="Alamat Salon"
                           required>
                </div>

            </div>

            <div class="form-group">
                <textarea
                    name="deskripsi"
                    placeholder="Deskripsi Salon"
                    required></textarea>
            </div>

            @endif


            <div class="form-group">
                <input type="password"
                    name="password"
                    placeholder="Password"
                    autocomplete="new-password"
                    required>
            </div>

            <button type="submit">
                Daftar
            </button>

        </form>

        <div class="login">

            <a href="/login">
                Sudah punya akun? Login
            </a>

        </div>

    </div>

</div>

</body>
</html>