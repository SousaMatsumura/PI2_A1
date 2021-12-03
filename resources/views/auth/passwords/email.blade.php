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

@section('title', 'Recuperar Senha')

@section('content')

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
                <button type="button" class="btn btn-primary btn-block active" data-toggle="modal" data-target="#wait-modal">
                    Enviar link para redefinir senha
                </button>
            </form>

        </div>
    </div>

    <div id="wait-modal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ asset('img/wait.svg') }}" alt="" class="img-fluid w-50">
                    <p class="m-0 text-uppercase font-weight-bold h4 mt-5">Em desenvolvimento</p>
                    <p>Estamos trabalhando neste recurso</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
