$(document).ready(function() {  
    $("#addTema").on("click", function() {  
        $("#more-tema").append("<div class='form-group'><input type='text' class='form-control'  placeholder='' required/></div>");  
    });  
    $("#removeTema").on("click", function() {  
        $("#more-tema").children().last().remove();  
    }); 
    
    $('#finalizado').click(function(){
        console.log();
    });
      
}); 



