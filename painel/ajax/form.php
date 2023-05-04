<?php
include '../../config.php';
include '../class/MySql.php';

    $data['suceesso'] = true;
    $data['mensagem'] = "";

    if(isset($_POST['acao']) && $_POST['acao'] == 'enviarMensagem'){
        $mensagem = $_POST['mensagem'];
        $id_user = $_SESSION['user_id'];
        $nome = $_SESSION['nome'];
    
        $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.chat` VALUES (null,?,?) ");
        $sql->execute(array($id_user,$mensagem));
        
        echo ' <div class="chat-msg">
                <span>'.$nome.'</span>
                <p>'.$mensagem.'</p>
                <div class="divi"></div>
            </div>';

        
    }else if(isset($_POST['acao']) && $_POST['acao'] == 'pegarMensagem'){
        echo 'nova mensagem';
    }
    

   
        


        

?>