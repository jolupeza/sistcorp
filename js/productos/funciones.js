$(document).on("ready", function(){
    // Script para mostrar el formulario para agregar imágenes a los productos
    $(".addFoto").live("click", function(event){
        event.preventDefault();
        var id = $(this).data('idproducto');        
        $("#modalFoto").modal();
        $(":hidden[name='id_producto']").val(id);
    });
    
    $("#modalFoto").on("show", function(){
        limpiaForm($('#frmFoto'));
    });
    
    // Script para mostrar el formulario para agregar imágenes a los productos
    $(".editFoto").live("click", function(event){
        event.preventDefault();
        var id = $(this).data('idproducto');        
        $("#modalEditFoto").modal();
        $(":hidden[name='idproducto']").val(id);
    });
    
    $("#modalEditFoto").on("show", function(){
        $("#modalEditFoto > .modal-body > .alert").remove();
        $("#panelFoto").empty();
        var id = $('.editFoto').data('idproducto');        
        $.post(getBaseURL() + 'almacen/productos/getFotos', {
            'idproducto'       :   id
        }, function(data){
            if (data) {
                var images;
                $.each(data, function(indice, entrada){
                    images += '<li id="foto' + entrada.ID_FOTO +'" class="span4"><div class="thumbnail"><img src="' + getBaseURL() + '/images/products/' + entrada.Foto + '" alt="" /><i data-idfoto="'+ entrada.ID_FOTO +'" class="delFoto icon-remove-sign" title="Eliminar"></i></div></li>';
                });
                $("#panelFoto").append($(images));            
            } else {
                $("#panelFoto").remove();
                alerta = '<div class="alert">El producto no tiene im&aacute;genes.</div>';
                $("#modalEditFoto > .modal-body").append(alerta);
            }
        }, 'json');
    });
    
    $('#modalEditFoto').on('hidden', function () {
        $(":hidden[name='idproducto']").val('');
    });
    
    $(".delFoto").live('click', function(){
        var id = $(this).data('idfoto');
        $.post(getBaseURL() + 'almacen/productos/delFoto', {
            'idfoto'       :   id
        }, function(data){
            if (data == 'ok') 
                $("li#foto" + id).remove();
        });
    });
    
    // Script para cargar la ventana para agregar producto
    var $submenu = $("#submenu");
    $('#addProducto', $submenu).click(function(event){
        event.preventDefault();
        $('#divIngresoForm').modal();
    });
        
    $('#divIngresoForm').on('shown', function () {
        limpiaForm($('#frm'));
        $('div[id$="Failed"]').addClass('hidden');
        var selClases = $("select[name^='ddlClase']");
        $(selClases).empty();
        var selFamilias = $("select[name^='ddlFamilia']");
        $(selFamilias).empty();
        // Script nos permite vaciar el select Clases                               
        opcion = '<option value="0">Primero seleccione el grupo</option>';
        $(selClases).append($(opcion));
        // Script nos permite vaciar el select Clases                               
        opcion = '<option value="0">Primero seleccione la clase</option>';
        $(selFamilias).append($(opcion));
    });
       
    // Nos permite verificar si seleccionamos el grupo y luego carga las clases del grupo seleccionado
    $('select[name^="ddlGrupo"]').on('blur change', function(){
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(getBaseURL() + 'almacen/productos/validateProductoAjax', {
            'inputValue'    :   valor,
            'fieldID'             :    id
        }, function(data){
            xmlDoc = data.documentElement;
            result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
            fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
            var opcion;
            var selClases = $("select[name^='ddlClase']");
            $(selClases).next().addClass('hidden').prev().empty();
            var selFamilias = $("select[name^='ddlFamilia']");
            $(selFamilias).next().addClass('hidden').prev().empty();
            // muestra el error o bien oculta el error
            if(result==0){
                $('#'+fieldID+'Failed').removeClass('ok').removeClass('hidden').addClass('nook');
                // Script nos permite vaciar el select Clases                               
                opcion = '<option value="0">Primero seleccione el grupo</option>';
                $(selClases).append($(opcion));
                // Script nos permite vaciar el select Clases                               
                opcion = '<option value="0">Primero seleccione la clase</option>';
                $(selFamilias).append($(opcion));
            }else if(result==1){
                $('#'+fieldID+'Failed').removeClass('nook').removeClass('hidden').addClass('ok'); 
                $.post(getBaseURL() + 'almacen/productos/getClases', {
                    'grupoId'       :   valor
                }, function(data){
                    if (data) {
                        opcion = '<option value="0">Seleccione la clase</option>';
                        $.each(data, function(indice, entrada){
                            opcion += '<option value=" ' + entrada.ID_CLASEPROD + ' ">' + entrada.Clase + '</option>';
                        });
                        $(selClases).append($(opcion));            
                    } else {
                        opcion = '<option value="0">No hay clases</option>';
                        $(selClases).append($(opcion));
                    }
                }, 'json');
            }
        });
        return false;
    });
    
    // Nos permite verificar si seleccionamos la clase y luego carga las familias de la clase seleccionada
    $('select[name^="ddlClase"]').on('blur change', function(){
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(getBaseURL() + 'almacen/productos/validateProductoAjax', {
            'inputValue'    :   valor,
            'fieldID'             :    id
        }, function(data){
            xmlDoc = data.documentElement;
            result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
            fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
            var opcion;
            var selFamilia = $("select[name^='ddlFamilia']");
            $(selFamilia).next().addClass('hidden').prev().empty();
            // muestra el error o bien oculta el error
            if(result==0){
                $('#'+fieldID+'Failed').removeClass('ok').removeClass('hidden').addClass('nook');
                // Script nos permite vaciar el select Clases                               
                opcion = '<option value="0">Primero seleccione la clase</option>';
                $(selFamilia).append($(opcion));
            }else if(result==1){
                $('#'+fieldID+'Failed').removeClass('nook').removeClass('hidden').addClass('ok'); 
                $.post(getBaseURL() + 'almacen/productos/getFamilias', {
                    'claseId'       :   valor
                }, function(data){
                    if (data) {
                        opcion = '<option value="0">Seleccione la familia</option>';
                        $.each(data, function(indice, entrada){
                            opcion += '<option value=" ' + entrada.ID_FAMILIAPROD + ' ">' + entrada.Familia + '</option>';
                        });
                        $(selFamilia).append($(opcion));            
                    } else {
                        opcion = '<option value="0">No hay familias</option>';
                        $(selFamilia).append($(opcion));
                    }
                }, 'json');
            }
        });
        return false;
    });
    
    // Nos permite validar si hemos seleccionado una clase
    $('select[name^="ddlFamilia"], select[name^="ddlMarca"], select[name^="ddlUniMed"], select[name^="ddlMoneda"], select[name^="ddlTipoProducto"]').on('blur change', function(){
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(getBaseURL() + 'almacen/familias/validateFamiliaAjax', {
            'inputValue'    :   valor,
            'fieldID'             :    id
        }, function(data){
            xmlDoc = data.documentElement;
            result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
            fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
            // muestra el error o bien oculta el error
            if(result==0){
                $('#'+fieldID+'Failed').removeClass('ok').removeClass('hidden').addClass('nook');
            }else if(result==1){
                $('#'+fieldID+'Failed').removeClass('nook').removeClass('hidden').addClass('ok');
            }
        });
        return false;
    });
  
    // Script para editar los datos de una familia específica
    var $main = $('#main');
    $('.editProducto', $main).live("click", function(e){
        e.preventDefault();
        var id = $(this).data('idproducto');
        $.post('/SISTCORP/almacen/productos/editProducto', {
            'idProducto': id
        }, function(data) {
            $('div[id$="Failed"]').addClass('hidden');
            $('#txtProductoEdit').val(data.Producto);
            $("select[name='ddlGrupoEdit'] option[value=" + data.ID_GRUPOPROD + "]").prop("selected",true);  
            var opcion;
            $.post(getBaseURL() + 'almacen/productos/getClases', {
                'grupoId'       :   data.ID_GRUPOPROD
            }, function(data2){
                if (data2) {
                    var se;
                    opcion = '<option value="0">Seleccione la clase</option>';
                    $.each(data2, function(indice, entrada){
                        $("#ddlClaseEdit").empty();
                        if (entrada.ID_CLASEPROD == data.ID_CLASEPROD) {
                            se = 'selected = "selected"';
                        } else {
                            se = '';
                        }
                        opcion += '<option value="' + entrada.ID_CLASEPROD + '" ' + se + '>' + entrada.Clase + '</option>';
                    })
                    $("#ddlClaseEdit").append($(opcion));                        
                        
                } else {
                    $("#ddlClaseEdit").empty();
                    opcion = '<option value="0">No hay clases</option>';
                    $("#ddlClaseEdit").append($(opcion));
                }
            }, 'json');
            
            $.post(getBaseURL() + 'almacen/productos/getFamilias', {
                'claseId'       :   data.ID_CLASEPROD
            }, function(data3){
                if (data3) {
                    opcion = '<option value="0">Seleccione la familia</option>';
                    $.each(data3, function(indice, entrada){
                        $("#ddlFamiliaEdit").empty();
                        if (entrada.ID_FAMILIAPROD == data.ID_FAMPROD) {
                            se = 'selected = "selected"';
                        } else {
                            se = '';
                        }
                        opcion += '<option value="' + entrada.ID_FAMILIAPROD + '" ' + se + '>' + entrada.Familia + '</option>';
                    })
                    $("#ddlFamiliaEdit").append($(opcion));                        
                        
                } else {
                    $("#ddlFamiliaEdit").empty();
                    opcion = '<option value="0">No hay familias</option>';
                    $("#ddlFamiliaEdit").append($(opcion));
                }
            }, 'json');
            
            $("select[name='ddlUniMedEdit'] option[value=" + data.ID_UNIDMED + "]").prop("selected",true); 
            $("select[name='ddlMarcaEdit'] option[value=" + data.ID_MARCA + "]").prop("selected",true); 
            $(":input[id='txtAbreviatura']").val(data.Abreviatura);
            $("select[name='ddlMonedaEdit'] option[value=" + data.ID_MONEDA + "]").prop("selected",true); 
            $(":input[id='txtPrecioCostoEdit']").val(data.PrecioCosto);
            $(":input[id='txtPrecioVentaEdit']").val(data.PrecioVenta);
            $(":input[id='txtPrecioMayorEdit']").val(data.PrecioXMayor);
            $("select[name='ddlTipoProductoEdit'] option[value=" + data.ID_TIPOPRODUCTO + "]").prop("selected",true); 
            $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true); 
            $(":input[name='id']").val(data.ID_PRODUCTO);
            $("#divEditForm").modal();
        }, 'json');
        return false;
    });
  
    // Permitir la paginación ajax en condeigniter        
    $("#gridResult").load("productos/listProducts");
    $("#pagination-digg li a").live("click",function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $("#gridResult").load(href);
    });
  
    $("form[name='frmsearch']").submit(function(){
        var search = $('input[name="txtNomProducto"]').val();
        if (search != '') {
            $("#gridResult").load("productos/searchProducto/" + encodeURIComponent(search));
        }
        else {
            $("#gridResult").load("productos/listProducts");
        }
        return false;
    });
});