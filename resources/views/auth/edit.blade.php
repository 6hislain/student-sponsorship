@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='text-center w-30'>
            <form action='{{ route('user.update', $user->id) }}' method='post' class='my-3'>
                <h2 class='mb-3'>Edit User</h2>
                @include('components.message')
                <div class="input-group mb-3">
                    <span class="input-group-text w-25">Name</span>
                    <input class='form-control' name='name' placeholder='full names' value='{{ $user->name }}' />
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text w-25">Email</span>
                    <input class='form-control' name='email' type='email' placeholder='my@email.com'
                        value='{{ $user->email }}' disabled />
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text w-25">Role</span>
                    <select name="role" class="form-select">
                        <option value='{{ $user->role }}'>{{ $user->role }}</option>
                        <option value='user'>user</option>
                        <option value='sponsor'>sponsor</option>
                        <option value='coordinator'>coordinator</option>
                        <option value='admin'>admin</option>
                    </select>
                </div>
                @csrf @method('put')
                <button type='submit' class='btn btn-primary rounded-pill w-10'>Submit</button>
            </form>
        </div>
    </div>
@endsection
