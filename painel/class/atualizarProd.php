<?php 

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST,  FILTER_DEFAULT);

/*$file = $_FILES['imagem'];

  #VALIDANDO A IMAGEM
  if($file['type'] == 'image/jpeg' ||
  $file['type'] == 'image/jpg' ||
  $file['type'] == 'image/png' ) {
      #SE TIVER DENTRO DAS NORMAS IRÁ SER SALVA
      $formato = explode('.',$file['name']);
      $imagemNome = uniqid().'.'.$formato[count($formato) - 1];
      move_uploaded_file($file['tmp_name'],'../painel/uploads/'.$imagemNome);
        $imagem = $imagemNome ;
      
  }else{
      #SE NÃO IRÁ SER NULL
      $imagem = '' ;
  }
    */
      



if(!empty($dados)){
   

    $query = "UPDATE  `tb_admin.estoque` SET  nome = :nome,  descricao = :descricao,largura = :largura 
    ,altura = :altura, comprimento = :comprimento, peso = :peso, quantidade = :quantidade WHERE id = :id";
    $cad_coment = $conn->prepare($query);
    $cad_coment->bindParam(':id', $dados['id']);
    $cad_coment->bindParam(':nome', $dados['nome']);
    $cad_coment->bindParam(':descricao', $dados['descricao']);
    $cad_coment->bindParam(':largura', $dados['largura']);
    $cad_coment->bindParam(':altura', $dados['altura']);
    $cad_coment->bindParam(':comprimento', $dados['comprimento']);
    $cad_coment->bindParam(':peso', $dados['peso']);
    $cad_coment->bindParam(':quantidade', $dados['quantidade']);
    $cad_coment->execute();
    
    


    $retorna = ['erro' => false, 'msg' => 'Produto atualizado', 'dados' => $dados];
}else{
    $retorna = ['erro' => true, 'msg' => 'Erro ao atualizar'];
}


echo json_encode($retorna);
