    <?php 
    session_start();
    require("protecao.php");
    require("conexao.php") ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>pgadmin</title>
</head>
<body>
    <?php



// Aqui você faz o SELECT para buscar os cursos já existentes
$resultado = mysqli_query($conn, "SELECT * FROM cursos ORDER BY id_curso DESC");
// query das categorias
$categorias = mysqli_query($conn,"SELECT * FROM categorias");

?>

<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h4>Cadastrar Novo Curso 🎓</h4>
        <form action="cadastro.php" method="POST" enctype="multipart/form-data">
            <input type="text" class="form-control mb-2" name="nome_curso" placeholder="Nome Do Curso">
            <input type="text" class="form-control mb-2" name="descricao" placeholder="Descrição">
            <input type="number" class="form-control mb-2" step="0.01" name="preco" placeholder="Valor do curso">
            
            <input type="file" class="form-control mb-2" name="foto" placeholder="Foto">
            <!-- categorias -->
            <select name="categoria" placeholder="categoria">
                <?php while ($opcoes = mysqli_fetch_assoc($categorias)): ?>
                <option value="<?= $opcoes['id_categoria'] ?>"> <?= $opcoes['nome_categoria'] ?> </option>
                <?php endwhile; ?>
            </select>
                <button type="button" data-bs-toggle="modal" data-bs-target="#meuModal">➕ Adicionar Nova Categoria</button>

            <input type="text" class="form-control mb-2" name="link" placeholder="Adicione o link">

             <button type="submit" class="btn btn-success">Adicionar Produto</button>
             <a href="sair.php" class="btn btn-primary">Voltar a Pagina Inicial</a>
            </form>
    </div>

    <hr class="my-5"> 
<div class="row">
    <?php 
    // O motor começa aqui: enquanto houver uma linha de curso, ele guarda em $curso
    while($curso = mysqli_fetch_assoc($resultado)): 
    ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="imagens/<?php echo $curso['foto']; ?>" class="card-img-top" style="height: 180px; object-fit: contain;">
                
                <div class="card-body">
                    <h5 class="fw-bold"><?php echo $curso['nome_curso']; ?></h5>
                </div>

                <div class="card-body border-top">
                    <h6 class="text-muted">Descrição</h6>
                    <p><?php echo $curso['decricao']; ?></p>
                </div>

                <div class="card-body border-top mt-auto">
                    <h6 class="text-muted">Valor</h6>
                    <p class="text-success fw-bold">R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?></p>
                    
                    <!-- <a href="confirmar_exclusao.php?id=<?php echo $curso['id_curso']; ?>" class="btn btn-danger btn-sm w-100 mb-2">
                        Excluir 🗑️
                    </a> -->
                    <button type="button" data-bs-toggle="modal" data-bs-target="#meuModalDeExcluir" data-id="<?php echo $curso['id_curso']; ?>" class="btn btn-danger btn-sm w-100 mb-2">Excluir 🗑️</button>  
                
                    <a href="formEditar.php?id=<?php echo $curso['id_curso'] ?>" class="btn btn-warning btn-sm w-100"> Editar</a>
                </div>
            </div>
        </div>
        <a href=""></a>
    <?php 
    // O motor para aqui e volta para o início até acabar os cursos
    endwhile; 
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Adicionar categoria -->

<div class="modal" id="meuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Categoria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                

                 <h1>Adicionar Nova Categoria</h1>
    
    <form action="cadastroCTG.php" method="POST" >
    
    <input type="text" class="form-control mb-2" name="novaCT" placeholder="Nova Categoria">
    
    <button type="submit" class="btn btn-success">Adicionar Produto</button>
    <a href="pgadm.php" class="btn btn-primary">Voltar</a>
    </form>


            </div>
        </div>
    </div>
</div>
<!-- botão  excluir -->

<div class="modal" id="meuModalDeExcluir" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                



   <div class="alert alert-warning" style="margin-top: 50px;">
    <h4>Atenção! ⚠️</h4>
    <p>Você tem certeza que deseja excluir o curso ?</p>
    
    <a id="linkExcluir" href="#" class="btn btn-danger">
        Sim, excluir agora 🗑️
    </a>

    <a href="pgadm.php" class="btn btn-secondary">
        Não, voltar ao painel ✋
    </a>


            </div>
        </div>
    </div>
</div>

<!-- javaScript -->

<script>
document.getElementById('meuModalDeExcluir').addEventListener('show.bs.modal', function(event) {
    var id = event.relatedTarget.getAttribute('data-id');
    document.getElementById('linkExcluir').href = "excluir_curso.php?id=" + id;
});


</script>

</body>
</html>