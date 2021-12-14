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
            flex-direction: column;
        }

    </style>
@endpush

@section('title', 'Recuperar Senha')

@section('content')

    @if(session()->has('status'))
        <div class="alert bg-success alert-dismissible fade show text-white mt-5" role="alert">
            <strong><i class="fa fa-fw fa-check"></i></strong> {!! session('status') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card w-50 mx-auto my-auto bg-primary text-white">
        <div class="card-body">
            
            <h1 class="text-center h3 font-weight-bold">Recuperar Senha</h1>

            <form id="password-request-form" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback text-white bg-danger p-1 rounded">
                            {{ $errors->first('email') }}
                        </div>
                    @enderror
                </div>
                <p class="small">
                    Lembrou sua senha? Clique <a href="{{ route('login') }}" class="text-white font-weight-bold">AQUI</a> para retornar ao login
                </p>
                <button type="submit" class="btn btn-primary btn-block active">
                    Enviar link para redefinir senha
                </button>
            </form>

        </div>
    </div>

@endsection
