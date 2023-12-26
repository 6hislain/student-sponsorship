@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Updates</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-between'>
        <h2>All updates</h2>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Child</th>
                <th scope="col">Content</th>
                <th scope="col">Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($updates as $key => $update)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>
                        {{ $update->child->first_name }}
                        {{ $update->child->last_name }}
                    </td>
                    <td>
                        {!! $update->content !!}
                        @if ($update->attachment)
                            <img alt='.' src='{{ asset('storage/' . $update->attachment) }}' width='100'
                                style='object-fit:cover' />
                        @endif
                    </td>
                    <td>{{ $update->created_at }}</td>
                    <td>
                        <a class='btn btn-sm btn-success' href='{{ route('child.show', $update->child_id) }}'>
                            <i class='bi bi-eye'></i>
                        </a>
                        <form action='{{ route('update.destroy', $update->id) }}' method='post' class='d-inline'>
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
    {{ $updates->links() }}
@endsection
