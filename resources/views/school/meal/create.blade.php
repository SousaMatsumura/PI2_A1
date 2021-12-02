@extends('layouts.app')

@section('title', 'Cadastrar Cardápio do Dia')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endpush

@section('content')
<form id="meal-form" action="{{ route('school.meal.store') }}" method="POST">

    @csrf

    <div class="mb-4">
        <div class="form-group">
            <div class="row">
                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Dia: </label>
                </div>
                <div class="col-md-4">

                    <div class="input-group bg-primary rounded">
                        <input
                            id="meal-created-at"
                            type="text"
                            name="meal[createdAt]"
                            class="form-control bg-primary text-white border-0 @error('meal.createdAt') is-invalid @enderror"
                            placeholder="Buscar..." 
                            readonly value="{{ old('meal.createdAt') }}"
                            data-url="{{ route('school.meal.index') }}"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-primary border-0" id="meal-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-white"></i>
                            </span>
                        </div>
                    </div>

                    @error('meal.createdAt')
                    <span class="text-danger d-block small">
                        {{ $errors->first('meal.createdAt') }}
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
                    <div class="col-md-6">
                        <div class="form group">
                            <textarea name="meal[breakfast][name]" class="form-control @error('meal.breakfast.name') is-invalid                                    
                                    @enderror" placeholder="Café da manhã"></textarea>
                            @error('meal.breakfast.name')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.breakfast.name') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[breakfast][amount]" class="form-control digits @error('meal.breakfast.amount') is-invalid                                    
                                    @enderror" placeholder="Quantidade">
                            @error('meal.breakfast.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.breakfast.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[breakfast][repeat]" class="form control digits @error('meal.breakfast.repeat') is-invalid                                    
                                    @enderror" placeholder="Repetições">
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
                    <div class="col-md-6">
                        <div class="form group">
                            <textarea name="meal[lunch][name]" class="form-control @error('meal.lunch.name') is-invalid                                    
                                    @enderror" placeholder="Almoço"></textarea>
                            @error('meal.lunch.name')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.lunch.name') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[lunch][amount]" class="form-control digits @error('meal.lunch.amount') is-invalid                                    
                                    @enderror" placeholder="Quantidade">
                            @error('meal.lunch.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.lunch.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[lunch][repeat]" class="form control digits @error('meal.lunch.repeat') is-invalid                                    
                                    @enderror" placeholder="Repetições">
                            @error('meal.lunch.repeat')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.lunch.repeat') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- snack -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form group">
                            <textarea name="meal[afternoon_snack][name]" class="form-control @error('meal.afternoon_snack.name') is-invalid                                    
                                    @enderror" placeholder="Lanche da tarde"></textarea>
                            @error('meal.afternoon_snack.name')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.afternoon_snack.name') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[afternoon_snack][amount]" class="form-control digits @error('meal.afternoon_snack.amount') is-invalid                                    
                                    @enderror" placeholder="Quantidade">
                            @error('meal.afternoon_snack.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.afternoon_snack.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[afternoon_snack][repeat]" class="form control digits @error('meal.afternoon_snack.repeat') is-invalid                                    
                                    @enderror" placeholder="Repetições">
                            @error('meal.afternoon_snack.repeat')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.afternoon_snack.repeat') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- dinner -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form group">
                            <textarea name="meal[dinner][name]" class="form-control @error('meal.dinner.name') is-invalid                                    
                                    @enderror" placeholder="Jantar"></textarea>
                            @error('meal.dinner.name')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.dinner.name') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[dinner][amount]" class="form-control digits @error('meal.dinner.amount') is-invalid                                    
                                    @enderror" placeholder="Quantidade">
                            @error('meal.dinner.amount')
                            <span class="text-danger d-block small">
                                {{ $errors->first('meal.dinner.amount') }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form group">
                            <input type="text" name="meal[dinner][repeat]" class="form control digits @error('meal.dinner.repeat') is-invalid                                    
                                    @enderror" placeholder="Repetições">
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
<!-- <script src="{{ asset('js/school/meal/create.js') }}"></script> -->
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
        // rules: {
        //     'meal[created_at]': {
        //         required: true
        //     },
        //     'meal[breakfast][name]': {
        //         required: true
        //     },
        //     'meal[breakfast][amount]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[breakfast][repeat]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[lunch][name]': {
        //         required: true
        //     },
        //     'meal[lunch][amount]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[lunch][repeat]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[afternoon_snack][name]': {
        //         required: true
        //     },
        //     'meal[afternoon_snack][amount]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[afternoon_snack][repeat]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[dinner][name]': {
        //         required: true
        //     },
        //     'meal[dinner][amount]': {
        //         required: true,
        //         digits: true
        //     },
        //     'meal[dinner][repeat]': {
        //         required: true,
        //         digits: true
        //     }
        // },
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
                // mealsCard.hide()

                // const consumptions = response.consumptions

                // if (consumptions.length > 0) {

                //     consumptions.forEach(function(food) {
                //         $(`[name="foods[${food.id}][amount_consumed]"]`).val(addLeftZero(food.amount_consumed))
                //     })

                //     submitButton.text('Atualizar Consumo Diário')
                //     submitRoute = response.route
                //     form.append('<input type="hidden" name="_method" value="patch">')

                // } else {

                //     $('.digits').val('')

                //     submitRoute = location.href
                //     submitButton.text('Cadastrar Consumo Diário')
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

    $('#meal-created-at-datepicker-icon').click(function() {
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