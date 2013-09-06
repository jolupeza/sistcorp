$(document).on("ready", function() {
    var $submenu = $("#submenu");
    $('#addMarca', $submenu).on("click", function(event) {
        event.preventDefault();
        $('#addMarcaModal').on('show', function() {
            limpiaForm($('#frmAddMarca'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addMarcaModal').modal();
    });

    // Script para editar los datos de una marca específica
    var $main = $("#main");
    $('.editMarca', $main).on("click", function(event) {
        event.preventDefault();
        var id = parseInt($(this).data('idmarca'));
        $.post(_root_ + 'almacen/marcas/getMarca', {
            'idMarca': id
        }, function(data) {
            $('#editMarcaModal').on('show', function() {
                limpiaForm($('#frmEditMarca'));
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtEditMarca').val(data.Marca);
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected", true);
                $(':input[name=hdId]').val(id);
                $(':input[name=hdFoto]').val(data.Foto);
            });
            $('#editMarcaModal').modal();
        }, 'json');
        return false;
    });

    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddMarca").submit();
        }
    });

    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditMarca").submit();
        }
    });
});