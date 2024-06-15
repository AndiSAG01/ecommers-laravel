<div class="offcanvas offcanvas-end" tabindex="-1" id="drawer-cart">
    <div class="offcanvas-header border-btm-black">
        <h5 class="cart-drawer-heading text_16">Keranjang Anda ({{ \App\Services\Helper::cartItemCount() }})</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="cart-content-area d-flex justify-content-between flex-column">
            @if (\App\Services\Helper::cartCount() == 0)
                <div class="cart-empty-area text-center py-5">
                    <div class="cart-empty-icon pb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M16 16s-1.5-2-4-2-4 2-4 2"></path>
                            <line x1="9" y1="9" x2="9.01" y2="9"></line>
                            <line x1="15" y1="9" x2="15.01" y2="9"></line>
                        </svg>
                    </div>
                    <p class="cart-empty">Anda tidak memiliki barang di keranjang Anda</p>
                </div>
            @else
                <div class="minicart-loop custom-scrollbar">
                    @foreach (\App\Services\Helper::getAllProductsInCart() as $data)
                        <div class="minicart-item d-flex">
                            <div class="mini-img-wrapper">
                                <img class="mini-img" src="{{ Storage::url( $data['product_image']) }}" alt="img">
                            </div>
                            <div class="product-info">
                                <h2 class="product-title">
                                    <a href="{{ route('front.show', $data['product_slug']) }}">{{ $data['product_name'] }}</a>
                                </h2>
                                @if (!empty($data['product_color']))
                                    <p class="product-vendor">{{ $data['product_color'] }}</p>
                                @endif
                                @if (!empty($data['product_nicotine']))
                                    <p class="product-vendor">{{ $data['product_nicotine'] }}</p>
                                @endif
                                <div class="misc d-flex align-items-end justify-content-between">
                                    <div class="product-remove-area d-flex flex-column align-items-end">
                                        <div class="product-price">{{ $data['qty'] }}X - IDR {{ number_format($data['product_price']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="minicart-footer">
                    <div class="minicart-calc-area">
                        <div class="minicart-calc d-flex align-items-center justify-content-between">
                            <span class="cart-subtotal mb-0">Subtotal</span>
                            <span class="cart-subprice">IDR {{ number_format($subtotal = \App\Services\Helper::getTotalCartPrice()) }}</span>
                        </div>
                        <p class="cart-taxes text-center my-4">Ongkos kirim akan dihitung pada saat pembayaran.</p>
                    </div>
                    <div class="minicart-btn-area d-flex align-items-center justify-content-between">
                        <a href="{{ route('front.list_cart') }}" class="minicart-btn btn-secondary">Lihat Keranjang</a>
                        <a href="{{ route('front.checkout') }}" class="minicart-btn btn-primary">Pembayaran</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
