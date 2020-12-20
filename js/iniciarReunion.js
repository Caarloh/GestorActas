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
function preguntarSiNo3(datos){
      alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
                      function(){ eliminarDatosAccion(datos) }
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

function modificarAsistenciaInvitado(datos){
  d=datos.split("||");

  cadena2="correo=" + d[0] +"&idReunion="+d[1];

  $.ajax({
      type:"POST",
      url:"baseDatos/actualizarAsistenciaInvitado.php",
      data:cadena2,
      success:function(r){
          if(r==1){
              location.reload();
          }else{
              if(r==6){
                alertify.error("Invitado no existe.");
              }
              else{
                alertify.error("FALLO EN EL SERVIDOR");
              }
              
          }
      }
  });
}

function modificarAsistenciaComite(datos){
  d=datos.split("||");

  cadena2="correo=" + d[0] +"&idReunion="+d[1];

  $.ajax({
      type:"POST",
      url:"baseDatos/actualizarAsistenciaComite.php",
      data:cadena2,
      success:function(r){
          if(r==1){
              location.reload();
          }else{
              if(r==6){
                alertify.error("Invitado no existe.");
              }
              else{
                alertify.error("FALLO EN EL SERVIDOR");
              }
              
          }
      }
  });
}
function reunionNoIniciada(){
  alertify.error("LA REUNION NO SE HA INICIADO");
}

function reunionTerminada(){
  alertify.error("LA REUNION SE ENCUENTRA TERMINADA");

}
function eliminarDatosAccion(idAccion){

    cadena2="&idAccion="+idAccion;

    $.ajax({
        type:"POST",
        url:"baseDatos/eliminarAccionReunion.php",
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

function formEditarAccion(datos){
    d=datos.split('||');
    $('#idAccionModalEdicion').val(d[0]);
    $('#nombreAccionModalEdicion').val(d[1]);
    $('#encargadoAccionModalEdicion').val(d[2]);
    $('#estadoAccionModalEdicion').val(d[3]);
    $('#fechanuevaterminoAccion').val(d[4]);
}

$(document).ready(function(){
    $('#btnTerminarReunion').click(function(){
        idReunion = $('#idReunion').val();


        if(idReunion == "" || idReunion==" "){
            alert("Error en Id Reunion");

        }
        else{
            cadena = "idReunion=" + idReunion;
            $.ajax({
                type:"POST",
                url:"baseDatos/terminarReunion.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    window.location="index.php";
                    
                  }else{
                    if (r==3) {
                        alertify.error("La reunión no se ha iniciado");
                    }
                    else if (r==6) {
                        alertify.error("Reunion no fue encontrada");
                    }
                    else{
                        alertify.error("Fallo en el servidor.");
                    }
                  }
                }
              });
        }

    });
    $('#crearAccionBoton').click(function(){
        nombreAccionModal = $('#nombreAccionModal').val();
        correoInvitadoAccion = $('#correoInvitadoAccion').val();
        fechaterminoAccion= $('#fechaterminoAccion').val();
        encargadoAccionModal = $('#encargadoAccionModal').val();


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
            "&correo=" + correoInvitadoAccion + "&fecha=" + fechaterminoAccion + "&encargadoAccionModal=" + encargadoAccionModal;
            $.ajax({
                type:"POST",
                url:"baseDatos/agregarAccionTema.php",
                data:cadena,
                success:function(r){
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

    $('#iniciarReunionHora').click(function(){
        idReunion = $('#idReunion').val();
        hora= $('#horaReunion').val();
        minuto= $('#minutoReunion').val();
        
        if(hora == "Seleccionar"){
            alert("Completar la hora");

        }
        else if(minuto == "Seleccionar"){
            alert("Completar los minutos");

        }
        else{
            cadena = "idReunion=" + idReunion + 
            "&horaReunion=" + hora + 
            "&minutoReunion=" + minuto;
            $.ajax({
                type:"POST",
                url:"BaseDatos/actualizarHoraInicialReunion.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                  }else{
                    if (r==6) {
                      alert("Reunión no existe en el sistema.");
                    }
                    else{
                      alert("Fallo en el servidor.");
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
    
    $('#editarAccionModal').click(function(){
        idAccion= $('#idAccionModalEdicion').val();
        nombreAccionModal= $('#nombreAccionModalEdicion').val();        
        encargadoAccionModal= $('#encargadoAccionModalEdicion').val();        
        fechaAccionModal= $('#fechanuevaterminoAccion').val();
        estadoAccionModal= $('#estadoAccionModalEdicion').val();

        cadena = "idAccionModalEdicion=" + idAccion+ "&nombreAccionModalEdicion=" + nombreAccionModal + "&encargadoAccionModalEdicion=" +encargadoAccionModal+
        "&fechanuevaterminoAccion=" + fechaAccionModal + "&estadoAccionModalEdicion=" + estadoAccionModal;
        //cadena = "idAccionModalEdicion=" + idAccion+ "&nombreAccionModalEdicion=" + nombreAccionModal;
        if(nombreTemaModal == "" || nombreTemaModal==" "){
            alert("Completar nombre del tema");
        }
        else{
            $.ajax({
                type:"POST",
                url:"baseDatos/actualizarAccion.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                  }else{
                    if (r==6) {
                        alertify.error("Error");
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