$(document).on("ready", function() {
    var $submenu = $("#submenu");
    $("#addPerfil", $submenu).click(function(event) {
        event.preventDefault();
        $('#addPerfilModal').on('show', function() {
            limpiaForm($('#frmAddPerfil'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addPerfilModal').modal();
    });

    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddPerfil").submit();
        }
    });

    /**
     *  Función que nos permitirá cargar los datos del perfil seleccionado para editar.
     *  @param  integer     iduser    Id del usuario a editar
     *  @return array       datos     Datos del usuario a editar
     **/
    var $main = $("#main");
    $('.editPerfil', $main).on("click", function(event) {
        event.preventDefault();
        var id = $(this).data("idperfil");
        $.post(_root_ + 'administracion/perfil/getPerfil', {
            'idperfil': id
        }, function(data) {
            $("#editPerfilModal").on('show', function() {
                limpiaForm($('#frmEditMarca'));
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtPerfilEdit').val(data.Perfil);
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected", true);
                $('input:hidden[name=id]').val(id);
                $('input:hidden[name=hdPerfil]').val(data.Perfil);
            });
            $('#editPerfilModal').modal();
        }, 'json');
        return false;
    });
    
    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditPerfil").submit();
        }
    });
});