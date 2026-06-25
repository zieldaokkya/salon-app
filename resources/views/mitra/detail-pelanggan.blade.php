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
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,.05);
    margin-bottom:20px;
}


.profile{
    display:flex;
    align-items:center;
    gap:20px;
}


.avatar{
    width:75px;
    height:75px;
    border-radius:50%;
    background:#ffe4ec;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#ff4f81;
    font-size:28px;
    font-weight:bold;
}


.info h3{
    margin:0;
}


.info p{
    margin:5px 0;
    color:#6b7280;
}


.back-btn{
    width:40px;
    height:40px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#ff4f81;
    color:white;
    border-radius:50%;
    text-decoration:none;
    font-size:20px;
}


.back-btn:hover{
    background:#e83e70;
    color:white;
}


.stats{
    display:flex;
    gap:20px;
    margin-top:25px;
}


.stat-box{
    flex:1;
    background:#f9fafb;
    padding:18px;
    border-radius:12px;
}


.stat-title{
    color:#6b7280;
    font-size:13px;
}


.stat-number{
    font-size:24px;
    font-weight:bold;
}


table{
    width:100%;
    border-collapse:collapse;
}


th{
    background:#f9fafb;
    padding:15px;
    text-align:left;
    color:#6b7280;
}


td{
    padding:15px;
    border-bottom:1px solid #eee;
}


.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    color:white;
}


.done{
    background:#10b981;
}


.pending{
    background:#f59e0b;
}


.rejected{
    background:#ef4444;
}


</style>



<div class="header">

<div class="title">
    Detail Pelanggan
</div>


<a href="/mitra/pelanggan" class="back-btn">
    ←
</a>

</div>




<div class="card">


<div class="profile">


<div class="avatar">

{{ strtoupper(substr($pelanggan->name,0,1)) }}

</div>



<div class="info">


<h3>
{{ $pelanggan->name }}
</h3>


<p>
{{ $pelanggan->email }}
</p>


<p>
Pelanggan Salon
</p>


</div>


</div>





<div class="stats">



<div class="stat-box">

<div class="stat-title">
Total Booking
</div>

<div class="stat-number">
{{ $booking->count() }}
</div>

</div>




<div class="stat-box">

<div class="stat-title">
Selesai
</div>

<div class="stat-number">
{{ $booking->where('status','done')->count() }}
</div>

</div>




<div class="stat-box">

<div class="stat-title">
Terakhir Booking
</div>

<div class="stat-number" style="font-size:16px">

{{ $booking->last()->tanggal ?? '-' }}

</div>

</div>



</div>


</div>






<div class="card">


<h4>
Riwayat Booking
</h4>



<table>


<tr>

<th>No</th>

<th>Layanan</th>

<th>Tanggal</th>

<th>Jam</th>

<th>Status</th>

</tr>





@forelse($booking as $b)



<tr>


<td>
{{ $loop->iteration }}
</td>



<td>
{{ $b->layanan->nama_layanan ?? '-' }}
</td>



<td>
{{ $b->tanggal }}
</td>



<td>
{{ $b->jam }}
</td>




<td>


@if($b->status == 'done')


<span class="badge done">
Selesai
</span>



@elseif($b->status == 'pending')


<span class="badge pending">
Pending
</span>



@elseif($b->status == 'rejected')


<span class="badge rejected">
Ditolak
</span>



@endif



</td>



</tr>





@empty


<tr>

<td colspan="5" style="text-align:center;padding:40px">

Belum ada riwayat booking

</td>

</tr>



@endforelse





</table>



</div>




@endsection