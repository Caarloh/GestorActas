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

function getIdTemaAcciones(datos){
    d=datos.split("||");
    idReunionAc = d[1];
    idTemaAc = d[2];
    cadena = "idTema="+idTemaAc;
    $.ajax({
        type:"POST",
        url:"baseDatos/rellenarTablaAcciones.php",
        data: cadena,
        success:function(r){
            document.getElementById("relleno").innerHTML=r;
        }
    });
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

function formEditarTema(datos){

    d=datos.split('||');
    $('#idTemaModalEdicion').val(d[0]);
    $('#nombreTemaModalEdicion').val(d[1]);
}

$(document).ready(function(){
    $('#crearAccionBoton').click(function(){
        nombreAccionModal = $('#nombreAccionModal').val();
        correoInvitadoAccion = $('#correoInvitadoAccion').val();
        fechaterminoAccion= $('#fechaterminoAccion').val();


        if(correoInvitadoAccion == "" || correoInvitadoAccion==" "){
            alert("Completar correo del encargado de la accion");

        }
        else if(fechaterminoAccion == "" || fechaterminoAccion==" "){
            alert("Completar fecha de termino de la accion");
        }
        else if(nombreAccionModal == "" || nombreAccionModal==" "){
            alert("Completar nombre de la accion");
        }
        else{
            cadena = "idTema=" + idTemaAc + "&idReunion=" + idReunionAc + "&nombre=" + nombreAccionModal + 
            "&correo=" + correoInvitadoAccion + "&fecha=" + fechaterminoAccion;
            $.ajax({
                type:"POST",
                url:"baseDatos/agregarAccionTema.php",
                data:cadena,
                success:function(r){
                console.log(r);
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Accion ya existe en el tema");
                    }
                    else{
                        alertify.error("Fallo en el servidor.");
                    }
                  }
                }
              });
        }

    });

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

    $('#editarTemaModalEdicion').click(function(){
        nombreTemaModal = $('#nombreTemaModalEdicion').val();
        idTema= $('#idTemaModalEdicion').val();

        if(nombreTemaModal == "" || nombreTemaModal==" "){
            alert("Completar nombre del tema");
        }
        else{
            cadena = "idTemaModalEdicion=" + idTema + "&nombreTemaModalEdicion=" + nombreTemaModal;
            $.ajax({
                type:"POST",
                url:"baseDatos/actualizarTema.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Tema ya existe en la reunión.");
                    }
                    else{
                        alertify.error(r);
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