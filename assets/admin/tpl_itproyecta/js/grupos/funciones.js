$(document).on("ready", function(){
    var $submenu = $("#submenu");
    $('#addGrupo', $submenu).click(function(event){
        event.preventDefault();
        $('#addGrupoModal').on('show', function() {
            limpiaForm($('#frmAddGrupo'));
            $('div[id$="Failed"]').addClass('hidden');
        });
        $('#addGrupoModal').modal();
    });
    
    $("#btnAddAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmAddGrupo").submit();
        }
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
        $.post(_root_ + 'almacen/grupos/getGrupo', {
            'idgrupo': id
        }, function(data) {
            $('#editGrupoModal').on('show', function() {
                limpiaForm($('#frmEditGrupo'));
                $('div[id$="Failed"]').addClass('hidden');
                $('#txtGrupoEdit').val(data.Grupo);
                $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true);      
                $('input:hidden[name=id]').val(id);
                $('input:hidden[name=hdGrupo]').val(data.Grupo);
            });
            $('#editGrupoModal').modal(); 
        }, 'json');
        return false;        
    });
    
    $("#btnEditAceptar").on("click", function() {
        if (rptaValidation == 0) {
            $("form#frmEditGrupo").submit();
        }
    });
});