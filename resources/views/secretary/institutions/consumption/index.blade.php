@extends('layouts.app')

@section('title', 'Consumo Diário: '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
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
                            class="form-control bg-primary text-white border-primary
                                @error('consumption.created_at') border-danger @enderror" 
                            placeholder="Buscar..." 
                            readonly
                            value="{{ old('consumption.created_at') }}"
                            data-url="{{ route('secretary.institution.consumption.index', $institution) }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0"
                                id="consumption-created-at-datepicker-icon">
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
                <div class="col-md text-right">
                    <a href="{{ route('secretary.institution.show', $institution) }}" class="btn btn-primary">Voltar</a>
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
                            <th class="text-center">Quantidade Consumida</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($foodRecords as $record)
                            <tr class="bg-white">
                                <td class="p-2">{{ $record->name }}</td>
                                <td class="text-center">{{ $record->unit }}</td>
                                <td id="food-{{ $record->id }}-amount_consumed" class="w-25 text-center"></td>
                            </tr>
                        @endforeach
                    </tbody>
        
                </table>
            </div>
           
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('js/secretary/school/consumption/index.js') }}"></script>
@endpush