@extends('frontend.layouts.app')
@section('title', 'Fas Vapor Store')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{ route('front.index') }}">Beranda</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li><a href="{{ route('customer.view_order', $order->invoice) }}">Pesanan</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Pengembalian</li>
        </ul>
    </div>
</div>
<div class="checkout-page mt-100">
    <div class="container">
        <form method="POST" action="{{ route('customer.return', $order->id) }}" class="shipping-address-form common-form" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="checkout-page-wrapper">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                        <div class="section-header d-flex align-items-center justify-content-between flex-wrap">
                            <h2 class="section-heading">Pengembalian</h2>
                        </div>
                        <hr>
                        @if ($order->return->status == 1)
                            <div class="shipping-address-area">
                                <div class="shipping-address-form-wrapper">
                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset>
                                                <label for="reason" class="label">Alasan</label>
                                                <textarea name="reason" id="reason" class="form-control" rows="5"></textarea>
                                                <p class="smaller text-danger">{{ $errors->first('reason') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <label for="refund_transfer" class="label">Jumalh transfer</label>
                                                <input type="number" name="refund_transfer" id="refund_transfer" class="form-control" value="{{ old('refund_transfer', $order->total) }}" readonly />
                                                <p class="smaller text-danger">{{ $errors->first('refund_transfer') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <label for="photo" class="label">Bukti barang</label>
                                                <input type="file" name="photo" id="photo" class="form-control" />
                                                <p class="smaller text-danger">{{ $errors->first('photo') }}</p>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-address-area billing-area">
                                <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                    <a href="{{ route('customer.account') }}" class="checkout-page-btn minicart-btn btn-secondary">KEMBALI</a>
                                    <button type="submit" class="checkout-page-btn minicart-btn btn-primary">KIRIM</button>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12 mt-5">
                                <p class="fw-normal text-center smaller">Anda telah melakukan pengembalian</p>
                                <a href="{{ route('customer.account') }}" class="checkout-page-btn minicart-btn btn-secondary">KEMBALI</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
