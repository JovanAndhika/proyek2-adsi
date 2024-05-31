@extends('layouts.customer')

@section('content')
    <h1 class="text-center">Jual</h1>
    <section>
        <form action="{{ route('customer.jual.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="namaBarang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="namaBarang" name="namaBarang" value="{{ old('namaBarang') }}"
                required>
            @error('namaBarang')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
            <br>

            <label for="hargaJual" class="form-label">Harga Jual</label>
            <input type="number" class="form-control" id="hargaJual" name="hargaJual" value="{{ old('hargaJual') }}"
                required>
            @error('hargaJual')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
            <br>

            <label for="fotoBarang" class="form-label">Upload Foto Barang</label>
            <input type="file" class="form-control" id="fotoBarang" name="fotoBarang" accept="image/*" required>
            @error('fotoBarang')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
            <br>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Jual Barang</button>
            </div>
        </form>
    </section>
@endsection