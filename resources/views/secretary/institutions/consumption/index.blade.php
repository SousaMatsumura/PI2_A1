@extends('layouts.app')

@section('title', 'Consumo de '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <form class="mb-2 w-80 ml-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-fill">

                    <label class="d-print-inline-flex mr-2 my-auto text-right">Data: </label>
                    <div class="background-white pl-0 col-lg-3 input-group bg-primary rounded">
                        <input
                            id="consumption-created-at"
                            type="text"
                            name="consumptionCreatedAt"
                            class="d-print-inline-flex form-control bg-primary text-white border-0"
                            readonly onpaste="return false;" autocomplete="off"
                            onkeypress="return false;"
                            value="{{ old('consumptionCreatedAt', isset($consumptionCreatedAt)
                                ? $consumptionCreatedAt : \Carbon\Carbon::now()->format('d/m/Y')) }}"
                        >
                        <div class="input-group-append">
                            <span class="p-0 background-white input-group-text bg-primary border-0"
                                id="consumption-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>

                    <input type="text" id="search" name="search" class="form-control ml-5 col-lg-5 mr-2" value="{{ $search }}" placeholder="Pesquisar...">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>

        <div class="col-md text-right mr-2">
            <a href="{{ route('secretary.institution.show', $institution) }}" class="btn btn-primary">
                Voltar
            </a>
        </div>
    </div>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th>Alimentos</th>
                <th class="text-center">Unidade de medida</th>
                <th class="text-center">Quantidade consumida</th>
                <!-- <th>Responsável</th> -->
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($consumptions as $consumption)
                @if(isset($search) && $search !== ''
                    && str_contains(strtolower($consumption->name), strtolower($search)))
                    <tr>
                        <td class="align-middle">
                            {{ $consumption->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $consumption->unit }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $consumption->amount }}
                        </td>
                        <!-- <td class="align-middle">
                            {{ $consumption->amount }}
                        </td> -->
                    </tr>
                @endif
                @if(!isset($search) || $search === '')
                    <tr>
                        <td class="align-middle">
                            {{ $consumption->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $consumption->unit }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $consumption->amount }}
                        </td>
                        <!-- <td class="align-middle">
                            {{ $consumption->amount }}
                        </td> -->
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <!--
    <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
        <a href="{{ route('secretary.institution.show', $institution->id) }}"
            class="btn btn-block btn-success d-flex flex-sm-column">
            <span>Voltar</span>
        </a>
    </div>
    -->
@endsection

@push('js')

    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('js/secretary/report/index.js')}}"></script>
    
<script>
$(document).ready(function () {

    /*** Handle Datepicker */

    var today = new Date();
    var inputString = $('#consumption-created-at').val().split("/");
    var inputDate = new Date(inputString[2], inputString[1] - 1, inputString[0]);

    let datepicker = $('#consumption-created-at').datepicker({
        language: 'pt-BR',
        autoclose: true,
        showOnFocus: false,
        endDate: today,
    });

    $('#consumption-created-at-datepicker-icon').click(function() {
        datepicker.datepicker('show')
    })


    $('#consumption-created-at').on("cut copy paste",function(e) {
        e.preventDefault();
    });

    $('#consumption-created-at').keydown(function(event) {
        if (event.ctrlKey==true && (event.which == '118' || event.which == '86')) {
            event.preventDefault();
        }
    });

    $( "#consumption-created-at, #search" ).change(function() {
        fetch();
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

    function getCurrentDate(s){
        string = s.split("/");
        return new Date(string[2], string[1] - 1, string[0]);
    }

    function stringDateEqualDate(s, r){
        d1 = getCurrentDate(s);
        d2 = getCurrentDate(r);
        return d1.getYear() === d2.getYear() &&
            d1.getMonth() === d2.getMonth() && d1.getDate() === d2.getDate();
    }

    function fetch(){
        $.ajax({
            type: "GET",
            url: '/secretaria/escola/' +institution.id+ '/consumption/fetch',
            dataType: 'json',
            success: function (response){
                $('tbody').html("");
                $.each(response.consumptions, function (key, item){

                    if(stringDateEqualDate(item.created_at, $('#consumption-created-at').val()) &&
                        item.name.toLowerCase().includes($('#search').val().toLowerCase())){
                           
                        $('tbody').append('<tr>\
                            <td class="align-middle">'+
                                item.name
                            +'</td>\
                            <td class="align-middle text-center">'+
                                item.unit
                            +'</td>\
                            <td class="align-middle text-center">'+
                                item.amount
                            +'</td>\
                        </tr>');
                    }
                });
            },
        })
    };

    /*** END Handle Fetch */

});
</script>
@endpush