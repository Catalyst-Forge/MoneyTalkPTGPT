@extends('layouts.main')

@section('title', 'Assets')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <header>
                            <h4 class="card-title">Daftar Aset</h4>
                            <small class="text-muted">Total Aset Masuk (Pengeluaran Kas): Rp.
                                {{ number_format($expenditure, 0, ',', '.') }}</small>
                        </header>

                        <div class="d-flex flex-column align-items-end gap-2">
                            @if (auth()->user()->role->name == 'admin')
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addAssetModal">Tambah Aset
                                        Baru</button>

                                    <a href="{{ route('asset.exportExcel') }}" class="btn btn-success ms-2"
                                        role="button">Export to Excel</a>
                                    <a href="{{ route('asset.exportPdf') }}" class="btn btn-secondary ms-2"
                                        role="button">Export to PDF</a>
                                </div>
                            @endif

                            <form action="{{ route('asset.monthlyReport') }}" method="GET" id="monthlyReportForm">
                                <div class="d-flex align-items-center gap-3">
                                    <input type="month" name="month" id="month" class="form-control w-auto"
                                        value="{{ request('month') }}">

                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table-xl table pt-5">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Nilai</th>
                                        <th>Total</th>
                                        @if (auth()->user()->role->name == 'admin')
                                            <th>Aksi</th>
                                        @endif
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
                                            @if (auth()->user()->role->name == 'admin')
                                                <td class="text-nowrap">
                                                    <div class="dropdown dropup">
                                                        <button class="btn btn-sm btn-secondary dropdown-toggle"
                                                            id="dropdownMenuButton-{{ $asset->id }}" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>

                                                        <ul class="dropdown-menu"
                                                            aria-labelledby="dropdownMenuButton-{{ $asset->id }}">
                                                            <li><a href="#" class="dropdown-item"
                                                                    data-bs-toggle="modal" data-bs-target="#editAssetModal"
                                                                    onclick="editAsset({{ json_encode($asset) }})">Ubah</a>
                                                            </li>

                                                            <form action="{{ route('asset.destroy', $asset->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Yakin ingin menghapus data aset ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">Hapus</button>
                                                            </form>
                                                        </ul>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Data Aset --}}
    <div class="modal fade" id="addAssetModal" tabindex="-1" aria-labelledby="addAssetModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label">Tambah Data Aset Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('asset.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required="required"
                                autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control" required="required">
                                <option value="" disabled selected>{{ '-' }}</option>
                                @if (isset($categories) && count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>- No Categories Available -</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="date" name="date" required="required">
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                required="required">
                        </div>

                        <div class="mb-3">
                            <label for="value" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="value" name="value"
                                required="required">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn bnt-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit Data Aset --}}
    <div class="modal fade" id="editAssetModal" tabindex="-1" aria-labelledby="editAssetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAssetModalLabel">Ubah Data Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="editAssetForm" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nama</label>
                            <input type="text" name="name" id="edit_name" class="form-control"
                                required="required" autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="edit_category" class="form-label">Kategori</label>
                            <select name="category" id="edit_category" class="form-control" required="required">
                                @if (isset($categories) && count($categories) > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>- No Categories Available -</option>
                                @endif
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_date" class="form-label">Tanggal</label>
                            <input type="date" name="date" id="edit_date" class="form-control"
                                required="required">
                        </div>

                        <div class="mb-3">
                            <label for="edit_amount" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="edit_amount" name="amount"
                                required="required"></input>
                        </div>

                        <div class="mb-3">
                            <label for="edit_value" class="form-label">Nilai</label>
                            <input type="number" name="value" id="edit_value" class="form-control"
                                required="required">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
  <script>
    function editAsset(asset) {
      doucment.getElementById('editAssetForm').action = `/asset/${asset.id}`
      document.getElementById('edit_name').value = asset.name
      document.getElementById('edit_category').value = asset.category.name
      document.getElementById('edit_date').value = asset.date
      document.getElementById('edit_amount').value = asset.amount
      document.getElementById('edit_value').value = asset.value
      $('#editAssetModal').modal('show')
    }
  </script>
@endpush --}}
