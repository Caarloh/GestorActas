function formEditarReunionIndex(datos){

  d=datos.split('||');
  hora = d[3].split(':');
  $('#idReunionEditar').val(d[0]);
  $('#nombreReunionEditar').val(d[7]);
  $('#tipoReunionEditar').val(d[1]);
  $('#fechaReunionEditar').val(d[2]);
  $('#horaEditar').val(hora[0]);
  $('#minutoEditar').val(hora[1]);
  $('#duracionReunionEditar').val(d[4]);
  $('#tipoDuracionEditar').val(d[5]);
  $('#linkReunionEditar').val(d[6]);
}

$(document).ready(function(){
    $('#siguientePaso').click(function(){
        idReunion = $('#idReunion').val();
        tipoReunion = $('#tipoReunion').val();
        fechaReunion= $('#fechaReunion').val();
        hora= $('#hora').val();
        minuto= $('#minuto').val();
        duracionReunion= $('#duracionReunion').val();
        tipoDuracion= $('#tipoDuracion').val();
        linkReunion = $('#linkReunion').val();
        nombreReunion = $('#nombreReunion').val();
        estado = "En Espera";

        if(duracionReunion<=0){
          alert("La duracion de la reunion debe ser mayor a 0");
        }
        else if(nombreReunion == "" || nombreReunion == " "){
            alert("Asignar nombre a la reunion");
        }
        else if(tipoReunion == "Seleccionar"){
            alert("Completar el tipo de reunion");

        }
        else if(hora == "Seleccionar"){
            alert("Completar la hora");

        }
        else if(minuto == "Seleccionar"){
            alert("Completar los minutos");

        }
        else if(tipoDuracion == "Seleccionar"){
            alert("Completar el tipo de duracion");

        }
        else if(fechaReunion == "" || fechaReunion==" "){
            alert("Completar fecha de la reunion");
        }
        else{
            cadena = "idReunion=" + idReunion + 
            "&tipoReunion=" + tipoReunion + 
            "&fechaReunion=" + fechaReunion + 
            "&hora=" + hora+ 
            "&minuto=" + minuto + 
            "&duracionReunion=" + duracionReunion+ 
            "&tipoDuracion=" + tipoDuracion + 
            "&linkReunion=" + linkReunion +
            "&nombreReunion=" + nombreReunion +
            "&estadoReunion=" + estado;
            $.ajax({
                type:"POST",
                url:"BaseDatos/agregarReunion.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    window.location = "crearReunion.php?id="+idReunion;
                  }else{
                    if (r==6) {
                      alert("Reunión ya existe en el sistema.");
                    }
                    else{
                      alert("Fallo en el servidor.");
                    }
                    
                  }
                }
              });
        }
      
    });

    $('#btnGurdarEditarIndex').click(function(){

      idReunionEditar = $('#idReunionEditar').val();
      nombreReunionEditar = $('#nombreReunionEditar').val();
      tipoReunionEditar = $('#tipoReunionEditar').val();
      fechaReunionEditar = $('#fechaReunionEditar').val();
      horaEditar = $('#horaEditar').val();
      minutoEditar = $('#minutoEditar').val();
      duracionReunionEditar = $('#duracionReunionEditar').val();
      tipoDuracionEditar = $('#tipoDuracionEditar').val();
      linkReunionEditar = $('#linkReunionEditar').val();

      if(duracionReunionEditar<=0){
        alert("La duracion de la reunion debe ser mayor a 0");
      }
      else if(nombreReunionEditar == "" || nombreReunionEditar == " "){
          alert("Asignar nombre a la reunion")
      }
      else if(tipoReunionEditar == "Seleccionar"){
          alert("Completar el tipo de reunion");

      }
      else if(horaEditar == "Seleccionar"){
          alert("Completar la hora");

      }
      else if(minutoEditar == "Seleccionar"){
          alert("Completar los minutos");

      }
      else if(tipoDuracionEditar == "Seleccionar"){
          alert("Completar el tipo de duracion");

      }
      else if(fechaReunionEditar == "" || fechaReunionEditar==" "){
          alert("Completar fecha de la reunion");
      }
      else{
          cadena = "idReunion=" + idReunionEditar + 
          "&tipoReunion=" + tipoReunionEditar + 
          "&fechaReunion=" + fechaReunionEditar + 
          "&hora=" + horaEditar+ 
          "&minuto=" + minutoEditar + 
          "&duracionReunion=" + duracionReunionEditar+ 
          "&tipoDuracion=" + tipoDuracionEditar + 
          "&linkReunion=" + linkReunionEditar +
          "&nombreReunion=" + nombreReunionEditar;

          $.ajax({
              type:"POST",
              url:"BaseDatos/actualizarReunion.php",
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
    $('#cerrarX').click(function(){
        location.reload();
      
    });
    $('#cerrar').click(function(){
        location.reload();
      
    });
});