@extends('layouts.app')

@section('title', 'Alimentos')

@section('options')

    <div class="row">
        <div class="col-md-5">
            <a href="{{ route('secretary.food.create') }}" class="btn btn-primary h-100 d-flex align-items-center justify-content-center">
                Cadastrar Alimento
            </a>
        </div>
        <div class="col-md-7">
            <form action="{{ route('secretary.food.index') }}">
                <div class="input-group bg-primary p-1 rounded">
                    <input type="text" name="pesquisa" class="form-control rounded" placeholder="Buscar..." value="{{ request()->get('pesquisa') }}">
                    <div class="input-group-append">
        
                        @if(request()->has('pesquisa'))
                            <a href="{{ route('secretary.food.index') }}" class="btn btn-primary">
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
        </div>
    </div>

@endsection

@section('content')

    <table id="food-table" class="table table-striped table-sm w-100">
        <thead class="bg-primary text-white table-bordered">
            <tr>
                <th width="7%" class="text-center">ID</th>
                <th width="52%">Nome</th>
                <th width="18%" class="text-center">Unidade de Medida</th>
                <th class="text-center" width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($foods as $food)
                <tr>
                    <td class="text-center">{{ $food->id }}</td>
                    <td>{{ $food->name }}</td>
                    <td class="text-center">{{ $food->unit }}</td>
                    <td class="text-center">
                        <a href="{{ route('secretary.food.edit', $food) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-fw fa-pen"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            Mostrando {{ $foods->firstItem() }} até {{ $foods->lastItem() }} de {{ $foods->total() }} registros
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            {!! $foods->links() !!}
        </div>
    </div>

@endsection