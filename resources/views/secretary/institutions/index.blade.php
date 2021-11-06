@extends('layouts.app')

@section('title', 'Instituições')

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
            <a href="{{ route('secretary.institution.create') }}" class="btn btn-primary">Nova instituição</a>
        </div>
    </form>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Instituição</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($institutions as $institution)
                <tr>
                    <td class="align-middle">{{ $institution->id }}</td>
                    <td class="align-middle">{{ $institution->name }}</td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center">
                            
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@push('js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.defaults.js') }}"></script>
    <!-- <script src="{{ asset('js/school/food_records/index.js') }}"></script> -->
@endpush