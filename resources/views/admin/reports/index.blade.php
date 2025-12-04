@extends('layout.app')

@section('title', __('Reports'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_reports', "active")

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/charts/apexcharts.css') }}">
@endpush

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Reports') }}</h3>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right"></div>
            </div>
        </div>
        <div class="content-body pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="float-left pl-2">
                                            <span class="font-large-3 text-bold-300 info">{{$countCustomers}}</span>
                                        </div>
                                        <div class="float-left mt-2 ml-1">
                                            <span class="blue-grey darken-1 block">{{ __("Customers")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="float-left pl-2">
                                            <span class="font-large-3 text-bold-300 danger">{{$countUsers}}</span>
                                        </div>
                                        <div class="float-left mt-2 ml-1">
                                            <span class="blue-grey darken-1 block">{{ __("Users")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="float-left pl-2">
                                            <span class="font-large-3 text-bold-300 success">{{$countServices}}</span>
                                        </div>
                                        <div class="float-left mt-2 ml-1">
                                            <span class="blue-grey darken-1 block">{{ __("Services")}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-12">
                                        <div class="float-left pl-2">
                                            <span class="font-large-3 text-bold-300 warning">{{$countRequests}}</span>
                                        </div>
                                        <div class="float-left mt-2 ml-1">
                                            <span class="blue-grey darken-1 block">{{ __("Requests")}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="minimal-statistics-bg">
                <div class="row">
                    <div class="col-12 mb-1">
                        <h4 class="text-uppercase">{{ __("Statistique de demande selon le status et le paiement")}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-warning">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fas la la-pause text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">{{\App\Models\Request\Request::where('status', 'pending')->count()}}</h3>
                                            <span>{{ __('En attente') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-info">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="la la-play text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">{{\App\Models\Request\Request::where('status', 'in_progress')->count()}}</h3>
                                            <span>{{ __('En cours') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-success">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa fa-check text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">{{\App\Models\Request\Request::where('status', 'completed')->count()}}</h3>
                                            <span>{{ __('Terminée') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <div class="card bg-danger">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="fa fa-times text-white font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-white text-right">
                                            <h3 class="text-white">{{\App\Models\Request\Request::where('status', 'refused')->count()}}</h3>
                                            <span>{{ __('refusé') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-md-12">
                        <div class="card overflow-hidden">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="fas fa-times-circle danger font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ __("Non payé")}}</h4>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{\App\Models\Request\Request::where('status', "<>", 'refused')->where('paid_status', 'unpaid')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="fas fa-check-circle primary font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ __("Payé")}}</h4>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{\App\Models\Request\Request::where('paid_status', 'paid')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="fas fa-check-double success font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ __("Payé et terminé")}}</h4>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{\App\Models\Request\Request::where('status', 'completed')->where('paid_status', 'paid')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body cleartfix">
                                    <div class="media align-items-stretch">
                                        <div class="align-self-center">
                                            <i class="fas fa-sync-alt warning font-large-2 mr-2"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ __("Payé et non terminé")}}</h4>
                                        </div>
                                        <div class="align-self-center">
                                            <h1>{{\App\Models\Request\Request::where('status', '<>', 'completed')->where('paid_status', 'paid')->count()}}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <div id="bar-basic-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div id="pie-simple-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var $primary = "#666ee8",
            $secondary = "#6B6F82",
            $success = "#1C9066",
            $info = "#1E9FF2",
            $warning = "#FF9149",
            $danger = "#FF4961",
            $themeColor = [$danger, $primary, $success, $info, $warning, $secondary];
        var services = @json($services);
        var nbDemandes = @json($nb);
        var barBasicChart = {
            chart: {
                //height: 350,
                type: "bar"
            },
            plotOptions: {
                bar: {
                    horizontal: !0
                }
            },
            title: {
                text: "{{ __('Nombre de demandes par service')}}",
                align: "center"
            },
            dataLabels: {
                enabled: !1
            },
            series: [{
                data: nbDemandes
            }],
            xaxis: {
                categories: services
            },
            yaxis: {
                title: {
                    text: "Services"
                }
            },
            fill: {
                colors: $themeColor
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " demandes";
                    }
                }
            }
        };
        var bar_basic_chart = new ApexCharts(document.querySelector("#bar-basic-chart"), barBasicChart);
        bar_basic_chart.render();

        var services2 = @json($services2);
        var nbDemandes2 = @json($nb2);
        var pieSimpleChart = {
            chart: {
                //height: 350,
                type: "pie"
            },
            title: {
                text: "{{ __('Les 5 premières services')}}",
                align: "center"
            },
            legend: {
                position: "bottom",
                horizontalAlign: "center"
            },
            labels: services2,
            series: nbDemandes2,
            responsive: [{
                breakpoint: 1200,
                options: {
                    chart: {
                        width: 300
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }, {
                breakpoint: 768,
                options: {
                    chart: {
                        width: 520
                    },
                    legend: {
                        position: "right"
                    }
                }
            }, {
                breakpoint: 620,
                options: {
                    chart: {
                        width: 450
                    },
                    legend: {
                        position: "right"
                    }
                }
            }, {
                breakpoint: 480,
                options: {
                    chart: {
                        width: 250
                    },
                    legend: {
                        position: "bottom"
                    }
                }
            }],
            fill: {
                colors: $themeColor
            }
        };
        var pie_simple_chart = new ApexCharts(document.querySelector("#pie-simple-chart"), pieSimpleChart);
        pie_simple_chart.render();
    </script>
@endpush