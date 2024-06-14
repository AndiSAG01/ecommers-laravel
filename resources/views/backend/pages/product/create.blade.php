@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('show-produk', 'show')
@section('active-produk', 'active')
@section('active-tambah-produk', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Tambah Produk</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($category as $row)
                                        <option value="{{ $row->id }}" data-color="{{ $row->name }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Masukan nama produk">
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
                                <label for="color" class="form-label fw-semibold">Warna</label>
                                <ul class="list-inline mb-0 g-3">
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorHitam" class="btn-check" value="Hitam">
                                        <label class="btn btn-outline-secondary" for="colorHitam">Hitam</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorPutih" class="btn-check" value="Putih">
                                        <label class="btn btn-outline-secondary" for="colorPutih">Putih</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorMerah" class="btn-check" value="Merah">
                                        <label class="btn btn-outline-secondary" for="colorMerah">Merah</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorBiru" class="btn-check" value="Biru">
                                        <label class="btn btn-outline-secondary" for="colorBiru">Biru</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorHijau" class="btn-check" value="Hijau">
                                        <label class="btn btn-outline-secondary" for="colorHijau">Hijau</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorUngu" class="btn-check" value="Ungu">
                                        <label class="btn btn-outline-secondary" for="colorUngu">Ungu</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorKuning" class="btn-check" value="Kuning">
                                        <label class="btn btn-outline-secondary" for="colorKuning">Kuning</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorPink" class="btn-check" value="Pink">
                                        <label class="btn btn-outline-secondary" for="colorPink">Pink</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorCoklat" class="btn-check" value="Coklat">
                                        <label class="btn btn-outline-secondary" for="colorCoklat">Coklat</label>
                                    </li>
                                    <li class="list-inline-item">
                                        <input type="checkbox" name="color[]" id="colorClear" class="btn-check" value="Clear">
                                        <label class="btn btn-outline-secondary" for="colorClear">Clear</label>
                                    </li>
                                </ul>
                                <p class="text-danger small">{{ $errors->first('color') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="Masukan harga">
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="weight" class="form-label">Berat</label>
                                <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight') }}" placeholder="Masukan berat">
                                <p class="text-danger">{{ $errors->first('weight') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="qty" class="form-label">Stok</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty') }}" placeholder="Masukan stok">
                                <p class="text-danger">{{ $errors->first('qty') }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="image" class="form-label">Foto</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <p class="text-danger">{{ $errors->first('image') }}</p>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea type="text" name="description" id="description" class="form-control" rows="10">{{ old('description') }}</textarea>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
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

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var categorySelect = document.getElementById("category_id");
        var colorCheckboxes = document.querySelectorAll('input[name="color[]"]');

        categorySelect.addEventListener("change", function() {
            var selectedCategory = $(this).children("option:selected").data('color');
            var isSaltnicOrFreebase = selectedCategory === "Saltnic" || selectedCategory === "Freebase";

            colorCheckboxes.forEach(function(checkbox) {
                checkbox.disabled = isSaltnicOrFreebase;
            });

            console.log("Selected category name: " + selectedCategory);
        });
    });
</script>
@endsection
