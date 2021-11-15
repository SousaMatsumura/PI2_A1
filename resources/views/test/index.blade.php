@extends('layouts.app')

@section('title', 'Cadastrar Cardápio do Dia')

@push('css')
    <style>
        textarea { resize: none; }
    </style>
@endpush

@section('content')
    
    <form action="">
        <div class="form-group">
            <div class="row">
                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Dia: </label>
                </div>
                <div class="col-md-4">

                    <div class="input-group bg-primary rounded">
                        <input 
                            id="food-record-created-at" 
                            type="text" 
                            name="consumption[created_at]" 
                            class="form-control bg-primary text-white border-0 @error('consumption.created_at') is-invalid @enderror" 
                            placeholder="Buscar..." 
                            readonly
                            value="{{ old('consumption.created_at') }}"
                            data-url="{{ route('school.consumption.index') }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="food-record-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>
                    
                    @error('consumption.created_at')
                        <span class="text-danger d-block small">
                            {{ $errors->first('consumption.created_at') }}
                        </span>
                    @enderror
                </div>
            </div>
            
            
        </div>

        <div class="card bg-primary">
            <div class="card-body">

                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea name="" class="form-control" placeholder="Lanche da Manhã"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Quantidade">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Repetições">
                    </div>
                </div>
        
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea name="" class="form-control" placeholder="Almoço"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Quantidade">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Repetições">
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea name="" class="form-control" placeholder="Lanche da Tarde"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Quantidade">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Repetições">
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="form-group">
                            <textarea name="" class="form-control" placeholder="Janta"></textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Quantidade">
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" placeholder="Repetições">
                    </div>
                </div>
        
                <div class="form-group text-center">
                    <button class="btn btn-primary active">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection