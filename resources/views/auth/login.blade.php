<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:sans-serif;
}

body{
    background:#fff0f6;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}


/* CARD */

.card{
    background:white;
    width:400px;
    padding:40px;
    border-radius:22px;
    box-shadow:0 10px 35px rgba(214,51,132,0.12);
}


/* TITLE */

h2{
    text-align:center;
    color:#d63384;
    margin-bottom:30px;
    font-size:34px;
}


/* FORM */

.form-group{
    margin-bottom:18px;
}

input{
    width:100%;
    height:50px;
    padding:0 15px;
    border-radius:12px;
    border:1px solid #eee;
    outline:none;
    font-size:15px;
    transition:0.2s;
}

input:focus{
    border-color:#d63384;
    box-shadow:0 0 0 4px rgba(214,51,132,0.08);
}


/* BUTTON */

button{
    width:100%;
    height:50px;
    border:none;
    border-radius:12px;
    background:#d63384;
    color:white;
    cursor:pointer;
    font-size:16px;
    font-weight:600;
    transition:0.2s;
}

button:hover{
    background:#b0256d;
}


/* ALERT */

.error{
    background:#ffe3ec;
    color:#d63384;
    text-align:center;
    padding:12px;
    border-radius:10px;
    margin-bottom:18px;
    font-size:14px;
}

.success{
    background:#e8fff1;
    color:#16a34a;
    text-align:center;
    padding:12px;
    border-radius:10px;
    margin-bottom:18px;
    font-size:14px;
}


/* LINK */

.link{
    text-align:center;
    margin-top:25px;
}

.daftar{
    color:#d63384;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
}


/* RESPONSIVE */

@media(max-width:500px){

    .card{
        width:90%;
        padding:30px 25px;
    }

    h2{
        font-size:28px;
    }

}

</style>

</head>

<body>

<div class="card">

<h2>Masuk</h2>

@if(session('success'))
    <div class="success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="error">
        {{ session('error') }}
    </div>
@endif

<form method="POST"
      action="/login"
      autocomplete="off">

@csrf

<!-- anti autofill -->
<input type="text" style="display:none">
<input type="password" style="display:none">

<div class="form-group">

    <input type="email"
           name="login_email"
           placeholder="Email"
           autocomplete="off"
           required>

</div>

<div class="form-group">

    <input type="password"
           name="login_password"
           placeholder="Password"
           autocomplete="new-password"
           required>

</div>

<button type="submit">
    Masuk
</button>

</form>

<div class="link">

    <a href="/register?role=customer" class="daftar">
        Belum punya akun? Daftar
    </a>

</div>

</div>

</body>
</html>