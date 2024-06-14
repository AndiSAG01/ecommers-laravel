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
            <li>Pembayaran</li>
        </ul>
    </div>
</div>
<div class="checkout-page mt-100">
    <div class="container">
        <form method="POST" action="{{ route('customer.storePayment') }}" class="shipping-address-form common-form" enctype="multipart/form-data">
            @csrf @method('POST')
            <div class="checkout-page-wrapper">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                        <div class="section-header d-flex align-items-center justify-content-between flex-wrap">
                            <h2 class="section-heading">Pembayaran</h2>
                        </div>
                        <hr>
                        @if($order->status == 0)
                            <div class="shipping-address-area">
                                <div class="shipping-address-form-wrapper">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label for="invoice" class="label">Invoice ID</label>
                                                <input type="text" name="invoice" id="invoice" class="form-control" value="{{ request()->invoice }}" readonly />
                                                <p class="smaller text-danger">{{ $errors->first('invoice') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label for="name" class="label">Nama pengirim</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $order->customer_name) }}" />
                                                <p class="smaller text-danger">{{ $errors->first('name') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label for="amount" class="label">Jumlah transfer</label>
                                                <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', $order->total) }}" readonly />
                                                <p class="smaller text-danger">{{ $errors->first('amount') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <fieldset>
                                                <label for="transfer_date" class="label">Tanggal transfer</label>
                                                <input type="date" name="transfer_date" id="transfer_date" class="form-control" data-date-format="d M Y" />
                                                <p class="smaller text-danger">{{ $errors->first('transfer_date') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <label for="transfer_to" class="label">Transfer ke</label>
                                                <select name="transfer_to" id="transfer_to" class="form-select">
                                                    <option value="BCA - 1234567">BCA: 1234567 a.n Vas Company</option>
                                                    <option value="BNI - 6789456">BNI: 6789456 a.n  Vas Company</option>
                                                    <option value="BRI - 9876543">BRI: 9876543 a.n  Vas Company</option>
                                                    <option value="Mandiri - 2345678">Mandiri: 2345678 a.n  Vas Company</option>
                                                </select>
                                                <p class="smaller text-danger">{{ $errors->first('transfer_to') }}</p>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <fieldset>
                                                <label for="proof" class="label">Bukti transfer</label>
                                                <input type="file" name="proof" id="proof" class="form-control" value="{{ old('proof') }}" />
                                                <p class="smaller text-danger">{{ $errors->first('proof') }}</p>
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
                        @endif
                        @if($order->status != 0)
                            <div class="col-lg-12 mt-5">
                                <p class="fw-normal text-center smaller">Anda telah melakukan pembayaran</p>
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
