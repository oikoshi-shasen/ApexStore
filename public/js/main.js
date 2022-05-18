$(window).ready(function(){

     
    $('#mimi').on('click', function(){
        const is_exists = $('#hana').hasClass('none');
        if(is_exists){
            $('#hana').removeClass('none');
        }else{
            $('#hana').addClass('none');
        }
    })
                    
});