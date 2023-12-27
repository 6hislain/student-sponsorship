@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>
    <div class="card mb-3">
        <div class="card-header">User Information</div>
        <div class="card-body">
            <table class='table table-bordered table-hover'>
                <tr>
                    <th>Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td>{{ $user->role }}</td>
                </tr>
            </table>
        </div>
    </div>
    @foreach ($sponsors as $sponsor)
        <div class='card mb-3'>
            <div class="card-header">Sponsor Information</div>
            <div class="card-body shadow-sm">
                <div class="d-flex flex-row">
                    <img src='{{ $sponsor->image }}' height="120" width='120' alt='{{ $sponsor->first_name }}'
                        class='rounded-pill me-3 my-auto' />
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Contact</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $sponsor->first_name }}</td>
                                <td>{{ $sponsor->last_name }}</td>
                                <td>{{ $sponsor->contact }}</td>
                                <td>{{ $sponsor->address }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td colspan="3">{{ $sponsor->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection
