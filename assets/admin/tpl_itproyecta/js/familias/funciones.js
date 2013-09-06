$(document).on("ready", function() {
    // Script que permite cargar el modal para agregar nueva familia
    var $submenu = $("#submenu");
    $('#addFamilia', $submenu).click(function(event) {
        event.preventDefault();
        $('#addFamiliaModal').on('show', function() {
            limpiaForm($('#frmAddFamilia'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addFamiliaModal').modal();
    });

    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddFamilia").submit();
        }
    });

    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditFamilia").submit();
        }
    });

    // Nos permite validar si hemos seleccionado una clase
    $('select[name^="ddlClase"]').on('blur change', function() {
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(_root_ + 'almacen/familias/validateFamiliaAjax', {
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

    // Nos permite verificar si seleccionamos el grupo y luego carga las clases del grupo seleccionado
    $('select[name^="ddlGrupo"]').on('blur change', function() {
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(_root_ + 'almacen/familias/validateFamiliaAjax', {
            'inputValue': valor,
            'fieldID': id
        }, function(data) {
            xmlDoc = data.documentElement;
            result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
            fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
            var opcion;
            var selClases = $("select[name^='ddlClase']");
            $(selClases).next().addClass('hidden').prev().empty();
            // muestra el error o bien oculta el error
            if (result == 0) {
                $('#' + fieldID + 'Failed').removeClass('ok hidden').addClass('nook');
                // Script nos permite vaciar el select Clases                               
                opcion = '<option value="0">Primero seleccione el grupo</option>';
                $(selClases).append($(opcion));
                $(':input[id$="Aceptar"]').prop('disabled', true);
            } else if (result == 1) {
                $('#' + fieldID + 'Failed').removeClass('nook hidden').addClass('ok');
                $.post(_root_ + 'almacen/familias/getClases', {
                    'grupoId': valor
                }, function(data) {
                    if (data) {
                        opcion = '<option value="0">Seleccione la clase</option>';
                        $.each(data, function(indice, entrada) {
                            opcion += '<option value=" ' + entrada.ID_CLASEPROD + ' ">' + entrada.Clase + '</option>';
                        });
                        $(selClases).append($(opcion));
                    } else {
                        opcion = '<option value="0">No hay clases</option>';
                        $(selClases).append($(opcion));
                    }
                }, 'json');
                $(':input[id$="Aceptar"]').prop('disabled', true);
            }
        });
        return false;
    });

    // Script para editar los datos de una familia específica
    $("body").on("click", ".editFamilia", function(e) {
        e.preventDefault();
        var id = $(this).data('idfamilia');
        $.post(_root_ + 'almacen/familias/getFamilia', {
            'idFamilia': id
        }, function(data) {
            $('#editFamiliaModal').on('show', function() {
                limpiaForm($('#frmEditFamilia'));
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtFamiliaEdit').val(data.Familia);
                $("select[name='ddlGrupoEdit'] option[value=" + data.ID_GRUPOPROD + "]").prop("selected", true);
                var opcion;
                $.post(_root_ + 'almacen/familias/getClases', {
                    'grupoId': data.ID_GRUPOPROD
                }, function(data2) {
                    if (data2) {
                        var se;
                        opcion = '<option value="0">Seleccione la clase</option>';
                        $.each(data2, function(indice, entrada) {
                            $("#ddlClaseEdit").empty();
                            se = (entrada.ID_CLASEPROD == data.ID_CLASEPROD) ? 'selected = "selected"' : '';
                            opcion += '<option value="' + entrada.ID_CLASEPROD + '" ' + se + '>' + entrada.Clase + '</option>';
                        })
                        $("#ddlClaseEdit").append($(opcion));
                    } else {
                        $("#ddlClaseEdit").empty();
                        opcion = '<option value="0">No hay clases</option>';
                        $("#ddlClaseEdit").append($(opcion));
                    }
                }, 'json');
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected", true);
                $("input:hidden[name=id]").val(id);
            });
            $("#editFamiliaModal").modal();
        }, 'json');
        return false;
    });

    // Permitir la paginación ajax en condeigniter        
    $("#gridResult").load(_root_ + "almacen/familias/listFamilia");
    $("body").on("click", "#pagination-digg li a", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $("#gridResult").load(href);
    });

    $(":input[id='searchFamilia']").on("click", function() {
        $.post(_root_ + 'almacen/familias/searchFamilia', {
            'txtNomFamilia': $(":input[name='txtNomFamilia']").val()
        }, function(data) {
            if (data != '') {
                $("#gridResult").load(_root_ + "almacen/familias/listFamilia/" + data);
            } else {
                $("#gridResult").load(_root_ + "almacen/familias/listFamilia");
            }
        });
    });
});