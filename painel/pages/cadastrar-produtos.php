
<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

    <div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250); display: flex; align-items: center;justify-content: center; padding: 40px; width: 800px;">


                <form style="width: 600px;" method="post" enctype="multipart/form-data">


                <?php

                    if(isset($_POST['acao'])){
                        $nome = @$_POST['nome'];
                        $descricao = @$_POST['descricao'];
                        $largura = @$_POST['largura'];
                        $altura = @$_POST['altura'];
                        $comprimento = @$_POST['comprimento'];
                        $peso = @$_POST['peso'];
                        $quantidade = @$_POST['quantidade'];

                        $imagem = array();
                        $amountFiles = count($_FILES['imagem']['name']);

                        $sucesso = true;

                        if($_FILES['imagem']['name'][0] != ''){

                        
                            for($i = 0; $i < $amountFiles; $i++){
                                $imagemAtual =  ['type' =>@$_FILES['imagem']['type'][$i],
                                'size' =>@$_FILES['imagem']['size'][$i]];

                                if(Painel::imagemValida($imagemAtual) == false){
                                    $sucesso = false;
                                    Painel::alerta('erro','Uma das imagens selecionadas é invalida');

                                }   break;
                            }

                        }else{
                            $sucesso = false;
                            Painel::alerta('erro','Voce precisa selecionar uma imagem');
                            
                        }


                        if($sucesso){
                            //Cadastrar informações

                            for($i = 0; $i < $amountFiles; $i++){
                                $imagemAtual =  ['tmp_name' =>@$_FILES['imagem']['tmp_name'][$i],
                                'name' =>@$_FILES['imagem']['name'][$i]];
                               $imagem[] = Painel::uploadImagem($imagemAtual);

                               }
                               $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.estoque` VALUES(null,?,?,?,?,?,?,?)");
                               $sql->execute(array($nome,$descricao,$largura,$altura,$comprimento,$peso,$quantidade));
                               $lastId = MySql::conectar()->lastInsertId();
                               foreach($imagem as $key => $value){
                                    MySql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$lastId, '$value') ");
                               }
                            Painel::alerta('sucesso','Produtos cadastrados com sucesso');

                        }

                    }

                ?>

                
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do produto</label>
                        <input type="text" class="form-control" id="nome" name="nome" >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Descrição do Produto</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>
            
                    <div class="mb-3">
                        <label class="form-label">Largura</label>
                        <input type="number" name="largura" min="0" max="900" step="1" class="form-control" value="0" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Altura</label>
                        <input type="number" name="altura" min="0" max="900" step="1" class="form-control" value="0" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comprimento</label>
                        <input type="number" name="comprimento" min="0" max="900" step="1" class="form-control" value="0" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Peso</label>
                        <input type="number" name="peso" min="0" max="900" step="1" class="form-control" value="0" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantidade</label>
                        <input type="number" name="quantidade" min="0" max="900" step="1" class="form-control" value="0" >
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Imagem</label>
                        <input multiple type="file" class="form-control"  name="imagem[]">
                    </div>
                  
                    <input type="submit" class="btn btn-outline-dark" value="Casdastrar produto" name="acao">

                </form>

    </div>

</section>