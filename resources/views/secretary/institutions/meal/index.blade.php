@extends('layouts.app')

@section('title', 'Cardápio de '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

@endpush

@section('content')
    <div class="row">
        <form class="mb-2 w-50 ml-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-fill">
                    <input type="text" name="search" class="form-control mr-2" value="{{ $search }}" placeholder="Pesquisar...">
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

    <!--
    <form class="input-group date datepicker mb-2">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-fill">
                <input type="text" name="begin-date" value="{{ $beginDate }}"
                    class="form-control w-50 mr-2" data-provide="datepicker"
                    data-date-format="dd-mm-yyyy" placeholder="Data de Inicio">
                <button type="submit" class="btn btn-primary"><i class="fa fa-calendar"></i></button>
            </div>
        </div>
    </form>

    <form class="input-group date datepicker mb-2">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-fill">
                <input type="text" data-provide="datepicker" value="{{ $testDate }}"
                    data-date-format="dd-mm-yyyy">
            </div>
        </div>
    </form>

    <form class="input-group date datepicker mb-2">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-fill">
                <input type="text" name="end-date" value="{{ $endDate }}"
                    class="form-control w-50 mr-2" data-provide="datepicker"
                    data-date-format="dd-mm-yyyy" placeholder="Data Fim">
                <button type="submit" class="btn btn-primary"><i class="fa fa-calendar"></i></button>
            </div>
        </div>
    </form>

    -->

    <!--
    <div class="input-group date mb-2 datepicker">
        <input type="text" class="form-control" data-provide="datepicker"
            data-date-format="dd/mm/yyyy">
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div>
    -->    

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th class="w-10">Período</th>
                <th class="w-50">Name</th>
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
                        <td class="w-10">
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
                        <td class="w-50">
                            {{ $meal->name }}
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
                        <td class="w-10">
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
                        <td class="w-50">
                            {{ $meal->name }}
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
    <!--
    <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
        <a href="{{ route('secretary.institution.show', $institution->id) }}"
            class="btn btn-block btn-success d-flex flex-sm-column">
            <span>Voltar</span>
        </a>
    </div>
    -->

    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection

@push('js')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
@endpush