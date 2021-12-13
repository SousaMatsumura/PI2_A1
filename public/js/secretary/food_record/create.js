var submitButton = $('#submit-button')
var form = $('#food-record-form')
var submitRoute = location.href
var foodsCard = $('#foods-card')
var today = new Date()

let datepicker = $('#food-record-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    endDate: today,
})



datepicker.val(today.toLocaleDateString('pt-BR', {timeZone: 'America/Sao_Paulo'}))

$( "#food-record-created-at" ).change(function() {
    var currentStringDate = $('#food-record-created-at').val().split('/')
    var currentDate = new Date(currentStringDate[2], currentStringDate[1] - 1, currentStringDate[0])
    var todayDateOnly = new Date(today.toDateString())

    if(currentDate.valueOf() != todayDateOnly.valueOf()){
        $('.read-only').attr('readonly', 'readonly');
    }else{
        $('.read-only').removeAttr('readonly');
    }
});

$('#food-record-created-at-datepicker-icon').click(function() {
    datepicker.datepicker('show')
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
    
    input = input ? parseInt(input) : 0

    if(input <= 9 && input.toString().length < 2) return `0${input.toString()}`

    return input
}

function addInputFoodsRules() {
    $("input[name^='foods']").each(function() {
        
        let min = $(this).data('min')
        // min = parseInt(min)

        console.log(min)

        $(this).rules('add', {
            min: min,
            digits: true,
            messages: {
                min: `O campo quantidade não pode ser inferior a {0}`,
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
                    $(`[name="foods[${food.id}][amount]"]`).val(addLeftZero(food.amount ?? 0))
                })

                if(response.route) {
                    submitButton.text('Atualizar Entrada de Alimentos')
                    submitRoute = response.route
                    form.append('<input type="hidden" name="_method" value="patch">')
                }
                

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
        
        value = value ?? '0'
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

$(window).on('load', function(){
    $('.food-amount-remaining').each(function(){
        let value = $(this).text() ? addLeftZero($(this).text()) : '00'

        $(this).text(value)
    })
})