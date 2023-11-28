@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Children</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <h2>All children</h2>
        <span>
            <a class='btn btn-outline-primary rounded-pill' href='{{ route('child.create') }}'>
                <i class='bi bi-plus'></i> Add child
            </a>
        </span>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">School</th>
                <th scope="col">Address</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($children as $key => $child)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        <img src='{{ $child->image }}' height="40" width='40' alt=''
                            class='rounded-pill me-1' />
                        {{ $child->first_name }} {{ $child->last_name }}
                    </td>
                    <td>{{ $child->dob }}</td>
                    <td>{{ $child->school }}</td>
                    <td>{{ $child->address }}</td>
                    <td>{{ $child->contact_person }} {{ $child->contact_details }}</td>
                    <td>
                        <div class='btn-group'>
                            <a class='btn btn-sm btn-success' href='{{ route('child.show', $child->id) }}'>
                                <i class='bi bi-eye'></i>
                            </a>
                            <a class='btn btn-sm btn-info' href='{{ route('child.edit', $child->id) }}'>
                                <i class='bi bi-pencil'></i>
                            </a>
                        </div>
                        <form action='{{ route('child.destroy', $child->id) }}' method='post' class='d-inline'>
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
    {{ $children->links() }}
@endsection
