@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sponsor Application</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <h2>All sponsor applications</h2>
        <span>
            <a class='btn btn-outline-primary rounded-pill' href='{{ route('application.create') }}'>
                <i class='bi bi-plus'></i> Add application
            </a>
        </span>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Donation</th>
                <th scope="col">Address</th>
                <th scope="col">User</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $application)
                <tr>
                    <th scope="row">{{ $application->id }}</th>
                    <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                    <td>{{ $application->currency }} {{ $application->amount }}, {{ $application->frequency }}</td>
                    <td>{{ $application->country }}, {{ $application->address }}</td>
                    <td>{{ $application->user->name }}</td>
                    <td>
                        <div class='btn-group'>
                            <a class='btn btn-sm btn-success' href='{{ route('application.show', $application->id) }}'>
                                <i class='bi bi-eye'></i>
                            </a>
                            <a class='btn btn-sm btn-info' href='{{ route('application.edit', $application->id) }}'>
                                <i class='bi bi-pencil'></i>
                            </a>
                        </div>
                        <form action='{{ route('application.destroy', $application->id) }}' method='post'
                            class='d-inline'>
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
    {{ $applications->links() }}
@endsection
