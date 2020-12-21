function preguntarSiNo(datos){
      alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
                      function(){ eliminarDatosConsejo(datos) }
                  , function(){ alertify.error('CANCELADO')});
}
function preguntarSiNo2(datos){
      alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
                      function(){ eliminarDatosInvitado(datos) }
                  , function(){ alertify.error('CANCELADO')});
}
  
function eliminarDatosConsejo(correo){

    cadena2="correo=" + correo;

    $.ajax({
        type:"POST",
        url:"baseDatos/eliminarConsejo.php",
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

function actualizarAdmin(datos){
  d=datos.split("||");
  correo = d[0];
  estado = d[1];

  cadena2="correo=" + correo + "&estado=" + estado;

  $.ajax({
      type:"POST",
      url:"baseDatos/actualizarAdmin.php",
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

function eliminarDatosInvitado(correo){

  cadena2="correo=" + correo;

  $.ajax({
      type:"POST",
      url:"baseDatos/eliminarInvitado.php",
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


    $('#btnNuevoUsuarioComite').click(function(){
      correoUsuarioComite = $('#correoUsuarioComite').val();
      nombreUsuarioComite = $('#nombreUsuarioComite').val();
      apellidosUsuarioComite = $('#apellidosUsuarioComite').val();
      contrasenaUsuarioComite = $('#contrasenaUsuarioComite').val();
      verificacionContrasenaUsuarioComite = $('#verificacionContrasenaUsuarioComite').val();

        if(correoUsuarioComite == "" || correoUsuarioComite==" "){
            alert("Completar correo del Usuario");

        }
        else if(nombreUsuarioComite == "" || nombreUsuarioComite==" "){
            alert("Completar nombre del Usuario");
        }
        else if(apellidosUsuarioComite == "" || apellidosUsuarioComite==" "){
          alert("Completar apellido del Usuario");
        }
        else if(contrasenaUsuarioComite == "" || contrasenaUsuarioComite==" "){
          alert("Completar contraseña del Usuario");
        }
        else if(verificacionContrasenaUsuarioComite == "" || verificacionContrasenaUsuarioComite==" "){
          alert("Completar verificacion de contraseña del Usuario");
        }
        else if(verificacionContrasenaUsuarioComite != contrasenaUsuarioComite){
          alert("Las contraseñas no coinciden");
        }
        else{
            cadena = "correoUsuarioComite=" + correoUsuarioComite + "&nombreUsuarioComite=" + nombreUsuarioComite + 
            "&apellidosUsuarioComite=" + apellidosUsuarioComite + "&contrasenaUsuarioComite=" + contrasenaUsuarioComite;
            $.ajax({
                type:"POST",
                url:"baseDatos/agregarComite.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Usuario ya existe.");
                    }
                    else{
                        alertify.error("Fallo en el servidor.");
                    }
                    
                  }
                }
              });
        }
      
    });


    
});