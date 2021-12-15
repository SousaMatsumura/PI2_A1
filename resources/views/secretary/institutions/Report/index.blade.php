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

                    <label class="d-print-inline-flex mr-2 my-auto text-right">Início: </label>
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

                    <input type="text" name="search" id="search" class="d-print-none ml-5 col-lg-3 form-control mr-2"
                        value="{{ $search }}" placeholder="Pesquisar...">

                    <!-- <button title="filtrar" type="submit" class="d-print-none ml-2 btn btn-primary"><i class="fa fa-filter"></i></button> -->
                    <button type="submit" class="d-print-none ml-2 btn btn-primary"><i class="fa fa-search"></i></button>

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
        <tbody id="food-records-tbody">
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
        <tbody id="consumptions-tbody">
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
        <tbody id="menus-tbody">
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($menus as $menu)
                @if(isset($search) && $search !== ''
                    && str_contains(strtolower($menu->name), strtolower($search)))
                    <tr>
                        <td class="w-10 text-center">
                            {{ $menu->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $menu->name }}
                        </td>
                        <td class="">
                            @switch($menu->time)
                                @case('breakfast')
                                    Café da manhã
                                    @break
                                @case('lunch')
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
                            {{ $menu->amount }}
                        </td>
                        <td class="text-center">
                            {{ $menu->repeat }}
                        </td>
                    </tr>
                @endif
                @if(!isset($search) || $search === '')
                    <tr>
                        <td class="w-10 text-center">
                            {{ $menu->created_at }}
                        </td>
                        <td class="w-50">
                            {{ $menu->name }}
                        </td>
                        <td class="">
                            @switch($menu->time)
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
                            {{ $menu->amount }}
                        </td>
                        <td class="text-center">
                            {{ $menu->repeat }}
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
    <!-- <script src="{{ asset('js/secretary/report/index.js')}}"></script> -->

    <!-- -->

<script>
$(document).ready(function () {
    
    /*** Handle Datepicker */
    var endDate = new Date();
    var beginString = $('#begin-created-at').val().split("/");
    var inputBegintDate = new Date(beginString[2], beginString[1] - 1, beginString[0]);
    var endString = $('#end-created-at').val().split("/");
    var inputEndDate = new Date(endString[2], endString[1] - 1, endString[0]);

    let beginDatepicker = $('#begin-created-at').datepicker({
        language: 'pt-BR',
        autoclose: true,
        showOnFocus: false,
        endDate: inputEndDate,
    });

    $( "#begin-created-at" ).change(function() {
        $('#end-created-at').datepicker('setStartDate', $('#begin-created-at').val())
        fetch();
    });

    let endDatepicker = $('#end-created-at').datepicker({
        language: 'pt-BR',
        autoclose: true,
        showOnFocus: false,
        startDate: inputBegintDate,
        endDate: endDate
    })

    $( "#end-created-at" ).change(function() {
        $('#begin-created-at').datepicker('setEndDate', $('#end-created-at').val())
        fetch();
    });

    $('#begin-created-at-datepicker-icon').click(function() {
        beginDatepicker.datepicker('show')
    })

    $('#end-created-at-datepicker-icon').click(function() {
        endDatepicker.datepicker('show')
    })

    $('#begin-created-at, #end-created-at').on("cut copy paste",function(e) {
        e.preventDefault();
    });

    $('#begin-created-at, #end-created-at').keydown(function(event) {
        if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
            event.preventDefault();
        }
    });

    $("form").submit( function (e){
        e.preventDefault();
        //e.stopPropagation();
        fetch();
    });

    /*** END Handle Datepicker */

    /*** Handle Fetch */

    var institution = <?php echo json_encode($institution) ?>;

    fetch();

    $( "#search" ).change(function() {
        fetch();
    });

    function getCurrentDate(s){
        string = s.split("/");
        return new Date(string[2], string[1] - 1, string[0]);
    }

    function stringDateHigherDate(s, r){
        d1 = getCurrentDate(s);
        d2 = getCurrentDate(r);
        return d1.getYear() >= d2.getYear() &&
            d1.getMonth() >= d2.getMonth() && d1.getDate() >= d2.getDate();
    }

    function fetch(){
        $.ajax({
            type: "GET",
            url: '/secretaria/escola/' +institution.id+ '/report/fetch',
            dataType: 'json',
            success: function (response){
                /*** Handle FoodRecords */
                $('#food-records-tbody').html("");
                $.each(response.foodRecords, function (key, item){
                    if(stringDateHigherDate(item.created_at, $('#begin-created-at').val()) &&
                        stringDateHigherDate($('#end-created-at').val(), item.created_at) &&
                        item.name.toLowerCase().includes($('#search').val().toLowerCase())){
                        
                        $('#food-records-tbody').append('<tr>\
                            <td class="w-10 text-center">'+
                                item.created_at
                            +'</td>\
                            <td class="w-50">'+
                                item.name
                            +'</td>\
                            <td class="text-center">'+
                                item.unit
                            +'</td>\
                            <td class="text-center">'+
                                item.amount
                            +'</td>\
                        </tr>');
                    }
                });

                if(isEmpty($('#food-records-tbody'))){
                    $('#food-records-tbody').append('<tr>\
                        <td colspan=4 class="align-middle card-body text-center">'+
                            '<p class="font-weight-bold mb-0">Não há registros.'
                        +'</td>'+   
                    '</tr>');
                }

                /*** END Handle FoodRecords */

                /*** Handle Consumptions */
                $('#consumptions-tbody').html("");
                $.each(response.consumptions, function (key, item){
                    if(stringDateHigherDate(item.created_at, $('#begin-created-at').val()) &&
                        stringDateHigherDate($('#end-created-at').val(), item.created_at) &&
                        item.name.toLowerCase().includes($('#search').val().toLowerCase())){
                        
                        $('#consumptions-tbody').append('<tr>\
                            <td class="w-10 text-center">'+
                                item.created_at
                            +'</td>\
                            <td class="w-50">'+
                                item.name
                            +'</td>\
                            <td class="text-center">'+
                                item.unit
                            +'</td>\
                            <td class="text-center">'+
                                item.amount
                            +'</td>\
                        </tr>');
                    }
                });

                if(isEmpty($('#consumptions-tbody'))){
                    $('#consumptions-tbody').append('<tr>\
                        <td colspan=4 class="align-middle card-body text-center">'+
                            '<p class="font-weight-bold mb-0">Não há registros.'
                        +'</td>'+   
                    '</tr>');
                }

                /*** END Handle Consumptions */

                /*** Handle Menus */
                $('#menus-tbody').html("");
                $.each(response.menus, function (key, item){
                    if(stringDateHigherDate(item.created_at, $('#begin-created-at').val()) &&
                        stringDateHigherDate($('#end-created-at').val(), item.created_at) &&
                        item.name.toLowerCase().includes($('#search').val().toLowerCase())){
                        
                        $('#menus-tbody').append('<tr>\
                            <td class="w-10 text-center">'+
                                item.created_at
                            +'</td>\
                            <td class="w-50">'+
                                item.name
                            +'</td>\
                            <td>'+
                                mealTime(item.time)
                            +'</td>\
                            <td class="text-center">'+
                                item.amount
                            +'</td>\
                            <td class="text-center">'+
                                item.repeat
                            +'</td>\
                        </tr>');
                    }
                });

                if(isEmpty($('#menus-tbody'))){
                    $('#menus-tbody').append('<tr>\
                        <td colspan=5 class="align-middle card-body text-center">'+
                            '<p class="font-weight-bold mb-0">Não há registros.'
                        +'</td>'+   
                    '</tr>');
                }

                /*** END Handle Menus */
            },
        })
    };

    function mealTime(s){
        switch(s){
            case "breakfast": return "Café da manhã";
            case "lunch": return "Almoço";
            case "afternoon snack": return "Lanche da tarde";
            default: return "Janta";
        }
    }

    function isEmpty( el ){
        return !$.trim(el.html());
    }

    /*** END Handle Fetch */

});
</script>
@endpush