@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('show-produk', 'show')
@section('active-produk', 'active')
@section('active-data-produk', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Data Produk</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Detail</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($product) > 0)
                                    @foreach ($product as $row)
                                        <tr>
                                            <th scope="row">{{ $row->id }}</th>
                                            <td>
												<img src="{{ Storage::url($row->image) }}" width="100" height="100" class="rounded me-2 bf-light" alt="product">
											</td>
                                            <td>
                                                <strong>{{ $row->name }}</strong>
                                                @if ($row->category->name == 'Saltnic' || $row->category->name == 'Freebase')
                                                    <div class="text-muted">
                                                        {{ $row->category->parent->name }} - {{ $row->category->name }}
                                                    </div>
                                                @else
                                                    <div class="text-muted">
                                                        {{ $row->category->name }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <ul class="list-unstyled mb-0">
                                                    @if ($row->color)
                                                        <li class="mb-1">Warna: {{ ucwords($row->color) }}</li>
                                                    @endif
                                                    <li class="mb-1">Harga: IDR {{ number_format($row->price) }}</li>
                                                    <li class="mb-1">Berat: {{ $row->weight }} gr/ml</li>
                                                    <li class="mb-1">Stok: {{ $row->qty }} pcs</li>
                                                    <li class="mb-1">
                                                        <a href="javascript:;" class="text-primary" data-bs-toggle="modal" data-bs-target="#detail-{{ $row->id }}">Lihat Detail</a>
                                                        <div class="modal fade" id="detail-{{ $row->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Deskripsi</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body m-3">
                                                                        <p class="mb-0">{{ $row->description }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td>{!! $row->status_label !!}</td>
                                            <td>
                                                <div class="dropdown position-relative">
                                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                        <i class="align-middle" data-feather="more-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <form method="POST" action="{{ route('product.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('product.edit', $row->id) }}" class="dropdown-item">Edit</a>
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
                    @if (count($product) > 0)
                        <div class="px-4 align-middle mb-2">
                            <div class="d-flex justify-content-sm-between align-items-sm-center">
                                <span class="mb-3">Menampilkan {{ $product->firstItem() }} hingga {{ $product->lastItem() }} dari {{ $product->total() }} entri</span>
                                {!! $product->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
