@extends('layouts.main')

@section('title', 'Dashboard Petinggi')

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

  <div class="row mt-4">
    <div class="col-md-12 mb-3">
      <div class="d-flex align-items-center">
        <label for="yearFilter" class="me-2">Pilih Tahun:</label>
        <select id="yearFilter" class="form-select" style="width: auto;">
          @foreach($availableYears as $year)
            <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
              {{ $year }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h2>Kas Masuk per Bulan</h2>
      <div id="cashInChart"></div>
    </div>

    <div class="col-md-6">
      <h2>Kas Keluar per Bulan</h2>
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
      <h2>Kategori Kas Masuk</h2>
      <div id="cashInCategoryChart"></div>
    </div>

    <div class="col-md-6">
      <h2>Kategori Kas Keluar</h2>
      <div id="cashOutCategoryChart"></div>
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
    var selectedYear = {!! json_encode($selectedYear) !!};

    // Event listener untuk filter tahun
    document.getElementById('yearFilter').addEventListener('change', function() {
      const year = this.value;
      window.location.href = `?year=${year}`;
    });


    // Fungsi format Rupiah
    function formatRupiah(value) {
      return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
    }

    // Fungsi untuk format tanggal bulan
    function formatMonth(date) {
      return new Date(date).toLocaleDateString('id-ID', {
        month: 'long',
        year: 'numeric'
      });
    }

    // Fungsi untuk merender diagram
    function renderChart(selector, options) {
      const element = document.querySelector(selector);
      if (element) {
        new ApexCharts(element, options).render();
      } else {
        console.error(`Element ${selector} not found`);
      }
    }

    // Konfigurasi umum untuk bar chart
    const barChartConfig = {
      chart: {
        type: 'bar',
        height: 400,
        toolbar: {
          show: false
        }
      },
      dataLabels: {
        enabled: false
      },
      tooltip: {
        y: {
          formatter: formatRupiah
        }
      },
      grid: {
        borderColor: '#f1f1f1'
      },
      xaxis: {
        labels: {
          rotate: -45,
          style: {
            fontSize: '12px'
          }
        }
      },
      yaxis: {
        labels: {
          formatter: function(value) {
            return formatRupiah(value);
          }
        }
      }
    };

    // Konfigurasi umum untuk pie chart
    const categoryBarConfig = {
      chart: {
        type: 'bar',
        height: 400,
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: true,
          dataLabels: {
            position: 'top',
          },
        }
      },
      dataLabels: {
        enabled: true,
        formatter: function(val) {
          return formatRupiah(val);
        },
        style: {
          fontSize: '12px',
        }
      },
      tooltip: {
        y: {
          formatter: formatRupiah
        }
      },
      grid: {
        borderColor: '#f1f1f1'
      },
      xaxis: {
        labels: {
          formatter: function(val) {
            return formatRupiah(val);
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '12px'
          }
        }
      }
    };
    // Konfigurasi umum untuk monthly bar chart
    const monthlyBarConfig = {
      ...barChartConfig,
      title: {
        text: `Tahun ${selectedYear}`,
        align: 'right',
        style: {
          fontSize: '14px',
          color: '#666'
        }
      }
    };

    // Render charts
    renderChart("#cashInChart", {
      ...monthlyBarConfig,
      series: [{
        name: 'Kas Masuk',
        data: Object.values(cashInData)
      }],
      xaxis: {
        ...monthlyBarConfig.xaxis,
        categories: Object.keys(cashInData).map(formatMonth)
      },
      colors: ['#00E396']
    });

    renderChart("#cashOutChart", {
      ...monthlyBarConfig,
      series: [{
        name: 'Kas Keluar',
        data: Object.values(cashOutData)
      }],
      xaxis: {
        ...monthlyBarConfig.xaxis,
        categories: Object.keys(cashOutData).map(formatMonth)
      },
      colors: ['#FF4560']
    });

    renderChart("#assetChart", {
      ...barChartConfig,
      series: [{
        name: 'Total',
        data: assetData.map(item => item.total)
      }],
      xaxis: {
        ...barChartConfig.xaxis,
        categories: assetData.map(item => item.name)
      }
    });

    renderChart("#cashInCategoryChart", {
      ...categoryBarConfig,
      series: [{
        name: 'Total',
        data: Object.values(cashInCategoryData)
      }],
      xaxis: {
        ...categoryBarConfig.xaxis,
        categories: Object.keys(cashInCategoryData)
      },
      colors: ['#00E396']
    });

    renderChart("#cashOutCategoryChart", {
      ...categoryBarConfig,
      series: [{
        name: 'Total',
        data: Object.values(cashOutCategoryData)
      }],
      xaxis: {
        ...categoryBarConfig.xaxis,
        categories: Object.keys(cashOutCategoryData)
      },
      colors: ['#FF4560']
    });
  </script>
@endsection
