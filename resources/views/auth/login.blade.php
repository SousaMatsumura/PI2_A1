@extends('layouts.app')

@section('title', 'Login')

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
    <div class="card w-25 mx-auto my-auto bg-primary text-white">
        <div class="card-body">
            <h1 class="text-center h3 font-weight-bold">Login</h1>

            <form id="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" value="{{ old('username') }}">
                    @error('username')
                    <div class="invalid-feedback text-white bg-danger p-1 rounded">
                        {{ $errors->first('username') }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Senha">
                    @error('password')
                    <div class="invalid-feedback text-white bg-danger p-1 rounded">
                        {{ $errors->first('password') }}
                    </div>
                    @enderror
                </div>
                <p class="small">
                    Esqueceu sua senha? Clique <a href="{{ route('password.request') }}" class="text-white font-weight-bold">AQUI</a> para recuperar
                </p>
                <button type="submit" class="btn btn-primary btn-block active">
                    Entrar
                </button>
            </form>

        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/auth/login/create.js') }}"></script>
@endpush