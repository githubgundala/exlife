@extends('layouts.layout')
@section('menDash','active')
@section('content')
<div class="row">
  {{-- <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>150</h3>

        <p>New Orders</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div> --}}
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $currentMonth }}<sup style="font-size: 20px"></sup></h3>

        <p>Member Bulan Ini</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      {{-- <a href="#" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a> --}}
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $count }}</h3>

        <p>Member Terdaftar</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      {{-- <a href="admin/member" class="small-box-footer">Lebih Lanjut <i class="fas fa-arrow-circle-right"></i></a> --}}
    </div>
  </div>
  <!-- ./col -->
  {{-- <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>65</h3>

        <p>Unique Visitors</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div> --}}
  <!-- ./col -->



  <div class="col-lg-12">
    <div class="card">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between">
          <h3 class="card-title">Grafik Member Tahun {{ date('Y') }}</h3>
          {{-- <a href="javascript:void(0);">View Report</a> --}}
        </div>
      </div>
      <div class="card-body">
        {{-- <div class="d-flex">
          <p class="d-flex flex-column">
            <span class="text-bold text-lg">820</span>
            <span>Member</span>
          </p>
          <p class="ml-auto d-flex flex-column text-right">
            <span class="text-success">
              <i class="fas fa-arrow-up"></i> 12.5%
            </span>
            <span class="text-muted">Since last week</span>
          </p>
        </div> --}}
        <!-- /.d-flex -->

        <div class="position-relative mb-4">
          <canvas id="visitors-chart1" height="200"></canvas>
        </div>

        {{-- <div class="d-flex flex-row justify-content-end">
          <span class="mr-2">
            <i class="fas fa-square text-primary"></i> Bulan Ini
          </span>

          <span>
            <i class="fas fa-square text-gray"></i> Bulan Kemarin
          </span>
        </div> --}}
      </div>
    </div>
  </div>
</div>
@endsection
@push('script')
    <script type="text/javascript">
    'use strict'
    var ticksStyle = {
        fontColor: '#495057',
        fontStyle: 'bold'
    }
    var mode = 'index'
    var intersect = true
    var $visitorsChart = $('#visitors-chart1');
    var bulan = "{{ json_encode($bulan) }}";
    var jumlah = {{ json_encode($jumlah) }};
    var visitorsChart = new Chart($visitorsChart, {
        data: {
            labels: JSON.parse(bulan.replace(/&quot;/g,'"')),
            datasets: [{
                type: 'line',
                data: jumlah,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                pointBorderColor: '#007bff',
                pointBackgroundColor: '#007bff',
                fill: false
                    // pointHoverBackgroundColor: '#007bff',
                    // pointHoverBorderColor    : '#007bff'
            }, 
            // {
            //     type: 'line',
            //     data: [60, 80, 70, 67, 80, 77, 100],
            //     backgroundColor: 'tansparent',
            //     borderColor: '#ced4da',
            //     pointBorderColor: '#ced4da',
            //     pointBackgroundColor: '#ced4da',
            //     fill: false
            //         // pointHoverBackgroundColor: '#ced4da',
            //         // pointHoverBorderColor    : '#ced4da'
            // }
          ]
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                mode: mode,
                intersect: intersect
            },
            hover: {
                mode: mode,
                intersect: intersect
            },
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    // display: false,
                    gridLines: {
                        display: true,
                        lineWidth: '4px',
                        color: 'rgba(0, 0, 0, .2)',
                        zeroLineColor: 'transparent'
                    },
                    ticks: $.extend({
                        beginAtZero: true,
                        suggestedMax: Math.max(...jumlah)
                    }, ticksStyle)
                }],
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    ticks: ticksStyle
                }]
            }
        }
    });
    </script>
@endpush