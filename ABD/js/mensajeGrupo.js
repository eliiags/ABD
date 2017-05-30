$(document).ready(function() {

    document.getElementById("cerrar").onclick=function(){

        var elemento = document.getElementById("asunto");
        elemento.value="";
        elemento = document.getElementById("cuerpo");
        elemento.value="";
    }

    
    $('#nuevoMensajeGrupo').submit(function(e) { e.preventDefault(); }).validate(
    { 
        debug: true,
        errorClass: "my-error-class",
        validClass: "my-valid-class",
        
        rules: {
            "grupo": {
                required: true
            },
            "asunto":{
                required: true,
            },
            "cuerpo":{
                required: true,
            }
        },
        
        messages: {
            "grupo": {
                required: "Escoge un grupo"
            },
            "asunto":{
                required: "Escribe el asunto.",
            },
            "cuerpo":{
                required: "Escribe el mensaje.",
            }
        },

        submitHandler: function(form) {
            form.submit();
        },
    });



});
