
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
        $('textarea').val('');
    }

    //Recuperando novas mensagens do banco de dados
    function recuperarMensagens(){
        console.log("recuperando")
    }

    //Tempo de intervalo
    setInterval(function(){
        recuperarMensagens();
    },3000)