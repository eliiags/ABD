$(document).ready(function() {

    $('#formulario').submit(function(e) { e.preventDefault(); }).validate(
    { 
        debug: true,
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        
        rules: {
           "nombre": {
                required: true
            },
            "apellidos": {
                required: true
            },
            "edad":{
                required: true,
                number: true
            },
            "tipo_musica":{ 
                required: true
            },
            "email": {
                required: true,
                email: true
            },
            "pass":{
                required: true,
                minlength: "6"
            },
            "confirm_password":{
                required: true,
                equalTo:"#pass"
            },
        },
        
        messages: {
             "nombre": {
                required: "Introduce tu nombre."
            },
            "apellidos": {
                required: "Introduce tus apellidos.",
            },
            "edad":{
                required: "Introduce tu edad.",
                number: "La edad debe ser un número."
            },
            "tipo_musica": { 
                required: "Por favor, selecciona un tipo de música!" 
            },
            "email": {
                required: "Introduce tu correo.",
                email: "Introduce un email válido."
            },
            "pass":{
                required: "Introduce la contraseña.",
                minlength: "La contraseña debe tener una longitud mínima de 6 caracteres."
            },
            "confirm_pass":{
                required: "Introduce la contraseña de nuevo.",
                equalTo:"La contraseña debe ser igual a la contraseña indicada anteriormente."
            },
        },

         submitHandler: function(form) {
            form.submit();
        },
    });
});