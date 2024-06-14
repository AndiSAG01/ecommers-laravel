@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('active-pesanan', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Detail Pesanan</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body d-grid gap-2">
                    <div class="d-grid mb-3">
                        <span class="h6 mb-1">Nama:</span>
                        <span>{{ ucwords($order->customer_name) }}</span>
                    </div>
                    <div class="d-grid mb-3">
                        <span class="h6 mb-1">Kontak:</span>
                        <span>{{ $order->customer_phone }}</span>
                    </div>
                    <div class="d-grid">
                        <span class="h6 mb-1">Alamat:</span>
                        <span>{{ ucwords($order->customer->address) }} {{ $order->district->city->name }}, <br> {{ $order->district->name }} {{ $order->customer_postal_code }}</span>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="d-grid mb-3">
                                <span class="h6 mb-1">Status:</span>
                                <span>{!! $order->sts_label !!}</span>
                            </div>
                            <div class="d-grid">
                                <span class="h6 mb-1">Kurir:</span>
                                <span>{{ Str::upper($order->courier) }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            @if ($order->status == 1 && $order->payment->status == 0)
                                <div class="mt-3">
                                    <a href="{{ route('order.approve_payment', $order->invoice) }}" class="btn btn-primary">Terima</a>
                                </div>
                            @endif
                            <div class="mt-3">
                                @if ($order->status == 2)
                                    <form action="{{ route('order.shipping') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <div class="input-group">
                                            <input type="text" name="tracking_number" class="form-control" placeholder="Masukkan Nomor Resi">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="d-grid mb-3">
                                        <span class="h6 mb-1">Nomor Pelacakan:</span>
                                        <span class="h6 mb-1">{{ $order->tracking_number }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if ($order->status != 0)
                        <div class="d-grid mb-3">
                            <span class="h6 mb-1">Nama Pengirim:</span>
                            <span>{{ ucwords($order->payment->name) }}</span>
                        </div>
                        <div class="d-grid mb-3">
                            <span class="h6 mb-1">Bank Tujuan:</span>
                            <span>{{ $order->payment->transfer_to }}</span>
                        </div>
                        <div class="d-grid mb-3">
                            <span class="h6 mb-1">Tanggal Transfer:</span>
                            <span>{{ $order->payment->transfer_date }}</span>
                        </div>
                        <div class="d-grid mb-3">
                            <span class="h6 mb-1">Jumlah Transfer:</span>
                            <span>IDR {{ number_format($order->payment->amount) }}</span>
                        </div>
                        <div class="d-grid mb-3">
                            <span class="h6 mb-1">Bukti Transfer:</span>
                            <span><a href="{{ asset('storage/payments/' . $order->payment->proof) }}" target="_blank">Lihat</a></span>
                        </div>
                        @if($order->return_count == 1)
                            <div class="d-grid mb-3">
                                <span class="h6 mb-1">Status Pembayaran:</span>
                                <span>{!! $order->payment->status_label !!}</span>
                            </div>
                        @endif
                        <div class="d-grid">
                            <span class="h6 mb-1">Status Pembayaran:</span>
                            <span>{!! $order->payment->status_label !!}</span>
                        </div>
                    @else
                        <div class="text-center">
                            <span class="h6 mb-1">Pesanan Ini Belum Melakukan Pembayaran</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
