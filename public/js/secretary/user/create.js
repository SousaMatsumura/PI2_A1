// Mascara
$('.phone').mask('(00) 0000-00009')

$('.phone').blur(function(event) {
    if($(this).val().length == 15){
        $('.phone').mask('(00) 00000-0009')
    } else {
        $('.phone').mask('(00) 0000-00009')
    }
})

$('.phone').trigger('blur')

// Validação
jQuery.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback bg-danger text-white p-1 rounded',
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

jQuery.validator.addMethod('phone', function (value, element) {
    
    value = value.replace('(', '')
    value = value.replace(')', '')
    value = value.replace('-', '')
    value = value.replace(' ', '')

    return this.optional(element) || /[0-9]{10}/.test(value) || /[0-9]{11}/.test(value)

}, 'O campo {0} não é um telefone válido.')

$('#user-form').validate({
    rules: {
        'user[name]': {
            required: true
        },
        'user[institution_id]' : {
            required: true
        },
        'user[email]': {
            required: true,
            email: true
        },
        'user[phone]': {
            required: true,
            phone: true
        },
        'user[username]': {
            required: true
        },
        'user[password]': {
            required: true,
            minlength: 8
        }
    },
    messages: {
        'user[name]': {
            required: 'O campo nome é obrigatório.'
        },
        'user[institution_id]' : {
            required: 'O campo escola / instituição é obrigatório.'
        },
        'user[email]': {
            required: 'O campo email é obrigatório.',
            email: 'O campo email deve ser um endereço de e-mail válido.'
        },
        'user[phone]': {
            required: 'O campo telefone é obrigatório.',
            phone: 'O campo telefone não é um telefone válido.'
        },
        'user[username]': {
            required: 'O campo username é obrigatório.'
        },
        'user[password]': {
            required: 'O campo senha é obrigatório.',
            minlength: 'O campo senha deve ter pelo menos 8 caracteres.'
        }
    }
})