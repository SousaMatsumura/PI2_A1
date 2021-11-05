jQuery.validator.setDefaults({
    errorElement: 'span',
    errorClass: 'invalid-feedback text-white bg-danger p-1 rounded',
    errorPlacement: function (error, element) {
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});
$('#login-form').validate({
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    },
    messages: {
        username: {
            required: 'O campo username é obrigatório'
        },
        password: {
            required: 'O campo senha é obrigatório'
        }
    }
})