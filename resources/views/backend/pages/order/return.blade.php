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
                                <span class="h6 mb-1">Alasan Return:</span>
                                <span>{{ $order->return->reason }}</span>
                            </div>
                            <div class="d-grid mb-3">
                                <span class="h6 mb-1">Rekening Pengembalian Dana:</span>
                                <span>{{ $order->return->refund_transfer }}</span>
                            </div>
                            <div class="d-grid">
                                <span class="h6 mb-1">Status:</span>
                                <span>{!! $order->return->status_label !!}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="mt-3">
                                @if ($order->return->status == 0)
                                    <form action="{{ route('order.approve_return') }}" onsubmit="return confirm('Kamu Yakin ?');" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <div class="input-group mb-3 w-auto">
                                            <select name="status" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <option value="1">Terima</option>
                                                <option value="2">Tolak</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
                                    </form>
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
                    <div class="d-grid">
                        <span class="h6 mb-1">Bukti Barang:</span>
                        <img src="{{ asset('storage/returns/' . $order->return->photo) }}" class="img-responsive" height="200" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
