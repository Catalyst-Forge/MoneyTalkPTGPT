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

  <div class="row mt-4">
    <div class="col-md-12 mb-3">
      <div class="d-flex align-items-center">
        <label for="monthFilter" class="me-2">Pilih Bulan:</label>
        <select id="monthFilter" class="form-select" style="width: auto;">
          @foreach ($availableMonth as $month)
              <option value="{{ $month }}" {{ $month == $selectedMonthYear ? 'selected' : '' }}>
                {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}
              </option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <h2 class="cashMonthTitle">Kas Masuk Bulan </h2>
      <div id="cashInChart"></div>
    </div>

    <div class="col-md-6">
      <h2 class="cashMonthTitle">Kas Keluar Bulan </h2>
      <div id="cashOutChart"></div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6">
      <h2 class="cashYearTitle">Kas Masuk Tahun </h2>
      <div id="cashInChartYear"></div>
    </div>

    <div class="col-md-6">
      <h2 class="cashYearTitle">Kas Keluar Tahun </h2>
      <div id="cashOutChartYear"></div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <h2 class="text-center">Diagram Pemasukan dan Pengeluaran Bulan {{ $lastMonthName }}</h2>
      <div id="lastMonthChart"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    // Data dari controller
    var cashInDataMonthly = {!! json_encode($cashInDataMonthly) !!};
    var cashOutDataMonthly = {!! json_encode($cashOutDataMonthly) !!};
    var cashInDataYearly = {!! json_encode($cashInDataYearly) !!};
    var cashOutDataYearly = {!! json_encode($cashOutDataYearly) !!};
    var lastMonthCashIn = {!! json_encode($lastMonthCashIn) !!}
    var lastMonthCashOut = {!! json_encode($lastMonthCashOut) !!}
    var selectedYear = {!! json_encode($selectedYear) !!};

    const dateInputFilter = document.getElementById('monthFilter')

    // Event listener untuk filter tahun
    dateInputFilter.addEventListener('change', function() {
      const month = this.value;
      window.location.href = `?month=${month}`;
    });

    // DOM Manipulation untuk mengganti bulan pada kas masuk dan kas keluar perbulan
    document.querySelectorAll('.cashMonthTitle').forEach(title => title.textContent += formatMonth(dateInputFilter.value,
      'month'))
    document.querySelectorAll('.cashYearTitle').forEach(title => title.textContent += formatMonth(dateInputFilter.value,
      'year'))

    // Fungsi format Rupiah
    function formatRupiah(value) {
      return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
    }

    // Fungsi untuk format tanggal bulan
    function formatMonth(date, format = 'both') {
      const options = format === 'month' ? {
          month: 'long'
        } :
        format === 'year' ? {
          year: 'numeric'
        } : 
        format === 'full' ? {
          day: 'numeric',
          month: 'long',
          year: 'numeric'
        } : {
          month: 'long',
          year: 'numeric'
        };

      return new Date(date).toLocaleDateString('id-ID', options);
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
            fontSize: '14px'
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

    // Data bulan terakhir untuk pemasukan dan pengeluaran
    const lastMonthData = {
      series: [{{ $lastMonthCashIn }}, {{ $lastMonthCashOut }}],
      labels: ['Pemasukan', 'Pengeluaran']
    }

    // Konfigurasi diagram bulan terakhir untuk pemasukan dan pengeluaran
    const lastMonthChartConfig = {
      chart: {
        type: 'pie',
        height: 400
      },
      labels: lastMonthData.labels,
      series: lastMonthData.series,
      colors: ['#00e396', '#ff4560'],
      tooltip: {
        y: {
          formatter: function(value) {
            return formatRupiah(value)
          }
        }
      },
      legend: {
        position: 'bottom'
      }
    }

    // Render charts
    renderChart("#cashInChart", {
      ...monthlyBarConfig,
      series: [{
        name: 'Kas Masuk',
        data: Object.values(cashInDataMonthly)
      }],
      xaxis: {
        ...monthlyBarConfig.xaxis,
        categories: Object.keys(cashInDataMonthly).map(date => formatMonth(date, 'full'))
      },
      colors: ['#00E396']
    })

    renderChart("#cashOutChart", {
      ...monthlyBarConfig,
      series: [{
        name: 'Kas Keluar',
        data: Object.values(cashOutDataMonthly)
      }],
      xaxis: {
        ...monthlyBarConfig.xaxis,
        categories: Object.keys(cashOutDataMonthly).map(month => formatMonth(month, 'full'))
      },
      colors: ['#FF4560']
    });

    renderChart("#cashInChartYear", {
      ...monthlyBarConfig,
      series: [{
        name: 'Kas Masuk',
        data: Object.values(cashInDataYearly)
      }],
      xaxis: {
        ...monthlyBarConfig.xaxis,
        categories: Object.keys(cashInDataYearly).map(formatMonth)
      },
      colors: ['#00E396']
    });

    renderChart("#cashOutChartYear", {
      ...monthlyBarConfig,
      series: [{
        name: 'Kas Keluar',
        data: Object.values(cashOutDataYearly)
      }],
      xaxis: {
        ...monthlyBarConfig.xaxis,
        categories: Object.keys(cashOutDataYearly).map(formatMonth)
      },
      colors: ['#ff4560']
    });

    renderChart('#lastMonthChart', lastMonthChartConfig)
  </script>
@endsection
