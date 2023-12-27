@extends('layouts.default')
@section('content')
    <nav aria-label="breadcrumb" class='d-none'>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sponsor Application</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='w-75'>
            <form action='{{ route('approve') }}' method='post' enctype="multipart/form-data">
                <h2 class='mb-3'>View application for sponsorship</h2>
                @include('components.message')
                <div class='row'>
                    <div class='col-md-4'>
                        <select class='form-select mb-3' name='destination'>
                            <option value='{{ $application->destination }}'>{{ $application->destination }}</option>
                            <option value='gikongoro'>gikongoro</option>
                            <option value='byumba'>byumba</option>
                            <option value='kayonza'>kayonza</option>
                            <option value='kigali'>kigali</option>
                        </select>
                    </div>
                    <div class='col-md-2'>
                        <select class='form-select mb-3' name='currency'>
                            <option value="{{ $application->currency }}">{{ $application->currency }}</option>
                            <option value='USD'>USD</option>
                            <option value='EUR'>EUR</option>
                            <option value='RWF'>RWF</option>
                        </select>
                    </div>
                    <div class='col-md-3'>
                        <input class='form-control mb-3' name='amount' placeholder='amount' type='number'
                            value='{{ $application->amount }}' />
                    </div>
                    <div class='col-md-3'>
                        <select class='form-select mb-3' name='frequency'>
                            <option value='{{ $application->frequency }}'>{{ $application->frequency }}</option>
                            <option value='monthly'>monthly</option>
                            <option value='quarterly'>quarterly</option>
                        </select>
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='first_name' placeholder='first name'
                            value='{{ $application->first_name }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='last_name' placeholder='last name'
                            value='{{ $application->last_name }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='email' type='email' placeholder='my@email.com'
                            value='{{ $application->email }}' />
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='address' placeholder='address'
                            value='{{ $application->address }}' />
                    </div>
                    <div class="col-md-4">
                        <select class='form-select mb-3' name='country'>
                            <option value="{{ $application->country }}">{{ $application->country }}</option>
                            <option value="United States">United States</option>
                            <option value="China">China</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Brazil">Brazil</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Japan">Japan</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Egypt">Egypt</option>
                            <option value="Vietnam">Vietnam</option>
                        </select>
                    </div>
                    <div class='col-12 mb-3'>
                        <textarea id='editor' class='form-control' name='message' placeholder="write a message">{{ $application->message }}</textarea>
                    </div>
                    <div class='col-md-4'>
                        <label for="dob" class='form-label'>Date of birth</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Date</span>
                            <input class='form-control' name='dob' placeholder='date of birth' type='date'
                                value='{{ old('dob') }}' required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="identification" class='form-label'>National ID or passport</label>
                        <input class='form-control mb-3' name='identification' type='file'
                            accept="image/*,.doc,.docx,.pdf" required />
                    </div>
                    <div class="col-md-4">
                        <label for="image" class='form-label'>Profile picture</label>
                        <input class='form-control mb-3' name='image' type='file' accept="image/*" required />
                        <input type="hidden" name="application" value='{{ $application->id }}'>
                    </div>
                </div>
                @csrf
                <div class='d-flex justify-content-between mt-3'>
                    <button type='submit' class='btn btn-primary rounded-pill w-10'>Approve</button>
                    <a href='{{ route('application.index') }}' class='btn btn-outline-primary rounded-pill w-10'>
                        All applications
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
