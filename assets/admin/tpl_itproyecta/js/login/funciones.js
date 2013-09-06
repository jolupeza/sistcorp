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
        errorClass: "text-error"
    });
});