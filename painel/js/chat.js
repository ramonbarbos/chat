
var lastId = $('lastId').attr('val');

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
        })
    }

    //Recuperando novas mensagens do banco de dados
    function recuperarMensagens(){
        $('textarea').val('');
        $.ajax({
            url:'http://localhost/chat/painel/ajax/form.php',
            method: 'post',
            data: {'lastId': lastId,'acao':'pegarMensagem'}
        }).done(function(data){
            $('.mensagem-chat').append(data);
        })
    }

    //Tempo de intervalo
    setInterval(function(){
        recuperarMensagens();
    },3000)