$(document).on("ready", function() {
    var $submenu = $("#submenu");
    $('#addUser', $submenu).on("click", function(event) {
        event.preventDefault();
        $('#addUserModal').on('show', function() {
            limpiaForm($('#frmAddUser'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addUserModal').modal();
    });

    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddUser").submit();
        }
    });

    $('#ddlPerfiles, #ddlPerfilesEdit').on('blur change', function() {
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(_root_ + 'administracion/usuarios/validateUserAjax', {
            'inputValue': valor,
            'fieldID': id
        }, function(data) {
            xmlDoc = data.documentElement;
            result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
            fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
            // muestra el error o bien oculta el error
            if (result == 0) {
                $('#' + fieldID + 'Failed').removeClass('ok hidden').addClass('nook');
                $(':input[id$="Aceptar"]').prop('disabled', true);
            } else if (result == 1) {
                $('#' + fieldID + 'Failed').removeClass('nook hidden').addClass('ok');
                $(':input[id$="Aceptar"]').prop('disabled', false);
            }
        });
        return false;
    });

    /**
     *  Función que nos permitirá cargar los datos del usuario seleccionado para editar.
     *  @param  integer     iduser    Id del usuario a editar
     *  @return array       datos     Datos del usuario a editar
     **/
    var $main = $("#main");
    $('.editUser', $main).on("click", function(event) {
        event.preventDefault();
        var id = $(this).data('iduser');
        $.post(_root_ + 'administracion/usuarios/getUser', {
            'iduser': id
        }, function(data) {
            $("#editUserModal").on('show', function() {
                limpiaForm($('#frmEditUser'));
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtNomUserEdit').val(data.Nombres);
                $('#txtApePaternoEdit').val(data.Ape_Paterno);
                $('#txtApeMaternoEdit').val(data.Ape_Materno);
                $(":radio[name='rbtSexo'][value='" + data.Sexo + "']").prop('checked', true)
                $('#txtEditEmail').val(data.Email);
                $('#txtTelefonoEdit').val(data.Telefono);
                $('#txtEditUsername').val(data.Usuario);
                $("select[name='ddlPerfilesEdit'] option[value=" + data.ID_PERFIL + "]").prop("selected", true);
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected", true);
                $('input:hidden[name=id]').val(id);
                $('input:hidden[name=hdUsername]').val(data.Usuario);
                $('input:hidden[name=hdEmail]').val(data.Email);
            });
            $('#editUserModal').modal();
        }, 'json');
        return false;
    });

    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditUser").submit();
        }
    });

    $("#btnGuardar").on("click", function(event) {
        event.preventDefault();
        $("form#frmPermUser").submit();
    });
});