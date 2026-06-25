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

    .status{
        padding:5px 10px;
        border-radius:20px;
        font-size:12px;
        color:white;
        display:inline-block;
    }

    .pending{
        background:orange;
    }

    .confirmed{
        background:#3b82f6;
    }

    .rejected{
        background:#ef4444;
    }

    .done{
        background:#10b981;
    }

    .btn{
        padding:8px 12px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        font-size:13px;
    }

    .accept{
        background:#10b981;
        color:white;
    }

    .reject{
        background:#ef4444;
        color:white;
    }

    .empty{
        text-align:center;
        padding:40px;
        color:gray;
    }

</style>

<div class="header">
    <div class="title">
        Kelola Order
    </div>
</div>

<div class="card">

    <table>

        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Layanan</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse($bookings as $booking)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $booking->customer->name ?? '-' }}</td>

            <td>{{ $booking->layanan->nama_layanan ?? '-' }}</td>

            <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>

            <td>{{ $booking->jam }}</td>

            <td>
                <span class="status
                    @if($booking->status == 'pending') pending
                    @elseif($booking->status == 'confirmed') confirmed
                    @elseif($booking->status == 'rejected') rejected
                    @else done
                    @endif">

                    @if($booking->status == 'pending')
                        Pending
                    @elseif($booking->status == 'confirmed')
                        Dikonfirmasi
                    @elseif($booking->status == 'rejected')
                        Ditolak
                    @else
                        Selesai
                    @endif

                </span>
            </td>

            <td style="display:flex;gap:8px;">

    {{-- KALO MASIH PENDING --}}
    @if($booking->status == 'pending')

        <form action="/mitra/order/{{ $booking->id }}/terima" method="POST">
            @csrf
            <button type="submit" class="btn accept"
                onclick="return confirm('Yakin terima booking ini?')">
                Terima
            </button>
        </form>

        <form action="/mitra/order/{{ $booking->id }}/tolak" method="POST">
            @csrf
            <button type="submit" class="btn reject"
                onclick="return confirm('Yakin tolak booking ini?')">
                Tolak
            </button>
        </form>

    {{-- KALO SUDAH DITERIMA --}}
    @elseif($booking->status == 'confirmed')

        <form action="/mitra/order/{{ $booking->id }}/selesai" method="POST">
            @csrf
            <button type="submit" class="btn accept"
                onclick="return confirm('Tandai booking ini selesai?')">
                Selesai
            </button>
        </form>

    {{-- KALO SUDAH SELESAI / DITOLAK --}}
    @else

        <span style="color:gray;">
            Tidak ada aksi
        </span>

    @endif

</td>

        </tr>

        @empty

        <tr>
            <td colspan="7" class="empty">
                Belum ada order
            </td>
        </tr>

        @endforelse

    </table>

</div>

@endsection