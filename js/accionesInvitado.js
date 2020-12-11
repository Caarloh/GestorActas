function formVerAccion(datos){

    d=datos.split('||');
    
    $('#idAccion').val(d[0]);
    $('#nombreAccion').val(d[1]);
    $('#fechaTermino').val(d[2]);
    $('#estadoAccion').val(d[3]);
}

$(document).ready(function(){
    $('#guardarAccion').click(function(){
        idAccion = $('#idAccion').val();
        nombreAccion = $('#nombreAccion').val();
        estadoAccion= $('#estadoAccion').val();


        if(nombreAccion == "" || nombreAccion==" "){
            alert("Error, nombre accion en blanco.");

        }
        else{
            cadena = "idAccion=" + idAccion + "&nombreAccion=" + nombreAccion + "&estadoAccion=" + estadoAccion;
            $.ajax({
                type:"POST",
                url:"../baseDatos/actualizarAccion.php",
                data:cadena,
                success:function(r){
                  if(r==1){
                    location.reload();
                    
                  }else{
                    if (r==6) {
                        alertify.error("Accion No existe en el sistema");
                    }
                    else{
                        alert(r);
                    }
                  }
                }
              });
        }

    });
});