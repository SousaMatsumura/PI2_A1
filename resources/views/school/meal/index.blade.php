@extends('layouts.app')

@section('title', 'Cadastrar Cardápio Diário')

@push('css')
<link rel="stylesheet" href="{{ asset('vendor/gijgo/gijgo.min.css') }}">
@endpush


@section('content')
<form id="meal-form" action="{{ route('school.meal.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <div class="form-group">
            <div class="row">
                <div class="col-auto d-flex align-items-center py-0 pr-0">
                    <label class="my-auto">Dia:</label>
                </div>
                <div class="col-md-4">
                    <div class="input-group rounded">
                        <input id="meal-created-at" type="date" name="meal[created_at]" class="form-control text-white border-0 @error('meal.created_at') is-invalid @enderror" 
                            placeholder="Buscar..." readonly value="{{ old('meal.created_at') }}" data-url="{{ route('school.meal.index') }}">
                        <label class="input-group-append" for="meal-created-at">
                            <span class="input-group-text border-0" id="meal-created-at-datepicker-icon">
                                <i class="fa fa-fw fa-calendar text-primary" style="color:blue"></i>
                            </span>
                        </label>
                </div>
                    @error('meal.created_at')
                    <span class="text-danger d-block small">
                        {{ $errors->first('meal.created_at') }}
                    </span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('school.meal.store')}}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="meal[name0]" class="form-control {{ $errors->has('meal.name') ? 'is-invalid' : '' }}" placeholder="Refeição" value="{{ old('meal.name') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.name') }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[amount0]" class="form-control amount {{ $errors->has('meal.amount') ? 'is-invalid' : '' }}" placeholder="Refeições servidas" value="{{ old('meal.amount') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.amount') }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[repeat0]" class="form-control repeat {{ $errors->has('meal.repeat') ? 'is-invalid' : '' }}" id="repeat" id="repeat[0]" placeholder="Repetições servidas" value="{{ old('meal.repeat') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.repeat') }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="meal[name1]" class="form-control {{ $errors->has('meal.name') ? 'is-invalid' : '' }}" placeholder="Refeição" value="{{ old('meal.name') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.name') }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[amount1]" class="form-control amount {{ $errors->has('meal.amount') ? 'is-invalid' : '' }}" placeholder="Refeições servidas" value="{{ old('meal.amount') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.amount') }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[repeat1]" class="form-control repeat {{ $errors->has('meal.repeat') ? 'is-invalid' : '' }}" id="repeat" id="repeat[0]" placeholder="Repetições servidas" value="{{ old('meal.repeat') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.repeat') }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="meal[name2]" class="form-control {{ $errors->has('meal.name') ? 'is-invalid' : '' }}" placeholder="Refeição" value="{{ old('meal.name') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.name') }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[amount2]" class="form-control amount {{ $errors->has('meal.amount') ? 'is-invalid' : '' }}" placeholder="Refeições servidas" value="{{ old('meal.amount') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.amount') }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[repeat2]" class="form-control repeat {{ $errors->has('meal.repeat') ? 'is-invalid' : '' }}" id="repeat" id="repeat[0]" placeholder="Repetições servidas" value="{{ old('meal.repeat') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.repeat') }}</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="meal[name3]" class="form-control {{ $errors->has('meal.name') ? 'is-invalid' : '' }}" placeholder="Refeição" value="{{ old('meal.name') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.name') }}</div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[amount3]" class="form-control amount {{ $errors->has('meal.amount') ? 'is-invalid' : '' }}" placeholder="Refeições servidas" value="{{ old('meal.amount') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.amount') }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" name="meal[repeat3]" class="form-control repeat {{ $errors->has('meal.repeat') ? 'is-invalid' : '' }}" id="repeat" id="repeat[0]" placeholder="Repetições servidas" value="{{ old('meal.repeat') }}">
                    <div class="invalid-feedback">{{ $errors->first('meal.repeat') }}</div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success btn-block mt-3">
            Cadastrar
        </button>

    </form>
</form>
@endsection

@push('js')
<script src="{{ asset('vendor/gijgo/gijgo.min.js') }}"></script>
<script src="{{ asset('vendor/gijgo/messages.pt-br.js') }}"></script>
<script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $('#meal-created-at').datepicker({
        locale: 'pt-br',
        uiLibrary: 'bootstrap4',
        iconsLibrary: 'fontawesome',
        format: 'dd/mm/yyyy',
        showOnFocus: false,
        change: function(event) {
            $(this).valid()

            const url = $(this).data('url')
            const createdAt = $(this).val()
            let value = $(this).val()

            value = value === $(this).val() ? value : $(this).val()

            if (value === $(this))

                console.log(value)


        },
    })

    $(document).on('change', '#meal-create-at', function() {
        console.log($(this).val())
    })

    $('.zero-left').mask('0#', {
        onKeyPress: function(value, event, currentField) {
            console.log(parseInt(value))
            value = parseInt(value)

            if (value <= 9 && value.toString().length < 2) {
                $(currentField).val(`0${value.toString()}`)
            } else {
                $(currentField).val(value)
            }
        }
    })

    jQuery.validator.setDefaults({
        errorElement: 'span',
        errorClass: 'invalid-feedback text-center',
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

    $('#meal-form').validate({
        rules: {
            'meal[created_at]': {
                required: true
            },
            'meal[mealtime]': {
                required: true
            }

        },
        messages: {
            'meal[created_at]': {
                required: 'O campo dia é obrigatório.'
            }
        }
    })

    $("input[name^='meal']").each(function() {

        $(this).rules('add', {
            required: true,
            messages: {
                required: 'Preenchimento obrigatório.'
            }
        })

    })
</script>
@endpush