@extends('layouts.app')

@section('title', 'Cadastrar Cardápio do Dia')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
<p class="small">Os campos marcados com <span class="text-danger">*</span> são de preenchimento obrigatório.</p>
<form id="menu-form" action="{{ route('school.menu.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <div class="form-group">
            <div class="row">
                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Dia: <small class="text-danger">*</small></label>
                </div>
                <div class="col-md-4">

                    <div class="input-group bg-primary rounded">
                        <input id="menu-created-at" type="text" name="menu[created_at]" class="form-control bg-primary text-dark border-0 @error('menu.created_at') is-invalid @enderror" placeholder="Buscar..." readonly value="{{ old('menu.created_at') }}" data-url="{{ 'school.menu.index' }}">
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="menu-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-dark"></i>
                            </span>
                        </div>
                    </div>

                    @error('menu.created_at')
                    <span class="text-danger d-block small">
                        {{ $errors->first('menu.created_at') }}
                    </span>
                    @enderror
                </div>
            </div>


        </div>
    </div>

    <div id="meals-card" class="card">
        <div class="card-body p-2 bg-primary">
            <div class="p-2 bg-white">

                <!-- breakfast -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form group">
                            <textarea name="meal[breakfast][description]" class="form-control @error('meal.breakfast.description') is-invalid @enderror" placeholder="Café da Manhã"></textarea>
                            @error('meal.breakfast.description')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.breakfast.description') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[breakfast][amount]" class="form-control digits @error('meal.breakfast.amount') is-invalid @enderror" placeholder="quantidade">
                            @error('meal.breakfast.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.breakfast.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[breakfast][repeat]" class="form-control digits @error('meal.breakfast.repeat') is-invalid @enderror" placeholder="repetições">
                            @error('meal.breakfast.repeat')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.breakfast.repeat') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- lunch -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form group">
                            <textarea name="meal[lunch][description]" class="form-control @error('meal.lunch.description') is-invalid @enderror" placeholder="Almoço"></textarea>
                            @error('meal.lunch.description')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.lunch.description') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[lunch][amount]" class="form-control digits @error('meal.lunch.amount') is-invalid @enderror" placeholder="quantidade">
                            @error('meal.lunch.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.lunch.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[lunch][repeat]" class="form-control digits @error('meal.lunch.repeat') is-invalid @enderror" placeholder="repetições">
                            @error('meal.lunch.repeat')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.lunch.repeat') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- afternoon_snack -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form group">
                            <textarea name="meal[afternoon_snack][description]" class="form-control @error('meal.afternoon_snack.description') is-invalid @enderror" placeholder="Lanche da Tarde"></textarea>
                            @error('meal.afternoon_snack.description')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.afternoon_snack.description') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[afternoon_snack][amount]" class="form-control digits @error('meal.afternoon_snack.amount') is-invalid @enderror" placeholder="quantidade">
                            @error('meal.afternoon_snack.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.afternoon_snack.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[afternoon_snack][repeat]" class="form-control digits @error('meal.afternoon_snack.repeat') is-invalid @enderror" placeholder="repetições">
                            @error('meal.afternoon_snack.repeat')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.afternoon_snack.repeat') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Dinner -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="form group">
                            <textarea name="meal[dinner][description]" class="form-control @error('meal.dinner.description') is-invalid @enderror" placeholder="Jantar"></textarea>
                            @error('meal.dinner.description')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.dinner.description') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[dinner][amount]" class="form-control digits @error('meal.dinner.amount') is-invalid @enderror" placeholder="quantidade">
                            @error('meal.dinner.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.dinner.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[dinner][repeat]" class="form-control digits @error('meal.dinner.repeat') is-invalid @enderror" placeholder="repetições">
                            @error('meal.dinner.repeat')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.dinner.repeat') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center my-2">
                <button id="submit-button" class="btn btn-primary active">
                    Cadastrar Cardápio do Dia
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@push('js')
<script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
<script>
    var submitButton = $('#submit-button')
    var form = $('#menu-form')
    var submitRoute = location.href
    var mealsCard = $('#meals-card')

    let datepicker = $('#menu-created-at').datepicker({
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
        rules: {
            'menu[created_at]': {
                required: true
            },
            'meal[breakfast][description]': {
                required: true
            },
            'meal[breakfast][amount]': {
                required: true,
                digits: true
            },
            'meal[breakfast][repeat]': {
                required: true,
                digits: true
            },
            'meal[lunch][description]': {
                required: true
            },
            'meal[lunch][amount]': {
                required: true,
                digits: true
            },
            'meal[lunch][repeat]': {
                required: true,
                digits: true
            },
            'meal[afternoon_snack][description]': {
                required: true
            },
            'meal[afternoon_snack][amount]': {
                required: true,
                digits: true
            },
            'meal[afternoon_snack][repeat]': {
                required: true,
                digits: true
            },
            'meal[dinner][description]': {
                required: true
            },
            'meal[dinner][amount]': {
                required: true,
                digits: true
            },
            'meal[dinner][repeat]': {
                required: true,
                digits: true
            },
        },
        messages: {
            'menu[created_at]': {
                required: 'O campo data é obrigatório.'
            },
            'meal[breakfast][description]': {
                required: 'Preenchimento obrigatório.'
            },
            'meal[breakfast][amount]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[breakfast][repeat]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[lunch][description]': {
                required: 'Preenchimento obrigatório.'
            },
            'meal[lunch][amount]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[lunch][repeat]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[afternoon_snack][description]': {
                required: 'Preenchimento obrigatório.'
            },
            'meal[afternoon_snack][amount]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[afternoon_snack][repeat]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[dinner][description]': {
                required: 'Preenchimento obrigatório.'
            },
            'meal[dinner][amount]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
            'meal[dinner][repeat]': {
                required: 'Preenchimento obrigatório.',
                digits: 'O valor do campo deve ser um número.'
            },
        }
    })

    function setForm(params = {}) {

        $.ajax({
            url: params.url,
            data: {
                created_at: params.created_at
            },
            success: function(response) {

                console.log(response)
                mealsCard.hide()
                
                // const meals = response.meals
                // if (meals.length > 0) {
                //     meals.forEach(function(meal) {
                //         $(`[name="meals[${meal.id}][mealtime]"]`).val(addLeftZero(food.mealtime))
                //     })
                //     submitButton.text('Atualizar Consumo Diário')
                //     submitRoute = response.route
                //     form.append('<input type="hidden" name="_method" value="patch">')
                // } else {
                //     $('.digits').val('')
                //     submitRoute = location.href
                //     submitButton.text('Cadastrar Cardápio do Dia')
                //     form.find('input[name="_method"]').remove()
                // }
                // form.prop('action', submitRoute)
                // mealsCard.fadeIn().show()
            },
            error: function(error) {
                console.log(error)
            }
        })

    }

    function addLeftZero(input) {

        input = parseInt(input)

        if (input <= 9 && input.toString().length < 2) return `0${input.toString()}`

        return input
    }

    $('#menu-created-at-datepicker-icon').click(function() {
        datepicker.datepicker('show')
    })

    datepicker.on('changeDate', function(e) {
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