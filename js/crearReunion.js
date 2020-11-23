function preguntarSiNo(datos){
    d=datos.split("||");
    correo = d[0];
    idReunion = d[1];
      alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
                      function(){ eliminarDatosInvitado(correo, idReunion) }
                  , function(){ alertify.error('CANCELADO')});
}
function preguntarSiNo2(datos){
    d=datos.split("||");
    nombre = d[0];
    idReunion = d[1];
      alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
                      function(){ eliminarDatosTema(nombre, idReunion) }
                  , function(){ alertify.error('CANCELADO')});
}
  
function eliminarDatosInvitado(correo, idReunion){

    cadena2="correo=" + correo+"&idReunion="+idReunion;

    $.ajax({
        type:"POST",
        url:"baseDatos/eliminarRelacionInvitadoReunion.php",
        data:cadena2,
        success:function(r){
            if(r==1){
                location.reload();
            }else{
                alertify.error("FALLO EN EL SERVIDOR");
            }
        }
    });
}

function eliminarDatosTema(nombre, idReunion){

    cadena2="nombre=" + nombre +"&idReunion="+idReunion;

    $.ajax({
        type:"POST",
        url:"baseDatos/eliminarTemaReunion.php",
        data:cadena2,
        success:function(r){
            if(r==1){
                location.reload();
            }else{
                alertify.error("FALLO EN EL SERVIDOR");
            }
        }
    });
}

$(document).ready(function(){
    //$('#tablaAcciones')

    $('#crearInvitadoBoton').click(function(){
        nombreInvitadoModal = $('#nombreInvitadoModal').val();
        correoInvitadoModal = $('#correoInvitadoModal').val();
        idReunion = $('#idReunionInvitadoModal').val();

        if(correoInvitadoModal == "" || correoInvitadoModal==" "){
            alert("Completar correo del invitado");

        }
        else if(nombreInvitadoModal == "" || nombreInvitadoModal==" "){
            alert("Completar nombre del invitado");
        }
        else{
            cadena = "idReunion=" + idReunion + "&nombre=" + nombreInvitadoModal + 
            "&correo=" + correoInvitadoModal;
            $.ajax({
                type:"POST",
                url:"baseDatos/agregarInvitadoReunion.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Invitado ya existe en la reunión.");
                    }
                    else{
                        alertify.error("Fallo en el servidor.");
                    }
                    
                  }
                }
              });
        }
      
    });

    $('#crearTemaBoton').click(function(){
        idTemaCr = $('#idTemaCrear').val();
        nombreTemaModal = $('#nombreTemaModal').val();
        idReunion = $('#idReunionTemaModal').val();

        console.log(idTemaCr);

        if(nombreTemaModal == "" || nombreTemaModal==" "){
            alert("Completar nombre del tema");
        }
        else{
            cadena = "idReunion=" + idReunion + "&nombre=" + nombreTemaModal + "&idTema=" + idTemaCr;
            $.ajax({
                type:"POST",
                url:"baseDatos/agregarTemaReunion.php",
                data:cadena,
                success:function(r){
                    console.log(r);
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Tema ya existe en la reunión.");
                    }
                    else{
                        alertify.error("Fallo en el servidor.");
                    }
                    
                  }
                }
              });
        }
        
    });
    

    $( "#correoInvitadoModal" ).autocomplete({
        source: "baseDatos/buscarInvitado.php",
        minLength: 2
      });
  
      $("#correoInvitadoModal").focusout(function(){
        rutEmpresa = $('#correoInvitadoModal').val();
        $.ajax({
          url:'baseDatos/obtenerInvitado.php',
          type:'POST',
          dataType:'json',
          data:{ rutEmpresa:rutEmpresa}
        }).done(function(respuesta){
          $("#nombreInvitadoModal").val(respuesta.nombreEmpresa);
  
        });
      });
    
});