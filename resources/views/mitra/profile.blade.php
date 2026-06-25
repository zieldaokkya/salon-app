@extends('layouts.mitra')

@section('content')

<style>

    .profile-card{
        background:white;
        border-radius:15px;
        padding:30px;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
        max-width:800px;
    }

    .profile-header{
        display:flex;
        align-items:center;
        gap:20px;
        margin-bottom:30px;
    }

    .avatar{
        width:90px;
        height:90px;
        border-radius:50%;
        background:#ff4d6d;
        color:white;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:35px;
        font-weight:bold;
    }

    .profile-header h2{
        margin-bottom:5px;
    }

    .profile-header p{
        color:gray;
    }

    .info{
        display:grid;
        grid-template-columns:180px 1fr;
        row-gap:15px;
    }

    .label{
        font-weight:bold;
        color:#555;
    }

    .value{
        color:#222;
    }

    .btn-edit{
        margin-top:25px;
        background:#ff4d6d;
        color:white;
        text-decoration:none;
        padding:12px 20px;
        border-radius:8px;
        display:inline-block;
    }

    .btn-edit:hover{
        background:#e63e5f;
    }

</style>

<div class="profile-card">

    <div class="profile-header">

        <div class="avatar">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>

        <div>
            <h2>{{ $user->name }}</h2>
            <p>Mitra SalonKu</p>
        </div>

    </div>

    <div class="info">

        <div class="label">Nama</div>
        <div class="value">{{ $user->name }}</div>

        <div class="label">Email</div>
        <div class="value">{{ $user->email }}</div>

        @if(isset($salon))

            <div class="label">Nama Salon</div>
            <div class="value">{{ $salon->nama_salon }}</div>

            <div class="label">Kota</div>
            <div class="value">{{ $salon->kota }}</div>

            <div class="label">Alamat</div>
            <div class="value">{{ $salon->alamat }}</div>

            <div class="label">Deskripsi</div>
            <div class="value">{{ $salon->deskripsi }}</div>

        @endif

    </div>

    <a href="/mitra/profile/edit" class="btn-edit">
        Edit Profile
    </a>

</div>

@endsection