var submitButton = $('#submit-button')
var form = $('#consumption-form')
var submitRoute = location.href
var foodsCard = $('#foods-card')
var startDate = new Date()
var endDate = new Date()

startDate.setDate(endDate.getDate() - 7)

let datepicker = $('#consumption-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    startDate: startDate,
    endDate: endDate
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

const validatedForm = $('#consumption-form').validate({
    rules: {
        'consumption[created_at]': {
            required: true
        }
    },
    messages: {
        'consumption[created_at]': {
            required: 'O campo dia é obrigatório.'
        }
    }
})

function addLeftZero(input) {

    input = input ? parseInt(input) : 0

    if(input <= 9 && input.toString().length < 2) return `0${input.toString()}`

    return input
}

function addInputFoodsRules() {
    $("input[name^='foods']").each(function() {
    
        let max = $(this).data('max')
        let value = parseInt($(this).val())

        max = value ? max + value : max
        max = parseInt(max)
        
        $(this).rules('remove', 'max')
        $(this).rules('add', {
            max: max,
            digits: true,
            messages: {
                max: `O campo quantidade não pode ser superior a {0}`,
                digits: ''
            }
        })

        $(this).valid()

        validatedForm.valid()

    })
}

function setForm(params = {}) {

    $.ajax({
        url: params.url,
        data: {
            created_at: params.created_at
        },
        success:function(response) {
            
            foodsCard.hide()

            const consumptions = response.consumptions

            if(consumptions.length > 0) {

                $('[name^="foods["]').val('')

                consumptions.forEach(function(food){
                    $(`[name="foods[${food.id}][amount_consumed]"]`).val(addLeftZero(food.amount_consumed))
                })

                submitButton.text('Atualizar Consumo Diário')
                submitRoute = response.route
                form.append('<input type="hidden" name="_method" value="patch">')

            } else {

                $('.digits').val('')

                submitRoute = location.href
                submitButton.text('Cadastrar Consumo Diário')
                form.find('input[name="_method"]').remove()

            }

            form.prop('action', submitRoute)

            addInputFoodsRules()

            foodsCard.fadeIn().show()

        },
        error:function(error) {
            console.log(error)
        }
    })

}

$('#consumption-created-at-datepicker-icon').click(function(){
    datepicker.datepicker('show')
})

datepicker.on('changeDate', function(e){
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
        
        let max = parseInt($(currentField).data('max'))

        value = value ?? 0

        if(value <= max) {
            $(currentField).val(addLeftZero(value))
        } else {
            $(currentField).val(value.substring(0, value.length - 1))
        }
        
    }
})

addInputFoodsRules()

if(datepicker.val()) {
    setForm({
        url: datepicker.data('url'),
        created_at: datepicker.val()
    })
}

$(window).on('load', function(){
    $('.record-amount-remaining').each(function(){
        let value = $(this).text() ? addLeftZero($(this).text()) : '00'

        $(this).text(value)
    })
})