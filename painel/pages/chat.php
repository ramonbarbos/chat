<?php

 verificaPermissaoPagina(2);

?>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


   <div class="container" id="box-chat">
    <div class="mensagem-chat">
            <span>Ramon Barbosa:</span>
            <p>Olá, mundo</p>
            <div class="divi"></div>
        </div>
        <form class="msg" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/form.php" method="post" >
            <textarea name="" id="" ></textarea>
            <input type="submit" name="acao" value="Enviar">
        </form>
   </div>

</div>
</section>
