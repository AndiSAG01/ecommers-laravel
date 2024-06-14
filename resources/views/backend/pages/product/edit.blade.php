@extends('backend.layouts.app')
@section('title', 'Fas Vapor Store')
@section('show-produk', 'show')
@section('active-produk', 'active')
@section('active-data-produk', 'active')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Edit Produk</h1>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="category_id" class="form-label">Kategori</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($category as $row)
                                        <option value="{{ $row->id }}" data-color="{{ $row->name }}" {{ $product->category_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('category_id') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" placeholder="Masukan nama produk">
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('status') }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="color" class="form-label fw-semibold">Warna</label>
                                <ul class="list-inline mb-0 g-3">
                                    @foreach($items as $row)
                                        @php
                                            $data = explode(',', $row->color);
                                        @endphp
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorHitam" class="btn-check" value="Hitam" @if( in_array("Hitam", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorHitam">Hitam</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorPutih" class="btn-check" value="Putih" @if( in_array("Putih", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorPutih">Putih</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorMerah" class="btn-check" value="Merah" @if( in_array("Merah", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorMerah">Merah</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorBiru" class="btn-check" value="Biru" @if( in_array("Biru", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorBiru">Biru</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorHijau" class="btn-check" value="Hijau" @if( in_array("Hijau", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorHijau">Hijau</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorUngu" class="btn-check" value="Ungu" @if( in_array("Ungu", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorUngu">Ungu</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorKuning" class="btn-check" value="Kuning" @if( in_array("Kuning", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorKuning">Kuning</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorPink" class="btn-check" value="Pink" @if( in_array("Pink", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorPink">Pink</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorCoklat" class="btn-check" value="Coklat" @if( in_array("Coklat", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorCoklat">Coklat</label>
                                        </li>
                                        <li class="list-inline-item">
                                            <input type="checkbox" name="color[]" id="colorClear" class="btn-check" value="Clear" @if( in_array("Clear", $data) ) checked @endif>
                                            <label class="btn btn-outline-secondary" for="colorClear">Clear</label>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text-danger small">{{ $errors->first('color') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Harga</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" placeholder="Masukan harga">
                                <p class="text-danger">{{ $errors->first('price') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="weight" class="form-label">Berat</label>
                                <input type="number" name="weight" id="weight" class="form-control" value="{{ old('weight', $product->weight) }}" placeholder="Masukan berat">
                                <p class="text-danger">{{ $errors->first('weight') }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="qty" class="form-label">Stok</label>
                                <input type="number" name="qty" id="qty" class="form-control" value="{{ old('qty', $product->qty) }}" placeholder="Masukan stok">
                                <p class="text-danger">{{ $errors->first('qty') }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="image" class="form-label">Foto</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <p class="text-danger">{{ $errors->first('image') }}</p>
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea type="text" name="description" id="description" class="form-control" rows="10">{{ old('description', $product->description) }}</textarea>
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
