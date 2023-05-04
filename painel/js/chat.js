
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
            data: {'mensagem': mensagem}
        }).done(function(data){
            $('.mensagem-chat').append(data);
        })
    }

    //Recuperando novas mensagens do banco de dados
    function recuperarMensagens(){
        console.log("recuperando")
    }

    //Tempo de intervalo
    setInterval(function(){
        recuperarMensagens();
    },3000)