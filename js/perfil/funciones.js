$(document).on("ready", function(){
    var $submenu = $("#submenu");
    $("#addPerfil", $submenu).click(function(event){
        event.preventDefault();
        $('#divIngresoForm').modal();
    });
    
    $('#divIngresoForm').on('shown', function () {
        limpiaForm($('#frm'));
        $('div[id$="Failed"]').addClass('hidden');
    });
  
  /**
    *  Función que nos permitirá cargar los datos del perfil seleccionado para editar.
    *  @param  integer     iduser    Id del usuario a editar
    *  @return array       datos     Datos del usuario a editar
    **/
   var $main = $("#main");
    $('.editPerfil', $main).on("click", function(event){
        event.preventDefault();              
        var id = $(this).data("idperfil");
        $.post('/SISTCORP/administracion/perfil/editPerfil', {
            'idperfil': id
        }, function(data) {
            $('div[id$="Failed"]').addClass('hidden');
            $('#txtPerfilEdit').val(data.Perfil);
            $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true);      
            $('input:hidden[name=id]').val(id);
            $('input:hidden[name=hdPerfil]').val(data.Perfil);
            $('#divEditForm').modal(); 
        }, 'json');
        return false;        
    });
});