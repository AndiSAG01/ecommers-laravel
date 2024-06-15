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
            <li><a href="{{ route('front.shop') }}">Product</a></li>
            <li>
                <svg class="icon icon-breadcrumb" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g opacity="0.4">
                        <path d="M25.9375 8.5625L23.0625 11.4375L43.625 32L23.0625 52.5625L25.9375 55.4375L47.9375 33.4375L49.3125 32L47.9375 30.5625L25.9375 8.5625Z" fill="#000" />
                    </g>
                </svg>
            </li>
            <li>{{ $category->name }}</li>
        </ul>
    </div>
</div>
<div class="collection mt-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9 col-md-12 col-12">
                <div class="filter-sort-wrapper d-flex justify-content-between flex-wrap">
                    <div class="collection-title-wrap d-flex align-items-end">
                        <h2 class="collection-title heading_24 mb-0">Produk {{ $category->name }}</h2>
                        <p class="collection-counter text_16 mb-0 ms-2">({{ $product->total() }} item)</p>
                    </div>
                    <div class="filter-sorting">
                        <div class="filter-drawer-trigger mobile-filter d-flex align-items-center d-lg-none">
                            <span class="mobile-filter-icon me-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon icon-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                                </svg>
                            </span>
                            <span class="mobile-filter-heading">Filter dan Penyortiran</span>
                        </div>
                    </div>
                </div>
                <div class="collection-product-container">
                    <div class="row" id="product-list">
                        @foreach ($product as $row)
                            <div class="col-lg-4 col-md-6 col-6 product-item" data-aos="fade-up" data-aos-duration="700">
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
                    </div>
                </div>
                @if (count($product) > 0)
                    <div class="pagination justify-content-center mt-100">
                        {!! $product->links('pagination::default') !!}
                    </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-12 col-12">
                <div class="collection-filter filter-drawer">
                    <div class="filter-widget d-lg-none d-flex align-items-center justify-content-between">
                        <h5 class="heading_24">Saring Berdasarkan</h4>
                        <button type="button" class="btn-close text-reset filter-drawer-trigger d-lg-none"></button>
                    </div>
                    <div class="filter-widget">
                        <div class="filter-header faq-heading heading_18 d-flex align-items-center justify-content-between border-bottom" data-bs-toggle="collapse" data-bs-target="#filter-category">
                            Kategori
                            <span class="faq-heading-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div id="filter-category" class="accordion-collapse collapse show">
                            <ul class="filter-lists list-unstyled mb-0">
                                @foreach ($categories as $category)
                                    <li class="filter-item">
                                        <a href="{{ route('front.category', $category->slug) }}" class="filter-label">
                                            <input type="checkbox" {{ request()->route('slug') === $category->slug ? 'checked' : '' }} />
                                            <span class="filter-checkbox rounded me-2"></span>
                                            <span class="filter-text">{{ $category->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="filter-widget">
                        <div class="filter-header faq-heading heading_18 d-flex align-items-center justify-content-between border-bottom" data-bs-toggle="collapse" data-bs-target="#filter-color">
                            Warna
                            <span class="faq-heading-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </div>
                        <div id="filter-color" class="accordion-collapse collapse show">
                            <ul class="filter-lists list-unstyled mb-0">
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'hitam']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('hitam', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Hitam</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'putih']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('putih', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Putih</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'merah']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('merah', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Merah</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'biru']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('biru', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Biru</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'hijau']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('hijau', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Hijau</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'ungu']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('ungu', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Ungu</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'kuning']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('kuning', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Kuning</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'pink']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('pink', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Pink</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'coklat']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('coklat', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Coklat</span>
                                    </a>
                                </div>
                                <div class="filter-item">
                                    <a href="{{ route('front.color', ['color' => 'clear']) }}" class="filter-label">
                                        <input type="checkbox" <?php echo (in_array('clear', explode(',', request()->route('color', '')))) ? 'checked' : ''; ?> />
                                        <span class="filter-checkbox rounded me-2"></span>
                                        <span class="filter-text">Clear</span>
                                    </a>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
