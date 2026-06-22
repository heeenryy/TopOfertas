    <?php 
    session_start();
    require("protecao.php");
    require("conexao.php") ?>

<!DOCTYPE html>
<html lang="en">
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
?>

<div class="container mt-4">
    <div class="card p-4 shadow-sm">
        <h4>Cadastrar Novo Curso 🎓</h4>
        <form action="cadastro.php" method="POST">
            <input type="text" class="form-control mb-2" name="nome_curso" placeholder="Nome Do Curso">
            <input type="text" class="form-control mb-2" name="descricao" placeholder="Descrição">
            <input type="number" class="form-control mb-2" step="0.01" name="preco" placeholder="Valor do curso">
            <input type="text" class="form-control mb-2" name="foto" placeholder="Foto">
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
                    
                    <a href="confirmar_exclusao.php?id=<?php echo $curso['id_curso']; ?>" class="btn btn-danger btn-sm w-100 mb-2">
                        Excluir 🗑️
                    </a>
                
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
</body>
</html>