@extends('layouts.app')

@section('title', 'Editar Funcionário')

@section('options')
    <a href="{{ route('secretary.user.index') }}" class="btn btn-primary">
        Voltar
    </a>
@endsection

@section('content')

    <div class="card bg-primary">
        <div class="card-body p-0 pt-3 px-3">

            <form id="user-form" action="{{ route('secretary.user.update', $user->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[name]" type="text" class="form-control @error('user.name') is-invalid @enderror" placeholder="Nome" value="{{ old() ? old('user.name') : $user->name }}">
                            @error('user.name')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.name') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="user[institution_id]" class="form-control @error('user.institution_id') is-invalid @enderror">
                                <option disabled selected>Escola / Instituição</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" {{ (old('user.institution_id') ?? $user->institution_id) == $institution->id ? 'selected' : '' }}>
                                        {{ $institution->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user.institution_id')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.institution_id') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[email]" type="text" class="form-control @error('user.email') is-invalid @enderror" placeholder="Email" value="{{ old() ? old('user.email') : $user->email }}">
                            @error('user.email')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.email') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[phone]" type="text" class="form-control phone @error('user.phone') is-invalid @enderror" placeholder="Telefone" value="{{ old() ? old('user.phone') : $user->phone }}">
                            @error('user.phone')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.phone') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[username]" type="text" class="form-control @error('user.username') is-invalid @enderror" placeholder="Username" value="{{ old() ? old('user.username') : $user->username }}">
                            @error('user.username')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.username') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[password]" type="text" class="form-control @error('user.password') is-invalid @enderror" placeholder="Nova Senha">
                            @error('user.password')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.password') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary active">Atualizar Funcionário</button>
                </div>

            </form>

        </div>
    </div>

    @if(auth()->user()->id != $user->id)
        <div class="row mt-5">
            <div class="col-md-12 text-right">
                <button class="btn btn-danger" data-toggle="modal" data-target="#remove-modal">
                    Excluir Funcionário
                </button>
            </div>
        </div>

        <div id="remove-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5 class="text-center d-block mb-3">Atenção</h5>
                        <p class="mb-0">Deseja realmente excluir o cadastro do funcionário <strong>{{ $user->name }}</strong> ?</p>
                    </div>
                    <div class="modal-footer border-0">
                        <form action="{{ route('secretary.user.destroy', $user) }}" method="POST" class="w-100 text-center">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger w-25">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/secretary/user/edit.js') }}"></script>
@endpush