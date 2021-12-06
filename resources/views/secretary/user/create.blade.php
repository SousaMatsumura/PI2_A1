@extends('layouts.app')

@section('title', 'Cadastrar Funcionário')

@section('options')
    <a href="{{ route('secretary.user.index') }}" class="btn btn-primary">
        Voltar
    </a>
@endsection

@section('content')

    <div class="card bg-primary">
        <div class="card-body p-0 pt-3 px-3">

            <form id="user-form" action="{{ route('secretary.user.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[name]" type="text" class="form-control @error('user.name') is-invalid @enderror" placeholder="Nome" value="{{ old('user.name') }}">
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
                                    <option value="{{ $institution->id }}" {{ old('user.institution_id') == $institution->id ? 'selected' : '' }}>
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
                            <input name="user[email]" type="text" class="form-control @error('user.email') is-invalid @enderror" placeholder="Email" value="{{ old('user.email') }}">
                            @error('user.email')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.email') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[phone]" type="text" class="form-control phone @error('user.phone') is-invalid @enderror" placeholder="Telefone" value="{{ old('user.phone') }}">
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
                            <input name="user[username]" type="text" class="form-control @error('user.username') is-invalid @enderror" placeholder="Username" value="{{ old('user.username') }}">
                            @error('user.username')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.username') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="user[password]" type="text" class="form-control @error('user.password') is-invalid @enderror" placeholder="Senha">
                            @error('user.password')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('user.password') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary active">Cadastrar Funcionário</button>
                </div>

            </form>

        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/secretary/user/create.js') }}"></script>
@endpush