@extends('layouts.mitra')

@section('content')

<style>
.card{
    width:100%;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.05);
}

.title{
    font-size:26px;
    font-weight:bold;
    margin-bottom:25px;
    color:#111827;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

input,
textarea{
    width:100%;
    padding:13px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    font-size:14px;
}

input:focus,
textarea:focus{
    border-color:#ff4d6d;
}

textarea{
    height:120px;
    resize:none;
}

.preview{
    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:12px;
    margin-top:10px;
    border:1px solid #eee;
}

.btn{
    background:#ff4d6d;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:10px;
    cursor:pointer;
    font-size:14px;
    font-weight:600;
}

.btn:hover{
    background:#ff3357;
}

.btn-back{
    background:#6b7280;
    margin-left:10px;
}

.btn-back:hover{
    background:#4b5563;
}
</style>

<div class="card">

    <div class="title">
        Edit Layanan
    </div>

    <form action="/mitra/layanan/{{ $layanan->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Layanan</label>
            <input type="text"
                   name="nama_layanan"
                   value="{{ $layanan->nama_layanan }}"
                   required>
        </div>

        <div class="form-group">
            <label>Varian</label>
            <input type="text"
                   name="varian"
                   value="{{ $layanan->varian }}"
                   required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number"
                   name="harga"
                   value="{{ $layanan->harga }}"
                   required>
        </div>

        <div class="form-group">
            <label>Durasi (Menit)</label>
            <input type="number"
                   name="durasi"
                   value="{{ $layanan->durasi }}"
                   required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi">{{ $layanan->deskripsi }}</textarea>
        </div>

        <div class="form-group">
            <label>Foto Saat Ini</label>

            @if($layanan->foto)
                <br>
                <img src="{{ asset('storage/'.$layanan->foto) }}" class="preview">
            @else
                <p>Belum ada foto.</p>
            @endif
        </div>

        <div class="form-group">
            <label>Ganti Foto</label>
            <input type="file" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn">
            Update Layanan
        </button>

        <a href="/mitra/layanan" class="btn btn-back" style="text-decoration:none;">
            Batal
        </a>

    </form>

</div>

@endsection