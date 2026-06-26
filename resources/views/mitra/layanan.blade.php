@extends('layouts.mitra')

@section('content')

<style>
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.title{
    font-size:26px;
    font-weight:bold;
    color:#111827;
}

.btn{
    background:#ff4d6d;
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:10px;
    cursor:pointer;
    font-size:14px;
    font-weight:600;
    transition:.3s;
}

.btn:hover{ background:#ff3357; }

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
    margin-bottom:25px;
}

.form-group{ margin-bottom:18px; }

label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
    color:#374151;
}

input, textarea, select{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
    outline:none;
    font-size:14px;
}

textarea{
    height:100px;
    resize:none;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f8fafc;
    color:#64748b;
    padding:18px;
    text-align:left;
    font-size:14px;
}

td{
    padding:18px;
}

tr{ border-bottom:1px solid #f1f5f9; }

tr:hover{ background:#fafafa; }

.empty{
    text-align:center;
    padding:40px;
    color:gray;
}

.foto-layanan{
    width:90px;
    height:90px;
    object-fit:cover;
    border-radius:12px;
}

.aksi{
    display:flex;
    gap:10px;
}

/* 🔥 FIX UTAMA DI SINI */
.edit-btn, .delete-btn{
    padding:10px 14px;
    border-radius:10px;
    font-weight:600;
    text-decoration:none;
    color:white;
    border:none;
    cursor:pointer;
    display:inline-block;
    font-size:14px;
}

.edit-btn{ background:#3b82f6; }
.delete-btn{ background:#ef4444; }

button{
    font-family:inherit;
}

.price-box{
    display:inline-block;
    padding:6px 12px;
    border-radius:8px;
    background:#ffe4e6;
    color:#ff4d6d;
    font-weight:600;
    font-size:13px;
}
</style>

<div class="header">
    <div class="title">Kelola Layanan</div>

    <button class="btn" onclick="showForm()">
        + Tambah Layanan
    </button>
</div>

@if(session('success'))
<div style="background:#dcfce7;color:#166534;padding:12px;border-radius:10px;margin-bottom:15px;">
    {{ session('success') }}
</div>
@endif

{{-- FORM --}}
<div class="card" id="formLayanan" style="display:none;">

    <h3 style="margin-bottom:20px;">Tambah Layanan</h3>

    <form action="/mitra/layanan" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama_layanan" required>
        </div>

        <div class="form-group">
            <label>Varian</label>
            <input type="text" name="varian" required>
        </div>

        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" required>
        </div>

        <div class="form-group">
            <label>Durasi (Menit)</label>
            <input type="number" name="durasi" required>
        </div>

        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi"></textarea>
        </div>

        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto">
        </div>

        <button type="submit" class="btn">Simpan</button>
        <button type="button" class="btn" style="background:#6b7280;" onclick="showForm()">Batal</button>

    </form>
</div>

{{-- TABLE --}}
<div class="card" id="tableLayanan">

<table>
    <tr>
        <th>Foto</th>
        <th>Nama</th>
        <th>Varian</th>
        <th>Harga</th>
        <th>Durasi</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

    @forelse($layanans as $layanan)

    <tr>
        <td>
            @if($layanan->foto)
                <img src="{{ asset('storage/'.$layanan->foto) }}" class="foto-layanan">
            @else
                -
            @endif
        </td>

        <td>{{ $layanan->nama_layanan }}</td>
        <td>{{ $layanan->varian }}</td>

        <td>
            <div class="price-box">
            Rp {{ number_format($layanan->harga,0,',','.') }}
            </div>
        </td>

        <td>{{ $layanan->durasi }} menit</td>
        <td>{{ $layanan->deskripsi }}</td>

        <td>
            <div class="aksi">
                <a href="/mitra/layanan/{{ $layanan->id }}/edit" class="edit-btn">
                    ✏️ 
                </a>

                <form action="/mitra/layanan/{{ $layanan->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn">
                        🗑️
                    </button>
                </form>
            </div>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="7" class="empty">Belum ada layanan</td>
    </tr>
    @endforelse

</table>

</div>

<script>
function showForm(){
    let form = document.getElementById('formLayanan');
    let table = document.getElementById('tableLayanan');

    form.style.display = form.style.display === 'none' ? 'block' : 'none';
    table.style.display = table.style.display === 'none' ? 'block' : 'none';
}

</script>

@endsection