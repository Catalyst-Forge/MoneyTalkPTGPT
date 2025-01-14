@extends('layouts.main')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Rekap Bulanan</h4>
          <p>Pilih bulan untuk melihat rekapitulasi aset</p>
        </div>

        <div class="card-body">
          <form action="{{ route('asset.monthlyReport') }}" method="GET" id="monthlyReportForm">
            <div class="d-flex align-items-center gap-3">
              <input type="month" name="month" id="month" class="form-control w-auto" value="{{ $month }}">
              <button type="submit" class="btn btn-primary">Tampilkan</button>
            </div>
          </form>
        </div>
      </div>

      @if ($assets->isNotEmpty())
        <div class="card mt-4">
          <div class="card-header">
            <h5 class="card-title">Rekap Aset untuk bulan {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
            </h5>
            <p>Total Jumlah: Rp. {{ number_format($totalAmount, 0, ',', '.') }}</p>
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table-bordered table">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Nilai</th>
                    <th>Total</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($assets as $asset)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $asset->name }}</td>
                      <td>{{ $asset->category->name }}</td>
                      <td>{{ \Carbon\Carbon::parse($asset->date)->translatedFormat('d F Y') }}</td>
                      <td>{{ $asset->amount }}</td>
                      <td>Rp. {{ number_format($asset->value, 0, ',', '.') }}</td>
                      <td>Rp. {{ number_format($asset->total, 0, ',', '.') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      @else
        <div class="alert alert-info mt-4">Tidak ada data aset untuk bulan ini</div>
      @endif
    </div>
  </div>
@endsection
