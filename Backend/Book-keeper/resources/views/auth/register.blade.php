@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 80vh">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" style="text-align: center">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-center align-items-center mb-2 flex-column">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label for="name" class=" col-form-label text-md-end">{{ __('Name') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group mb-2">
                            <label for="password-confirm" class=" col-form-label text-md-end">{{ __('Confirm Password') }}</label>


                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="form-group mb-2">

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>

                        </div>
                    </form>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('images/login.jpg') }}" alt="Background Image" class="img-fluid" style="height: 100%;max-height:450px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
