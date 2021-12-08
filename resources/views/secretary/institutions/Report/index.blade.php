@extends('layouts.app')

@section('title', 'Relatório da '.$institution->name)

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
    <div class="row">
        <form class="mb-2 w-50 ml-3">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-fill">
                    <input type="text" name="search" class="form-control mr-2" value="{{ $search }}" placeholder="Pesquisar...">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <div class="col-md text-right mr-2">
            <a href="{{ route('secretary.institution.show', $institution) }}" class="btn btn-primary">
                Voltar
            </a>
        </div>
    </div>


    
    <div class="mb-4 mt-3 ml-1">
        <div class="form-group">
            <div class="row">
                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Início: </label>
                </div>
                <div class="col-md-4">
                    <div class="input-group bg-primary rounded">
                        <input
                            id="meal-created-at"
                            type="text"
                            name="begin"
                            class="form-control bg-primary text-white border-0"
                            readonly value="{{ old('begin', isset($begin) ? $begin : '') }}"
                            data-url="{{ route('school.meal.index') }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="meal-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Fim: </label>
                </div>
                <div class="col-md-4">
                    <div class="input-group bg-primary rounded">
                        <input
                            id="end-created-at"
                            type="text"
                            name="end"
                            class="form-control bg-primary text-white border-0 @error('meal.createdAt') is-invalid @enderror"
                            readonly value="{{$end}}"
                            data-url="{{ route('school.meal.index') }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="end-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr> <th colspan=4 class="text-center">Estoque</th></tr>
            <tr>
                <th class="w-10 text-center">Data</th>
                <th class="w-50">Alimentos</th>
                <th class="text-center">Unidade</th>
                <th class="text-center">Quantidade</th>
                <!-- <th>Responsável</th> -->
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($foodRecords as $foodRecord)
                <tr>
                    <td class="w-10 text-center">
                        {{ $foodRecord->created_at }}
                    </td>
                    <td class="w-50">
                        {{ $foodRecord->name }}
                    </td>
                    <td class="text-center">
                        {{ $foodRecord->unit }}
                    </td>
                    <td class="text-center">
                        {{ $foodRecord->amount }}
                    </td>
                </tr>                
            @endforeach
        </tbody>
    </table>

    <hr>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr> <th colspan=4 class="text-center">Consumo</th></tr>
            <tr>
                <th class="w-10 text-center">Data</th>
                <th class="w-50">Alimentos</th>
                <th class="text-center">Unidade</th>
                <th class="text-center">Quantidade</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($consumptions as $consumption)                
                <tr>
                    <td class="w-10 text-center">
                        {{ $consumption->created_at }}
                    </td>
                    <td class="w-50">
                        {{ $consumption->name }}
                    </td>
                    <td class="text-center">
                        {{ $consumption->unit }}
                    </td>
                    <td class="text-center">
                        {{ $consumption->amount }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <table id="" class="table w-100">
        <thead class="bg-primary text-white">
            <tr> <th colspan=5 class="text-center">Cardápio</th></tr>
            <tr>
                <th class="w-10 text-center">Data</th>
                <th class="w-50">Name</th>
                <th class="">Período</th>
                <th class="text-center">Porções</th>
                <th class="text-center">Repetições</th>
            </tr>
        </thead>
        <tbody>
            <!-- CONTEÚDO DA TABELA -->
            @foreach ($meals as $meal)
                <tr>
                    <td class="w-10 text-center">
                        {{ $meal->created_at }}
                    </td>
                    <td class="w-50">
                        {{ $meal->name }}
                    </td>
                    <td class="">
                        @switch($meal->time)
                            @case('breakfast')
                                Café da manhã
                                @break
                            @case( 'lunch')
                                Almoço
                                @break
                            @case('afternoon snack')
                                Lanche da tarde
                                @break
                            @default
                                Janta
                        @endswitch
                    </td>
                    <td class="text-center">
                        {{ $meal->amount }}
                    </td>
                    <td class="text-center">
                        {{ $meal->repeat }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!--
    <div class="text-right col-12 col-sm-4 col-lg-2 my-2 mt-4 col-6">
        <a href="#" onclick="window.print();return false;"
            class="btn btn-block btn-primary d-flex flex-sm-column">
            <span>Imprimir</span>
        </a>
    </div>
    -->
    
    <div class="col-md text-center mr-2">
        <a href="#" onclick="window.print();return false;" class="btn btn-primary">
            Imprimir
        </a>
    </div>
@endsection

@push('js')

    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <script>
        var submitButton = $('#submit-button')
        var form = $('#meal-form')
        var submitRoute = location.href
        var mealsCard = $('#meals-card')

        let datepicker = $('#meal-created-at').datepicker({
            language: 'pt-BR',
            autoclose: true,
            showOnFocus: false
        })

        let endDatepicker = $('#end-created-at').datepicker({
            language: 'pt-BR',
            autoclose: true,
            showOnFocus: false
        })

        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorClass: 'invalid-feedback',
            errorPlacement: function(error, element) {
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })

        const validatedForm = form.validate({
            messages: {
                'meal[created_at]': {
                    required: 'O campo dia é obrigatório.'
                },
                'meal[breakfast][name]': {
                    required: 'O campo Café da manhã é obrigatório'
                },
                'meal[breakfast][amount]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[breakfast][repeat]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[lunch][name]': {
                    required: 'O campo Almoço é obrigatório'
                },
                'meal[lunch][amount]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[lunch][repeat]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[afternoon_snack][name]': {
                    required: 'O campo Lanche da tarde é obrigatório'
                },
                'meal[afternoon_snack][amount]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[afternoon_snack][repeat]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[dinner][name]': {
                    required: 'O campo Jantar é obrigatório'
                },
                'meal[dinner][amount]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                },
                'meal[dinner][repeat]': {
                    required: 'Preenchimento obrigatório.',
                    digits: 'O valor digitado deve ser um número.'
                }
            }
        })

        function addLeftZero(input) {

            input = parseInt(input)

            if (input <= 9 && input.toString().length < 2) return `0${input.toString()}`

            return input
        }

        function setForm(params = {}) {

            $.ajax({
                url: params.url,
                data: {
                    created_at: params.created_at
                },
                success: function(response) {
                    console.log(response)
                    mealsCard.hide()

                    const meals = response.meals

                    if (meals.length > 0) {

                        meals.forEach(function(meal) {
                            $(`[name="meals[${meal.id}][mealtime]"]`).val(addLeftZero(food.mealtime))
                        })

                        submitButton.text('Atualizar Consumo Diário')
                        submitRoute = response.route
                        form.append('<input type="hidden" name="_method" value="patch">')

                    } else {

                        $('.digits').val('')

                        submitRoute = location.href
                        submitButton.text('Cadastrar Cardápio do Dia')
                        form.find('input[name="_method"]').remove()

                    }

                    form.prop('action', submitRoute)

                    mealsCard.fadeIn().show()

                },
                error: function(error) {
                    console.log(error)
                }
            })

        }

        $('#meal-created-at-datepicker-icon').click(function() {
            datepicker.datepicker('show')
        })

        $('#end-created-at-datepicker-icon').click(function() {
            endDatepicker.datepicker('show')
        })

        datepicker.on('changeDate', function(e) {
            $(this).valid()

            const url = $(this).data('url')
            const createdAt = $(this).val()

            $('#end-created-at').value = createdAt

            setForm({
                url: url,
                created_at: createdAt
            })

        })

        endDatepicker.on('changeDate', function(e) {
            $(this).valid()

            const url = $(this).data('url')
            const createdAt = $(this).val()



            setForm({
                url: url,
                created_at: createdAt
            })

        })


        $('.digits').mask('0#', {
            onKeyPress: function(value, event, currentField) {

                $(currentField).val(addLeftZero(value))

            }
        })

        if (datepicker.val()) {
            setForm({
                url: datepicker.data('url'),
                created_at: datepicker.val()
            })
        }
    </script>
@endpush