@extends('layouts.app')

@section('title', 'Entrada de Alimentos: '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <form id="food-record-form" action="{{ route('secretary.school.food_record.store', $institution) }}" method="POST">
       
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
                                id="food-record-created-at" 
                                type="text" 
                                name="food_record[created_at]" 
                                class="form-control bg-primary text-white border-primary @error('food_record.created_at') border-danger @enderror" 
                                placeholder="Buscar..." 
                                readonly
                                value="{{ old('food_record.created_at') }}"
                                data-url="{{ route('secretary.school.food_record.index', ['institution_id' => $institution->id]) }}"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary border-0" id="food-record-created-at-datepicker-icon">
                                    <i class="fa fa-fw fa-calendar text-white"></i>
                                </span>
                            </div>
                        </div>
                        
                        @error('food_record.created_at')
                            <span class="text-danger d-block small">
                                {{ $errors->first('food_record.created_at') }}
                            </span>
                        @enderror
                    </div>
                    <div class="col-md text-right">
                        <a href="{{ route('secretary.institution.show', $institution) }}" class="btn btn-primary">Voltar</a>
                    </div>
                </div>
                
                
            </div>
        </div>
        {{-- @dd($foods->toArray()) --}}
        <div id="foods-card" class="card">
            <div class="card-body p-2 bg-primary">
                <div class="p-2 bg-white">

                    <table id="foods-table" class="table table-borderless table-sm w-100 m-0">
                        <thead>
                            <tr class="bg-white border-bottom">
                                <th class="p-2">Alimentos</th>
                                <th class="text-center">Unidade de Medida</th>
                                <th class="text-center">Quantidade Atual</th>
                                <th class="text-center">Entrada</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($foods as $food)
                                <tr class="bg-white">
                                    <td class="p-2">{{ $food->name }}</td>
                                    <td class="text-center">{{ $food->unit }}</td>
                                    <td class="text-center food-amount-remaining">{{ $food->amount_remaining }}</td>
                                    <td class="w-25">
                                        <div class="form-group m-0">
                                            <input 
                                                type="text" 
                                                name="foods[{{ $food->id }}][amount]" 
                                                placeholder="00"
                                                class="form-control form-control-sm border-top-0 border-left-0 border-right-0 rounded-0 text-center digits @error('foods.'.$food->id.'.amount') is-invalid @enderror"
                                                value="{{ old('foods.'.$food->id.'.amount')}}"
                                                data-min="{{ $food->amount_consumed }}"
                                            >
                                            @error('foods.'.$food->id.'.amount')
                                                <span class="text-danger d-block small text-center">
                                                    {{ $errors->first('foods.'.$food->id.'.amount') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
            
                    </table>
                </div>
                <div class="text-center my-2">
                    <button id="submit-button" class="btn btn-primary active">
                        Cadastrar Entrada de Alimentos
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
    <script src="{{ asset('js/secretary/food_record/create.js') }}"></script>
@endpush