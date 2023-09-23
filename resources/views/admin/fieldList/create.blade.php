@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-8 mx-auto my-auto">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h1 class="h3 mt-2 text-gray-800 text-center">Tambah Lapangan</h1>
                </div>
                <form action="/admin/daftar-lapangan/store" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lapangan</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="contoh : Lapangan 1" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="time_price" class="form-label">Jam & Biaya Perjam</label>
                            @foreach ($items as $item)
                            <div id="inputContainer">
                                <div class="row mb-2">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Jam" name="time_display[]"
                                            value="{{ $item->time }}" readonly>
                                        <input type="hidden" name="time[]" value="{{ $item->id }}">
                                    </div>
                                    <div class="col">
                                        <input type="number" class="form-control" name="price[]" placeholder="Harga"
                                            value="{{ old('price') }}" required>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/admin/daftar-lapangan" class="btn btn-secondary me-auto">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
