$(document).ready(function(){
    var $submenu = $("#submenu");
    $('#addClase', $submenu).click(function(event){
        event.preventDefault();
        $('#divIngresoForm').modal();
    });
    
    $('#divIngresoForm').on('shown', function () {
        limpiaForm($('#frm'));
        $('div[id$="Failed"]').addClass('hidden');
    });
    
    $('#ddlGrupo, #ddlGrupoEdit').on('blur change', function(){
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(getBaseURL() + 'almacen/clases/validateClaseAjax', {
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
  
  
    // Script para editar los datos de una clase específica
    var $main = $("#main");
    $('.editClase', $main).on("click", function(event){
        event.preventDefault();  
        var id = $(this).data('idclase');
        $.post('/SISTCORP/almacen/clases/editClase', {
            'idClase': id
        }, function(data) {
            $('div[id$="Failed"]').addClass('hidden');
            $('#txtClaseEdit').val(data.Clase);
            $("select[name='ddlGrupoEdit'] option[value=" + data.ID_GRUPOPROD + "]").prop("selected",true);  
            $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true);      
            $('input:hidden[name=id]').val(id);
            $('#divEditForm').modal();
        }, 'json');
        return false;
    });
});