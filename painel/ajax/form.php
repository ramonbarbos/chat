<?php
include '../../config.php';

    $data['suceesso'] = true;
    $data['mensagem'] = "";


    $mensagem = $_POST['mensagem'];
    $id_user = $_SESSION['user_id'];
    $nome = $_SESSION['nome'];
  

    echo ' <div class="mensagem-chat">
            <span>'.$nome.'</span>
            <p>'.$mensagem.'</p>
            <div class="divi"></div>
        </div>';

        

?>