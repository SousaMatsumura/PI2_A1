@extends('layouts.app')

@section('title', 'Cadastro da Escola')

@section('options')
    
@endsection

@section('content')
    
<div class="card">
    <div class="card-body p-2 bg-primary rounded">
        <div class="p-2">

            <form id="school-form" action="{{ route('school.institution.update') }}" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <input name="institution[name]" type="text" class="form-control @error('institution.name') is-invalid @enderror" placeholder="Nome" value="{{ old() ? old('institution.name') : $institution->name }}">
                            @error('institution.name')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input name="institution[phone]" type="text" class="form-control phone @error('institution.phone') is-invalid @enderror" placeholder="Telefone" value="{{ old() ? old('institution.phone') : $institution->phone }}">
                            @error('institution.phone')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input name="address[zipcode]" type="text" class="form-control zipcode @error('address.zipcode') is-invalid @enderror" placeholder="CEP" value="{{ old() ? old('address.zipcode') : $institution->address->zipcode }}">
                            @error('address.zipcode')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input name="address[street]" type="text" class="form-control @error('address.street') is-invalid @enderror" placeholder="Rua" value="{{ old() ? old('address.street') : $institution->address->street }}">
                            @error('address.street')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input name="address[number]" type="text" class="form-control @error('address.number') is-invalid @enderror" placeholder="Número" value="{{ old() ? old('address.number') : $institution->address->number }}">
                            @error('address.number')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input name="address[district]" type="text" class="form-control @error('address.district') is-invalid @enderror" placeholder="Bairro" value="{{ old() ? old('address.district') : $institution->address->district }}">
                            @error('address.district')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input name="address[city]" type="text" class="form-control @error('address.city') is-invalid @enderror" placeholder="Cidade" value="{{ old() ? old('address.city') : $institution->address->city }}">
                            @error('address.city')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select name="address[state]" type="text" class="form-control @error('address.state') is-invalid @enderror">
                                <option disabled selected>UF</option>
                                @foreach(config('enums.states') as $state)
                                    <option value="{{ $state['key'] }}" {{ (old('address.state') ?? $institution->address->state) == $state['key'] ? 'selected' : '' }}>
                                        {{ $state['key'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('address.state')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input name="address[complement]" type="text" class="form-control @error('address.complement') is-invalid @enderror" placeholder="Complemento" value="{{ old() ? old('address.complement') : $institution->address->complement }}">
                            @error('address.complement')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input name="institution[students]" type="text" class="form-control number @error('institution.students') is-invalid @enderror" placeholder="Alunos" value="{{ old() ? old('institution.students') : $institution->students }}">
                            @error('institution.students')
                                <div class="invalid-feedback bg-danger text-white rounded px-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center my-2">
                    <button id="submit-button" class="btn btn-primary active">
                        Atualizar Cadastro da Escola
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<div id="alert-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <p>Não foi possível localizar o endereço.</p>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('js/school/institution/edit.js') }}"></script>
@endpush