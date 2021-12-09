var submitButton = $('#submit-button')
var form = $('#menu-form')
var submitRoute = location.href
var mealsCard = $('#meals-card')
var startDate = new Date()
var endDate = new Date()

startDate.setDate(endDate.getDate() - 7)

let datepicker = $('#menu-created-at').datepicker({
    language: 'pt-BR',
    autoclose: true,
    showOnFocus: false,
    startDate: startDate,
    endDate: endDate
})

jQuery.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback bg-danger text-white p-1 rounded',
    errorPlacement: function (error, element) {
        let elementName = $(element).prop('name')

        if(elementName === 'menu[created_at]') {
            $(error).removeClass('bg-danger text-white p-1 rounded')
        }

        element.closest('.form-group').find('.invalid-feedback').remove()
        element.closest('.form-group').append(error)
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
        'menu[created_at]': {
            required: true
        },
        'meals[breakfast][description]': {
            required: true
        },
        'meals[breakfast][amount]': {
            required: true,
            digits: true
        },
        'meals[breakfast][repeat]': {
            required: true,
            digits: true
        },
        'meals[lunch][description]': {
            required: true
        },
        'meals[lunch][amount]': {
            required: true,
            digits: true
        },
        'meals[lunch][repeat]': {
            required: true,
            digits: true
        },
        'meals[afternoon_snack][description]': {
            required: true
        },
        'meals[afternoon_snack][amount]': {
            required: true,
            digits: true
        },
        'meals[afternoon_snack][repeat]': {
            required: true,
            digits: true
        },
        'meals[dinner][description]': {
            required: true
        },
        'meals[dinner][amount]': {
            required: true,
            digits: true
        },
        'meals[dinner][repeat]': {
            required: true,
            digits: true
        },
    },
    messages: {
        'menu[created_at]': {
            required: 'O campo dia é obrigatório.'
        },
        'meals[breakfast][description]': {
            required: 'O campo lanche da manhã é obrigatório.'
        },
        'meals[breakfast][amount]': {
            required: 'O campo quantidade é obrigatório.',
            digits: 'O campo quantidade deve ser um número.'
        },
        'meals[breakfast][repeat]': {
            required: 'O campo repetições é obrigatório.',
            digits: 'O campo repetições deve ser um número.'
        },
        'meals[lunch][description]': {
            required: 'O campo almoço é obrigatório.'
        },
        'meals[lunch][amount]': {
            required: 'O campo quantidade é obrigatório.',
            digits: 'O campo quantidade deve ser um número.'
        },
        'meals[lunch][repeat]': {
            required: 'O campo repetições é obrigatório.',
            digits: 'O campo repetições deve ser um número.'
        },
        'meals[afternoon_snack][description]': {
            required: 'O campo lanche da tarde é obrigatório.'
        },
        'meals[afternoon_snack][amount]': {
            required: 'O campo quantidade é obrigatório.',
            digits: 'O campo quantidade deve ser um número.'
        },
        'meals[afternoon_snack][repeat]': {
            required: 'O campo repetições é obrigatório.',
            digits: 'O campo repetições deve ser um número.'
        },
        'meals[dinner][description]': {
            required: 'O campo janta é obrigatório.'
        },
        'meals[dinner][amount]': {
            required: 'O campo quantidade é obrigatório.',
            digits: 'O campo quantidade deve ser um número.'
        },
        'meals[dinner][repeat]': {
            required: 'O campo repetições é obrigatório.',
            digits: 'O campo repetições deve ser um número.'
        },
    }
})

function addLeftZero(input) {

    input = input ? parseInt(input) : 0

    if(input <= 9 && input.toString().length < 2) return `0${input.toString()}`

    return input
}

function setForm(params = {}) {

    $.ajax({
        url: params.url,
        data: {
            created_at: params.created_at
        },
        success:function(response) {
            
            mealsCard.hide()

            const menus = response.menus

            if(menus.length > 0) {

                form.find('.form-control').removeClass('is-invalid')

                menus.forEach(function(menu){
                    $(`[name="meals[${menu.mealtime}][description]"]`).val(menu.description)
                    $(`[name="meals[${menu.mealtime}][amount]"]`).val(addLeftZero(menu.amount))
                    $(`[name="meals[${menu.mealtime}][repeat]"]`).val(addLeftZero(menu.repeat))
                })

                submitButton.text('Atualizar Cardápio do Dia')
                submitRoute = response.route
                form.append('<input type="hidden" name="_method" value="patch">')

            } else {

                $('.digits, textarea.form-control').val('')

                submitRoute = location.href
                submitButton.text('Cadastrar Cardápio do Dia')
                form.find('input[name="_method"]').remove()

            }

            form.prop('action', submitRoute)

            mealsCard.fadeIn().show()

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

if(datepicker.val()) {
    setForm({
        url: datepicker.data('url'),
        created_at: datepicker.val()
    })
}