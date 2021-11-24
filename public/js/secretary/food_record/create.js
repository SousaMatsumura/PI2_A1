var submitButton = $('#submit-button')
var form = $('#food-record-form')
var submitRoute = location.href
var foodsCard = $('#foods-card')

let datepicker = $('#food-record-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false
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

const validatedForm = form.validate({
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

function addLeftZero(input) {

    input = parseInt(input)

    if(input <= 9 && input.toString().length < 2) return `0${input.toString()}`

    return input
}

function addInputFoodsRules() {
    $("input[name^='foods']").each(function() {
    
        $(this).rules('add', {
            digits: true,
            messages: {
                digits: 'O campo entrada deve ser um número.'
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

            const foodRecords = response.foodRecords

            if(foodRecords.length > 0) {

                foodRecords.forEach(function(food){
                    $(`[name="foods[${food.food_id}][amount]"]`).val(addLeftZero(food.amount))
                })

                submitButton.text('Atualizar Entrada de Alimentos')
                submitRoute = response.route
                form.append('<input type="hidden" name="_method" value="patch">')

            } else {

                $('.digits').val('')

                submitRoute = location.href
                submitButton.text('Cadastrar Entrada de Alimentos')
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

$('#food-record-created-at-datepicker-icon').click(function(){
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
        $(currentField).val(addLeftZero(value))
    }
})

addInputFoodsRules()

if(datepicker.val()) {
    setForm({
        url: datepicker.data('url'),
        created_at: datepicker.val()
    })
}