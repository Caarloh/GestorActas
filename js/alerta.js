$(document).on("click", ".open-AddBookDialog", function () { 
    
    var myBookId = $(this).data('id'); 
    $(".modal-body #bookId").val( myBookId ); 

    var myId = $(this).data('reunion'); 
    $(".modal-footer #idReunionCalendar").val( myId ); 


    var horaR = $(this).data('horita'); 
    $(".modal-body #reunionHora").val( horaR ); 



    var myif = $(this).data('condicion'); 
    $(".modal-footer #clausula").val( myif ); 

    $('#alerta').modal('show');

});

