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
        <h2>Report</h2>
        <span>
            <a class='btn btn-outline-primary rounded-pill' href='{{ route('application.create') }}'>
                <i class='bi bi-plus'></i> Add application
            </a>
        </span>
    </div>
@endsection
