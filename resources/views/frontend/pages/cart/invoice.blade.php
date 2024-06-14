<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #1e2e50;
        }

        .card-footer-btn {
            display: flex;
            align-items: center;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }

        .text-uppercase-bold-sm {
            text-transform: uppercase !important;
            font-weight: 500 !important;
            letter-spacing: 2px !important;
            font-size: .85rem !important;
        }

        .hover-lift-light {
            transition: box-shadow .25s ease, transform .25s ease, color .25s ease, background-color .15s ease-in;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .btn-group-lg>.btn,
        .btn-lg {
            padding: 0.8rem 1.85rem;
            font-size: 1.1rem;
            border-radius: 0.3rem;
        }

        .btn-dark {
            color: #fff;
            background-color: #1e2e50;
            border-color: #1e2e50;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(30, 46, 80, .09);
            border-radius: 0.25rem;
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .p-5 {
            padding: 3rem !important;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1.5rem 1.5rem;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .table td,
        .table th {
            border-bottom: 0;
            border-top: 1px solid #edf2f9;
        }

        .table>:not(caption)>*>* {
            padding: 1rem 1rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .px-0 {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .table thead th,
        tbody td,
        tbody th {
            vertical-align: middle;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-color: inherit;
            border-style: solid;
            border-width: 0;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .icon-circle[class*=text-] [fill]:not([fill=none]),
        .icon-circle[class*=text-] svg:not([fill=none]),
        .svg-icon[class*=text-] [fill]:not([fill=none]),
        .svg-icon[class*=text-] svg:not([fill=none]) {
            fill: currentColor !important;
        }

        .svg-icon>svg {
            width: 1.45rem;
            height: 1.45rem;
        }
    </style>
</head>
<body>
    <div class="container mt-6 mb-7">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-7">
                <div class="card">
                    <div class="card-body p-5">
                        <div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Invoice</div>
                                    <strong>#{{ $order->invoice }}</strong>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Tanggal</div>
                                    <strong>{{ $order->created_at->format('d F Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-gray-200 mt-4 py-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Pelanggan</div>
                                    <strong> {{ $order->customer_name }} </strong>
                                    <p class="fs-sm"> {{ $order->customer_address }}, {{ $order->district->city->name }}, {{ $order->district->name }} {{ $order->district->city->postal_code }} <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <table class="table border-bottom border-gray-200 mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Produk</th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Kuantitas</th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $data)
                                    <tr>
                                        <td class="px-0">{{ $data->product->name }}</td>
                                        <td class="px-0">{{ $data->qty }}</td>
                                        <td class="text-end px-0">IDR {{ number_format($data->product->price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5">
                            <div class="d-flex justify-content-end">
                                <p class="text-muted me-3">Subtotal:</p>
                                <span>IDR {{ number_format($order->subtotal) }}</span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="text-muted me-3">Pengiriman:</p>
                                <span>IDR {{ number_format($order->cost) }}</span>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <h5 class="me-3">Total:</h5>
                                <h5 class="text-success">IDR {{ number_format($order->total) }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row px-5 py-3">
                        <div class="col-md-6">
                            <a href="{{ route('front.index') }}" class="btn btn-secondary btn-lg card-footer-btn justify-content-center text-uppercase-bold-sm hover-lift-light">
                                <span class="svg-icon text-white me-2">
                                </span> Kembali
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('customer.view_order', $order->invoice) }}" class="btn btn-dark btn-lg card-footer-btn justify-content-center text-uppercase-bold-sm hover-lift-light">
                                <span class="svg-icon text-white me-2">
                                </span> Bayar Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
</body>
</html>
