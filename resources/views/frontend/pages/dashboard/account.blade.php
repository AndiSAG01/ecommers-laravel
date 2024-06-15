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
            <li>Akun</li>
        </ul>
    </div>
</div>
<div class="wishlist-page mt-100">
    <div class="wishlist-page-inner">
        <div class="container">
            <div class="section-header d-flex align-items-center justify-content-between flex-wrap">
                <h2 class="section-heading">Akun</h2>
            </div>
            <hr>
            <div class="row g-4 g-lg-5">
                <div class="col-md-6">
                    <div class="card rounded-0 p-4">
                        <div class="card-body p-0">
                            <h5 class="fw-normal">Informasi anda</h5> <hr>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class=" h6 mb-0">Nama:</span>
                                <span class="">{{ ucwords($customer->first_name) }} {{ ucwords($customer->last_name) }}<span>
                            </div>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class=" h6 mb-0">Kontak:</span>
                                <span class=" mb-0">{{ $customer->email }}</span>
                                <span class="">{{ chunk_split($customer['phone'], 4); }}</span>
                            </div>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class="h6 mb-0">Alamat:</span>
                                <span class="mb-0">{{ ucwords($customer->address) }},</span>
                                <span class="mb-0">
                                    @if($customer->district)
                                        {{ $customer->district->name }},
                                        @if($customer->district->city)
                                            {{ $customer->district->city->name }},
                                            @if($customer->district->city->province)
                                                {{ $customer->district->city->province->name }}
                                            @endif
                                        @endif
                                    @endif
                                    {{ $customer->postal_code }}
                                </span>
                            </div>
                            
                            <div class="d-flex justify-content-start align-items-center">
                                <span class="">
                                    <a href="{{ route('customer.setting') }}" class="product-remove">Pengaturan akun</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card rounded-0 p-4">
                        <div class="card-body p-0 px-7">
                            <h5 class="fw-normal">Pesanan anda</h5> <hr>
                            @if (count($orders) > 0)
                                <div class="scrollbar scrollbar-secondary">
                                    @foreach ($orders as $row)
                                        @foreach ($orderDetails->where('order_id', $row->id) as $data)
                                            <div class="d-grid justify-content-start align-items-center">
                                                @if (!empty($data->color))
                                                    <span class="h6 mb-0">{{ ucwords($data->product->name) }}</span>
                                                    <span class="mb-2">{{ ucwords($data->color) }} X {{ $data->qty }} item<span>
                                                @elseif (!empty($data->nicotine))
                                                    <span class="h6 mb-0">{{ ucwords($data->product->name) }}</span>
                                                    <span class="mb-2">{{ ucwords($data->nicotine) }} X {{ $data->qty }} item<span>
                                                @else
                                                    <span class="h6 mb-0">{{ ucwords($data->product->name) }}</span>
                                                    <span class="mb-2">{{ ucwords($data->nicotine) }} X {{ $data->qty }} item<span>
                                                @endif
                                            </div>
                                        @endforeach
                                        <form action="{{ route('customer.order_accept') }}" onsubmit="return confirm('Are you sure you can accept the order?');" method="post">
                                            @csrf
                                            <ul class="list-unstyled d-flex flex-wrap align-items-center mb-0">
                                                <input type="hidden" name="order_id" value="{{ $row->id }}">
                                                    <li><a href="{{ route('customer.view_order', $row->invoice) }}" class="product-remove">Lihat pesanan</a></li>
                                                @if ($row->status == 3 && $row->return_count == 0)
                                                    <li class="ms-2 me-1">|</li>
                                                    <li><button type="submit" class="product-remove bg-transparent">Terima pesanan</button></li>
                                                    <li class="ms-1 me-2">|</li>
                                                    <li><a href="{{ route('customer.order_return', $row->invoice) }}" class="product-remove">Pengembalian pesanan</a></li>
                                                @endif
                                            </ul>
                                        </form>
                                        <hr>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center mt-4">
                                    <h6 class="fw-lighter text-secondary small mb-2">Anda belum memiliki pesanan </h6>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
