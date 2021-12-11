@extends('layouts.app')

@section('title', 'Relatório da '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print-report.css') }}">
@endpush

@section('content')
    <div class="row d-print-none">
        <form class="mb-2 w-80 ml-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-fill">
                    <input type="text" name="search" class="d-print-none col-lg-3 form-control mr-2"
                        value="{{ $search }}" placeholder="Pesquisar...">
                    <button type="submit" class="d-print-none btn btn-primary"><i class="fa fa-search"></i></button>

                    <label class="d-print-inline-flex ml-5 mr-2 my-auto text-right">Início: </label>
                    <div class="background-white pl-0 col-lg-2 input-group bg-primary rounded">
                        <input
                            id="begin-created-at"
                            type="text"
                            name="begin"
                            class="d-print-inline-flex form-control bg-primary text-white border-0"
                            readonly onpaste="return false;" autocomplete="off"
                            onkeypress="return false;"
                            value="{{ old('begin', isset($begin) ? $begin : \Carbon\Carbon::now()->format('d/m/Y')) }}"
                        >
                        <div class="input-group-append">
                            <span class="background-white input-group-text bg-primary border-0"
                                id="begin-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>


                    <label class="d-print-inline-flex ml-3 mr-2 my-auto text-right">Fim: </label>
                    <div class="background-white pl-0 col-lg-2 input-group bg-primary rounded">
                        <input
                            id="end-created-at"
                            type="text"
                            name="end"
                            class="d-print-inline-flex form-control bg-primary text-white border-0"
                            onkeypress="return false;"
                            onpaste="return false;"
                            autocomplete="off"
                            value="{{ old('end', isset($end) ? $end : \Carbon\Carbon::now()->format('d/m/Y')) }}"
                        >
                        <div class="input-group-append">
                            <span class="background-white input-group-text bg-primary border-0"
                                id="end-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="d-print-none ml-2 btn btn-primary"><i class="fa fa-filter"></i></button>

                </div>
            </div>
        </form>
        <div class="d-print-none col-md text-right mr-2">
            <a href="{{ route('secretary.institution.show', $institution) }}" class="btn btn-primary">
                Voltar
            </a>
        </div>
    </div>


    <!-- food-records -->

    <table id="" class="d-print-table table w-100">
        <thead class="bg-primary text-white">
            <tr class="d-print-table-row"> <th colspan=4 class="text-center">Estoque</th></tr>
            <tr class="d-print-table-row">
                <th class="w-10 text-center">Data</th>
                <th class="w-50">Alimentos</th>
                <th class="text-center">Unidade</th>
                <th class="text-center">Quantidade</th>
                <!-- <th>Responsável</th> -->
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($foodRecords as $foodRecord)
                @if(isset($search) && $search !== ''
                    && str_contains(strtolower($foodRecord->name), strtolower($search)))

                    <tr>
                        <td class="w-10 text-center">
                            {{ $foodRecord->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $foodRecord->name }}
                        </td>
                        <td class="text-center">
                            {{ $foodRecord->unit }}
                        </td>
                        <td class="text-center">
                            {{ $foodRecord->amount }}
                        </td>
                    </tr>

                @endif
                @if(!isset($search) || $search === '')
                    <tr>
                        <td class="w-10 text-center">
                            {{ $foodRecord->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $foodRecord->name }}
                        </td>
                        <td class="text-center">
                            {{ $foodRecord->unit }}
                        </td>
                        <td class="text-center">
                            {{ $foodRecord->amount }}
                        </td>
                    </tr>                
                @endif
            @endforeach
        </tbody>
    </table>

    <hr>

    <!-- consumptions -->

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr class="d-print-table-row"> <th colspan=4 class="text-center">Consumo</th></tr>
            <tr class="d-print-table-row">
                <th class="w-10 text-center">Data</th>
                <th class="w-50">Alimentos</th>
                <th class="text-center">Unidade</th>
                <th class="text-center">Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($consumptions as $consumption)                
                @if(isset($search) && $search !== ''
                    && str_contains(strtolower($consumption->name), strtolower($search)))
                    <tr>
                        <td class="w-10 text-center">
                            {{ $consumption->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $consumption->name }}
                        </td>
                        <td class="text-center">
                            {{ $consumption->unit }}
                        </td>
                        <td class="text-center">
                            {{ $consumption->amount }}
                        </td>
                    </tr>
                @endif
                @if(!isset($search) || $search === '')
                    <tr>
                        <td class="w-10 text-center">
                            {{ $consumption->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $consumption->name }}
                        </td>
                        <td class="text-center">
                            {{ $consumption->unit }}
                        </td>
                        <td class="text-center">
                            {{ $consumption->amount }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <hr>

    <!-- menus -->

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr class="d-print-table-row"> <th colspan=5 class="text-center">Cardápio</th></tr>
            <tr class="d-print-table-row">
                <th class="w-10 text-center">Data</th>
                <th class="w-50">Name</th>
                <th class="">Período</th>
                <th class="text-center">Porções</th>
                <th class="text-center">Repetições</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($meals as $meal)
                @if(isset($search) && $search !== ''
                    && str_contains(strtolower($meal->name), strtolower($search)))
                    <tr>
                        <td class="w-10 text-center">
                            {{ $meal->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $meal->name }}
                        </td>
                        <td class="">
                            @switch($meal->time)
                                @case('breakfast')
                                    Café da manhã
                                    @break
                                @case( 'lunch')
                                    Almoço
                                    @break
                                @case('afternoon snack')
                                    Lanche da tarde
                                    @break
                                @default
                                    Janta
                            @endswitch
                        </td>
                        <td class="text-center">
                            {{ $meal->amount }}
                        </td>
                        <td class="text-center">
                            {{ $meal->repeat }}
                        </td>
                    </tr>
                @endif
                @if(!isset($search) || $search === '')
                    <tr>
                        <td class="w-10 text-center">
                            {{ $meal->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $meal->name }}
                        </td>
                        <td class="">
                            @switch($meal->time)
                                @case('breakfast')
                                    Café da manhã
                                    @break
                                @case( 'lunch')
                                    Almoço
                                    @break
                                @case('afternoon snack')
                                    Lanche da tarde
                                    @break
                                @default
                                    Janta
                            @endswitch
                        </td>
                        <td class="text-center">
                            {{ $meal->amount }}
                        </td>
                        <td class="text-center">
                            {{ $meal->repeat }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    
    <div class="d-print-none col-md text-center mr-2">
        <a href="#" onclick="window.print();return false;" class="btn btn-primary">
            Imprimir
        </a>
    </div>
@endsection

@push('js')

    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script>
        var endDate = new Date()
        var beginString = $('#begin-created-at').val().split("/")
        var inputBegintDate = new Date(beginString[2], beginString[1] - 1, beginString[0])
        var endString = $('#end-created-at').val().split("/")
        var inputEndDate = new Date(endString[2], endString[1] - 1, endString[0])

        let beginDatepicker = $('#begin-created-at').datepicker({
            language: 'pt-BR',
            autoclose: true,
            showOnFocus: false,
            endDate: inputEndDate
        })

        let endDatepicker = $('#end-created-at').datepicker({
            language: 'pt-BR',
            autoclose: true,
            showOnFocus: false,
            startDate: inputBegintDate,
            endDate: endDate
        })

        $('#begin-created-at-datepicker-icon').click(function() {
            beginDatepicker.datepicker('show')
        })

        $('#end-created-at-datepicker-icon').click(function() {
            endDatepicker.datepicker('show')
        })

    </script>
@endpush