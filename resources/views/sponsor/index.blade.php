@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sponsor</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <h2>All sponsors</h2>
        <span>
            <a class='btn btn-outline-primary rounded-pill' href='{{ route('sponsor.create') }}'>
                <i class='bi bi-plus'></i> Add sponsor
            </a>
        </span>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Address</th>
                <th scope="col">Contact</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sponsors as $key => $sponsor)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        @if ($sponsor->image)
                            <img alt='{{ $sponsor->first_name }}' src='{{ asset('storage/' . $sponsor->image) }}'
                                width='40' height='40' style='object-fit:cover' class='rounded-pill me-1' />
                        @endif
                        {{ $sponsor->first_name }} {{ $sponsor->last_name }}
                    </td>
                    <td>{{ $sponsor->dob }}</td>
                    <td>{{ $sponsor->address }}</td>
                    <td>{{ $sponsor->contact }}</td>
                    <td>
                        <div class='btn-group'>
                            <a class='btn btn-sm btn-success' href='{{ route('sponsor.show', $sponsor->id) }}'>
                                <i class='bi bi-eye'></i>
                            </a>
                            <a class='btn btn-sm btn-info' href='{{ route('sponsor.edit', $sponsor->id) }}'>
                                <i class='bi bi-pencil'></i>
                            </a>
                        </div>
                        <form action='{{ route('sponsor.destroy', $sponsor->id) }}' method='post' class='d-inline'>
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
    {{ $sponsors->links() }}
@endsection
