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
            <li><a href="{{ route('customer.account') }}">Akun</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>Pengaturan</li>
        </ul>
    </div>
</div>
<div class="checkout-page mt-100">
    <div class="container">
        <form method="POST" action="{{ route('customer.post_setting') }}" class="shipping-address-form common-form">
            @csrf @method('POST')
            <div class="checkout-page-wrapper">
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                        <div class="section-header d-flex align-items-center justify-content-between flex-wrap">
                            <h2 class="section-heading">Pengaturan</h2>
                        </div>
                        <hr>
                        <div class="shipping-address-area">
                            <div class="shipping-address-form-wrapper">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_first_name" class="label">Nama depan</label>
                                            <input type="text" name="customer_first_name" id="customer_first_name" class="form-control" value="{{ old('customer_first_name', $customer->first_name) }}" />
                                            <p class="smaller text-danger">{{ $errors->first('customer_first_name') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_last_name" class="label">Nama belakang</label>
                                            <input type="text" name="customer_last_name" id="customer_last_name" class="form-control" value="{{ old('customer_last_name', $customer->last_name) }}" />
                                            <p class="smaller text-danger">{{ $errors->first('customer_last_name') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="email" class="label">Alamat email</label>
                                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}" />
                                            <p class="smaller text-danger">{{ $errors->first('email') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_phone" class="label">Nomor telepon</label>
                                            <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="{{ old('customer_phone', $customer->phone) }}" />
                                            <p class="smaller text-danger">{{ $errors->first('customer_phone') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-12">
                                        <fieldset>
                                            <label for="password" class="label">Kata sandi baru</label>
                                            <input type="password" name="password" id="password" class="form-control" />
                                            <p class="smaller text-danger">{{ $errors->first('password') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label class="label">Provinsi</label>
                                            @php
                                                $provinces = DB::table('provinces')->orderBy('name', 'ASC')->get();
                                            @endphp
                                            <select name="province_id" id="province_id" class="form-select">
                                                @foreach ($provinces as $row)
                                                    <option value="{{ $row->id }}" {{ $customer->district->province_id == $row->id ? 'selected':'' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="smaller text-danger">{{ $errors->first('province_id') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <fieldset>
                                            <label for="city_id" class="label">Kota</label>
                                            <select name="city_id" id="city_id" class="form-select" disabled>
                                                <option value=""></option>
                                            </select>
                                            <p class="smaller text-danger">{{ $errors->first('city_id') }}</p>
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
                                            <input type="text" name="customer_postal_code" id="customer_postal_code" class="form-control" value="{{ old('customer_postal_code', $customer->postal_code) }}" />
                                            <p class="smaller text-danger">{{ $errors->first('customer_postal_code') }}</p>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <fieldset>
                                            <label for="customer_address" class="label">Alamat</label>
                                            <input type="text" name="customer_address" id="customer_address" class="form-control" value="{{ old('customer_address', $customer->address) }}" />
                                            <p class="smaller text-danger">{{ $errors->first('customer_address') }}</p>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-address-area billing-area">
                            <div class="minicart-btn-area d-flex align-items-center justify-content-between flex-wrap">
                                <a href="{{ route('customer.account') }}" class="checkout-page-btn minicart-btn btn-secondary">KEMBALI</a>
                                <button type="submit" class="checkout-page-btn minicart-btn btn-primary">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
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
</script>
@endsection
