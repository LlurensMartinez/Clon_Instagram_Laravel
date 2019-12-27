let url="http://localhost:8888/mater-php/Proyecto-Laravel/public/"

window.addEventListener("load", function(){

    $('.fas').css('cursor', 'pointer');
    $('.fas').css('cursor', 'pointer');

    //Boton de Like
    function like(){
        $('.far').unbind('click').click(function(){

            $(this).addClass('fas').removeClass('far');

            $.ajax({
                url: `${url}/like/${$(this).data('id')}`,
                type: 'GET',
                success: function(response) {
                    if(response.like){
                        console.log('Has dado like a la publicacion');
                    }else{
                        console.log('error al dar like');
                    }

                }
            });
            //Sumar al Front 1 like
            let num = parseInt($('.count').val()) + 1;
            $('.count').attr('value', num);
            dislike();
        });
    }
    like();


    //Boton de DisLike
    function dislike(){
        $('.fas').unbind('click').click(function(){

            $(this).addClass('far').removeClass('fas');

            $.ajax({
                url: `${url}/dislike/${$(this).data('id')}`,
                type: 'GET',
                success: function(response) {
                    if(response.like){
                      console.log('Has dado dislike a la publicacion');
                    }else{
                        console.log('error al dar dislike');
                    }

                }
            });
            //Restar al Front 1 like
            let num = parseInt($('.count').val()) - 1;
            $('.count').attr('value', num);
            like();
        });
    }
    dislike();

    //BUSCADOR

    $('#buscador').submit(function(){
        $(this).attr('action', `${url}gente/${$('#buscador #search').val()}`);
    })
});
