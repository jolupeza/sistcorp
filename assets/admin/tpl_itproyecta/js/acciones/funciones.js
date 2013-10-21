$(document).on("ready", function() {
    var $submenu = $("#submenu");
    $("#addPermiso", $submenu).click(function(event) {
        event.preventDefault();
        $('#addPermisoModal').on('show', function() {
            limpiaForm($('#frmAddPermiso'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addPermisoModal').modal();
    });

    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddPermiso").submit();
        }
    });

    /**
     *  Función que nos permitirá cargar los datos del permiso seleccionado para editar.
     **/
    var $main = $("#main");
    $('.editAccion', $main).on("click", function(event) {
        event.preventDefault();
        var id = $(this).data("idaccion");
        $.post(_root_ + 'administracion/acciones/getPermiso', {
            'idpermiso': id
        }, function(data) {
            $("#editPermisoModal").on('show', function() {
                limpiaForm($('#frmEditPermiso'));
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtPermisoEdit').val(data.Accion);
                $('#txtKeyEdit').val(data.AccionKey);
                $("select[name='ddlOpcion'] option[value=" + data.ID_OPCION+ "]").prop("selected", true);
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected", true);
                $('input:hidden[name=id]').val(id);
                $('input:hidden[name=hdPermiso]').val(data.Accion);
                $('input:hidden[name=hdKey]').val(data.AccionKey);
            });
            $('#editPermisoModal').modal();
        }, 'json');
        return false;
    });

    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditPermiso").submit();
        }
    });

    $("#slRegistro").on("change", function(){
        var $registro = $(this).val();
        var $sortBy = $(this).data('sortby');
        var $sortOrder = $(this).data('sortorder');
        var $search = $(this).data('search');
        window.location = _root_ + 'administracion/acciones/index/' + $search + '/' + $sortBy + '/' + $sortOrder + '/' + $registro;
    });

    $("#btnGo").on("click", function(ev){
        ev.preventDefault();
        var $txtPage = $('#txtPage');
        var $page = $txtPage.val();
        var $registro = $("#slRegistro").val();
        var $total = $txtPage.data('total');
        var $numPage = Math.ceil($total / $registro);
        var $search = $txtPage.data('search');
        var $sortBy = $txtPage.data('sortby');
        var $sortOrder = $txtPage.data('sortorder');
        if ($page <= $numPage) {
            $page = ($page - 1) * $registro;
            if ($page == 0) {
                window.location = _root_ + 'administracion/acciones/index/' + $search + '/' + $sortBy + '/' + $sortOrder + '/' + $registro;
            } else {
                window.location = _root_ + 'administracion/acciones/index/' + $search + '/' + $sortBy + '/' + $sortOrder + '/' + $registro + '/' + $page;
            }
        } else {
            jAlert('¡Debes seleccionar una página entre 1 y ' + $numPage +  ' !');
            $txtPage.val('').focus();
        }
    });

    $('.displaySearch').on('click', function(ev){
        ev.preventDefault();
        $('.panel-search').slideToggle('slow').find('input[type="text"]').first().focus();
    });
});