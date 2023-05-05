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
        $_SESSION['lastIdChat'] = MySql::conectar()->lastInsertId();

        
    }else if(isset($_POST['acao']) && $_POST['acao'] == 'pegarMensagem'){
        $lastId = $_SESSION['lastIdChat'];

        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.chat`  WHERE id > $lastId ");
        $sql->execute();
        $mensagem = $sql->fetchAll();
        $mensagem = array_reverse($mensagem);
        foreach($mensagem as $key => $value){
            $usuarios = MySql::conectar()->prepare("SELECT nome FROM `tb_admin.usuarios`  WHERE id = $value[user_id]");
            $usuarios->execute();
            $usuarios = $usuarios->fetch()['nome'];
            echo ' <div class="chat-msg">
                <span>'.$usuarios.'</span>
                <p>'.$value['mensagem'].'</p>
                <div class="divi"></div>
            </div>';

            $_SESSION['lastIdChat']= $value['id'];
        }
    }
    

   
        


        

?>