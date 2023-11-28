@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <div>
            <h2>Payment Report</h2>
            <h5 class='text-muted'>{{ now()->format('l, F j, Y') }}</h5>
        </div>
        <div>
            <button class='btn btn-primary' onclick='printReport()'>
                <i class='bi bi-file-break'></i> PRINT
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover my-2">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sponsor's Name</th>
                <th scope="col">Supported Children</th>
                <th scope="col">Transactions</th>
                <th scope="col" class='text-end'>Amount Donated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $key => $payment)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        <img src='{{ $payment->sponsor->image }}' height="40" width='40' alt=''
                            class='rounded-pill me-1' />
                        {{ $payment->sponsor->first_name }} {{ $payment->sponsor->last_name }}
                    </td>
                    <td>{{ random_int(1, 20) }}</td>
                    <td>{{ random_int(1, 10) }}</td>
                    <td class='text-end'>$ {{ number_format($payment->totalAmount) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan='4' class='text-end'>Total: </th>
                <th class='text-end'>$ {{ number_format($total) }}</th>
            </tr>
        </tbody>
    </table>
@endsection
@section('scripts')
    <script>
        function printReport() {
            document.querySelector('.sidebar').style.width = 0
            window.print();
            setTimeout(() => {
                document.querySelector('.sidebar').style.width = 'inherit'
            }, 2000);
        }
    </script>
@endsection
