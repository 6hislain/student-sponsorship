@extends('layouts.dashboard')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payment.index') }}">Payment</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <div class='d-flex justify-content-center align-items-center h-75'>
        <div class='w-75'>
            <form action='{{ route('payment.update', $payment->id) }}' method='post' enctype="multipart/form-data">
                <h2 class='mb-3'>Edit payment</h2>
                @include('components.message')
                <div class='row'>
                    <div class='col-md-2'>
                        <select class='form-select mb-3' name='currency'>
                            <option value='{{ $payment->currency }}'>{{ $payment->currency }}</option>
                            <option value='USD'>USD</option>
                            <option value='EUR'>EUR</option>
                            <option value='RWF'>RWF</option>
                        </select>
                    </div>
                    <div class='col-md-4'>
                        <input class='form-control mb-3' name='amount' placeholder='amount' type='number'
                            value='{{ $payment->amount }}' />
                    </div>
                    <div class='col-md-3'>
                        <select class='form-select mb-3' name='type'>
                            <option value='{{ $payment->type }}'>{{ $payment->type }}</option>
                            <option value='regular'>regular</option>
                            <option value='donation'>donation</option>
                        </select>
                    </div>
                    <div class='col-md-3'>
                        <select class='form-select mb-3' name='sponsor'>
                            <option value='{{ $payment->sponsor_id }}'>
                                {{ $payment->sponsor->first_name }} {{ $payment->sponsor->last_name }}
                            </option>
                            @foreach ($sponsors as $sponsor)
                                <option value='{{ $sponsor->id }}'>
                                    {{ $sponsor->first_name }} {{ $sponsor->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="attachment" class='form-label'>Attach document</label>
                        <input class='form-control mb-3' name='attachment' type='file'
                            accept="image/*,.doc,.docx,.pdf" />
                    </div>
                    <div class='col-md-3'>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="confirmed"
                                value="{{ $payment->confirmed ? 'on' : '' }}">
                            <label class="form-check-label" for="confirmed">
                                Payment Received
                            </label>
                        </div>
                    </div>
                </div>
                <textarea id='editor' class='form-control' name='description' placeholder="write more details">
                    {{ $payment->description }}
                </textarea>
                @csrf @method('put')
                <div class='d-flex justify-content-between mt-3'>
                    <button type='submit' class='btn btn-primary rounded-pill w-10'>Submit</button>
                    <a href='{{ route('payment.index') }}' class='btn btn-outline-primary rounded-pill w-10'>
                        All payments
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
