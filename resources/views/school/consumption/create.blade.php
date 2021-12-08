@extends('layouts.app')

@section('title', 'Cadastrar Consumo Diário')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')

    <form id="consumption-form" action="{{ route('school.consumption.store') }}" method="POST">
       
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
                                id="consumption-created-at" 
                                type="text" 
                                name="consumption[created_at]" 
                                class="form-control bg-primary text-white border-0 @error('consumption.created_at') is-invalid @enderror" 
                                placeholder="Buscar..." 
                                readonly
                                value="{{ old('consumption.created_at') }}"
                                data-url="{{ route('school.consumption.index') }}"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text bg-primary border-0" id="consumption-created-at-datepicker-icon">
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
        </div>

        <div id="foods-card" class="card">
            <div class="card-body p-2 bg-primary">
                <div class="p-2 bg-white">

                    <table id="foods-table" class="table table-borderless table-sm w-100 m-0">
                        <thead>
                            <tr class="bg-white border-bottom">
                                <th class="p-2">Alimentos</th>
                                <th class="text-center">Unidade de Medida</th>
                                <th class="text-center">Quantidade Atual</th>
                                <th class="text-center">Quantidade Consumida</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($foodRecords as $record)
                                <tr class="bg-white">
                                    <td class="p-2">{{ $record->name }}</td>
                                    <td class="text-center">{{ $record->unit }}</td>
                                    <td class="text-center record-amount-remaining">{{ $record->amount_remaining }}</td>
                                    <td class="w-25">
                                        <div class="form-group m-0">
                                            <input 
                                                type="text" 
                                                name="foods[{{ $record->id }}][amount_consumed]" 
                                                placeholder="00"
                                                class="form-control form-control-sm border-top-0 border-left-0 border-right-0 rounded-0 text-center digits @error('foods.'.$record->id.'.amount_consumed') is-invalid @enderror"
                                                data-max="{{ (int)$record->amount_remaining }}"
                                                value={{ old('foods.'.$record->id.'.amount_consumed')}}
                                            >
                                            @error('foods.'.$record->id.'.amount_consumed')
                                                <span class="text-danger d-block small text-center">
                                                    {{ $errors->first('foods.'.$record->id.'.amount_consumed') }}
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
                        Cadastrar Consumo Diário
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
    <script src="{{ asset('js/school/consumption/create.js') }}"></script>
@endpush