@extends('layouts.app')

@push('css')
    <style>

        #content-wrapper {
            min-height: 100vh;
        }

        .container-fluid {
            min-height: 70vh !important;            
            display: flex !important;
            align-items: center !important;
        }

    </style>
@endpush

@section('content')

<div class="card w-50 mx-auto my-auto bg-primary text-white">
    <div class="card-body">
        
        <h1 class="text-center h3 font-weight-bold">Modificar Senha</h1>

        <form id="password-request-form" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ $email ?? old('email') }}">
                @error('email')
                    <div class="invalid-feedback text-white bg-danger p-1 rounded">
                        {{ $errors->first('email') }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Nova Senha</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback text-white bg-danger p-1 rounded">
                        {{ $errors->first('password') }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Confirme a Senha</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                @error('password_confirmation')
                    <div class="invalid-feedback text-white bg-danger p-1 rounded">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block active">
                Modificar Senha
            </button>
        </form>

    </div>
</div>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
