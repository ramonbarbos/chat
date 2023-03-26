
<?php 
    if(isset($_GET['pendente']) == false){

    
?>

<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

    <div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250);  align-items: center;justify-content: center; padding: 40px; width: 800px;">
    <h4>No estoque</h4>

    <?php
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
                                <h6 class="card-subtitle mb-2 text-muted ">Quantidade: <?php echo $value['quantidade'] ?> </h6>
                                
                                <button   class="btn btn-outline-primary"  onclick="editarProd(<?php echo $value['id'] ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Editar</button>
                                <button class="btn btn-outline-danger"  onclick="apagarProd(<?php echo $value['id'] ?>)" >Excluir</button>
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
                                <h6 class="card-subtitle mb-2 text-muted ">Quantidade: <?php echo $value['quantidade'] ?> </h6>

                                <button   class="btn btn-outline-primary"  onclick="editarProd(<?php echo $value['id'] ?>)" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Editar</button>

                                <button class="btn btn-outline-danger"  onclick="apagarProd(<?php echo $value['id'] ?>)" >Excluir</button>
                            </div>
                        </div>
                    <?php } ?>
                </div>




    </div>

    </section>


    <?php }?>
    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
                <div class="modal-body">
                <div class="card d-flex" style="width: 20rem; margin-right: 5px;">
                <span id="msg" ></span>
                    <span id="msgADD" ></span>
            <div class="">
                <span id="img" ></span>
            </div>
                <form action="" method="post" id="formProd">
                
                    <div class="card-body">
                        <div class="">
                            <span class="">Nome:</span>
                            <span id="nome"></span>
                        </div>
                        <div class="">
                            <span class="">Descrição:</span>
                            <span id="descricao"></span>
                        </div> 
                        <div class="">
                            <span class="">Largura:  </span>
                            <span id="largura"></span>
                        </div>  
                        <div class="">
                            <span class="">Altura:  </span>
                            <span id="altura"></span>
                        </div> 
                        <div class="">
                            <span class="">Comprimento:  </span>
                            <span id="comprimento"></span>
                        </div> 
                        <div class="">
                            <span class="">Peso:  </span>
                            <span id="peso"></span>
                        </div> 
                        <div class="">
                            <span class="">Quantidade:  </span>
                            <span id="quantidade"></span>
                        </div> 
                            <span id="id" ></span>
                        <div class="d-flex" >
                            <button id="excluir"  class="btn btn-outline-danger" onclick="cancelarUp()" >Cancelar</button>
                            <button type="submit" class="btn btn-outline-success" >Salvar</button>
                        </div>
                </form>
                        
                </div>
            </div>
      </div>
      
    </div>
  </div>
</div>

    <script>
          //DELETAR  PUBLICAÇÃO
            async function apagarProd(id){
                console.log("Envido: " +id)
                const dados = await fetch("./class/apagarProd.php?id=" + id) //enviar
                const resposta = await dados.json(); //receber
                console.log(resposta)

                window.location.reload();



            }
            
             //Mudar Input
             async function cancelarUp(){
                window.location.reload();
            }

            //BUSCAR PRODUTO
            async function editarProd(id){
                console.log("Envido: " +id)
                const dados = await fetch("./class/consultaProd.php?id=" + id) //enviar
                const resposta = await dados.json(); //receber
                console.log(resposta)

                if(resposta['erro']){
                document.getElementById('msg').innerHTML ='<div class="alert alert-danger" role="alert">'+resposta['msg']+'</div>'  ;
                
                 }else{
    
                    document.getElementById('img').innerHTML = '<img src="./uploads/'+resposta['dadosImg'].imagem+'" class="card-img-top" alt="...">' ;
                    document.getElementById('nome').innerHTML = '<input type="text" name="nome" id="nome" class="" value="'+resposta['dados'].nome+'" >' ;
                    document.getElementById('descricao').innerHTML = '<input type="text" name="descricao" id="descricao" class="" value="'+resposta['dados'].descricao+'" >' ;
                    document.getElementById('largura').innerHTML = '<input type="text" name="largura" id="largura" class="" value="'+resposta['dados'].largura+'" >' ;
                    document.getElementById('altura').innerHTML = '<input type="text" name="altura" id="altura" class="" value="'+resposta['dados'].altura+'" >' ;
                    document.getElementById('comprimento').innerHTML = '<input type="text" name="comprimento" id="comprimento" class="" value="'+resposta['dados'].comprimento+'" >' ;
                    document.getElementById('peso').innerHTML = '<input type="text" name="peso" id="peso" class="" value="'+resposta['dados'].peso+'" >' ;
                    document.getElementById('quantidade').innerHTML = '<input type="text" name="quantidade" id="quantidade" class="" value="'+resposta['dados'].quantidade+'" >' ;
                    document.getElementById('id').innerHTML = '<input type="hidden" name="id" id="id" class="" value="'+resposta['dados'].id+'" >' ;
                    
                }
        
             }

              //UPDATE NA PUBLICAÇÃO
            const cadForm = document.getElementById("formProd");

                cadForm.addEventListener("submit", async (e) =>{
                    e.preventDefault(); //para não recarrecar a pagina
                    console.log("chegou a requisição para ser atualizada")

                    const dadosForm =  new FormData(cadForm);
                    dadosForm.append("add", 1)

                    const dadosPubli = await fetch("./class/atualizarProd.php",{
                        method: "POST",
                        body:dadosForm
                    });
                    const respostaPubli = await dadosPubli.json();
                    console.log(respostaPubli)

                    if(respostaPubli['erro']){
                        document.getElementById('msgADD').innerHTML ='<div class="alert alert-danger" role="alert">'+respostaPubli['msg']+'</div>'  ;
                        
                            //const visModal = document.getElementById("feedUser");
                        // visModal.show();
                    }else{
                        document.getElementById('msgADD').innerHTML ='<div class="alert alert-success" role="alert">'+respostaPubli['msg']+'</div>'  ;

                        console.log(respostaPubli);
                    }
       

             })
    </script>
