@extends('admin.layouts.main')

@section('content')
<div class="container-fluid">

    @if (session()->has('success'))
    @include('admin.partials.alertSuccess')
    @endif

    <h1 class="h3 mb-2 text-gray-800 text-center">Data Transaksi</h1>

    <div class="card shadow mb-4">
        <form action="/admin/data-transaksi" method="POST">
            <div class="card-header py-3 d-flex">
                @csrf

                <div class="mb-3">
                    <select id="selectMenu" name="status" class="form-select" aria-label="Default select example" style="width: fit-content;">
                        <option value="" {{ !$status ? 'selected' : '' }}>Semua Data Transaksi</option>
                        <option value="selesai" {{ $status === 'selesai' ? 'selected' : '' }}>Data Transaksi Selesai</option>
                        <option value="belum-selesai" {{ $status === 'belum-selesai' ? 'selected' : '' }}>Data Transaksi Belum Selesai</option>
                        <option value="tidak-selesai" {{ $status === 'tidak-selesai' ? 'selected' : '' }}>Data Transaksi Tidak Selesai</option>
                    </select>
                </div>

                <div class="mb-3 ml-3">
                    <table>
                        <tr>
                            <td class="text-center align-middle">Dari</td>
                            <td></td>
                            <td>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date1" name="date1">
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="mb-3 ml-3">
                    <table>
                        <tr>
                            <td class="text-center align-middle">Sampai</td>
                            <td></td>
                            <td>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date2" name="date2">
                            </td>
                        </tr>
                    </table>
                </div>

                {{-- <div class="mb-3 ml-3">
                    <select class="form-select" aria-label="Default select example" id="date" name="date">
                        <option value="" selected>Tanggal</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" {{ old('date') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3 ml-3">
                    <select class="form-select" aria-label="Default select example" id="mount" name="mount">
                        <option value="" selected>Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-3 ml-3">
                    <select class="form-select" aria-label="Tahun" id="year" name="year">
                        <option selected value="">Tahun</option>
                        @php
                            $currentYear = date('Y');
                            $startYear = 1900;
                        @endphp
                        @for ($i = $currentYear; $i >= $startYear; $i--)
                            <option value="{{ $i }}" {{ old('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div> --}}
                
                
                <div class="mb-3 ml-3">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Nama Tim</th>
                            <th class="text-center">Nomor Telpon</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
                            <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                            <td>{{ $item->user->team_name }}</td>
                            <td class="text-center">{{ $item->user->phone_number }}</td>
                            <td class="text-center">{{ $item->total_price }}</td>
                            <td class="text-center">
                                @if ( ($item->status_pay_early === 'paid' && $item->status_pay_final === 'paid') || ($item->status_pay_early === 'paid_final' && $item->status_pay_final === 'paid'))
                                Selesai
                                @elseif( $item->status_pay_early === 'expire' || $item->status_pay_final === 'expire' )
                                Tidak Selesai
                                @elseif( $item->status_pay_early === 'pending' || $item->status_pay_final === 'pending'
                                || $item->status_pay_early === 'unpaid' || $item->status_pay_final === 'unpaid' )
                                Belum Selesai
                                @endif
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a href="{{ url('/admin/data-transaksi/show/' . $item->id) }}"
                                    class="btn btn-info btn-icon-split btn-sm mb-2">
                                    <span class="text">Detail</span>
                                </a>
                                <a id="deleteButton" href="{{ url('/admin/data-transaksi/hapus/' . $item->id) }}"
                                    class="btn btn-danger btn-icon-split btn-sm mb-2">
                                    <span class="text">Hapus</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-footer">
            {{-- <a href="{{ url('/admin/data-transaksi/export?status=' . ($status ? $status : '') . '&date=' . ($date ? $date : '')) }}" class="btn btn-success">Download Excel</a> --}}
        </div>
    </div>

</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
