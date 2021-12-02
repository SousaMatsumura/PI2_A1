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
    {{$temp = 2}}
    @for ($i = 0; $i < count($foodRecords); $i++)
        @for ($j = 0; $j < count($consumptions); $j++)
            @if ($i <> $temp)
                <table id="" class="table w-100">         
                <thead class="bg-primary text-white">
                    <tr> <th colspan=4 class="text-center">{{$foodRecords[$i]->created_at}}</th></tr>    
                    <tr> <th colspan=4 class="text-center">Estoque</th></tr>
                    <tr>
                        <th>Alimentos</th>
                        <th>Unidade</th>
                        <th>Quantidade</th>
                        <th>Data</th>
                    </tr>
                </thead>   
            @endif
                @if (date('d-m-Y',strtotime($foodRecords[$i]->created_at)) == date('d-m-Y',strtotime($consumptions[$j]->created_at)))
                    <tbody>
                        {{ ($i+1 < count($foodRecords)) && (date('d-m-Y',strtotime($foodRecords[$i]->created_at))
                             == date('d-m-Y',strtotime($foodRecords[$i+1]->created_at))) ? "true" : "false"}}
                        
                        @while($i+1 < count($foodRecords))
                            <tr>
                                <td class="align-middle">
                                    {{ $foodRecords[$i]->name }}
                                </td>
                                <td class="align-middle">
                                    {{ $foodRecords[$i]->unit }}
                                </td>
                                <td class="align-middle">
                                    {{ $foodRecords[$i]->amount }}
                                </td>
                                <td class="align-middle">
                                    {{ $foodRecords[$i]->created_at }}
                                </td>
                            </tr>
                            @if($foodRecords[$i]->created_at == $foodRecords[($i+1)]->created_at)
                                $i++;
                            @else
                                @break;
                            @endif
                        @endwhile
                    </tbody>
                @endif
            </table>
            $temp = $i;
        @endfor    
    @endfor

    
    <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
        <a href="{{ route('secretary.institution.show', $institution->id) }}"
            class="btn btn-block btn-success d-flex flex-sm-column">
            <span>Voltar</span>
        </a>
    </div>
@endsection