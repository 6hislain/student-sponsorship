@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb" class='hide-navigation'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Report</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <img alt='logo' src='/img/logo.png' height='75' width='200' />
        <div class='hide-button'>
            <button class='btn btn-primary' onclick='printReport()'>
                <i class='bi bi-file-break'></i> PRINT
            </button>
        </div>
    </div>
    <h2 class='text-center my-3'>Payment Report</h2>
    <table class="table table-bordered table-hover my-2">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Sponsor's Name</th>
                <th scope="col" width='20%'>Supported Children</th>
                <th scope="col" width='10%'>Transactions</th>
                <th scope="col" width='20%' class='text-end'>Amount Donated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $key => $payment)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        @if ($payment->sponsor->image)
                            <img alt='{{ $payment->sponsor->first_name }}'
                                src='{{ asset('storage/' . $payment->sponsor->image) }}' width='32' height='32'
                                style='object-fit:cover' class='rounded-pill me-1' />
                        @endif
                        {{ $payment->sponsor->first_name }} {{ $payment->sponsor->last_name }}
                    </td>
                    <td>{{ count($payment->sponsor->childSupport ?: []) }}</td>
                    <td>{{ count($payment->sponsor->payments ?: []) }}</td>
                    <td class='text-end'>RWF {{ number_format($payment->totalAmount) }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan='4' class='text-end'>Total: </th>
                <th class='text-end'>RWF {{ number_format($total) }}</th>
            </tr>
        </tbody>
    </table>
    <div class="float-end my-3 show-credit">
        <h6 class='text-muted text-end'>
            {{ now()->format('l, F j, Y') }} <br />
            prepared by {{ Auth::user()->name }}
        </h6>
    </div>
@endsection
@section('scripts')
    <script>
        document.querySelector('.show-credit').style.display = 'none'

        function printReport() {
            document.querySelector('.sidebar').style.width = 0
            document.querySelector('.show-credit').style.display = ''
            document.querySelector('.hide-button').style.display = 'none'
            document.querySelector('.hide-navigation').style.display = 'none'
            window.print();
            setTimeout(() => {
                document.querySelector('.sidebar').style.width = 'inherit'
                document.querySelector('.hide-button').style.display = ''
                document.querySelector('.show-credit').style.display = 'none'
                document.querySelector('.hide-navigation').style.display = ''
            }, 2000);
        }
    </script>
@endsection
