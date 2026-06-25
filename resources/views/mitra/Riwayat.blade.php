@extends('layouts.mitra')

@section('content')

<style>

.page-title{
    font-size:26px;
    font-weight:700;
    color:#111827;
    margin-bottom:25px;
}


.card{
    background:#fff;
    border-radius:24px;
    padding:28px;
    box-shadow:0 2px 10px rgba(0,0,0,.04);
}


.table-wrap{
    overflow-x:auto;
}


table{
    width:100%;
    border-collapse:collapse;
}


thead{
    background:#f7f8fa;
}


th{
    padding:20px;
    text-align:center;
    color:#64748b;
    font-size:16px;
    font-weight:600;
}


td{
    padding:20px;
    text-align:center;
    border-top:1px solid #eee;
    color:#374151;
}


.empty{
    padding:60px 20px;
    color:#6b7280;
    font-size:18px;
}


.status{
    padding:8px 16px;
    border-radius:30px;
    font-size:13px;
    font-weight:600;
}


.status-selesai{
    background:#dcfce7;
    color:#15803d;
}


.status-ditolak{
    background:#fee2e2;
    color:#dc2626;
}


</style>



<h2 class="page-title">
    Riwayat Booking
</h2>



<div class="card">


    <div class="table-wrap">


        <table>


            <thead>

                <tr>

                    <th>No</th>

                    <th>Customer</th>

                    <th>Layanan</th>

                    <th>Tanggal</th>

                    <th>Jam</th>

                    <th>Status</th>

                </tr>

            </thead>



            <tbody>


            @forelse($riwayat as $booking)


            <tr>


                <td>
                    {{ $loop->iteration }}
                </td>


                <td>
                    {{ $booking->customer->name ?? '-' }}
                </td>


                <td>
                    {{ $booking->layanan->nama_layanan ?? '-' }}
                </td>


                <td>
                    {{ $booking->tanggal ?? '-' }}
                </td>


                <td>
                    {{ $booking->jam ?? '-' }}
                </td>



                <td>


                    @php
                        $status = $booking->status;
                    @endphp



                    <span class="status

                    {{ $status == 'done' ? 'status-selesai' : '' }}

                    {{ $status == 'rejected' ? 'status-ditolak' : '' }}

                    ">



                        {{ $status == 'done' ? 'Selesai' : 'Ditolak' }}



                    </span>


                </td>


            </tr>



            @empty



            <tr>

                <td colspan="6" class="empty">

                    Belum ada riwayat booking

                </td>

            </tr>



            @endforelse



            </tbody>



        </table>



    </div>


</div>



@endsection