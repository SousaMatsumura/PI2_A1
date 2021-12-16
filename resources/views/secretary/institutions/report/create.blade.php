@extends('layouts.app')

@section('title', $institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print-report.css') }}">
@endpush

@section('content')
<div class="mb-4">

    <form id="report-form" class="form-inline" method="{{ route('secretary.institution.report.create', $institution) }}">
        
        <label class="my-1 mr-2">Início: </label>
        <div class="input-group bg-primary rounded">
            <input 
                id="report-begin" 
                type="text" 
                name="inicio" 
                class="form-control bg-primary text-white border-primary
                    @error('report.begin') border-danger @enderror" 
                placeholder="Buscar..." 
                readonly
                value="{{ request()->get('inicio') }}"
            >
            <div class="input-group-append">
                <span class="input-group-text bg-primary border-0"
                    id="report-begin-datepicker-icon">
                    <i class="fa fa-fw fa-calendar text-white"></i>
                </span>
            </div>
        </div>
        
        @error('report.begin')
            <span class="text-danger d-block small">
                {{ $message }}
            </span>
        @enderror
      
        <label class="my-1 ml-4 mr-2">Final: </label>
        <div class="input-group bg-primary rounded">
            <input 
                id="report-end" 
                type="text" 
                name="final" 
                class="form-control bg-primary text-white border-primary
                    @error('report[end]') border-danger @enderror" 
                placeholder="Buscar..." 
                readonly
                value="{{ request()->get('final') }}"
            >
            <div class="input-group-append">
                <span class="input-group-text bg-primary border-0"
                    id="report-end-datepicker-icon">
                    <i class="fa fa-fw fa-calendar text-white"></i>
                </span>
            </div>
        </div>
        
        @error('report.end')
            <span class="text-danger d-block small">
                {{ $message }}
            </span>
        @enderror
        <a href="{{ route('secretary.institution.show', $institution) }}" class="ml-auto btn btn-primary">Voltar</a>
    </form>

</div>
<hr>

<div>
    @isset($foodRecords)
    
        <h1 class="h5">Entrada de Alimentos</h1>
        <div id="foods-card" class="card mb-5">
            <div class="card-body p-2 bg-primary rounded">
                <div class="p-2 bg-white rounded">

                    <table class="table table-borderless table-sm w-100 m-0">
                        <thead>
                            <tr class="bg-white border-bottom">
                                <th class="p-2">Data</th>
                                <th>Alimentos</th>
                                <th class="text-center">Unidade de Medida</th>
                                <th class="text-center">Quantidade de Entrada</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($foodRecords as $record)
                                <tr class="bg-white">
                                    <td class="p-2">{{ $record->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $record->food->name }}</td>
                                    <td class="text-center">{{ $record->food->unit }}</td>
                                    <td class="w-25 text-center">{{ $record->amount }}</td>
                                </tr>
                            @endforeach
                        </tbody>
            
                    </table>
                </div>
            </div>
        </div>

    @endisset

    @isset($consumptions)
    
        <h1 class="h5">Consumo Total do Período</h1>
        <div id="foods-card" class="card mb-5">
            <div class="card-body p-2 bg-primary rounded">
                <div class="p-2 bg-white rounded">

                    <table class="table table-borderless table-sm w-100 m-0">
                        <thead>
                            <tr class="bg-white border-bottom">
                                <th class="p-2">Data</th>
                                <th>Alimentos</th>
                                <th class="text-center">Unidade de Medida</th>
                                <th class="text-center">Consumo</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach($consumptions as $consumption)
                                <tr class="bg-white">
                                    <td class="p-2">{{ $consumption->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $consumption->food->name }}</td>
                                    <td class="text-center">{{ $consumption->food->unit }}</td>
                                    <td class="w-25 text-center">{{ $consumption->amount_consumed }}</td>
                                </tr>
                            @endforeach
                        </tbody>
            
                    </table>
                </div>
            </div>
        </div>

    @endisset

    @isset($menus)
    
    <h1 class="h5">Cardápio do Período</h1>
    <div id="foods-card" class="card mb-5">
        <div class="card-body p-2 bg-primary rounded">
            <div class="p-2 bg-white rounded">

                <table class="table table-borderless table-sm w-100 m-0">
                    <thead>
                        <tr class="bg-white border-bottom">
                            <th class="p-2">Data</th>
                            <th>Refeição</th>
                            <th>Cardápio</th>
                            <th class="text-center">Porções</th>
                            <th class="text-center">Repetições</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($menus as $menu)
                            <tr class="bg-white">
                                <td class="p-2">{{ $menu->created_at->format('d/m/Y') }}</td>
                                <td>{{ __('mealtimes.'.$menu->mealtime) }}</td>
                                <td>{{ $menu->description }}</td>
                                <td class="text-center">{{ $menu->amount }}</td>
                                <td class="text-center">{{ $menu->repeat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
        
                </table>
            </div>
        </div>
    </div>

    @endisset

    @if(request()->has('inicio') && request()->has('final'))
    <div class="text-center">
        <button id="btn-print" class="btn btn-primary active">
            Imprimir
        </button>
    </div>
    @endif

</div>

@endsection

@push('js')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('js/secretary/report/create.js') }}"></script>
@endpush