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

        if(tipoReunion == "Seleccionar"){
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
            cadena = "idReunion=" + idReunion + "&tipoReunion=" + tipoReunion + 
            "&fechaReunion=" + fechaReunion + "&hora=" + hora+ "&minuto=" + minuto + "&duracionReunion=" + duracionReunion+ "&tipoDuracion=" + tipoDuracion + "&linkReunion=" + linkReunion;
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
    $('#cerrarX').click(function(){
        location.reload();
      
    });
    $('#cerrar').click(function(){
        location.reload();
      
    });
});