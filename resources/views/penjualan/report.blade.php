@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Laporan Transaksi</h1>
    <p>Total Pendapatan: <strong>Rp{{ number_format($total_income, 0, ',', '.') }}</strong></p>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
                <tr>
                    <td>{{ $trx->id }}</td>
                    <td>{{ $trx->created_at }}</td>
                    <td>Rp{{ number_format($trx->total, 0, ',', '.') }}</td>
                    <td>
                        <ul>
                            @foreach($trx->details as $detail)
                                <li>{{ $detail->product->name }} x {{ $detail->quantity }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection