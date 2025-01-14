@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
  <div class="row">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h6 class="text-muted">Kas Masuk</h6>
          <h4 class="font-weight-bold text-success">Rp {{ number_format($totalCashIn, 0, ',', '.') }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h6 class="text-muted">Kas Keluar</h6>
          <h4 class="font-weight-bold text-danger">Rp {{ number_format($totalCashOut, 0, ',', '.') }}</h4>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body text-center">
          <h6 class="text-muted">Kas Akhir</h6>
          <h4 class="font-weight-bold text-primary">Rp {{ number_format($totalBalance, 0, ',', '.') }}</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h2>Kas masuk</h2>
      <div id="cashInChart"></div>
    </div>

    <div class="col-md-6">
      <h2>Kas keluar</h2>
      <div id="cashOutChart"></div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-12">
      <h2>Data Aset</h2>
      <div id="assetChart"></div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6">
      <h2>Kategori kas masuk</h2>
      <div id="cashInCategoryChart"></div>
    </div>

    <div class="col-md-6">
      <h2>Kategori kas keluar
        <div id="cashOutCategoryChart"></div>
      </h2>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    // Data dari controller
    var cashInData = {!! json_encode($cashInData) !!};
    var cashOutData = {!! json_encode($cashOutData) !!};
    var assetData = {!! json_encode($assetData) !!};
    var cashInCategoryData = {!! json_encode($cashInCategoryData) !!};
    var cashOutCategoryData = {!! json_encode($cashOutCategoryData) !!};

    // Fungsi untuk merender diagram
    function renderChart(selector, options) {
      const element = document.querySelector(selector);
      if (element) {
        new ApexCharts(element, options).render();
      } else {
        console.error(`Element ${selector} not found`);
      }
    }

    // Kas Masuk
    renderChart("#cashInChart", {
      chart: {
        type: "bar",
        height: 400
      },
      series: [{
        name: "Total",
        data: Object.values(cashInData)
      }],
      xaxis: {
        categories: Object.keys(cashInData)
      },
      title: {
        text: "Kas Masuk per Tanggal"
      },
    });

    // Kas Keluar
    renderChart("#cashOutChart", {
      chart: {
        type: "bar",
        height: 400
      },
      series: [{
        name: "Total",
        data: Object.values(cashOutData)
      }],
      xaxis: {
        categories: Object.keys(cashOutData)
      },
      title: {
        text: "Kas Keluar per Tanggal"
      },
    });

    // Data Aset
    renderChart("#assetChart", {
      chart: {
        type: "bar",
        height: 400
      },
      series: [{
        name: "Total",
        data: assetData.map(a => a.total)
      }],
      xaxis: {
        categories: assetData.map(a => a.name)
      },
      title: {
        text: "Total Aset Berdasarkan Nama"
      },
    });

    // Kategori Kas Masuk
    renderChart("#cashInCategoryChart", {
      chart: {
        type: "pie",
        height: 400
      },
      series: Object.values(cashInCategoryData),
      labels: Object.keys(cashInCategoryData),
      title: {
        text: "Kategori Kas Masuk"
      },
    });

    // Kategori Kas Keluar
    renderChart("#cashOutCategoryChart", {
      chart: {
        type: "pie",
        height: 400
      },
      series: Object.values(cashOutCategoryData),
      labels: Object.keys(cashOutCategoryData),
      title: {
        text: "Kategori Kas Keluar"
      },
    });
  </script>
@endsection
