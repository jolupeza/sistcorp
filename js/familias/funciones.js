$(document).on("ready", function(){
    // Script que permite cargar el modal para agregar nueva familia
    var $submenu = $("#submenu");
    $('#addFamilia', $submenu).click(function(event){
        event.preventDefault();
        $('#divIngresoForm').modal();
    });
    
    $('#divIngresoForm').on('shown', function () {
        limpiaForm($('#frm'));
        $('div[id$="Failed"]').addClass('hidden');
        var selClases = $("select[name^='ddlClase']");
        $(selClases).empty();
        // Script nos permite vaciar el select Clases                               
        opcion = '<option value="0">Primero seleccione el grupo</option>';
        $(selClases).append($(opcion));
    });
    
    // Nos permite validar si hemos seleccionado una clase
    $('select[name^="ddlClase"]').on('blur change', function(){
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
    
    // Nos permite verificar si seleccionamos el grupo y luego carga las clases del grupo seleccionado
    $('select[name^="ddlGrupo"]').on('blur change', function(){
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(getBaseURL() + 'almacen/familias/validateFamiliaAjax', {
            'inputValue'    :   valor,
            'fieldID'             :    id
        }, function(data){
            xmlDoc = data.documentElement;
            result = xmlDoc.getElementsByTagName("result")[0].firstChild.data;
            fieldID = xmlDoc.getElementsByTagName("fieldid")[0].firstChild.data;
            var opcion;
            var selClases = $("select[name^='ddlClase']");
            $(selClases).next().addClass('hidden').prev().empty();
            // muestra el error o bien oculta el error
            if(result==0){
                $('#'+fieldID+'Failed').removeClass('ok').removeClass('hidden').addClass('nook');
                // Script nos permite vaciar el select Clases                               
                opcion = '<option value="0">Primero seleccione el grupo</option>';
                $(selClases).append($(opcion));
            }else if(result==1){
                $('#'+fieldID+'Failed').removeClass('nook').removeClass('hidden').addClass('ok'); 
                $.post(getBaseURL() + 'almacen/familias/getClases', {
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
        
    // Script para editar los datos de una familia específica
    var $main = $("#main");
    $('.editFamilia', $main).on("click", function(e){
        e.preventDefault();
        var id = $(this).data('idfamilia');
        $.post('/SISTCORP/almacen/familias/editFamilia', {
            'idFamilia': id
        }, function(data) {
            $('div[id$="Failed"]').addClass('hidden');
            $('#txtFamiliaEdit').val(data.Familia);
            $("select[name='ddlGrupoEdit'] option[value=" + data.ID_GRUPOPROD + "]").prop("selected",true);  
            var opcion;
            $.post(getBaseURL() + 'almacen/familias/getClases', {
                'grupoId'       :   data.ID_GRUPOPROD
            }, function(data2){
                if (data2) {
                    var se;
                    opcion = '<option value="0">Seleccione la clase</option>';
                    $.each(data2, function(indice, entrada){
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
            $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true);  
            $("input:hidden[name=id]").val(id);
            $("#divEditForm").modal();
        }, 'json');
        return false;
    });
  
    // Permitir la paginación ajax en condeigniter        
    $("#gridResult").load("familias/listFamilia");
    $("#pagination-digg li a").on("click",function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        $("#gridResult").load(href);
    });
    
    $("form[name='frmsearch']").submit(function(){
        var search = $(':input[name="txtNomFamilia"]').val();
        if (search.length > 0) {
            $("#gridResult").load("familias/searchFamilia/" + encodeURIComponent(search));
        }
        else {
            $("#gridResult").load("familias/listFamilia");
        }
        //El return false va igual
        return false;
    });
});