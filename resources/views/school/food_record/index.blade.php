@extends('layouts.app')

@section('title', 'Estoque da Escola')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    
    <table id="inventory-table" class="table w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Alimento</th>
                <th class="text-center">Unidade</th>
                <th class="text-center">Quantidade</th>
            </tr>
        </thead>
    </table>

@endsection

@push('js')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.defaults.js') }}"></script>
    <script src="{{ asset('js/school/food_records/index.js') }}"></script>
@endpush