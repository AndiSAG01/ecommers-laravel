@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('show-kategori', 'show')
@section('active-kategori', 'active')
@section('active-tambah-kategori', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Tambah Kategori</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama Kategori</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Masukan nama kategori">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="parent_id" class="form-label">Parent</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="">Pilih Parent</option>
                                    @foreach ($parent as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('parent_id') }}</p>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{ route('category.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
