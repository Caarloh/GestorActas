

$(document).ready(function(){
    $('#finalizado').click(function(){
        idReunion = $('#idReunion').val();
        console.log(idReunion)
        titulo = $('#titulo').val();
            cadena = "&titulo=" + titulo + "&idReunion=" + idReunion;
            console.log(cadena)
            if(idReunion=null){
              alert("no hay refreunion");
            }else{
              $.ajax({
                type:"POST",
                url:"BaseDatos/agregarActa.php",
                data:cadena,
                success:function(){                  
                   
                  }
                }
            )
            }
           
            window.location.reload();});

            $('#finalizado2').click(function(){
                tituloModificado = $('#tituloModificado').val();
                refReunion = refReunion;
                console.log(tituloModificado);
                console.log(idReunion);
                    cadena = "&tituloModificado=" + tituloModificado +"&refReunion=" + refReunion;
                    $.ajax({
                        type:"POST",
                        url:"BaseDatos/editarActa.php",
                        data:cadena,
                        success:function(){                  
                            
                          }
                        }
                    )
                    window.location.reload();});


              $('#btnEliminar').click(function(){
                var regex = /(\d+)/g;     
                const acta = document.getElementById('tituloActa');
                const actaString = acta.innerHTML;
                tituloActa = actaString.match(regex)              
                    cadena = "&tituloActa=" + tituloActa;
                    $.ajax({
                        type:"POST",
                        url:"BaseDatos/eliminarActa.php",
                        data:cadena,
                        success:function(){                 
                            
                          }
                        }
                  )
                  window.location.reload();});

                  $('#btnEditar').click(function(){
                    var regex = /(\d+)/g;     
                    const editarTitulo = document.getElementById('refReunion');
                    const tituloString = editarTitulo.innerHTML;
                    refReunion = tituloString.match(regex)
                  });

                
                    
      
    });
    
    

     
