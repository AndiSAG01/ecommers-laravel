@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('active-pesanan', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Data Pesanan</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="GET" action="{{ route('order.index') }}" class=" mt-3 mb-3">
                            <div class="row g-4">
                                <div class="col-sm-auto">
                                    <div>
                                        <select name="status" class="form-select">
                                            <option value="">Pilih Status</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Lunas</option>
                                            <option value="2">Diproses</option>
                                            <option value="3">Dikirim</option>
                                            <option value="4">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <div class="input-group w-auto">
                                            <input type="text" name="q" class="form-control" placeholder="Cari Pesanan" value="{{ request()->q }}">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Cari</button>
                                        </div>
                                    </div>
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
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
                                            <td>
                                                @if ($row->return_count == 1)
                                                    <div class="badge bg-warning font-size-12">Dikembalikan</div>
                                                @else
                                                    {!! $row->status_label !!}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown position-relative">
                                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                        <i class="align-middle" data-feather="more-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <form method="POST" action="{{ route('order.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('order.view', $row->invoice) }}" class="dropdown-item">Lihat</a>
                                                            @if ($row->return_count == 1)
                                                                <a href="{{ route('order.return', $row->invoice) }}" class="dropdown-item">Kembalikan</a>
                                                            @endif
                                                            <button type="submit" class="dropdown-item">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
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
                @if (count($order) > 0)
                    <div class="px-4 align-middle mb-2">
                        <div class="d-flex justify-content-sm-between align-items-sm-center">
                            <span class="mb-3">Menampilkan {{ $order->firstItem() }} hingga {{ $order->lastItem() }} dari {{ $order->total() }} entri</span>
                            {!! $order->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
