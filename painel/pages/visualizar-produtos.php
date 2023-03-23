
<section style="background-color: #ebebeb;display: flex; align-items: center; height: 100vh;">

    <div class="container" style="border-radius: 7px; background-color: rgb(250, 250, 250);  align-items: center;justify-content: center; padding: 40px; width: 800px;">


                <form style="width: 600px;" method="post" enctype="multipart/form-data">

                <div class="mb-3 d-flex">
                    <input type="text"  class="form-control" name="buscar" placeholder="Pesquisar">
                    <input type="submit" class="btn btn-outline-dark" value="Buscar" name="acao">
                </div>
                </form>

                <div class="container-card">

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Nome do produto: </h6>
                        <h6 class="card-subtitle mb-2 text-muted">Descrição: </h6>
                        <h6 class="card-subtitle mb-2 text-muted">Largura: </h6>
                        <h6 class="card-subtitle mb-2 text-muted">Altura: </h6>
                        <h6 class="card-subtitle mb-2 text-muted">Comprimento: </h6>
                        <h6 class="card-subtitle mb-2 text-muted">Peso: </h6>
                        <h6 class="card-subtitle mb-2 text-muted ">Quantidade: </h6>
                        <div class="mb-3 d-flex">
                          <input type="number" name="quantidade" min="0" max="900" step="1" class="form-control" value="0" >
                          <input type="submit" class="btn btn-outline-dark" value="Atualizar" name="atualizar">

                        </div>
                        <a href="#" class="card-link">Editar</a>
                        <a href="#" class="card-link">Excluir</a>
                    </div>
                </div>

                </div>

    </div>

</section>