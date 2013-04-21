function limpiaForm(miForm) {
    // recorremos todos los campos que tiene el formulario
    $(':input', miForm).each(function() {
        var type = this.type;
        var tag = this.tagName.toLowerCase();
        //limpiamos los valores de los campos…
        if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'file') {
            this.value = "";
            // excepto de los checkboxes y radios, le quitamos el checked
            // pero su valor no debe ser cambiado
        } else if (type == 'checkbox' || type == 'radio') {
            //this.checked = false;
            // los selects le ponesmos el indice a -
        } else if (tag == 'select') {
            this.selectedIndex = 0;
        }
    });
}

$(document).on("ready", function() {
    // Función para asignar el foco al primer campo de un formulario
    $(":input:first").focus();
    $(":input").prop("disabled", false);
});

// Función para enviar submit a través de input tipo button
function submit(form) {
    form.submit();
}

// Función para validar correo eléctronico
function validarEmail(correo) {
    re = /^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
    if (!re.exec(correo)) {
        return false;
    } else {
        return true;
    }
}

function deleteRow(registro, url) {
    jConfirm('¿Está seguro que desea eliminar el registro ' + registro + '?', 'Eliminación de registro', function(r) {
        if (r == true) {
            window.location = url;
        }
    });
}