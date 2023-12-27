@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payment</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <h2>All payments</h2>
        <span>
            <a class='btn btn-outline-primary rounded-pill' href='{{ route('payment.create') }}'>
                <i class='bi bi-plus'></i> Add payment
            </a>
        </span>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Confirmed</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $key => $payment)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $payment->sponsor->first_name }} {{ $payment->sponsor->last_name }}
                    </td>
                    <td>{{ $payment->currency }} {{ $payment->amount }}, {{ $payment->type }}</td>
                    <td>{{ $payment->confirmed ? 'yes' : 'no' }}</td>
                    <td>{{ $payment->created_at }}</td>
                    <td>
                        @if (!$payment->confirmed)
                            <a class='btn btn-sm btn-info' href='{{ route('payment.edit', $payment->id) }}'>
                                <i class='bi bi-pencil'></i>
                            </a>
                        @endif
                        <form action='{{ route('payment.destroy', $payment->id) }}' method='post' class='d-inline'>
                            @csrf @method('delete')
                            <button class='btn btn-sm btn-warning'>
                                <i class='bi bi-trash'></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $payments->links() }}
@endsection
