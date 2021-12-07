@extends('layouts.app')

@section('title', 'Cadastrar Alimento')

@section('options')
    <a href="{{ route('secretary.food.index') }}" class="btn btn-primary">
        Voltar
    </a>
@endsection

@section('content')

    <div class="card bg-primary">
        <div class="card-body p-0 pt-3 px-3">

            <form id="food-form" action="{{ route('secretary.food.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input name="food[name]" type="text" class="form-control @error('food.name') is-invalid @enderror" placeholder="Nome" value="{{ old('food.name') }}">
                            @error('food.name')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('food.name') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="food[unit]" class="form-control @error('food.unit') is-invalid @enderror">
                                <option disabled selected>Unidade de Medida</option>
                                @foreach(config('enums.food_units') as $unit)
                                    <option value="{{ $unit['key'] }}" {{ old('food.unit') == $unit['key'] ? 'selected' : '' }}>
                                        {{ $unit['label'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('food.unit')
                                <div class="invalid-feedback bg-danger text-white p-1 rounded">
                                    {{ $errors->first('food.unit') }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary active">Cadastrar Alimento</button>
                </div>

            </form>

        </div>
    </div>

    @if(session()->has('trashed'))
        <div id="restore-modal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h5 class="text-center d-block mb-3">Atenção</h5>
                        <p class="mb-0 text-center">Existe um alimento excluído com as mesmas informações.</p>
                        <ul>
                            <li><strong>Nome:</strong> {{ session('trashed')['name'] }}</li>
                            <li><strong>Unidade de Medida:</strong> {{ session('trashed')['unit'] }}</li>
                        </ul>
                        <p class="text-center mb-0">Deseja restaurar o cadastro do alimento?</p>
                    </div>
                    <div class="modal-footer border-0">
                        
                        <form action="{{ route('secretary.food.restore', session('trashed')) }}" method="POST" class="w-100 text-center">
                            @csrf
                            <button type="button" class="btn btn-secondary w-25" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary w-25">Restaurar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/secretary/food/create.js') }}"></script>
@endpush