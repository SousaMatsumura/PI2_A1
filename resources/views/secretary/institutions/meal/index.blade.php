@extends('layouts.app')

@section('title', 'Cardápio do Dia: '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')

    <div class="mb-4">
        <div class="form-group">
            <div class="row">
                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Dia: </label>
                </div>
                <div class="col-md-4">

                    <div class="input-group bg-primary rounded">
                        <input 
                            id="menu-created-at" 
                            type="text" 
                            name="menu[created_at]" 
                            class="form-control bg-primary text-white border-primary
                                @error('menu.created_at') border-danger @enderror" 
                            placeholder="Buscar..." 
                            readonly
                            value="{{ old('menu.created_at') }}"
                            data-url="{{ route('secretary.institution.meal.index', $institution) }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0"
                                id="menu-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>
                    
                    @error('menu.created_at')
                        <span class="text-danger d-block small">
                            {{ $errors->first('menu.created_at') }}
                        </span>
                    @enderror
                </div>
                <div class="col-md text-right">
                    <a href="{{ route('secretary.institution.show', $institution) }}" class="btn btn-primary">Voltar</a>
                </div>
            </div>
            
            
        </div>
    </div>
    
    <div id="menus-card" class="card min-h-50">
        <div class="card-body p-2 bg-primary rounded">
            <div class="p-2">

                @foreach(config('enums.mealtimes') as $mealtime)
                    <div class="row">
                        <div class="col-md-8">
                            <div class="bg-white rounded pt-2 pb-3 px-2">
                                <small class="font-weight-bold">{{ $mealtime['label'] }}</small>
                                <p class="m-0" id="mealtime-{{$mealtime['key']}}-description"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="bg-white rounded pt-2 pb-3 px-2 text-right">
                                <small class="font-weight-bold">Quantidade</small>
                                <p class="m-0" id="mealtime-{{$mealtime['key']}}-amount"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="bg-white rounded pt-2 pb-3 px-2 text-right">
                                <small class="font-weight-bold">Repetições</small>
                                <p class="m-0" id="mealtime-{{$mealtime['key']}}-repeat"></p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div id="no-results" class="card-body text-white rounded text-center">
                    <i class="fa fa-fw fa-calendar fa-3x mb-2"></i>
                    <p class="mb-0">O cardápio do dia <span id="no-results-day"></span> não foi cadastrado pela escola.</p>
                </div>
                
            </div>
            
        </div>
    </div>

    

@endsection

@push('js')
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script src="{{ asset('js/secretary/school/menu/index.js') }}"></script>
@endpush