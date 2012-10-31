$(document).on("ready", function(){
    var $submenu = $("#submenu");
    $("#addUser", $submenu).click(function(event){
        event.preventDefault();
        $('#divIngresoForm').modal();
    });
    
    $('#divIngresoForm').on('shown', function () {
        limpiaForm($('#frm'));
        $('div[id$="Failed"]').addClass('hidden');
    });
  
    $('#ddlPerfiles, #ddlPerfilesEdit').on('blur change', function(){
        var valor = $(this).val();
        var id = $(this).attr("id");
        $.post(getBaseURL() + 'administracion/usuarios/validateUserAjax', {
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
  
    /**
    *  Función que nos permitirá cargar los datos del usuario seleccionado para editar.
    *  @param  integer     iduser    Id del usuario a editar
    *  @return array       datos     Datos del usuario a editar
    **/
    var $main = $("#main");
    $('.editUser', $main).on("click", function(event){
        event.preventDefault();              
        var id = $(this).data('iduser');
        $.post('/SISTCORP/administracion/usuarios/editUser', {
            'iduser': id
        }, function(data) {
            $('div[id$="Failed"]').addClass('hidden');
            $('#txtNomUserEdit').val(data.Nombres);
            $('#txtApePaternoEdit').val(data.Ape_Paterno);
            $('#txtApeMaternoEdit').val(data.Ape_Materno);
            $(":radio[name='rbtSexo'][value='" + data.Sexo + "']").prop('checked', true)
            $('#txtEditEmail').val(data.Email);
            $('#txtTelefonoEdit').val(data.Telefono);
            $('#txtEditUsername').val(data.Usuario);
            $("select[name='ddlPerfilesEdit'] option[value=" + data.ID_PERFIL + "]").prop("selected",true);  
            $("select[name='ddlActivo'] option[value=" + data.Activo + "]").prop("selected",true);      
            $('input:hidden[name=id]').val(id);
            $('input:hidden[name=hdUsername]').val(data.Usuario);
            $('input:hidden[name=hdEmail]').val(data.Email);
            $('#divEditForm').modal();
        }, 'json');
        return false;        
    });
    
    $('#searchUser').on("click", function() {
        $('form[name="frmsearch"]').submit();
    });
});