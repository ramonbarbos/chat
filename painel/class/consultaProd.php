<?php 

include_once "conexao.php";


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if(!empty($id)){

    //Consulta Feed
    $queryFeed =  "SELECT * FROM `tb_admin.estoque` WHERE id = :id ";
    $resultFeed = $conn->prepare($queryFeed);
    $resultFeed->bindParam(':id', $id);
    $resultFeed->execute();
    $dados = $resultFeed->fetch();

    $id_img = $dados['id'];

    //Consulta Feed
    $queryImg =  "SELECT imagem FROM `tb_admin.estoque_imagens` WHERE produto_id = :id ";
    $resultImg = $conn->prepare($queryImg);
    $resultImg->bindParam(':id', $id_img);
    $resultImg->execute();
    $dadosImg = $resultImg->fetch();

   
    
    $dados = ['erro' => false, 'dados' => $dados,'dadosImg' => $dadosImg];

}else{
    $dados = ['erro' => true, 'msg' => 'Erro no tramite'];

}

echo json_encode($dados);


?>
