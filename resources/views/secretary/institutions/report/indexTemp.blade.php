    
<!--  Old meal tbody

    <tbody>

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

 -->


<!-- Filter Backup
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

    <div class="row">
        <form class="mb-2 w-50 ml-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-fill">
                    <label class="col-lg-1 my-auto">Início: </label>
                    <div class="ml-2 input-group bg-primary rounded">
                        <input
                            id="meal-created-at"
                            type="text"
                            name="begin"
                            class="form-control bg-primary text-white border-0"
                            readonly value="{{ old('begin', isset($begin) ? $begin : \Carbon\Carbon::now()->format('d/m/Y')) }}"
                            data-url="{{ route('school.meal.index') }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="meal-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>

                    <label class="col-lg-1 my-auto">Fim: </label>
                    <div class="input-group bg-primary rounded">
                        <input
                            id="end-created-at"
                            type="text"
                            name="end"
                            class="form-control bg-primary text-white border-0 @error('meal.createdAt') is-invalid @enderror"
                            onkeypress="return false;"
                            onpaste="return false;"
                            value="{{ old('end', isset($end) ? $end : \Carbon\Carbon::now()->format('d/m/Y')) }}"
                            data-url="{{ route('school.meal.index') }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="end-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="ml-2 btn btn-primary"><i class="fa fa-filter"></i></button>
                </div>
            </div>
        </form>
        

    </div>




-->


    <!-- Colocando estoque e consumo juntos, ordenados por data, Precisa disso???
    @for ($i=0, $j=0; $i < count($foodRecords) && $j < count($consumptions); )
        @if(date('d-m-Y',strtotime($foodRecords[$i]->created_at)) <=
            date('d-m-Y',strtotime($consumptions[$j]->created_at)))
            <table id="" class="table w-100">
                <thead class="bg-primary text-white">
                    <tr> <th colspan=3 class="text-center">{{ date('d-m-Y',strtotime($foodRecords[$i]->created_at)) }}</th></tr>
                    <tr> <th colspan=3 class="text-center">Estoque</th></tr>
                    <tr>
                        <th>Alimentos</th>
                        <th>Unidade</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <tr>
                        <td class="align-middle w-50">
                            {{ $foodRecords[$i]->name }}
                        </td>
                        <td class="align-middle">
                            {{ $foodRecords[$i]->unit }}
                        </td>
                        <td class="align-middle">
                            {{ $foodRecords[$i]->amount }}
                        </td>
                    </tr>
                    @while ($i+1 < count($foodRecords) &&
                        date('d-m-Y',strtotime($foodRecords[$i]->created_at)) ==
                            date('d-m-Y',strtotime($foodRecords[$i+1]->created_at)))
                        @php $i++; @endphp
                        <tr>
                            <td class="align-middle w-50">
                                {{ $foodRecords[$i]->name }}
                            </td>
                            <td class="align-middle">
                                {{ $foodRecords[$i]->unit }}
                            </td>
                            <td class="align-middle">
                                {{ $foodRecords[$i]->amount }}
                            </td>
                        </tr>
                    @endwhile
                    @if ($i < count($foodRecords))
                        @php $i++; @endphp
                    @endif
                </tbody>
            </table>
        @elseif(date('d-m-Y',strtotime($foodRecords[$i]->created_at)) >= 
            date('d-m-Y',strtotime($consumptions[$j]->created_at)))
        <table id="" class="table w-100">
                <thead class="bg-primary text-white">
                    <tr> <th colspan=3 class="text-center">
                        {{date('d-m-Y',strtotime($consumptions[$j]->created_at))}}
                    </th></tr>
                    <tr> <th colspan=3 class="text-center">Consumo</th></tr>
                    <tr>
                        <th>Alimentos</th>
                        <th>Unidade</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle w-50">
                            {{ $consumptions[$j]->name }}
                        </td>
                        <td class="align-middle">
                            {{ $consumptions[$j]->unit }}
                        </td>
                        <td class="align-middle">
                            {{ $consumptions[$j]->amount }}
                        </td>
                    </tr>
                    @while ($j+1 < count($consumptions) &&
                        date('d-m-Y',strtotime($consumptions[$j]->created_at)) ==
                        date('d-m-Y',strtotime($consumptions[$j+1]->created_at)))
                        @php $j++; @endphp
                        <tr>
                            <td class="align-middle w-50">
                                {{ $consumptions[$j]->name }}
                            </td>
                            <td class="align-middle">
                                {{ $consumptions[$j]->unit }}
                            </td>
                            <td class="align-middle">
                                {{ $consumptions[$j]->amount }}
                            </td>
                        </tr>
                    @endwhile
                    @if ($j < count($consumptions))
                        @php $j++; @endphp
                    @endif
                </tbody>
            </table>
            
        @endif
        
    @endfor
    <hr>
    -->


@extends('layouts.app')

@section('title', 'Relatório da '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <form class="mb-2">
        <div class="d-flex justify-content-between">
            <div class="d-flex flex-fill">
                <input type="text" name="search" class="form-control w-50 mr-2" value="{{ $search }}" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr> <th colspan=4 class="text-center">Estoque</th></tr>
            <tr>
                <th>Alimentos</th>
                <th>Unidade</th>
                <th>Quantidade</th>
                <th>Data</th>
                <!-- <th>Responsável</th> -->
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($foodRecords as $foodRecord)
                <tr>
                    <td class="align-middle">
                        {{ $foodRecord->name }}
                    </td>
                    <td class="align-middle">
                        {{ $foodRecord->unit }}
                    </td>
                    <td class="align-middle">
                        {{ $foodRecord->amount }}
                    </td>
                    <td class="align-middle">
                        {{ $foodRecord->created_at }}
                    </td>
                </tr>                
            @endforeach
        </tbody>
    </table>

    <hr>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr> <th colspan=4 class="text-center">Consumo</th></tr>
            <tr>
                <th>Alimentos</th>
                <th>Unidade</th>
                <th>Quantidade</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($consumptions as $consumption)                
                <tr>
                    <td class="align-middle">
                        {{ $consumption->name }}
                    </td>
                    <td class="align-middle">
                        {{ $consumption->unit }}
                    </td>
                    <td class="align-middle">
                        {{ $consumption->amount }}
                    </td>
                    <td class="align-middle">
                        {{ $consumption->created_at }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
        <a href="{{ route('secretary.institution.show', $institution->id) }}"
            class="btn btn-block btn-success d-flex flex-sm-column">
            <span>Voltar</span>
        </a>
    </div>
@endsection