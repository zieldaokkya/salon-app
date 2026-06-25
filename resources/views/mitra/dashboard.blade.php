@extends('layouts.mitra')

@section('content')

<style>

.welcome-card{
    background:linear-gradient(135deg,#ff4d6d,#ff758f);
    color:white;
    padding:30px;
    border-radius:18px;
    margin-bottom:30px;
    box-shadow:0 10px 25px rgba(255,77,109,0.25);
}

.cards{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

.mini-card{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.table-card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#f9fafb;
    padding:15px;
}

td{
    padding:15px;
}

tr{
    border-bottom:1px solid #eee;
}

.status{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

/* STATUS WARNA */
.success{
    background:#dcfce7;
    color:#16a34a;
}

.pending{
    background:#fef3c7;
    color:#d97706;
}

.confirmed{
    background:#dbeafe;
    color:#2563eb;
}

.rejected{
    background:#fee2e2;
    color:#dc2626;
}

.empty{
    text-align:center;
    color:gray;
    padding:30px;
}

</style>

<!-- WELCOME -->
<div class="welcome-card">
    <h1>Halo, {{ $user->name }} 👋</h1>
    <p>Kelola booking pelanggan dengan mudah</p>
</div>

<!-- STATISTIK -->
<div class="cards">
    <div class="mini-card">
        <h3>Pending</h3>
        <h2>{{ $pending }}</h2>
    </div>

    <div class="mini-card">
        <h3>Selesai</h3>
        <h2>{{ $selesai }}</h2>
    </div>

    <div class="mini-card">
        <h3>Total</h3>
        <h2>{{ $total }}</h2>
    </div>

    <div class="mini-card">
        <h3>Layanan</h3>
        <h2>{{ $jumlahLayanan }}</h2>
    </div>
</div>

<!-- TABLE -->
<div class="table-card">

    <h3>Booking Terbaru</h3>

    <table>
        <tr>
            <th>Customer</th>
            <th>Layanan</th>
            <th>Harga</th>
            <th>Status</th>
        </tr>

        @forelse($bookings as $order)
        <tr>

            <td>{{ $order->customer->name ?? '-' }}</td>

            <td>{{ $order->layanan->nama_layanan ?? '-' }}</td>

            <td>
                Rp{{ number_format($order->layanan->harga ?? 0,0,',','.') }}
            </td>

            <td>

                @switch($order->status)

                    @case('done')
                        <span class="status success">Selesai</span>
                        @break

                    @case('confirmed')
                        <span class="status confirmed">Diterima</span>
                        @break

                    @case('rejected')
                        <span class="status rejected">Ditolak</span>
                        @break

                    @default
                        <span class="status pending">Pending</span>
                        @break

                @endswitch

            </td>

        </tr>

        @empty
        <tr>
            <td colspan="4" class="empty">Belum ada booking</td>
        </tr>
        @endforelse

    </table>

</div>

@endsection