@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('show-kategori', 'show')
@section('active-kategori', 'active')
@section('active-data-kategori', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Data Kategori</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Terkait</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($category) > 0)
                                    @foreach ($category as $row)
                                        <tr>
                                            <th scope="row">{{ $row->id }}</th>
                                            <td>{{ ucwords($row->name) }}</td>
                                            <td>{{ ucwords($row->parent ? $row->parent->name : '-') }}</td>
                                            <td>{!! $row->status_label !!}</td>
                                            <td>
                                                <div class="dropdown position-relative">
                                                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                        <i class="align-middle" data-feather="more-horizontal"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <form method="POST" action="{{ route('category.destroy', $row->id) }}">
                                                            @csrf @method('DELETE')
                                                            <a href="{{ route('category.edit', $row->id) }}" class="dropdown-item">Edit</a>
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
                @if (count($category) > 0)
                    <div class="px-4 align-middle mb-2">
                        <div class="d-flex justify-content-sm-between align-items-sm-center">
                            <span class="mb-3">Menampilkan {{ $category->firstItem() }} hingga {{ $category->lastItem() }} dari {{ $category->total() }} entri</span>
                            {!! $category->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
