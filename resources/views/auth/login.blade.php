@extends('auth.layouts.app')
@section('title', 'Fas Vapor Store')

@section('content')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-4 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Masukkan email Anda" />
                                    <p class="text-danger small mt-1">{{ $errors->first('email') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Masukkan password Anda" />
                                    <p class="text-danger small mt-1">{{ $errors->first('password') }}</p>
                                </div>
                                <div>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
                                        <span class="form-check-label">
                                        ingatkan saya?
                                        </span>
                                    </label>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
