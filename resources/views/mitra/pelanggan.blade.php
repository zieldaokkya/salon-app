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


.card{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}



.search{
    width:300px;
    padding:12px;
    border:1px solid #ddd;
    border-radius:10px;
    margin-bottom:20px;
}



table{
    width:100%;
    border-collapse:collapse;
}



th{
    background:#f9fafb;
    color:#6b7280;
    padding:15px;
    text-align:left;
    font-size:14px;
}



td{
    padding:15px;
    font-size:14px;
}



tr{
    border-bottom:1px solid #eee;
}



tr:hover{
    background:#f9fafb;
}



.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#ffe4ec;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#ff4f81;
    font-weight:bold;
}



.btn{
    padding:8px 14px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-size:13px;
    text-decoration:none;
    display:inline-block;
}



.detail{
    background:#3b82f6;
    color:white;
}



.detail:hover{
    background:#2563eb;
    color:white;
    text-decoration:none;
}



.delete{
    background:#ef4444;
    color:white;
}



.delete:hover{
    background:#dc2626;
}



.empty{
    text-align:center;
    padding:40px;
    color:gray;
}


</style>





<div class="header">

    <div class="title">
        Data Pelanggan
    </div>

</div>







<div class="card">



<input 
id="searchPelanggan"
class="search"
placeholder="Cari nama pelanggan..."
>




<table id="tabelPelanggan">


<thead>

<tr>

<th>No</th>

<th>Pelanggan</th>

<th>Email</th>

<th>Total Booking</th>

<th>Terakhir Booking</th>

<th>Aksi</th>

</tr>

</thead>




<tbody>



@forelse($pelanggan as $p)



<tr>


<td>

{{ $loop->iteration }}

</td>





<td>


<div style="display:flex;align-items:center;gap:12px;">


<div class="avatar">

{{ strtoupper(substr($p->name,0,1)) }}

</div>



<span class="nama-pelanggan">

{{ $p->name }}

</span>


</div>


</td>







<td>

{{ $p->email }}

</td>







<td>

{{ $p->total_booking ?? 0 }} Kali

</td>







<td>

{{ $p->last_booking ?? '-' }}

</td>







<td style="display:flex;gap:8px;">



<a href="/mitra/pelanggan/{{ $p->id }}" 
class="btn detail">

Detail

</a>




<form action="/mitra/pelanggan/{{ $p->id }}/hapus" method="POST">

    @csrf
    @method('DELETE')

    <button 
    class="btn delete"
    onclick="return confirm('Yakin hapus pelanggan ini?')">

        Hapus

    </button>

</form>



</td>





</tr>





@empty



<tr>

<td colspan="6" class="empty">

Belum ada pelanggan

</td>

</tr>





@endforelse





</tbody>



</table>



</div>







<script>


document
.getElementById('searchPelanggan')
.addEventListener('keyup', function(){


    let keyword = this.value.toLowerCase();



    let rows = document
    .querySelectorAll('#tabelPelanggan tbody tr');



    rows.forEach(row => {



        let nama = row
        .querySelector('.nama-pelanggan')
        .innerText
        .toLowerCase();



        if(nama.includes(keyword)){


            row.style.display = "";


        }else{


            row.style.display = "none";


        }



    });



});



</script>





@endsection