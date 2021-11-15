@extends('layouts.app')

@section('title', 'Editar Instituição')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/gijgo/gijgo.min.css') }}">
@endpush

@section('content')
<form action="{{ route('secretary.institution.update', $institution->id) }}" method="POST" autocomplete="off">
        @method('PUT')
        @include('secretary.institutions._partials.form')
    </form>   
@endsection

@push('js')
    <script src="{{ asset('vendor/gijgo/gijgo.min.js') }}"></script>
    <script src="{{ asset('vendor/gijgo/messages.pt-br.js') }}"></script>
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>

        $('#food_record-created-at').datepicker({
            locale: 'pt-br',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            format: 'dd/mm/yyyy',
            showOnFocus: false,
            change:function(event) {
                $(this).valid()

                const url = $(this).data('url')
                const createdAt = $(this).val()
                let value = $(this).val()

                value = value === $(this).val() ? value : $(this).val()

                if(value === $(this))

                console.log(value)
            },
        })

        $(document).on('change', '#food_record-create-at', function(){
            console.log($(this).val())
        })

        $('.zero-left').mask('0#', {
            onKeyPress: function(value, event, currentField) {
                console.log(parseInt(value))
                value = parseInt(value)
                
                if(value <= 9 && value.toString().length < 2) {
                    $(currentField).val(`0${value.toString()}`)
                } else {
                    $(currentField).val(value)
                }
            }
        })

        jQuery.validator.setDefaults({
            errorElement: 'span',
            errorClass: 'invalid-feedback text-center',
            errorPlacement: function (error, element) {
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        })

        $('#consumption-form').validate({
            rules: {
                'food_record[created_at]': {
                    required: true
                }
            },
            messages: {
                'food_record[created_at]': {
                    required: 'O campo dia é obrigatório.'
                }
            }
        })

        $("input[name^='foods']").each(function() {
            
            let max = $(this).data('max')

            $(this).rules('add', {
                required: true,
                max: max,
                messages: {
                    required: 'Informe a quantidade consumida',
                    max: `O campo quantidade não pode ser superior a {0}`
                }
            })

        })


    </script>
@endpush