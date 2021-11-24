@extends('layouts.app')

@section('title', $institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    
    <div class="row">
        <div class="col-lg-3">
            <div class="bg-light p-1 rounded">
                <span class="text-dark font-weight-bold">Demanda:</span>
            </div>
        </div>    
        <div class="col-lg-3">
            <div class="bg-info p-1 rounded">
                <span class="text-dark font-weight-bold">
                    Manhã
                    <div class="bg-light p-1 rounded">
                        <span class="text-dark font-weight-bold">{{$institution->meal_morning_demand}}</span>
                    </div>
            </span>
        </div>
    </div>
        <div class="col-lg-3">
            <div class="bg-info p-1 rounded">
                <span class="text-dark font-weight-bold">
                    Tarde
                    <div class="bg-light p-1 rounded">
                        <span class="text-dark font-weight-bold">{{$institution->meal_afternoon_demand}}</span>
                    </div>
                </span>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="bg-info p-1 rounded">
                <span class="text-dark font-weight-bold">
                    Noite
                    <div class="bg-light p-1 rounded">
                        <span class="text-dark font-weight-bold">{{$institution->meal_night_demand}}</span>
                    </div>
                </span>
            </div>
        </div>
        
        <div class="col-lg-1">
            <div class="bg-light p-1 rounded mt-4">
                <span class="text-dark font-weight-bold">Endereço:</span>
            </div>
        </div>
        <div class="col-lg-11">
            <div class="bg-info p-1 rounded mt-4">
                <div class="bg-light p-1 rounded">
                    <span class="text-dark font-weight-bold">
                        {{$institution->address->street}}, 
                        Nº {{$institution->address->number}}, 
                        {{$institution->address->district}}, 
                        {{$institution->address->city}}, 
                        {{$institution->address->state}}. 
                        CEP: {{$institution->address->zipcode}}.
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
            <a href="{{ route('secretary.institution.show', $institution->id) }}"
                class="btn btn-block btn-success d-flex flex-sm-column">
                <span>Voltar</span>
            </a>
        </div>
        <div class="col-12 col-sm-4 col-lg-1 my-2 mt-4 col-6">
            <a href="{{ route('secretary.institution.edit', $institution->id) }}"
                class="btn btn-block btn-success d-flex flex-sm-column">
                <span>Editar</span>
            </a>
        </div>
    </div>
@endsection