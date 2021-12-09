@extends('layouts.app')

@section('title', 'Cadastrar Cardápio do Dia')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <form id="menu-form" action="{{ route('school.menu.store') }}" method="POST">
       
        @csrf
       
        <div class="mb-4">
            <div class="form-group">
                <div class="row">
                    <div class="col-auto d-flex align-items-center py-0 pr-0">
                        <label class="my-auto">Dia: </label>
                    </div>
                    <div class="col-md-4">

                        <div class="input-group bg-primary rounded">
                            <input 
                                id="menu-created-at" 
                                type="text" 
                                name="menu[created_at]" 
                                class="form-control bg-primary text-white border-0 @error('menu.created_at') is-invalid @enderror" 
                                placeholder="Buscar..." 
                                readonly
                                value="{{ old('menu.created_at') }}"
                                data-url="{{ route('school.menu.index') }}"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary border-0" id="food-record-created-at-datepicker-icon">
                                    <i class="fa fa-fw fa-calendar text-white"></i>
                                </span>
                            </div>
                        </div>
                        
                        @error('menu.created_at')
                            <span class="small text-danger">
                                {{ $errors->first('menu.created_at') }}
                            </span>
                        @enderror
                    </div>
                </div>
                
                
            </div>
        </div>

        <div id="meals-card" class="card">
            <div class="card-body p-2 bg-primary">
                <div class="p-2">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea name="meals[breakfast][description]" class="form-control @error('meals.breakfast.description') is-invalid @enderror" placeholder="Lanche da Manhã">{{ old('meals.breakfast.description') }}</textarea>
                                @error('meals.breakfast.description')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.breakfast.description') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[breakfast][amount]" class="form-control digits @error('meals.breakfast.amount') is-invalid @enderror" placeholder="Quantidade" value="{{ old('meals.breakfast.amount') }}">
                                @error('meals.breakfast.amount')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.breakfast.amount') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[breakfast][repeat]" class="form-control digits @error('meals.breakfast.repeat') is-invalid @enderror" placeholder="Repetições" value="{{ old('meals.breakfast.repeat') }}">
                                @error('meals.breakfast.repeat')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.breakfast.repeat') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea name="meals[lunch][description]" class="form-control @error('meals.lunch.description') is-invalid @enderror" placeholder="Almoço">{{ old('meals.lunch.description') }}</textarea>
                                @error('meals.lunch.description')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.lunch.description') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[lunch][amount]" class="form-control digits @error('meals.lunch.amount') is-invalid @enderror" placeholder="Quantidade" value="{{ old('meals.lunch.amount') }}">
                                @error('meals.lunch.amount')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.lunch.amount') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[lunch][repeat]" class="form-control digits @error('meals.lunch.repeat') is-invalid @enderror" placeholder="Repetições" value="{{ old('meals.lunch.repeat') }}">
                                @error('meals.lunch.repeat')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.lunch.repeat') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea name="meals[afternoon_snack][description]" class="form-control @error('meals.afternoon_snack.description') is-invalid @enderror" placeholder="Lanche da Tarde">{{ old('meals.afternoon_snack.description') }}</textarea>
                                @error('meals.afternoon_snack.description')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.afternoon_snack.description') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[afternoon_snack][amount]" class="form-control digits @error('meals.afternoon_snack.amount') is-invalid @enderror" placeholder="Quantidade" value="{{ old('meals.afternoon_snack.amount') }}">
                                @error('meals.afternoon_snack.amount')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.afternoon_snack.amount') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[afternoon_snack][repeat]" class="form-control digits @error('meals.afternoon_snack.repeat') is-invalid @enderror" placeholder="Repetições" value="{{ old('meals.afternoon_snack.repeat') }}">
                                @error('meals.afternoon_snack.repeat')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.afternoon_snack.repeat') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <textarea name="meals[dinner][description]" class="form-control @error('meals.dinner.description') is-invalid @enderror" placeholder="Janta">{{ old('meals.dinner.description') }}</textarea>
                                @error('meals.dinner.description')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.dinner.description') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[dinner][amount]" class="form-control digits @error('meals.dinner.amount') is-invalid @enderror" placeholder="Quantidade" value="{{ old('meals.dinner.amount') }}">
                                @error('meals.dinner.amount')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.dinner.amount') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="text" name="meals[dinner][repeat]" class="form-control digits @error('meals.dinner.repeat') is-invalid @enderror" placeholder="Repetições" value="{{ old('meals.dinner.repeat') }}">
                                @error('meals.dinner.repeat')
                                    <span class="invalid-feedback bg-danger text-white p-1 rounded">
                                        {{ $errors->first('meals.dinner.repeat') }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="text-center my-2">
                    <button id="submit-button" class="btn btn-primary active">
                        Cadastrar Cardápio do Dia
                    </button>
                </div>
            </div>
        </div>
    </form>   
@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('js/school/menu/create.js') }}"></script>
@endpush