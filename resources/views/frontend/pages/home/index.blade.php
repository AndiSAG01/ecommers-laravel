@extends('frontend.layouts.app')
@section('title', 'Fas Vapor Store')

@section('content')
<div class="single-banner-section overflow-hidden">
    <div class="position-relative overlay">
        <img class="single-banner-img" src="{{ asset('frontend/img/banner/vape.jpeg') }}" alt="slide-1">
        <div class="content-absolute content-slide">
            <div class="container height-inherit d-flex align-items-center justify-content-center">
                <div class="content-box single-banner-content py-4 text-center" data-aos="fade-up" data-aos-duration="700">
                    <h2 class="single-banner-heading heading_42 text-white animate__animated animate__fadeInUp" data-animation="animate__animated animate__fadeInUp" data-aos="fade-up" data-aos-duration="700">
                        Vas Vapor Store
                    </h2>
                    <p class="single-banner-text text_16 text-white animate__animated animate__fadeInUp" data-animation="animate__animated animate__fadeInUp" data-aos="fade-up" data-aos-duration="700">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@foreach ($products as $category => $items)
@if ($category == 'liquid')
        <div class="banner-section mt-100 overflow-hidden">
            <div class="banner-section-inner">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 col-12" data-aos="fade-right" data-aos-duration="1200">
                            <a href="{{ route('front.shop') }}" class="banner-item position-relative rounded">
                                <img src="{{ asset('frontend/img/banner/vape-1.jpg') }}" class="banner-img" alt="banner-1">
                                <div class="content-absolute content-slide">
                                    <div class="container height-inherit d-flex align-items-center">
                                        <div class="content-box banner-content p-4">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12" data-aos="fade-left" data-aos-duration="1200">
                            <a href="{{ route('front.shop') }}" class="banner-item position-relative rounded">
                                <img src="{{ asset('frontend/img/banner/liquid-1.jpg') }}" class="banner-img" alt="banner-2">
                                <div class="content-absolute content-slide">
                                    <div class="container height-inherit d-flex align-items-center">
                                        <div class="content-box banner-content p-4">
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="featured-collection-section mt-100 home-section overflow-hidden">
        <div class="container">
            <div class="section-header">
                <h2 class="section-heading">{{ strtoupper($category) }}</h2>
            </div>
            <div class="product-container position-relative">
                <div class="common-slider" data-slick='{
                    "slidesToShow": 4,
                    "slidesToScroll": 1,
                    "dots": false,
                    "arrows": true,
                    "responsive": [
                        {
                            "breakpoint": 1281,
                            "settings": {
                                "slidesToShow": 3
                            }
                        },
                        {
                            "breakpoint": 768,
                            "settings": {
                                "slidesToShow": 2
                            }
                        }
                    ]
                }'>
                    @foreach ($items as $product)
                        @foreach ($product as $row)
                            <div class="new-item" data-aos="fade-up" data-aos-duration="300">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a href="{{ route('front.show', $row->slug) }}" class="hover-switch">
                                            <img src="{{ Storage::url($row->image) }}" class="secondary-img" alt="product-img">
                                            <img src="{{ Storage::url($row->image) }}" class="primary-img" alt="product-img">
                                        </a>
                                    </div>
                                <div class="product-card-details">
                                        <h3 class="product-card-title">
                                            <a href="{{ route('front.show', $row->slug) }}">{{ $row->name }}</a>
                                        </h3>
                                        <div class="product-card-price">
                                            <span class="card-price-regular">IDR {{ number_format($row->price) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <div class="activate-arrows show-arrows-always article-arrows arrows-white"></div>
            </div>
            <div class="view-all text-center" data-aos="fade-up" data-aos-duration="700">
                <a class="btn-primary" href="{{ route('front.shop') }}">LIHAT SEMUA</a>
            </div>
        </div>
    </div>
@endforeach

@endsection
