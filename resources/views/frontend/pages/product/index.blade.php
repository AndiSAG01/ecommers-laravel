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
            <li><a href="{{ route('front.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>{{ $product->name }}</li>
        </ul>
    </div>
</div>

<div class="product-page mt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-gallery product-gallery-vertical d-flex">
                    <div class="product-img-large">
                        <div class="img-large-slider common-slider" data-slick='{
                            "slidesToShow": 1,
                            "slidesToScroll": 1,
                            "dots": false,
                            "arrows": false,
                            "asNavFor": ".img-thumb-slider"
                        }'>
                            <div class="img-large-wrapper">
                                <a href="{{ Storage::url($product->image) }}" data-fancybox="gallery">
                                    <img src="{{ Storage::url($product->image) }}" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="product-details ps-lg-4">
                    <form action="{{ route('front.cart') }}" method="POST">
                        @csrf
                        <h2 class="product-title mb-3">{{ $product->name }}</h2>
                        <div class="product-price-wrapper mb-4">
                            <span class="product-price regular-price">IDR {{ number_format($product->price) }}</span>
                        </div>
                        <div class="product-vendor product-meta mb-3">
                            <strong class="label mb-1 d-block">Deskripsi:</strong>
                            <p class="text_16 mb-4">{{ $product->description }}</p>
                        </div>
                        @if (!empty($product->color))
                            @php
                                $colors = explode(',', $product->color);
                            @endphp
                            <div class="product-variant-wrapper">
                                <div class="product-variant product-variant-other">
                                    <strong class="label mb-1 d-block">Warna:</strong>
                                    <ul class="variant-list list-unstyled d-flex align-items-center flex-wrap">
                                        @foreach($colors as $color)
                                            <li class="list-inline-item">
                                                <input type="checkbox" class="btn-check" name="color" id="btn-check-{{ $loop->index }}" value="{{ $color }}">
                                                <label class="variant-label" for="btn-check-{{ $loop->index }}">{{ Str::upper($color) }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (!empty($product->nicotine))
                            @php
                                $nicotines = explode(',', $product->nicotine);
                            @endphp
                            <div class="product-variant-wrapper">
                                <div class="product-variant product-variant-other">
                                    <strong class="label mb-1 d-block">Nikotin:</strong>
                                    <ul class="variant-list list-unstyled d-flex align-items-center flex-wrap">
                                        @foreach($nicotines as $nicotine)
                                            <li class="list-inline-item">
                                                <input type="checkbox" class="btn-check" name="nicotine" id="btn-check-{{ $loop->index }}" value="{{ $nicotine }}">
                                                <label class="variant-label" for="btn-check-{{ $loop->index }}">{{ Str::upper($nicotine) }}</label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="misc d-flex align-items-end justify-content-between mt-4 mb-4">
                            <div class="quantity d-flex align-items-center justify-content-between">
                                <span class="qty-btn dec-qty" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;">
                                    <img src="{{ asset('frontend/img/icon/minus.svg') }}" alt="minus">
                                </span>
                                <input class="qty-input" type="number" name="qty" id="sst" min="1" max="10" value="1">
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <span class="qty-btn inc-qty" onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) && sst < {{ $product->qty }}) result.value++;return false;">
                                    <img src="{{ asset('frontend/img/icon/plus.svg') }}" alt="plus">
                                </span>
                            </div>
                        </div>
                        <div class="buy-it-now-btn mt-2">
                            <button type="submit" class="position-relative btn-atc btn-add-to-cart loader">Tambah ke keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
