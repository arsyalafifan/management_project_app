<?php
use App\enumVar as enum;
?>
@extends('layouts.master')

@section('content')
<!-- ============================================================== -->
<!-- Info box -->
<!-- ============================================================== -->
<!-- .row -->
<!-- /.row -->
<!-- ============================================================== -->
<!-- End Info box -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Over Visitor, Our income , slaes different and  sales prediction -->
<!-- ============================================================== -->
<!-- .row -->
<!-- /.row -->

{{-- <div class="row">
    <!-- Column -->
    <div class="col-lg-5 col-md-12">
        <div class="card">
            <img class="img-responsive" src="{{ asset('/images/news/business-management.png') }}">
        </div>

        <div class="card">
            <img class="img-responsive" src="{{ asset('/images/news/image1.jpg') }}">
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-body collapse show">
                <h3 class="card-title">Selamat Datang</h4>
                <p class="card-text font-weight-bold text-justify" style="height:380px;">{{ config('app.name', '-') }}</p>
            </div>
        </div>
    </div>
    <!-- Column -->
    <div class="col-lg-4 col-md-12">
        <div class="row">
            <!-- Column -->
            <div class="col-md-12">
                <div class="card bg-info text-white">
                    <div class="card-body ">
                        <div class="row weather">
                            <div class="col-8">
                                <div class="display-6" id="d_time">73<sup>°F</sup></div>
                                <p class="text-white">Kota Batam</p>
                            </div>
                            <div class="col-4 text-right">
                                <h1 class="m-b-"><i class="fa fa-clock-o"></i></h1>
                                <b class="text-white" id="d_day">SUNNEY DAY</b>
                                <p class="op-5" id="d_fulldate">April 14</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-12">
                <div class="card bg-dark text-white">
                    <div class="card-body">
                        <div id="myCarouse2" class="carousel slide" data-ride="carousel">
                            <div class="active carousel-item">
                                <h6 style="height:50px;">{{ config('app.name', '-') }}</h6>
                                <div class="d-flex no-block">
                                    <span class="m-l-5">
                                    <div class="text-white m-b-0">Tim {{ config('app.name', '-') }}</div>
                                    <div class="text-white"></div>
                                    </span>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <h6 style="height:50px;">{{ config('app.name', '-') }}</h6>
                                <div class="d-flex no-block">
                                    <span class="m-l-5">
                                    <div class="text-white m-b-0">Tim {{ config('app.name', '-') }}</div>
                                    <div class="text-white"></div>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-md-12">
                <div class="card bg-danger text-white">
                    <div class="card-body ">
                        <div class="row weather">
                            <div class="col-12 text-center">
                                <div class="display-5">{{ strtoupper(apps::gettemplate($mode, 'app_alias2')) }}</div>
                                <h2 class="text-white"></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>
</div> --}}
<!-- /.row -->
<!--row -->
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
        <div class="white-box">
            <div class="row row-in">
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-briefcase" aria-hidden="true"></i>
                            <h5 class="text-muted vb">TOTAL MANPOWER</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-danger">{{ $countmanpower }}</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="{{ $countmanpower }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $countmanpower }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="fa fa-database" aria-hidden="true"></i>
                            <h5 class="text-muted vb">TOTAL MATERIAL</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-megna">{{ $countmaterial }}</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="{{ $countmaterial }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $countmaterial }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 row-in-br">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                            <h5 class="text-muted vb">TOTAL PROJECT</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-primary">{{ $countproject }}</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="{{ $countproject }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $countproject }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6  b-0">
                    <div class="col-in row">
                        <div class="col-md-6 col-sm-6 col-xs-6"> <i class="linea-icon linea-basic" data-icon="&#xe016;"></i>
                            <h5 class="text-muted vb">TOTAL PENGGUNA</h5>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <h3 class="counter text-right m-t-15 text-success">{{ $countuser }}</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $countuser }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $countuser }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!--row -->
<div class="row">
    <div class="col-md-12 col-lg-6 col-sm-12 col-xs-12 pull-right">
        <div class="white-box">
            <h3 class="box-title">Project selesai vs belum selesai</h3>
            <div style="height: 500px;">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-6 col-sm-6 col-xs-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="white-box m-b-15">
                    <h3 class="box-title">Daftar Jadwal Proyek Berjalan</h3>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered yajra-datatable table-striped" id="jadwalproyek-table">
                                <thead>
                                    <tr>
                                        <th>Nama Proyek</th>
                                        <th>Location</th>
                                        <th>Start Date</th>
                                        <th>Finish Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row -->


<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ['Selesai', 'Belum Selesai'],
        datasets: [{
          label: 'Project',
          data: ["{{ $countprojectselesai }}", "{{ $countprojectbelumselesai }}"],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
  <script>
    $(document).ready(function () {
        var jadwalproyektable = $('#jadwalproyek-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            pageLength: 50,
            dom: 'Bfrtip',
            select: false,
            ordering: false,
            searching: false,
            language: {
                lengthMenu: "Menampilkan _MENU_ data per halaman",
                zeroRecords: "Tidak ada data",
                info: "Halaman _PAGE_ dari _PAGES_",
                infoEmpty: "Tidak ada data",
                infoFiltered: "(difilter dari _MAX_ data)",
                search: "Pencarian :",
                paginate: {
                   previous: "Sebelumnya",
                   next: "Selanjutnya",
                }
            },
            ajax: {
                url: "{{ route('index') }}",
                dataSrc: function(response){
                    response.recordsTotal = response.data.count;
                    response.recordsFiltered = response.data.count;
                    return response.data.data;
                },
                data: function ( d ) {
                    return $.extend( {}, d, {
                        // "search": $("#search").val().toLowerCase(),
                    } );
                }
            },
            buttons: {
                buttons: [
            ]
            },
            columns: [
                {'orderData': 0, data: 'namaproyek',
                    render: function ( data, type, row ) {
                        return row.namaproyek;
                    }, 
                    name: 'namaproyek'},
                {'orderData': 1, data: 'location',
                    render: function ( data, type, row ) {
                        return row.location;
                    }, 
                    name: 'location'},
                {'orderData': 2, data: 'startdate',
                    render: function ( data, type, row ) {
                        return row.startdate;
                    }, 
                    name: 'startdate'},
                {'orderData': 3, data: 'finishdate',
                    render: function ( data, type, row ) {
                        return row.finishdate;
                    }, 
                    name: 'finishdate'},
            ],
            initComplete: function (settings, json) {
                $(".btn-datatable").removeClass("dt-button");
            },
            //order: [[1, 'asc']]
        });
    })
  </script>

{{-- <script>
    let myScript = document.createElement("script");
    myScript.setAttribute("src", "{{ asset('/default/dist/js/dashboard1.js') }}");
    document.body.appendChild(myScript);

    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var ctxBar = document.getElementById('barChart').getContext('2d');
    var ctxLine = document.getElementById('lineChart').getContext('2d');

    var dataPie = {
        labels: [
            @foreach ($jumlahnakerbyjk as $item)
            "{{ $item->jenisvw }}",
            @endforeach
        ],
        datasets: [{
            label: "",
            backgroundColor: [
                @foreach ($jumlahnakerbyjk as $item)
                    @if($item->jeniskelamin==enum::JENISKELAMIN_LAKILAKI)
                    "#3ba3e8",
                    @elseif($item->jeniskelamin==enum::JENISKELAMIN_PEREMPUAN)
                    '#fc6485',
                    @endif
                @endforeach
            ],
            borderColor: 'rgb(255, 255, 255)',
            data: [
                @foreach ($jumlahnakerbyjk as $item)
                {{ $item->jumlah }},
                @endforeach
            ],
        }]
    };
    
    var dataBar = {
        labels: [
            @foreach ($jumlahnakerbykecbyjk as $item)
            "{{ $item->namakec }}",
            @endforeach
        ],
        datasets: [
            {
                label: "Perempuan",
                backgroundColor: '#fc6485',
                data: [
                    @foreach ($jumlahnakerbykecbyjk as $item)
                    {{ $item->jumlahperempuan }},
                    @endforeach
                ]
            },
            {
                label: "Laki-Laki",
                backgroundColor: '#3ba3e8',
                data: [
                    @foreach ($jumlahnakerbykecbyjk as $item)
                    {{ $item->jumlahlaki }},
                    @endforeach
                ]
            },
        ]
    };

    var dataLine = {
        labels: [
            @foreach ($jumlahnakerbybulanbystatus as $item)
            "{{ $item->bulanvw }}",
            @endforeach
        ],
        datasets: [
            {
                label: "Belum Bekerja",
                borderColor: '#fc6485',
                backgroundColor: 'rgba(0,0,0,0.0)',
                data: [
                    @foreach ($jumlahnakerbybulanbystatus as $item)
                    {{ $item->belumbekerja }},
                    @endforeach
                ]
            },
            {
                label: "Sedang Bekerja",
                borderColor: '#3ba3e8',
                backgroundColor: 'rgba(0,0,0,0.0)',
                data: [
                    @foreach ($jumlahnakerbybulanbystatus as $item)
                    {{ $item->sedangbekerja }},
                    @endforeach
                ]
            },
        ]
    };

    var pieChart = new Chart(ctxPie,{
        type: 'pie',
        data: dataPie,
        options: { responsive: false}
    });

    var barChart = new Chart(ctxBar, {
        type: 'bar',
        data: dataBar,
        options: {
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                        // OR //
                        beginAtZero: true   // minimum value will be 0.
                    }
                }]
            },
            maintainAspectRatio: false,
        }
    });

    var lineChart = new Chart(ctxLine, {
        type: 'line',
        data: dataLine,
        options: {
            maintainAspectRatio: false,
            elements: {
                line: {
                    tension: 0, // disables bezier curves
                }
            },
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        suggestedMin: 0,    // minimum will be 0, unless there is a lower value.
                        // OR //
                        beginAtZero: true   // minimum value will be 0.
                    }
                }]
            },
        }
    });

    function filter(){
        window.location.href = window.location.pathname+"?"+$.param({'tahun': $("#tahun").val()})
    }
</script> --}}
@endsection
