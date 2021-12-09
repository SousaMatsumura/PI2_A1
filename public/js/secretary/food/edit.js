$('#restore-modal').modal('show')

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

$('#food-form').validate({
    rules: {
        'food[name]': {
            required: true
        },
        'food[unit]' : {
            required: true
        }
    },
    messages: {
        'food[name]': {
            required: 'O campo nome é obrigatório.'
        },
        'food[unit]' : {
            required: 'O campo unidade de medida é obrigatório.'
        }
    }
})