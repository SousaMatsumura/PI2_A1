var form = $('#school-form')

function fetchZipcode(zipcode) {
    $.ajax({
        
        url: `https://viacep.com.br/ws/${zipcode}/json/`,
        
        success: function(response) {
            
            if(response.erro){
                $('#alert-modal').modal('show')

                $('[name^="address["]:not([name="address[zipcode]"])').val('')

            } else {

                $('[name="address[street]"]').val(response.logradouro)
                $('[name="address[district]"]').val(response.bairro)
                $('[name="address[city]"]').val(response.localidade)
                $('[name="address[state]"]').val(response.uf)
                $('[name="address[complement]"]').val(response.complemento)

            }

            

        }

    })
}


$('.zipcode').mask('00000-000', {
    onComplete(zipcode) {
        fetchZipcode(zipcode)
    }
});
$('.phone').mask('(00) 0000-00009');

$('.phone').blur(function(event) {

    if($(this).val().length == 11){
        $('.phone').mask('(00) 00000-0009')
    } else {
        $('.phone').mask('(00) 0000-00009')
    }
})

$('.phone').trigger('blur')

$('.number').mask('0#')

jQuery.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback bg-danger text-white rounded px-2',
    errorPlacement: function (error, element) {
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid')
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid')
    }
})

jQuery.validator.addMethod('phone', function (value, element) {
    
    value = value.replace('(', '')
    value = value.replace(')', '')
    value = value.replace('-', '')
    value = value.replace(' ', '')

    return this.optional(element) || /[0-9]{10}/.test(value) || /[0-9]{11}/.test(value)

}, 'O campo {0} não é um telefone válido.')

jQuery.validator.addMethod('zipcode', function(value, element) {
    return this.optional(element) || /^[0-9]{2}[0-9]{3}-[0-9]{3}$/.test(value);
}, 'O campo {0} não é um CEP válido.')

form.validate({
    rules: {
        'institution[name]': {
            required: true
        },
        'institution[phone]': {
            required: true,
            phone: true
        },
        'address[zipcode]': {
            required: true,
            zipcode: true
        },
        'address[street]': {
            required: true
        },
        'address[number]': {
            required: true
        },
        'address[district]': {
            required: true
        },
        'address[city]': {
            required: true
        },
        'address[state]': {
            required: true
        },
        'institution[students]': {
            required: true,
            digits: true
        }
    },
    messages: {
        'institution[name]': {
            required: 'O campo nome é obrigatório.'
        },
        'institution[phone]': {
            required: 'O campo telefone é obrigatório.',
            phone: 'O campo telefone não é um telefone válido.'
        },
        'address[zipcode]': {
            required: 'O campo CEP é obrigatório.',
            zipcode: 'O campo CEP não é um CEP válido.'
        },
        'address[street]': {
            required: 'O campo endereço é obrigatório.'
        },
        'address[number]': {
            required: 'O campo número é obrigatório.'
        },
        'address[district]': {
            required: 'O campo bairro é obrigatório.'
        },
        'address[city]': {
            required: 'O campo cidade é obrigatório.'
        },
        'address[state]': {
            required: 'O campo UF é obrigatório.'
        },
        'institution[students]': {
            required: 'O campo alunos é obrigatório.',
            digits: 'O campo alunos deve ser um número.'
        }
    }
})