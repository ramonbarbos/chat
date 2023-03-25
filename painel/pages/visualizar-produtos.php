
<?php 
    if(isset($_GET['pendente']) == false){

    
?>

<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

    <div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250);  align-items: center;justify-content: center; padding: 40px; width: 800px;">
    <h4>No estoque</h4>

    <?php
                if(isset($_POST['atualizar'])){

                    $quantidade = $_POST['quantidade'];
                    $produto_id = @$_POST['produto_id'];
                    if($quantidade < 0){
                        Painel::alerta('erro','Erro ao atualizar a quantidade');

                    }else{
                        $sql = MySql::conectar()->prepare("UPDATE `tb_admin.estoque` SET quantidade = $quantidade WHERE id = $produto_id ");
                        $sql->execute();

                        Painel::alerta('sucesso','Produtos atualizado com sucesso');

                    }
                }
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
                $sql->execute();
                if($sql->rowCount() > 0 ){
                     Painel::alerta('sucesso','Voce está com produtos em falta! Clique <a href="'.INCLUDE_PATH_PAINEL.'visualizar-produtos&pendente"> aqui </a> para ver');
                }

                ?>
                <form style="width: 600px;" method="post" enctype="multipart/form-data">  

                <div class="mb-3 d-flex">
                    <input type="text"  class="form-control" name="busca" placeholder="Pesquisar">
                    <input type="submit" class="btn btn-outline-dark" value="Buscar" name="acao">
                </div>
                </form>

                <div class="container" style="display:flex">

                <?php 
                        $query = ''; 
                        if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar'){
                            $nome  = @$_POST['busca'];
                            $query = " WHERE nome LIKE '%$nome%' OR descricao LIKE '%$nome%' ";
                            
                        }

                        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query");
                       $sql->execute();
                       $produtos = $sql->fetchAll();
                       $produtosUni = $sql->fetch();
                       if((count($produtos) == 0 ) || (@$produtosUni['quantidade'] == '0') ){
                        echo 'Nenhum produto encontrado, pesquise novamente!';
                        }
                       foreach( $produtos as $key => $value){ 
                        if($value['quantidade'] == '0')
                            continue;
                        $imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
                        $imagemSingle->execute();
                        $imagemSingle = $imagemSingle->fetch()['imagem'];
                        
                ?>

                
                

                    <div class="card d-flex" style="width: 18rem; margin-right: 5px;">

                        <div class="">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagemSingle ?>" class="card-img-top" alt="...">
                        </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Nome do produto: <?php echo $value['nome'] ?> </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Descrição: <?php echo $value['descricao'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Largura: <?php echo $value['largura'] ?> </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Altura: <?php echo $value['altura'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Comprimento: <?php echo $value['comprimento'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Peso: <?php echo $value['peso'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted ">Quantidade: </h6>
                                <form method="post" >
                                    <div class="mb-3 ">
                                        <input type="number" name="quantidade" min="0" max="900" step="1" class="form-control" value="<?php echo $value['quantidade'] ?>" >
                                        <input type="hidden" name="produto_id" value="<?php echo $value['id'] ?>" >
                                        <input type="submit" class="btn btn-outline-dark" value="Atualizar" name="atualizar">
                                    </div>
                                </form>
                                <a  class="card-link">Editar</a>
                                <button   class="btn btn-outline-danger" onclick="apagarProd(<?php echo $value['id'] ?>)" >Excluir</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>


    </div>

</section>

<?php 
  } else{  ?>

    <section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

    <div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250);  align-items: center;justify-content: center; padding: 40px; width: 800px;">

    

    <h4><a href="<?php echo INCLUDE_PATH_PAINEL?>visualizar-produtos">No estoque</a> > Pendentes</h4>

    <span id="msg" ></span>

    <?php
                if(isset($_POST['atualizar'])){

                    $quantidade = $_POST['quantidade'];
                    $produto_id = @$_POST['produto_id'];
                    if($quantidade < 0){
                        Painel::alerta('erro','Erro ao atualizar a quantidade');

                    }else{
                        $sql = MySql::conectar()->prepare("UPDATE `tb_admin.estoque` SET quantidade = $quantidade WHERE id = $produto_id ");
                        $sql->execute();

                        Painel::alerta('sucesso','Produtos atualizado com sucesso');

                    }
                }
              

                ?>
            

                <div class="container" style="display:flex">

                <?php 
                      

                        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0 ");
                       $sql->execute();
                       $produtos = $sql->fetchAll();
                       if(count($produtos) == 0){
                            echo 'Nenhum produto em falta!';
                        }
                       foreach( $produtos as $key => $value){ 
                        $imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
                        $imagemSingle->execute();
                        $imagemSingle = $imagemSingle->fetch()['imagem'];
                        
                ?>

                
                

                    <div class="card d-flex" style="width: 18rem; margin-right: 5px;">

                        <div class="">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $imagemSingle ?>" class="card-img-top" alt="...">
                        </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted">Nome do produto: <?php echo $value['nome'] ?> </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Descrição: <?php echo $value['descricao'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Largura: <?php echo $value['largura'] ?> </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Altura: <?php echo $value['altura'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Comprimento: <?php echo $value['comprimento'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted">Peso: <?php echo $value['peso'] ?>  </h6>
                                <h6 class="card-subtitle mb-2 text-muted ">Quantidade: </h6>
                                <form method="post" >
                                    <div class="mb-3 ">
                                        <input type="number" name="quantidade" min="0" max="900" step="1" class="form-control" value="<?php echo $value['quantidade'] ?>" >
                                        <input type="hidden" name="produto_id" value="<?php echo $value['id'] ?>" >
                                        <input type="submit" class="btn btn-outline-dark" value="Atualizar" name="atualizar">
                                    </div>
                                </form>
                                <a  class="card-link">Editar</a>
                                <button class="btn btn-outline-danger"  onclick="apagarProd(<?php echo $value['id'] ?>)" >Excluir</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>




    </div>

    </section>


    <?php }?>

    <script>
          //DELETAR  PUBLICAÇÃO
  async function apagarProd(id){
    console.log("Envido: " +id)
    const dados = await fetch("./class/apagarProd.php?id=" + id) //enviar
    const resposta = await dados.json(); //receber
    console.log(resposta)

    window.location.reload();



}
    </script>
