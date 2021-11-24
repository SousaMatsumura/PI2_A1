@extends('layouts.app')

@section('title', 'Estoque da Escola')

@section('options')
    <form action="{{ route('school.food_record.index') }}" class="w-75 float-right">
        <div class="input-group bg-primary p-1 rounded">
            <input type="text" name="pesquisa" class="form-control rounded" placeholder="Buscar..." value="{{ request()->get('pesquisa') }}">
            <div class="input-group-append">

                @if(request()->has('pesquisa'))
                    <a href="{{ route('school.food_record.index') }}" class="btn btn-primary">
                        <i class="fa fa-fw fa-times-circle"></i>
                    </a>                
                @else
                    <button class="btn btn-primary">
                        <i class="fa fa-fw fa-search"></i>
                    </button>
                @endif
                
            </div>
        </div>
    </form>
@endsection

@section('content')
    
    <table id="inventory-table" class="table table-striped table-sm w-100">
        <thead class="bg-primary text-white table-bordered">
            <tr>
                <th width="7%" class="text-center">ID</th>
                <th width="52%">Alimento</th>
                <th width="18%" class="text-center">Unidade</th>
                <th width="21%" class="text-center">Quantidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foodRecords as $foodRecord)
                <tr>
                    <td class="text-center">{{ $foodRecord->food_id }}</td>
                    <td>{{ $foodRecord->food_name }}</td>
                    <td class="text-center">{{ $foodRecord->food_unit }}</td>
                    <td class="text-center">{{ $foodRecord->amount_remaining }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            Mostrando {{ $foodRecords->firstItem() }} até {{ $foodRecords->lastItem() }} de {{ $foodRecords->total() }} registros
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            {!! $foodRecords->links() !!}
        </div>
    </div>

@endsection