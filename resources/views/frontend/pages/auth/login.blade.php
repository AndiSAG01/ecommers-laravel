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
            <li>Masuk</li>
        </ul>
    </div>
</div>

<div class="login-page mt-100">
    <div class="container">
        <form method="POST" action="{{ route('customer.post_login') }}" class="login-form common-form mx-auto">
            @csrf
            <div class="section-header mb-3">
                <h2 class="section-heading text-center">Masuk</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <fieldset>
                        <label for="email" class="label">Alamat email</label>
                        <input type="email" name="email" id="email" class="form-control" required />
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    </fieldset>
                </div>
                <div class="col-12">
                    <fieldset>
                        <label for="password" class="label">Kata sandi</label>
                        <input type="password" name="password" id="password" class="form-control" required />
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                    </fieldset>
                </div>
                <div class="col-12 mt-3">
                    <button type="submit" class="btn-primary d-block mt-4 btn-signin">MASUK</button>
                    <a href="{{ route('customer.register') }}" class="btn-secondary mt-2 btn-signin">BUAT AKUN BARU</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
