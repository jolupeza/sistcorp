$(document).on("ready", function(){
    // Definimos las reglas 
    $("#frmLogin").validate({
        rules: {
            // Definimos los campos como obligatorio
            empresa: "required",
            username: "required",             
            pass: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            empresa: "Debe seleccionar la empresa.",
            username: "Debe ingresar su nombre de usuario.",
            pass: {
                required: "Debe ingresar su password.",
                minlength: "Por favor, introduzca al menos 6 caracteres."
            }
        }
    });
});