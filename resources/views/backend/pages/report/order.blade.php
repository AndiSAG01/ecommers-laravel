@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('show-laporan', 'show')
@section('active-laporan', 'active')
@section('active-laporan-pesanan', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Data Laporan Pesanan</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('report.order') }}" class="mt-3 mb-3">
                            <div class="d-flex mb-3 align-items-center">
                                <div>
                                    <input type="text" id="created_at" name="date" class="form-control">
                                </div>
                                <div class="ms-auto flex-shrink-0">
                                    <button type="submit" class="btn btn-secondary waves-effect waves-light">Filter</button>
                                    <a target="_blank" class="btn btn-primary waves-effect waves-light ml-2" id="exportpdf">Export PDF</a>
                                </div>
                            </div>
                        </form>
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Informasi Pelanggan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($order) > 0)
                                    @foreach ($order as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <ul class="list-unstyled product-desc-list">
                                                    <li>Nama: {{ $row->customer_name }}</li>
                                                    <li>Telp: {{ $row->customer_phone }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $row->created_at->format('d M Y') }}</td>
                                            <td>IDR {{ number_format($row->total) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="10">
                                            <div class="col-12">
                                                <div class="text-center mt-4">
                                                    <h6 class="text-dark mb-2">Anda tidak memiliki data dalam tabel ini</h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        let start = moment().startOf('month')
        let end = moment().endOf('month')

        $('#exportpdf').attr('href', '/admin/report/order/pdf/' + start.format('YYYY-MM-DD') + '+' + end.format('YYYY-MM-DD'))

        $('#created_at').daterangepicker({
            startDate: start,
            endDate: end
        }, function(first, last) {
            $('#exportpdf').attr('href', '/admin/report/order/pdf/' + first.format('YYYY-MM-DD') + '+' + last.format('YYYY-MM-DD'))
        })
    })
</script>
@endsection
