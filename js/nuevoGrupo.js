$(document).ready(function() {

    document.getElementById("cerrar").onclick=function(){

        var elemento = document.getElementById("nombre_grupo");
        elemento.value="";      
        elemento = document.getElementById("tipo_musica");
        elemento.value="";
        elemento = document.getElementById("edad_min");
        elemento.value="";
        elemento = document.getElementById("edad_max");
        elemento.value="";      
    }


    
    $('#nuevo_grupo').submit(function(e) { e.preventDefault(); }).validate(
    { 
        debug: true,
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        
        rules: {
            "nombre_grupo": {
                required: true
            },
            "tipo_musica":{ 
                required: true
            },
            "edad_min":{
                required: true,
                number: true
            },
            "edad_max":{
                required: true,
                number: true
            },
        },
        
        messages: {
            "nombre_grupo": {
                required: "Introduce un nombre de grupo"
            },
            "tipo_musica": { 
                required: "Por favor, selecciona un tipo de música" 
            },
            "edad_min":{
                required: "Introduce la edad mínima.",
                number: "La edad debe ser un número."
            },
            "edad_max":{
                required: "Introduce la edad máxima.",
                number: "La edad debe ser un número."
            },
        },

        submitHandler: function(form) {
            form.submit();
        },
    });



});
