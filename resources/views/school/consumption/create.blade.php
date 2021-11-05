@extends('layouts.app')

@section('title', 'Cadastrar Consumo Diário')

@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/gijgo/gijgo.min.css') }}">
@endpush

@section('content')
<form id="consumption-form" action="{{ route('school.consumption.store') }}" method="POST">
@csrf
<div class="mb-4">
    <div class="form-group">
        <div class="row">
            <div class="col-auto d-flex align-items-center py-0 pr-0">
                <label class="my-auto">Dia:</label>
            </div>
            <div class="col-md-4">
                <input 
                    id="food_record-created-at" 
                    type="text" 
                    name="food_record[created_at]" 
                    class="form-control @error('food_record.created_at') is-invalid @enderror" 
                    placeholder="Buscar..." 
                    readonly
                    value="{{ old('food_record.created_at') }}"
                    data-url="{{ route('school.consumption.index') }}"
                >
                @error('food_record.created_at')
                    <span class="text-danger d-block small">
                        {{ $errors->first('food_record.created_at') }}
                    </span>
                @enderror
            </div>
        </div>
        
        
    </div>
</div>

<div class="card">
    <div class="card-body p-2 bg-primary">
        <div class="p-2 bg-white">
            <table class="table table-borderless table-sm w-100 m-0">
                <thead>
                    <tr class="bg-white border-bottom">
                        <th class="p-2">Alimentos</th>
                        <th class="text-center">Unidade de Medida</th>
                        <th class="text-center">Quantidade Consumida</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($foodRecords as $record)
                    <tr class="bg-white">
                        <td class="p-2">{{ $record->food }}</td>
                        <td class="text-center">{{ $record->unit }}</td>
                        <td class="w-25">
                            <div class="form-group m-0">
                                <input 
                                    type="text" 
                                    name="foods[{{ $record->id }}][amount_consumed]" 
                                    class="form-control form-control-sm border-top-0 border-left-0 border-right-0 rounded-0 text-center zero-left @error('foods.'.$record->id.'.quantity') is-invalid @enderror"
                                    data-max="{{ $record->amount }}"
                                    value={{ old('foods.'.$record->id.'.amount_consumed') ?: '00' }}
                                >
                                @error('foods.'.$record->id.'.amount_consumed')
                                    <span class="text-danger d-block small text-center">
                                        {{ $errors->first('foods.'.$record->id.'.amount_consumed') }}
                                    </span>
                                @enderror
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
    
            </table>
        </div>
        <div class="text-center my-2">
            <button class="btn btn-success active">
                Cadastrar
            </button>
        </div>
    </div>
</div>
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

                /**$.ajax({
                    url: url,
                    data: {
                        created_at: createdAt
                    },
                    success:function(response) {
                        console.log(response)
                    },
                    error:function(error) {
                        console.log(error)
                    }
                })**/

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