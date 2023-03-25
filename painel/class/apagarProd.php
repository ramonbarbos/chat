<?php 

include_once "conexao.php";
include_once "../../config.php";



$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);


if(!empty($id)){


     //Consultar Imagem do Produto
    $queryImg =  "SELECT * FROM `tb_admin.estoque_imagens` WHERE id = :id ";
    $resultImg = $conn->prepare($queryImg);
    $resultImg->bindParam(':id', $id);
    $resultImg->execute();
    $imagens = $resultImg->fetchAll();
    foreach($imagens as $key => $value){
        @unlink(BASE_DIR_PAINEL.'./uploads/'.$imagens);
    }
    //Deletar Imagem do Produto
    $queryImgDell =  "DELETE FROM `tb_admin.estoque_imagens` WHERE produto_id = :id ";
    $resultImgDell = $conn->prepare($queryImgDell);
    $resultImgDell->bindParam(':id', $id);
    $resultImgDell->execute();
    //Deletar Produto
    $queryProd =  "DELETE FROM `tb_admin.estoque` WHERE id = :id ";
    $resultProd = $conn->prepare($queryProd);
    $resultProd->bindParam(':id', $id);
    $resultProd->execute();


    
    $dados = ['erro' => false,'msg' => 'Apagado com sucesso!' ];

}else{
    $dados = ['erro' => true, 'msg' => 'Erro ao apagar'];

}

echo json_encode($dados);


?>
