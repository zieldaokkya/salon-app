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

.btn:hover{
    background:#ff3357;
}

.card{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.05);
    margin-bottom:25px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
    color:#374151;
}

input,
textarea{
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
    font-weight:600;
}

td{
    padding:18px;
    vertical-align:middle;
}

tr{
    border-bottom:1px solid #f1f5f9;
}

tr:hover{
    background:#fafafa;
}

.harga{
    color:#ff4d6d;
    font-weight:700;
}

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
    border:2px solid #f3f4f6;
}

.aksi{
    display:flex;
    gap:10px;
    align-items:center;
}

.edit-btn,
.delete-btn{
    display:flex;
    align-items:center;
    justify-content:center;
    min-width:80px;
    height:40px;
    border:none;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    cursor:pointer;
    transition:.3s;
}

.edit-btn{
    background:#3b82f6;
    color:white;
}

.edit-btn:hover{
    background:#2563eb;
}

.delete-btn{
    background:#ef4444;
    color:white;
}

.delete-btn:hover{
    background:#dc2626;
}

.btn-secondary{
    background:#e5e7eb;
    color:#374151;
    border:none;
    padding:12px 22px;
    border-radius:10px;
    cursor:pointer;
    font-size:14px;
    font-weight:600;
}

.btn-secondary:hover{
    background:#d1d5db;
}

.form-buttons{
    display:flex;
    gap:10px;
    margin-top:20px;
}

</style>


<div class="header">
    <div class="title">Kelola Layanan</div>

    <button class="btn" onclick="showForm()">
        + Tambah Layanan
    </button>
</div>


<div class="card" id="formLayanan" style="display:none;">

    <h3 style="margin-bottom:25px;">Tambah Layanan Baru</h3>

    <form action="/mitra/layanan"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label>Nama Layanan</label>
            <input type="text" name="nama_layanan" required>
        </div>

        <!-- ✅ VARIAN FLEXIBLE -->
        <div class="form-group">
            <label>Varian Layanan</label>
            <input type="text"
                   name="varian"
                   required>
        </div>

        <div class="form-group">
            <label>Harga Layanan</label>
            <input type="text"
                   name="harga" 
                   id="harga" required>
        </div>

        <div class="form-group">
            <label>Durasi (Menit)</label>
            <input type="number" name="durasi" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Layanan</label>
            <textarea name="deskripsi" placeholder="Masukkan deskripsi layanan"></textarea>
        </div>

        <div class="form-group">
            <label>Foto Layanan</label>
            <input type="file" name="foto" accept="image/*">
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn">
                Simpan Layanan
            </button>

            <button type="button"
                    class="btn-secondary"
                    onclick="showForm()">
                Batal
            </button>
        </div>

    </form>

</div>


<div class="card" id="tableLayanan">

    <table>

        <tr>
            <th>Foto</th>
            <th>Nama Layanan</th>
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
                    <img src="{{ asset('storage/' . $layanan->foto) }}" class="foto-layanan">
                @else
                    -
                @endif
            </td>

            <td>{{ $layanan->nama_layanan }}</td>

            <td>{{ $layanan->varian }}</td>

            <td class="harga">
                Rp{{ number_format($layanan->harga,0,',','.') }}
            </td>

            <td>{{ $layanan->durasi }} menit</td>

            <td>{{ $layanan->deskripsi }}</td>

            <td>
                <div class="aksi">

                    <a href="/mitra/layanan/{{ $layanan->id }}/edit"
                       class="edit-btn">
                        Edit
                    </a>

                    <form action="/mitra/layanan/{{ $layanan->id }}"
                          method="POST">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="delete-btn"
                                onclick="return confirm('Yakin hapus layanan?')">
                            Hapus
                        </button>

                    </form>

                </div>
            </td>

        </tr>

        @empty

        <tr>
            <td colspan="7" class="empty">
                Belum ada layanan
            </td>
        </tr>

        @endforelse

    </table>

</div>


<script>

function showForm()
{
    let form = document.getElementById('formLayanan');
    let table = document.getElementById('tableLayanan');

    if(form.style.display === 'none')
    {
        form.style.display = 'block';
        table.style.display = 'none';
    }
    else
    {
        form.style.display = 'none';
        table.style.display = 'block';
    }
}

</script>

@endsection