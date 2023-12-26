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
            <img src='{{ $child->image }}' height="120" width='120' alt='{{ $child->first_name }}'
                class='rounded-pill me-3 my-auto' />
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
                        <td colspan="4">{{ $child->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @foreach ($updates as $update)
        <div>
            {!! $update->content !!}
            @if ($update->attachment)
                <img alt='.' src='{{ asset('storage/' . $update->attachment) }}' width='300'
                    style='object-fit:cover' />
            @endif
        </div>
    @endforeach
    {{ $updates->links() }}
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
@endsection
@section('scripts')
    <script src="/js/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector("#editor"));
    </script>
@endsection
