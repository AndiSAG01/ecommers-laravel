<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('backend/img/favicon/icon.png') }}" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap">

    @yield('css')
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}" type="text/css">
</head>
<body>
    <div class="wrapper">
        @include('backend.layouts.sidebar')
        <div class="main">
            @include('backend.layouts.navbar')
            <main class="content">
                @yield('content')
            </main>
            @include('backend.layouts.footer')
        </div>
    </div>

    @include('sweetalert::alert')

    @yield('js')
    <script src="{{ asset('backend/js/app.js') }}"></script>

    @yield('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
            gradientLight.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradientLight.addColorStop(1, "rgba(215, 227, 244, 0)");
            var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
            gradientDark.addColorStop(0, "rgba(51, 66, 84, 1)");
            gradientDark.addColorStop(1, "rgba(51, 66, 84, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales ($)",
                        fill: true,
                        backgroundColor: window.theme.id === "light" ? gradientLight : gradientDark,
                        borderColor: window.theme.primary,
                        data: [
                            2115,
                            1562,
                            1584,
                            1892,
                            1587,
                            1923,
                            2566,
                            2448,
                            2805,
                            3438,
                            2917,
                            3327
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)",
                                fontColor: "#fff"
                            }
                        }]
                    }
                }
            });
        });
    </script>
</body>
</html>
