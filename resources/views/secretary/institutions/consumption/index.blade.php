@extends('layouts.app')

@section('title', 'Consumo de '.$institution->name)

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
            <tr>
                <th>Alimentos</th>
                <th>Unidade de medida</th>
                <th>Quantidade consumida</th>
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
                        <td class="align-middle">
                            {{ $consumption->unit }}
                        </td>
                        <td class="align-middle">
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
                        <td class="align-middle">
                            {{ $consumption->unit }}
                        </td>
                        <td class="align-middle">
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
    <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
        <a href="{{ route('secretary.institution.show', $institution->id) }}"
            class="btn btn-block btn-success d-flex flex-sm-column">
            <span>Voltar</span>
        </a>
    </div>
@endsection