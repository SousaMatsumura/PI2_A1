@extends('layouts.app')

@section('title', 'Funcionários')

@section('options')

    <div class="row">
        <div class="col-md-5">
            <a href="{{ route('secretary.user.create') }}" class="btn btn-primary h-100 d-flex align-items-center justify-content-center">
                Cadastrar Funcionário
            </a>
        </div>
        <div class="col-md-7">
            <form action="{{ route('secretary.user.index') }}">
                <div class="input-group bg-primary p-1 rounded">
                    <input type="text" name="pesquisa" class="form-control rounded" placeholder="Buscar..." value="{{ request()->get('pesquisa') }}">
                    <div class="input-group-append">
        
                        @if(request()->has('pesquisa'))
                            <a href="{{ route('secretary.user.index') }}" class="btn btn-primary">
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

    <table id="user-table" class="table table-striped table-sm w-100">
        <thead class="bg-primary text-white table-bordered">
            <tr>
                <th width="7%" class="text-center">ID</th>
                <th>Nome</th>
                <th width="50%">Escola</th>
                <th class="text-center" width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td class="text-center">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->institution->name }}</td>
                    <td class="text-center">
                        <a href="{{ route('secretary.user.edit', $user) }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-fw fa-pen"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-6">
            Mostrando {{ $users->firstItem() }} até {{ $users->lastItem() }} de {{ $users->total() }} registros
        </div>
        <div class="col-md-6 d-flex justify-content-end">
            {!! $users->links() !!}
        </div>
    </div>

@endsection