$(document).ready(function(){

    var update = setInterval(readAll, 5000);
    
	$(document).on('click', '#search', function(){

            var keyws = $('#keywordsin').val();
            //Añadimos la imagen de carga en el contenedor 

            if( keyws === "" ){
                alert("Introduzca un texto para buscar");
                return;
            }

            $('#content').html('<div class="loading"><img src="styles/img/giphy.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            // Si en vez de por post lo queremos hacer por get, cambiamos el $.post por $.get
            $.get('ph_list/search.php', {
                keywords: keyws
            }, function(responseText) {
                $('#content').html(responseText);
                clearInterval(update);
            }); 
            
              
           
	 });
         
         // show home page
    $(document).on('click', '#readall', function(){
        readAll();
        update = setInterval(readAll, 5000);

    });

    function readAll(){
        
        $('#content').html('<div class="loading"><img src="styles/img/giphy.gif" alt="loading" /><br/>Un momento, por favor...</div>');
        $.get('ph_list/read.php', {
        }, function(responseText) {
            $('#content').html(responseText);
        }); 
    }
	
});