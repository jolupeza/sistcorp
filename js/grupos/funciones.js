$(document).on("ready", function(){
    var $submenu = $("#submenu");
    $('#addGrupo', $submenu).click(function(event){
        event.preventDefault();
        $('#divIngresoForm').modal();
    });
    
    $('#divIngresoForm').on('shown', function () {
        limpiaForm($('#frm'));
        $('div[id$="Failed"]').addClass('hidden');
    });
  
    /**
    *  Función que nos permitirá cargar los datos del grupo seleccionado para editar.
    *  @param  integer     idgrupo    Id del grupo a editar
    *  @return array       datos     Datos del grupo a editar
    **/
   var $main = $("#main");
    $('.editGrupo', $main).on("click", function(event){
        event.preventDefault();              
        var id = $(this).data('idgrupo');
        $.post('/SISTCORP/almacen/grupos/editGrupo', {
            'idgrupo': id
        }, function(data) {
            $('div[id$="Failed"]').addClass('hidden');
            $('#txtGrupoEdit').val(data.Grupo);
            $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true);      
            $('input:hidden[name=id]').val(id);
            $('input:hidden[name=hdGrupo]').val(data.Grupo);
            $('#divEditForm').modal(); 
        }, 'json');
        return false;        
    });
});