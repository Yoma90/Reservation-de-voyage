@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        @if (auth()->user()->role_id == 1)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ count($users) }}
                                        <span class="text-danger text-sm font-weight-bolder"> </span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (auth()->user()->role_id == 1)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Agencies</p>
                                    <h5 class="font-weight-bolder mb-0">
                                        {{ count($agencies) }}
                                        <span class="text-danger text-sm font-weight-bolder"> </span>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        {{-- <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 ">
        <div class="card ">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8 ">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Managers</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ count($users) }}
                                <span class="text-success text-sm font-weight-bolder"> </span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Customers</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count($customers) }}
                                    <span class="text-danger text-sm font-weight-bolder"> </span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Buses</p>
                                <h5 class="font-weight-bolder mb-0">
                                    {{ count($bus) }}
                                    <span class="text-danger text-sm font-weight-bolder"> </span>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Customers overview</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-4">
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                        <h6 class="ms-2 mt-4 mb-0"> Active Customers </h6>
                        <!-- <p class="text-sm ms-2"> (<span class="font-weight-bolder">+23%</span>) than last week </p> -->
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Web site history</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            @foreach ($histories as $history)
                                @if ($history->type === 'add')
                                    <div class="timeline-block ">
                                        <span class="timeline-step">
                                            <i class="ni ni-fat-add text-success text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $history->user->first_name . ' ' . $history->user->last_name . ' ' . $history->notification }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $history->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if ($history->type === 'delete')
                                    <div class="timeline-block ">
                                        <span class="timeline-step">
                                            <i class="ni ni-fat-remove text-danger text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $history->user->first_name . ' ' . $history->user->last_name . ' ' . $history->notification }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $history->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if ($history->type === 'change')
                                    <div class="timeline-block ">
                                        <span class="timeline-step">
                                            <i class="ni ni-fat-delete text-info text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $history->user->first_name . ' ' . $history->user->last_name . ' ' . $history->notification }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $history->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if ($history->type === 'logout')
                                    <div class="timeline-block ">
                                        <span class="timeline-step">
                                            <i class="ni ni-bold-left text-danger text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $history->user->first_name . ' ' . $history->user->last_name . ' ' . $history->notification }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $history->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                                @if ($history->type === 'login')
                                    <div class="timeline-block">
                                        <span class="timeline-step">
                                            <i class="ni ni-bold-right text-success text-gradient"></i>
                                        </span>
                                        <div class="timeline-content">
                                            <h6 class="text-dark text-sm font-weight-bold mb-0">
                                                {{ $history->user->first_name . ' ' . $history->user->last_name . ' ' . $history->notification }}
                                            </h6>
                                            <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                                                {{ $history->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@push('dashboard')
    <script>
        window.onload = function() {
            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"],
                    datasets: [{
                        label: "Customers",
                        tension: 0.4,
                        borderWidth: 0,
                        borderRadius: 4,
                        borderSkipped: false,
                        backgroundColor: "#fff",
                        data: [5, 0, 10, 0, 0, 80, 0, 0, 20, 0, 0, 0],
                        maxBarThickness: 6
                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                suggestedMin: 0,
                                suggestedMax: 500,
                                beginAtZero: true,
                                padding: 15,
                                font: {
                                    size: 14,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                                color: "#fff"
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false
                            },
                            ticks: {
                                display: false
                            },
                        },
                    },
                },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"],
                    datasets: [{
                        label: "Customers",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [5, 10, 0, 0, 0, 80, 0, 0, 20, 0, 0, 0],
                        maxBarThickness: 6

                    }, ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endpush
