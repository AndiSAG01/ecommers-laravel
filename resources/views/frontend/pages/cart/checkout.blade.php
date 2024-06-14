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
            <li><a href="{{ route('front.cart') }}">Keranjang</a></li>
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
        <form method="POST" action="{{ route('front.store_checkout') }}" class="shipping-address-form common-form">
            @csrf @method('POST')
            <div class="checkout-page-wrapper">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                        <div class="section-header mb-3">
                            <h2 class="section-heading">Pembayaran</h2>
                        </div>
                        <div class="shipping-address-area">
                            <div class="shipping-address-form-wrapper">
                                <h2 class="shipping-address-heading pb-1">Alamat pengiriman</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_first_name" class="label">Nama depan</label>
                                            @if (auth()->guard('customer')->check())
                                                <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" value="{{ auth()->guard('customer')->user()->first_name }}" required />
                                            @else
                                                <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" value="{{ old('customer_first_name') }}" required />
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('customer_first_name') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_last_name" class="label">Nama belakang</label>
                                            @if (auth()->guard('customer')->check())
                                                <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" value="{{ auth()->guard('customer')->user()->last_name }}" required />
                                            @else
                                                <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" value="{{ old('customer_last_name') }}" required />
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('customer_last_name') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="email" class="label">Alamat email</label>
                                            @if (auth()->guard('customer')->check())
                                                <input type="email" name="email" id="email" class="form-control" value="{{ auth()->guard('customer')->user()->email }}" required />
                                            @else
                                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required />
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('email') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_phone" class="label">Nomor telephone</label>
                                            @if (auth()->guard('customer')->check())
                                                <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="{{ auth()->guard('customer')->user()->phone }}" required />
                                            @else
                                                <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required />
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('customer_phone') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Provinsi</label>
                                            @if (auth()->guard('customer')->check())
                                                @php
                                                    $provinces = DB::table('provinces')->orderBy('name', 'ASC')->get();
                                                @endphp
                                                <select name="province_id" id="province_id" class="form-select">
                                                    @foreach ($provinces as $row)
                                                        <option value="{{ $row->id }}" {{ $customer->district->province_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                @php
                                                    $provinces = DB::table('provinces')->orderBy('name', 'ASC')->get();
                                                @endphp
                                                <select name="province_id" id="province_id" class="form-select">
                                                    @foreach ($provinces as $row)
                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('province_id') }}</p>
                                            <input type="hidden" name="shipping" id="shipping_input">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="city_id" class="label">Kota</label>
                                            <select name="city_id" id="city_id" class="form-select" disabled>
                                                <option value=""></option>
                                            </select>
                                            <p class="smaller text-danger">{{ $errors->first('city_id') }}</p>
                                            <input type="hidden" name="weight" id="weight" value="{{ $weight }}">
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="district_id" class="label">Kecamatan</label>
                                            <select name="district_id" id="district_id" class="form-select" disabled>
                                                <option value=""></option>
                                            </select>
                                            <p class="smaller text-danger">{{ $errors->first('district_id') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_postal_code" class="label">Kode pos</label>
                                            @if (auth()->guard('customer')->check())
                                                <input type="text" name="customer_postal_code" id="customer_postal_code" class="form-control" value="{{ auth()->guard('customer')->user()->postal_code }}" required />
                                            @else
                                                <input type="text" name="customer_postal_code" id="customer_postal_code" class="form-control" value="{{ old('customer_postal_code') }}" required />
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('customer_postal_code') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_address" class="label">Alamat</label>
                                            @if (auth()->guard('customer')->check())
                                                <input type="text" name="customer_address" id="customer_address" class="form-control" value="{{ auth()->guard('customer')->user()->address }}" required />
                                            @else
                                                <input type="text" name="customer_address" id="customer_address" class="form-control" value="{{ old('customer_address') }}" required />
                                            @endif
                                            <p class="smaller text-danger">{{ $errors->first('customer_address') }}</p>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="shipping-address-area billing-area">
                                <h2 class="shipping-address-heading pb-1">Metode pengiriman</h2>
                                <div class="row justify-content-center">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="contact-item">
                                            <div class="contact-icon">
                                                <input type="radio" name="courier" class="form-check-input" value="jne">
                                            </div>
                                            <div class="contact-details">
                                                <h2 class="contact-title">JNE Express</h2>
                                            </div>
                                        </div>
                                        <p class="text-danger">{{ $errors->first('courier') }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="contact-item">
                                            <div class="contact-icon">
                                                <input type="radio" name="courier" class="form-check-input" value="tiki">
                                            </div>
                                            <div class="contact-details">
                                                <h2 class="contact-title">TIKI Express</h2>
                                            </div>
                                        </div>
                                        <p class="text-danger">{{ $errors->first('courier') }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="contact-item">
                                            <div class="contact-icon">
                                                <input type="radio" name="courier" class="form-check-input" value="pos">
                                            </div>
                                            <div class="contact-details">
                                                <h2 class="contact-title">POS Indonesia</h2>
                                            </div>
                                        </div>
                                        <p class="text-danger">{{ $errors->first('courier') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-address-area billing-area">
                            <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                <a href="{{ route('front.list_cart') }}" class="checkout-page-btn minicart-btn btn-secondary">KEMBALI KE KERANJANG</a>
                                @if (auth()->guard('customer')->check())
                                    <button type="submit" class="checkout-page-btn minicart-btn btn-primary">LANJUTKAN KE PEMBAYARAN</button>
                                @else
                                    <a href="{{ route('customer.login') }}" class="checkout-page-btn minicart-btn btn-primary">LANJUTKAN KE PEMBAYARAN</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                        <div class="cart-total-area checkout-summary-area">
                            <h3 class="d-none d-lg-block mb-0 text-center heading_24 mb-4">Ringkasan pesanan</h4>
                            @foreach ($carts as $data)
                                <div class="minicart-item d-flex">
                                    <div class="mini-img-wrapper">
                                        <img class="mini-img" src="{{ asset('storage/products/' . $data['product_image']) }}" alt="img">
                                    </div>
                                    <div class="product-info">
                                        <h2 class="product-title">
                                            @if (!empty($data['product_color']))
                                                <a href="{{ $data['product_slug'] }}">{{ $data['product_name'] }} {{ $data['product_color'] }}</a>
                                            @endif
                                            @if (!empty($data['product_nicotine']))
                                                <a href="{{ $data['product_slug'] }}">{{ $data['product_name'] }} {{ $data['product_nicotine'] }}</a>
                                            @endif
                                        </h2>
                                        <p class="product-vendor">IDR {{ number_format($data['product_price']) }}x {{ $data['qty'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="cart-total-box mt-4 bg-transparent p-0">
                                <div class="subtotal-item subtotal-box">
                                    <h4 class="subtotal-title">Subtotals:</h4>
                                    <p class="subtotal-value">IDR {{ number_format($subtotal) }}</p>
                                </div>
                                <div class="subtotal-item shipping-box">
                                    <h4 class="subtotal-title">Pengiriman:</h4>
                                    <p class="subtotal-value" id="shipping">0</p>
                                </div>
                                <hr />
                                @php
                                    $total_amount = \App\Services\Helper::getTotalCartPrice();
                                @endphp
                                <div class="subtotal-item discount-box">
                                    <h4 class="subtotal-title">Total:</h4>
                                    <p class="subtotal-value" id="total">IDR {{ number_format($total_amount) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@if (auth()->guard('customer')->user())
    @section('script')
        <script>
            @php
                $total_amount = \App\Services\Helper::getTotalCartPrice();
                if (session()->has('coupon')) {
                    $total_amount = $total_amount - Session::get('coupon')['value'];
                }
            @endphp

            $(document).ready(function() {
                loadCity($('#province_id').val(), 'bySelect').then(() => {
                    loadDistrict($('#city_id').val(), 'bySelect');
                });
            });

            $('#province_id').on('change', function() {
                loadCity($(this).val(), '');
            });

            $('#city_id').on('change', function() {
                loadDistrict($(this).val(), '');
            });

            $('#city_id').prop('disabled', false);
            $('#district_id').prop('disabled', false);

            function loadCity(province_id, type) {
                return new Promise((resolve, reject) => {
                    $.ajax({
                        url: "{{ url('/api/city') }}",
                        type: "GET",
                        data: { province_id: province_id },
                        success: function(html){
                            $('#city_id').empty();
                            $('#city_id').append('');
                            $.each(html.data, function(key, item) {
                                let city_selected = {{ $customer->district->city_id }};
                                let selected = type == 'bySelect' && city_selected == item.id ? 'selected' : '';
                                $('#city_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>');
                                resolve();
                            });
                        }
                    });
                });
            }

            function loadDistrict(city_id, type) {
                $.ajax({
                    url: "{{ url('/api/district') }}",
                    type: "GET",
                    data: { city_id: city_id },
                    success: function(html){
                        $('#district_id').empty();
                        $('#district_id').append('');
                        $.each(html.data, function(key, item) {
                            let district_selected = {{ $customer->district->id }};
                            let selected = type == 'bySelect' && district_selected == item.id ? 'selected' : '';
                            $('#district_id').append('<option value="'+item.id+'" '+ selected +'>'+item.name+'</option>');
                        });
                    }
                });
            }

            var total_amount = parseFloat({{ $total_amount }});

            function updateTotalWithShipping(total_amount, shippingCost) {
                var total = total_amount + shippingCost;
                $('#total').text("IDR " + total.toLocaleString());
            }

            $('input[name="courier"]').on('change', function() {
                $('#shipping').text("Calculating...");
                $('#save-button').prop('disabled', true);

                var destination = $('#city_id').val();
                var weight = $('#weight').val();
                var courier = $(this).val();

                var requestData = {
                    destination: destination,
                    weight: weight,
                    courier: courier
                };

                $.ajax({
                    url: "{{ url('/api/cost') }}",
                    type: "GET",
                    data: requestData,
                    success: function(resp) {
                        var cost = resp?.rajaongkir?.results?.[0]?.costs?.[0]?.cost?.[0]?.value;

                        if (cost) {
                            $('#shipping').text("IDR " + cost.toLocaleString());
                            $('#shipping_input').val(cost);

                            updateTotalWithShipping(total_amount, cost);

                            $('#save-button').prop('disabled', false);
                        } else {
                            $('#shipping').text("Courier not available.");
                            $('#save-button').prop('disabled', true);
                        }
                    },
                    error: function() {
                        $('#shipping').text("Error while fetching data.");
                        $('#save-button').prop('disabled', true);
                    }
                });
            });

            function checkInputs() {
                var inputs = document.querySelectorAll('input[required], select[required]');
                var isAllFilled = true;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value === '') {
                        isAllFilled = false;
                        break;
                    }
                }
                return isAllFilled;
            }

            function toggleSaveButton() {
                var saveButton = document.querySelector('.next-btn');
                saveButton.disabled = !checkInputs();
            }

            var formInputs = document.querySelectorAll('input[required], select[required]');
            for (var i = 0; i < formInputs.length; i++) {
                formInputs[i].addEventListener('input', toggleSaveButton);
            }

            window.addEventListener('load', toggleSaveButton);
        </script>
    @endsection
@else
    @section('script')
        <script>
            @php
                $total_amount = \App\Services\Helper::getTotalCartPrice();
                if (session()->has('coupon')) {
                    $total_amount = $total_amount - Session::get('coupon')['value'];
                }
            @endphp

            $('#province_id').on('change', function() {
                $('#city_id').prop('disabled', false);
                $('#district_id').prop('disabled', false);

                $.ajax({
                    url: "{{ url('/api/city') }}",
                    type: "GET",
                    data: { province_id: $(this).val() },
                    success: function(html){
                        $('#city_id').empty()
                        $('#city_id').append('')
                        $.each(html.data, function(key, item) {
                            $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                        })
                    }
                });
            })

            $('#city_id').on('change', function() {
                $.ajax({
                    url: "{{ url('/api/district') }}",
                    type: "GET",
                    data: { city_id: $(this).val() },
                    success: function(html){
                        $('#district_id').empty()
                        $('#district_id').append('')
                        $.each(html.data, function(key, item) {
                            $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                        })
                    }
                });
            })

            var total_amount = parseFloat({{ $total_amount }});

            function updateTotalWithShipping(total_amount, shippingCost) {
                var total = total_amount + shippingCost;
                $('#total').text("IDR " + total.toLocaleString());
            }

            $('input[name="courier"]').on('change', function() {
                $('#shipping').text("Calculating...");
                $('#save-button').prop('disabled', true);

                var destination = $('#city_id').val();
                var weight = $('#weight').val();
                var courier = $(this).val();

                var requestData = {
                    destination: destination,
                    weight: weight,
                    courier: courier
                };

                $.ajax({
                    url: "{{ url('/api/cost') }}",
                    type: "GET",
                    data: requestData,
                    success: function(resp) {
                        var cost = resp?.rajaongkir?.results?.[0]?.costs?.[0]?.cost?.[0]?.value;

                        if (cost) {
                            $('#shipping').text("IDR " + cost.toLocaleString());
                            $('#shipping_input').val(cost);

                            updateTotalWithShipping(total_amount, cost);

                            $('#save-button').prop('disabled', false);
                        } else {
                            $('#shipping').text("Courier not available.");
                            $('#save-button').prop('disabled', true);
                        }
                    },
                    error: function() {
                        $('#shipping').text("Error while fetching data.");
                        $('#save-button').prop('disabled', true);
                    }
                });
            });

            function checkInputs() {
                var inputs = document.querySelectorAll('input[required], select[required]');
                var isAllFilled = true;

                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].value === '') {
                        isAllFilled = false;
                        break;
                    }
                }
                return isAllFilled;
            }

            function toggleSaveButton() {
                var saveButton = document.querySelector('.next-btn');
                saveButton.disabled = !checkInputs();
            }

            var formInputs = document.querySelectorAll('input[required], select[required]');
            for (var i = 0; i < formInputs.length; i++) {
                formInputs[i].addEventListener('input', toggleSaveButton);
            }

            window.addEventListener('load', toggleSaveButton);
        </script>
    @endsection
@endif
