@extends('layouts.mitra')

@section('content')

<style>
    .card{
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
        max-width:800px;
    }

    .card h2{
        margin-bottom:25px;
    }

    .form-group{
        margin-bottom:18px;
    }

    .form-group label{
        display:block;
        margin-bottom:8px;
        font-weight:600;
        color:#444;
    }

    .form-control{
        width:100%;
        padding:12px;
        border:1px solid #ddd;
        border-radius:8px;
        font-size:14px;
    }

    textarea.form-control{
        resize:none;
        height:100px;
    }

    .btn{
        background:#ff4d6d;
        color:white;
        border:none;
        padding:12px 20px;
        border-radius:8px;
        cursor:pointer;
        font-size:15px;
    }

    .btn:hover{
        background:#e63e5f;
    }

    .btn-back{
        background:#6b7280;
        text-decoration:none;
        color:white;
        padding:12px 20px;
        border-radius:8px;
        margin-right:10px;
    }

    .actions{
        margin-top:25px;
    }
</style>

<div class="card">

    <h2>Edit Profile Mitra</h2>

    <form action="/mitra/profile/update" method="POST">
        @csrf

        <div class="form-group">
            <label>Nama Pemilik</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input
                type="email"
                name="email"
                class="form-control"
                value="{{ $user->email }}">
        </div>

        <div class="form-group">
            <label>Nama Salon</label>
            <input
                type="text"
                name="nama_salon"
                class="form-control"
                value="{{ $salon->nama_salon }}">
        </div>

        <div class="form-group">
            <label>Kota</label>
            <input
                type="text"
                name="kota"
                class="form-control"
                value="{{ $salon->kota }}">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea
                name="alamat"
                class="form-control">{{ $salon->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label>Deskripsi Salon</label>
            <textarea
                name="deskripsi"
                class="form-control">{{ $salon->deskripsi }}</textarea>
        </div>

        <div class="actions">

            <a href="/mitra/profile" class="btn-back">
                Kembali
            </a>

            <button type="submit" class="btn">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection