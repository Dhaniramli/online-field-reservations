@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800 text-center">Hari & Tanggal</h1>

    <div class="row">
        <div class="col-lg-5 mx-auto my-auto">
            <form action="/admin/hari-tanggal/create" method="POST">
                <div class="card shadow mb-4">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="max_year" class="form-label">Maximal Tampilan Tahun</label>
                            <input type="number" class="form-control @error('max_year') is-invalid @enderror" id="max_year"
                            name="max_year" placeholder="contoh : 2023" value="{{ old('max_year') }}" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
@endsection
