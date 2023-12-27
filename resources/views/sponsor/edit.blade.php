@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('sponsor.index') }}">Sponsor</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Sponsor</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='w-75'>
            <form action='{{ route('sponsor.update', $sponsor->id) }}' method='post' enctype="multipart/form-data">
                <h2 class='mb-3'>Edit sponsor</h2>
                @include('components.message')
                <div class='row'>
                    <div class='col-md-2'>
                        <input class='form-control mb-3' name='first_name' placeholder='first name'
                            value='{{ $sponsor->first_name }}' />
                    </div>
                    <div class='col-md-2'>
                        <input class='form-control mb-3' name='last_name' placeholder='last name'
                            value='{{ $sponsor->last_name }}' />
                    </div>
                    <div class='col-md-3'>
                        <input class='form-control mb-3' name='contact' placeholder='phone or email'
                            value='{{ $sponsor->contact }}' />
                    </div>
                    <div class='col-md-2'>
                        <input class='form-control mb-3' name='address' placeholder='address'
                            value='{{ $sponsor->address }}' />
                    </div>
                    <div class='col-md-3'>
                        <select name="user" id="" class="form-select">
                            <option value="{{ $sponsor->user_id }}">{{ $sponsor->user->name }}</option>
                            @foreach ($users as $user)
                                <option value='{{ $user->id }}'>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class='col-md-4'>
                        <label for="dob" class='form-label'>Date of birth</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Date</span>
                            <input class='form-control' name='dob' placeholder='date of birth' type='date'
                                value='{{ $sponsor->dob }}' />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="identification" class='form-label'>National ID or passport</label>
                        <input class='form-control mb-3' name='identification' type='file'
                            accept="image/*,.doc,.docx,.pdf" />
                    </div>
                    <div class="col-md-4">
                        <label for="image" class='form-label'>Profile picture</label>
                        <input class='form-control mb-3' name='image' type='file' accept="image/*" />
                    </div>
                </div>
                <textarea id='editor' class='form-control' name='description' placeholder="write more details">
                    {{ $sponsor->description }}
                </textarea>
                @csrf @method('put')
                <div class='d-flex justify-content-between mt-3'>
                    <button type='submit' class='btn btn-primary rounded-pill w-10'>Submit</button>
                    <a href='{{ route('sponsor.index') }}' class='btn btn-outline-primary rounded-pill w-10'>
                        All sponsors
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
