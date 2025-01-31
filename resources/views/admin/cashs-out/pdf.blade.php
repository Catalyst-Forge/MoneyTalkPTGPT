<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Kas Keluar</title>
  <style>
    body {
      font-family: 'Times New Roman', Times, serif;
    }

    .container {
      margin: 0 auto;
      max-width: 100%;
    }

    .text-center {
      text-align: center;
    }

    .mt-5 {
      margin-top: 1.5rem;
    }

    .report-header {
      margin-bottom: 20px;
      border-bottom: 1px solid #000;
      padding-bottom: 1rem;
      width: 100%;
      display: table;
    }

    .report-header .logo {
      display: table-cell;
      width: 10%;
      vertical-align: middle;
      text-align: center;
    }

    .report-header .logo img {
      max-width: 100px;
      height: auto;
    }

    .report-header .info {
      display: table-cell;
      width: 90%;
      text-align: center;
    }

    .report-header .info h1 {
      margin: 0;
      font-size: 24pt;
    }

    .report-header h2 {
      margin: 0 0 5px 0;
      font-size: 14pt;
    }

    .report-header small {
      font-size: 10pt;
    }

    .report-footer {
      margin-top: 30px;
      text-align: right;
      font-size: 12pt;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      table-layout: fixed;
      background-color: white;
      border-radius: 4px;
      overflow: hidden;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table th,
    table td {
      border: 1px solid #dee2e6;
      padding: 12px;
      text-align: left;
    }

    table th {
      background-color: #343a40;
      color: white;
      text-transform: uppercase;
    }

    .total-row {
      font-weight: bold;
      background-color: #e9ecef;
    }
  </style>
  </script>
</head>

<body>
  <div class="container">
    <header class="report-header">
      <div class="logo">
        <img src="{{ public_path('assets/compiled/png/logo.png') }}" alt="Logo cap laporan">
      </div>
      <div class="info">
        <h1>PT GPT</h1>
        <h2>CCTV Terpercaya No 1 di Bandung</h2>
        <small>Jl. Mochamad Toha No. 158 - RT. 002/10 Kel. Pelindung Hewan, Astanaanyar <br> Kota Bandung, Jawa Barat
          40243 P: 0813 2221 1101</small>
      </div>
    </header>

    <h3 class="mt-5 text-center">Laporan Keuangan Kas Keluar Bulan {{ $formattedMonth }}</h3>

    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Deskripsi</th>
          <th>Kategori</th>
          <th>Catatan</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($cashs_out as $cashOut)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($cashOut->date)->translatedFormat('d F Y') }}</td>
            <td>{{ Str::limit($cashOut->description, 100, '...') }}</td>
            <td>{{ $cashOut->category->name }}</td>
            <td>{{ Str::limit($cashOut->notes, 100, '...') }}</td>
            <td>Rp. {{ number_format($cashOut->amount, 0, ',', '.') }}</td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr class="total-row">
          <td colspan="5">Grand Total</td>
          <td>Rp. {{ number_format($totalBalanceCashOut, 0, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</body>

</html>
