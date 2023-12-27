@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('child.index') }}">Children</a></li>
            <li class="breadcrumb-item active" aria-current="page">Child Profile</li>
        </ol>
    </nav>
    <div class="card card-body shadow-sm mb-3">
        <div class="d-flex flex-row">
            @if ($child->image)
                <img alt='{{ $child->first_name }}' src='{{ asset('storage/' . $child->image) }}' width='120'
                    height='120' style='object-fit:cover' class='rounded-pill me-3 my-auto' />
            @endif
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Full names</th>
                        <th>School</th>
                        <th>Birth date</th>
                        <th>Guardian</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $child->first_name }} {{ $child->last_name }}</td>
                        <td>{{ $child->school }}</td>
                        <td>{{ $child->dob }}</td>
                        <td>
                            {{ $child->contact_person }} <br />
                            {{ $child->contact_details }}
                        </td>
                        <td>{{ $child->address }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td colspan="3">{!! $child->description !!}</td>
                        <td>
                            @if (Auth::user()->role == 'sponsor')
                                <a href='{{ route('child.support', $child->id) }}' class='btn btn-sm btn-info'
                                    data-toggle="tooltip" title="Sponsor child">
                                    <i class='bi bi-check'></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($updates as $update)
        <div class='d-flex mb-2 hover-white p-2'>
            <img alt='{{ $update->user->name }}' src='/img/user.png' width='40' height='40' style='object-fit:cover'
                class='rounded-pill me-1' />
            <div class='ms-2 me-auto'>
                <h6>
                    {{ $update->user->name }} &middot;
                    <span class='text-muted'>{{ $update->created_at->diffForHumans() }}</span>
                </h6>
                {!! $update->content !!}
                @if ($update->attachment)
                    <img alt='.' src='{{ asset('storage/' . $update->attachment) }}' width='300'
                        style='object-fit:cover' />
                @endif
            </div>
            @if ($update->user_id == Auth::id())
                <form action='{{ route('update.destroy', $update->id) }}' method='post' class='d-inline'>
                    @csrf @method('delete')
                    <button class='btn btn-sm btn-warning rounded-pill'>
                        <i class='bi bi-x-lg'></i>
                    </button>
                </form>
            @endif
        </div>
    @endforeach
    {{ $updates->links() }}
    @if (in_array(Auth::user()->role, ['admin', 'coordinator']))
        <div class="card shadow-sm my-3">
            <div class="card-header">Post Update</div>
            <div class="card-body">
                @include('components.message')
                <form method='post' action='{{ route('update.store') }}' enctype="multipart/form-data">
                    <textarea id='editor' name="content" rows="2" class="form-control"></textarea>
                    <div class="d-flex justify-content-between mt-2">
                        <div>
                            @csrf
                            <input type="hidden" name="child" value='{{ $child->id }}' />
                            <input class='form-control' name='attachment' type='file' accept="image/*" />
                        </div>
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
@section('styles')
    <style>
        .hover-white:hover {
            background-color: whitesmoke;
        }
    </style>
@endsection
@section('scripts')
    <script src="/js/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#editor"));
    </script>
@endsection
