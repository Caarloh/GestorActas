function formVerAccion(datos){

    d=datos.split('||');
    $('#idAccion').val(d[0]);
    $('#nombreAccion').val(d[1]);
    $('#fechaTermino').val(d[2]);
    $('#estadoAccion').val(d[3]);
}

