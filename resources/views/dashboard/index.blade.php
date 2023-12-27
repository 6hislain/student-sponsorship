@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class='d-flex flex-row'>
        <img class='my-auto me-3 rounded-pill' alt='{{ Auth::user()->name }}' src='/img/user.png' height='75'
            width='75' />
        <div>
            <h3 class='fw-normal'>Welcome, {{ Auth::user()->name }}</h3>
            <p class="text-muted mb-0">These are your analytics stats for today {{ today()->format('F d, Y') }}</p>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-success text-white shadow-sm'>
                <h6 class='fw-normal'>CHILDREN</h6>
                <h1>{{ $children }} <i class="bi bi-arrow-down-up float-end"></i></h1>
            </div>
        </div>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-info shadow-sm'>
                <h6 class='fw-normal'>SPONSORS</h6>
                <h1>{{ $sponsors }} <i class="bi bi-box float-end"></i></h1>
            </div>
        </div>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-secondary text-white shadow-sm'>
                <h6 class='fw-normal'>PAYMENTS</h6>
                <h1>{{ $payments }} <i class="bi bi-collection float-end"></i></h1>
            </div>
        </div>
        <div class='col-md-3'>
            <div class='card card-body border-0 bg-warning shadow-sm'>
                <h6 class='fw-normal'>SPONSOR APPLICATIONS</h6>
                <h1>{{ $applications }} <i class="bi bi-person-check float-end"></i></h1>
            </div>
        </div>
        <div class="col-12 mt-2">
            <canvas id="myChart" width="400" height="150"></canvas>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="/vendor/chartjs/chart.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($sponsor_list as $sponsor)
                        '{{ $sponsor->first_name }} {{ $sponsor->last_name }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'Sponsor & Sponsored Children',
                    data: [
                        @foreach ($sponsor_list as $sponsor)
                            {{ count($sponsor->childSupport) }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
@endsection
