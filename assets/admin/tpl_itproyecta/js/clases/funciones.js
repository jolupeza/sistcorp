$(document).ready(function() {
    var $submenu = $("#submenu");
    $('#addClase', $submenu).click(function(event) {
        event.preventDefault();
        $('#addClaseModal').on('show', function() {
            limpiaForm($('#frmAddClase'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addClaseModal').modal();
    });

    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddClase").submit();
        }
    });

    $('#ddlGrupo, #ddlGrupoEdit').on('blur change', function() {
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(_root_ + 'almacen/clases/validateClaseAjax', {
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


    // Script para editar los datos de una clase específica
    var $main = $("#main");
    $('.editClase', $main).on("click", function(event) {
        event.preventDefault();
        var id = $(this).data('idclase');
        $.post(_root_ + 'almacen/clases/getClase', {
            'idClase': id
        }, function(data) {
            $('#editClaseModal').on('show', function() {
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtClaseEdit').val(data.Clase);
                $("select[name='ddlGrupoEdit'] option[value=" + data.ID_GRUPOPROD + "]").prop("selected", true);
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected", true);
                $('input:hidden[name=id]').val(id);
            });
            $('#editClaseModal').modal();
        }, 'json');
        return false;
    });

    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditClase").submit();
        }
    });
});