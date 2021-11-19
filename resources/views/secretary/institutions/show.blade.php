@extends('secretary.dashboard.index')
@section('title', $institution->name)
@section('content')
    
<style>
    .block-btn {
        min-width: 60px !important;
        min-height: 60px !important;
        text-align: center;
    }
</style>

<div class="vertical-align-center">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-4 col-lg-3 my-2 col-4">
            <a href="#" class="btn btn-block btn-primary d-flex flex-sm-column" style="min-height: 60px">
                <span>Consumo</span>
                <span>Diário</span>
            </a>
        </div>
    
        <div class="col-12 col-sm-4 col-lg-3 my-2 col-4">
            <a href="#" class="btn btn-block btn-primary d-flex flex-sm-column" style="min-height: 60px">
                <span> Cardápio <br> Diário </span>
            </a>
        </div>
        <div class="col-12 col-sm-4 col-lg-3 my-2 col-4">
            <a href="#" class="btn btn-block btn-primary d-flex flex-sm-column" style="min-height: 60px">
                <span>Entrada de</span>
                <span>Alimentos</span>
            </a>
        </div>
        
    </div>
    
    <div class="row justify-content-center">
        <div class="col-12 col-sm-4 col-lg-3 my-2 col-6">
            <a href="#" class="btn btn-block btn-primary d-flex flex-sm-column" style="min-height: 60px">
                <span>Relatório</span>
            </a>
        </div>
    
        <div class="col-12 col-sm-4 col-lg-3 my-2 col-6">
            <a href="#" class="btn btn-block btn-primary d-flex flex-sm-column" style="min-height: 60px">
                <span>Dados da</span>
                <span>Escola</span>
            </a>
        </div>

        <div class="col-12 col-sm-4 col-lg-3 my-2 col-6">
            <a href="{{ url('/secretaria/instituicao') }}"
                class="btn btn-block btn-success d-flex flex-sm-column" style="min-height: 60px">
                <span>Voltar</span>
            </a>
        </div>
    </div>
</div>

@endsection