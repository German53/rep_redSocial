var url = 'http://127.0.0.1:8000';

window.addEventListener("load", function(){//al capturar el evento 'load' se realiza la funcion
    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    function like(){
        $('.btn-like').unbind('click').click(function(){//unbind borra anteriores registros
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url + "/img/heart-red.png");//se le cambia el atributo
            $.ajax({
                url: url + '/like/' + $(this).data('id'), //data pasa un atributo guardado en html
                type: 'GET',
            });
            dislike();
        });
    }
    like();
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){//unbind borra anteriores registros
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url + "/img/heart-black.png");//se le cambia el atributo
            $.ajax({
                url: url + '/dislike/' + $(this).data('id'), //data pasa un atributo guardado en html
                type: 'GET',
            });
            like();
        });
    }
    dislike();


    //BUSCADOR
    $('#buscador').submit(function(e){
        $(this).attr('action', url + '/gente/' + $('#buscador #search').val());
    });
});