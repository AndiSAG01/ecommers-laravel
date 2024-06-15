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
            <li>Keranjang</li>
        </ul>
    </div>
</div>
<div class="cart-page mt-100">
    <div class="container">
        <div class="cart-page-wrapper">
            <form method="POST" action="{{ route('front.update_cart') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-7 col-md-12 col-12">
                        <table class="cart-table w-100">
                            <thead>
                                <tr>
                                    <th class="cart-caption heading_18">Produk</th>
                                    <th class="cart-caption heading_18"></th>
                                    <th class="cart-caption text-center heading_18 d-none d-md-table-cell">Kuantitas</th>
                                    <th class="cart-caption text-end heading_18">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $row)
                                    <tr class="cart-item">
                                        <td class="cart-item-media">
                                            <div class="mini-img-wrapper">
                                                <img class="mini-img" src="{{ Storage::url($row['product_image']) }}" alt="img">
                                            </div>
                                        </td>
                                        <td class="cart-item-details">
                                            <h2 class="product-title"><a href="{{ route('front.show', $row['product_slug']) }}">{{ $row['product_name'] }}</a></h2>
                                            @if (!empty($row['product_color']))
                                                <p class="product-vendor">{{ $row['product_color'] }}</p>
                                            @endif
                                            @if (!empty($row['product_nicotine']))
                                                <p class="product-vendor">{{ $row['product_nicotine'] }}</p>
                                            @endif
                                        </td>
                                        <td class="cart-item-quantity">
                                            <input type="hidden" name="product_id[]" value="{{ $row['product_id'] }}">
                                            <div class="quantity d-flex align-items-center justify-content-between">
                                                <span class="qty-btn dec-qty" onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;">
                                                    <img src="{{ asset('frontend/img/icon/minus.svg') }}" alt="minus">
                                                </span>
                                                <input type="number" name="qty[]" id="sst{{ $row['product_id'] }}" maxlength="12" value="{{ $row['qty'] }}" class="qty-input">
                                                <span class="qty-btn inc-qty" onclick="var result = document.getElementById('sst{{ $row['product_id'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;">
                                                    <img src="{{ asset('frontend/img/icon/plus.svg') }}" alt="plus">
                                                </span>
                                            </div>
                                        </td>
                                        <td class="cart-item-price text-end">
                                            <div class="product-price">IDR {{ number_format($row['product_price']) }}</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="cart-item-details">
                                            <h2 class="product-title">Anda tidak memiliki barang di keranjang Anda.</h2>
                                            <p class="product-vendor"><a href="{{ route('front.shop') }}">Lanjutkan berbelanja</a></p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if(count($carts) > 0)
                            <div class="py-4">
                                <button type="submit" class="btn btn-dark w-50 text-center mt-4" role="button">PERBARUI KERANJANG</button>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-5 col-md-12 col-12">
                        <div class="cart-total-area">
                            <h3 class="cart-total-title d-none d-lg-block mb-0">Total Keranjang</h4>
                            <div class="cart-total-box mt-4">
                                <div class="subtotal-item subtotal-box">
                                    <h4 class="subtotal-title">Subtotal:</h4>
                                    <p class="subtotal-value">IDR {{ number_format($subtotal) }}</p>
                                </div>
                                <div class="subtotal-item shipping-box">
                                    <h4 class="subtotal-title">Pengiriman:</h4>
                                    <p class="subtotal-value">0</p>
                                </div>
                                <hr />
                                <div class="subtotal-item discount-box">
                                    <h4 class="subtotal-title">Total:</h4>
                                    <p class="subtotal-value">IDR {{ number_format($subtotal) }}</p>
                                </div>
                                <div class="d-flex justify-content-center mt-4">
                                    <a href="{{ route('front.checkout') }}" class="position-relative btn-primary text-uppercase">
                                        MEMPROSES KE PEMBAYARAN
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
