@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('child.index') }}">Children</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Child</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='text-center w-75'>
            <form action='{{ route('child.update', $child->id) }}' method='post' enctype="multipart/form-data">
                <h2 class='mb-3'>Edit child details</h2>
                @include('components.message')
                <div class='row'>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='first_name' placeholder='first name'
                            value='{{ $child->first_name }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='last_name' placeholder='last name'
                            value='{{ $child->last_name }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='school' placeholder='school' value='{{ $child->school }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='address' placeholder='address'
                            value='{{ $child->address }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='contact_person' placeholder='contact person name'
                            value='{{ $child->contact_person }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='contact_details' placeholder='contact details (phone, email)'
                            value='{{ $child->contact_details }}' />
                    </div>
                    <div class='col-md-6'>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Birth date</span>
                            <input class='form-control' name='dob' placeholder='date of birth' type='date'
                                value='{{ $child->dob }}' />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <input class='form-control mb-3' name='image' type='file' accept="image/*" />
                    </div>
                </div>
                <textarea id='editor' class='form-control' name='description' placeholder="write more details">
                    {{ $child->description }}
                </textarea>
                @csrf @method('put')
                <div class='d-flex justify-content-between mt-3'>
                    <button type='submit' class='btn btn-primary rounded-pill w-10'>Submit</button>
                    <a href='{{ route('child.index') }}' class='btn btn-outline-primary rounded-pill w-10'>
                        All children
                    </a>
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
