$(document).ready(function() {
    
    $('#formulario').submit(function(e) { e.preventDefault(); }).validate(
    { 
        debug: true,
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        
        rules: {
            "user": {
                required: true,
                email: true
            },
            "password":{
                required: true,
                minlength: "6"
            }
        },
        
        messages: {
            "user": {
                required: "Introduce email",
                email: "Introduce una dirección válida de email"
            },
            "password":{
                required: "Introduce la contraseña",
                minlength: "Tiene que tener una longitud minima de 6 caracteres"
            }
        },

        submitHandler: function(form) {
            form.submit();
        },
    });



});
