<?php

 #verificaPermissaoPagina(2);

 
?>



<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

<div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">
   <div class="container" id="box-chat">
   
        <div class="mensagem-chat">
        <?php
        $mensagem = MySql::conectar()->prepare("SELECT * FROM `tb_admin.chat`  LIMIT 10 ");
        $mensagem->execute();
        $mensagem = $mensagem->fetchAll();
       # $mensagem = array_reverse($mensagem);
        foreach($mensagem as $key => $value){
         $usuarios = MySql::conectar()->prepare("SELECT nome FROM `tb_admin.usuarios` WHERE id = $value[user_id] ");
         $usuarios->execute();
         $usuarios = $usuarios->fetch()['nome'];
         $lastId = $value['id'];    
    ?>
    <div class="chat-msg">
            <span><?php echo $usuarios ?></span>
            <p><?php echo $value['mensagem']; ?></p>
            <div class="divi"></div>
     </div>
            <?php
            $_SESSION['lastIdChat'] = $lastId;
            }
        ?>
        </div>
       
        <form class="msg" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/form.php" method="post" >
            <textarea name="" id="" ></textarea>
            <input type="submit" name="acao" value="Enviar">
        </form>
   </div>

</div>
</section>
