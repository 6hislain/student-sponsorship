@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sponsor.index') }}">Sponsor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sponsor Profile</li>
        </ol>
    </nav>
    @php
        $currentDate = new DateTime();
    @endphp
    <div class="card card-body shadow-sm">
        <div class="d-flex flex-row">
            @if ($sponsor->image)
                <img alt='{{ $sponsor->first_name }}' src='{{ asset('storage/' . $sponsor->image) }}' width='80'
                    height='80' style='object-fit:cover' class='rounded-pill me-3 my-auto' />
            @endif
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Contact</th>
                        <th colspan='2'>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $sponsor->first_name }}</td>
                        <td>{{ $sponsor->last_name }}</td>
                        <td>{{ $sponsor->contact }}</td>
                        <td>{{ $sponsor->address }}</td>
                        <td>
                            <a class='btn btn-sm btn-info' href='{{ route('sponsor.edit', $sponsor->id) }}'>
                                <i class='bi bi-pencil'></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 my-4">
            <h4>Supported Children</h4>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">School</th>
                        <th scope="col" colspan='2'>Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($children as $key => $child)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>
                                {{ $child->child->first_name }} {{ $child->child->last_name }}
                            </td>
                            <td>{{ $child->child->school }}</td>
                            <td>{{ $currentDate->diff(new DateTime($child->child->dob))->y }}</td>
                            <td>
                                <a class='btn btn-sm btn-success' href='{{ route('child.show', $child->child->id) }}'>
                                    <i class='bi bi-arrow-right'></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $children->links() }}
        </div>
        <div class="col-md-6 my-4">
            <h4>Contributed Payments</h4>
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Confirmed</th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $key => $payment)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $payment->currency }} {{ $payment->amount }}, {{ $payment->type }}</td>
                            <td>{{ $payment->confirmed ? 'yes' : 'no' }}</td>
                            <td>{{ $payment->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $payments->links() }}
        </div>
    </div>
@endsection
