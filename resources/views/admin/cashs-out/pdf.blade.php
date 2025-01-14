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

    .report-header {
      text-align: center;
      margin-bottom: 30px;
      padding: 20px;
    }

    .report-header h1 {
      font-size: 28pt;
      margin: 0;
    }

    .report-header h2 {
      font-size: 16pt;
      margin: 5px 0;
    }

    .report-header p {
      margin: 0;
      font-size: 12pt;
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
    <div class="report-header">
      <h1>Laporan Kas Keluar</h1>
      <h2>Company Name</h2>
    </div>

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
        @foreach ($cashOuts as $cashOut)
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
          <td colspan="6">Grand Total</td>
          <td>Rp. {{ number_format($totalBalanceCashOut, 0, ',', '.') }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</body>

</html>
