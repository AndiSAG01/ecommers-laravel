@extends('frontend.layouts.app')
@section('title', 'Fas Vapor Store')

@section('content')
<div class="breadcrumb">
    <div class="container">
        <ul class="list-unstyled d-flex align-items-center m-0">
            <li><a href="{{ route('front.index') }}">Home</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li><a href="{{ route('customer.account') }}">Akun</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Pesanan</li>
        </ul>
    </div>
</div>
<div class="wishlist-page mt-100">
    <div class="wishlist-page-inner">
        <div class="container">
            <div class="section-header d-flex align-items-center justify-content-between flex-wrap">
                <h2 class="section-heading">Pesanan</h2>
            </div>
            <hr>
            <div class="row g-4 g-lg-5">
                <div class="col-lg-4 col-xl-5">
                    <div class="card rounded-0 p-4">
                        <div class="card-body p-0">
                            <h5 class="fw-normal">Alamat pengiriman</h5> <hr>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class=" h6 mb-0">Invoice:</span>
                                <span class="">{{ ucwords($order->invoice) }}<span>
                            </div>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class=" h6 mb-0">Penerima:</span>
                                <span class="">{{ ucwords($order->customer_name) }}<span>
                            </div>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class=" h6 mb-0">Kontak:</span>
                                <span class=" mb-0">{{ $order->customer->email }}</span>
                                <span class="">{{ chunk_split($order['customer_phone'], 4); }}</span>
                            </div>
                            <div class="d-grid justify-content-start align-items-center mb-3">
                                <span class=" h6 mb-0">Alamat:</span>
                                <span class=" mb-0">{{ ucwords($order->customer_address) }},</span>
                                <span class=" mb-0">{{ $order->district->name }}, {{ $order->district->city->name }}, {{ $order->district->city->province->name }} {{ $order->postal_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-xl-3"></div>
                <div class="col-lg-3 col-xl-4">
                    <div class="card rounded-0 p-4">
                        <div class="card-body p-0 px-7">
                            <h5 class="fw-normal">Pembayaran</h5> <hr>
                            @if ($order->payment)
                                <div class="d-grid justify-content-between align-items-center mb-3">
                                    <span class="h6 mb-0">Nama Pengirim:</span>
                                    <span class="mb-0">{{ $order->payment->name }}</span>
                                </div>
                                <div class="d-grid justify-content-between align-items-center mb-3">
                                    <span class="h6 mb-0">Transfer ke:</span>
                                    <span class="mb-0">{{ $order->payment->transfer_to }}</span>
                                </div>
                                <div class="d-grid justify-content-between align-items-center mb-3">
                                    <span class="h6 mb-0">Jumlah transfer:</span>
                                    <span class="mb-0">IDR {{ number_format($order->payment->amount) }}</span>
                                </div>
                                <div class="d-grid justify-content-between align-items-center mb-3">
                                    <span class="h6 mb-0">Tanggal transfer:</span>
                                    <span class="mb-0">{{ $order->payment->transfer_date }}</span>
                                </div>
                                <div class="d-grid justify-content-between align-items-center mb-0">
                                    <span class="h6 mb-0">Bukti transfer:</span>
                                    <a href="{{ asset('storage/payments/' . $order->payment->proof) }}" target="_blank" class="product-remove">Lihat Bukti</a>
                                </div>
                            @else
                                <p class="d-grid justify-content-start align-content-center mb-0">
                                    <span class="fw-normal smaller">Anda belum melakukan pembayaran.</span>
                                    <a href="{{ route('customer.paymentForm', $order->invoice) }}" class="product-remove">KONFIRMASI PEMBAYARAN</a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-11 col-xl-12 px-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-lg">
                                <table class="table table-borderless table-shrink caption-bottom align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="border-0"></th>
                                            <th scope="col" class="border-0">Produk</th>
                                            <th scope="col" class="border-0">Harga</th>
                                            <th scope="col" class="border-0">Kuantitas</th>
                                            <th scope="col" class="border-0">Subtotal</th>
                                            <th scope="col" class="border-0"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top-0">
                                        @foreach ($order->details as $row)
                                        <tr>
                                            <td></td>
                                            <td>
                                                <span class="h6">
                                                    {{ $row->product->name }} <br>
                                                    {{ $row->color }}
                                                </span>
                                            </td>
                                            <td> <span class="h6">IDR {{ number_format($row->product->price) }}</span> </td>
                                            <td> <span class="h6">{{ $row->qty }} item</span> </td>
                                            <td> <span class="h6">IDR {{ number_format($order->subtotal) }}</span> </td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="mt-5">
                                        <tr>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td> <span class="h6 mb-0">Pengiriman</span> </td>
                                            <td> <span class="h6 mb-0">IDR {{ number_format($order->cost) }}</span> </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="2"></td>
                                            <td> <span class="h6 mb-0">Total</span> </td>
                                            <td> <span class="h6 mb-0">IDR {{ number_format($order->total) }}</span> </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
