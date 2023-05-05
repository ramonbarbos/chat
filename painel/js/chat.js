
    $(".mensagem-chat").scrollTop($('.mensagem-chat')[0].scrollHeight);
    
     $("textarea").keyup(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var code = e.keyCode || e.which;
        if(code == 13) { //Enter keycode
            insertChat()

        }

  
    });

    $("form").submit(function(){
        insertChat() 
        
        return false;
    })

    //Função responsavel
    function insertChat(){

        var mensagem = $('textarea').val();
        $('textarea').val('');
        $.ajax({
            url:'http://localhost/chat/painel/ajax/form.php',
            method: 'post',
            data: {'mensagem': mensagem,'acao':'enviarMensagem'}
        }).done(function(data){
            $('.mensagem-chat').append(data);
            $(".mensagem-chat").scrollTop($('.mensagem-chat')[0].scrollHeight);

        })
    }

    //Recuperando novas mensagens do banco de dados
    function recuperarMensagens(){
        $('textarea').val('');
        $.ajax({
            url:'http://localhost/chat/painel/ajax/form.php',
            method: 'post',
            data: {'acao':'pegarMensagem'}
        }).done(function(data){
            $('.mensagem-chat').append(data);
            $(".mensagem-chat").scrollTop($('.mensagem-chat')[0].scrollHeight);

        })
    }

    //Tempo de intervalo
    setInterval(function(){
        recuperarMensagens();
    },3000)