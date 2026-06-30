<!DOCTYPE html>
<?php
// filtros

$idCategoria = trim($_GET['idCategoria'] ?? '');

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="estilo.css">
     <link rel="shortcut icon" href="image.png" type="image/x-icon">
    <script src="padrao_cards.js"></script>
    <?php require("conexao.php") ?>
    <title>🔥 TopOfertas</title>
</head>
<body>
     <!-- cabeçalho -->
    <header>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="cor">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <a class=" navbar-brand" href="index.php">🔥 TopOfertas</a>

    <a href="login.php" class="btn btn-primary ms-auto d-lg-none">Admin</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php"></a>
            
            </li>
        </ul>
        <form class="d-flex" method="GET" action="index.php">
            <input class="form-control me-2" type="search" name="pesquisa" placeholder="Pesquisar" aria-label="Search" value="<?php echo isset($_GET['pesquisa']) ? $_GET['pesquisa'] : ''; ?>">
            <button class="btn btn-success ms-auto" type="submit">Pesquisar</button>
        </form>

        <a href="login.php" class="btn btn-primary ms-2 d-none d-lg-block">Admin</a>     
    </div>
    <div>
    </div>
</div>
</nav>
</header>
<!-- corpo principal -->
<main>

    <!-- slide 1 -->
<div class="container mt-5" style="max-width: 800px;">
    
    <div id="meuCarrossel" class="carousel slide">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <img src="imagens/php1.png" class="d-block w-100" alt="curso 1">
            </div>

            <div class="carousel-item">
                <img src="imagens/js1.png" class="d-block w-100" alt="curso 2">
            </div>

            <div class="carousel-item">
                <img src="imagens/kt1.png" class="d-block w-100" alt="curso 3">
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#meuCarrossel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#meuCarrossel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            
        </div>
    </div>

</div>

<!-- cursos -->
<?php
  if(!empty(intval($idCategoria))){
      $sql = mysqli_query($conn,"SELECT * FROM cursos WHERE id_categoria = $idCategoria ");
      
      } else{
      $pesquisa = isset($_GET['pesquisa']) ? mysqli_real_escape_string($conn,$_GET['pesquisa']):'';
    if ($pesquisa != '') {
        $sql = mysqli_query($conn,"SELECT * FROM cursos where nome_curso LIKE '%$pesquisa%' ORDER BY id_curso DESC");
    } else {
        $sql = mysqli_query($conn,"SELECT * FROM cursos ORDER BY id_curso DESC");
    }}
    
 ?>
    <!-- Filtros rapidos -->
<?php $resultcateg = mysqli_query($conn,"SELECT * FROM categorias");

?>

<div class="container text-center my-4">
    <a href="index.php" class="btn  <?= empty($idCategoria) ? 'btn-secondary' : 'btn-outline-primary' ?> me-2 mb-2">Todos</a>
    <?php while($resultado2 = mysqli_fetch_assoc($resultcateg)): ?>
    <a href="index.php?idCategoria=<?= $resultado2['id_categoria'] ?>" class="btn <?= ($resultado2['id_categoria'] == $idCategoria) ? 'btn-secondary' : 'btn-outline-primary' ?> btn-sm rounded-pill me-2 mb-2"><?= $resultado2['nome_categoria'] ?></a>
    <?php endwhile; ?>  
</div>




    <?php 
    if(mysqli_num_rows($sql) == 0): ?>
  
        <div class="msg-vazio">
            <div class="ico">🔍</div>
        <h3 >Nem um curso encontrado</h3>
      <p>Tente outros filtros ou <a href="index.php">veja todos os produtos</a>.</p>
    <?php else: ?>
          <hr class="my-5"> 
<div class="container">
    <h2 style="text-align:center; margin-bottom:40px;"  >Nossos produtos</h2>
    <div class="row">
  <?php  // O motor começa aqui: enquanto houver uma linha de curso, ele guarda em $curso
    while($curso = mysqli_fetch_assoc($sql)): 
    ?>
    <?php 
    
        if ($pesquisa != '') {
            $limite = strlen($pesquisa) / 3;
            $result = levenshtein($pesquisa,$curso['nome_curso']);
            
            if ($$result >= $limite) { ?>
             <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                <img src="imagens/<?php echo $curso['foto']; ?>" class="card-img-top" style="height: 180px; object-fit: contain;">
                
                <div class="card-body">
                    <h5 class="fw-bold text-dark"><?php echo $curso['nome_curso']; ?></h5>
                </div>

                <div class="card-body border-top">
                    <h6 class="text-muted">Descrição</h6>
                    <p><?php echo $curso['decricao']; ?></p>
                </div>

                <div class="card-body border-top mt-auto">
                    <h6 class="text-muted">Valor</h6>
                    <p class="text-success fw-bold">R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?></p>
                    
                    <a href="confirmar_exclusao.php?id=<?php echo $curso['id_curso']; ?>">
                       
                    </a>
                    <a href="<?php echo $curso['link']?>" class="btn btn-primary btn-sm w-100" >Comprar Agora</a>
                </div>
            </div>
        </div>
           <?php } else { ?>
                    <?php echo "Conteudo não encontrado" ?>

           <?php }?>
            
       <?php } else {     
    ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="imagens/<?php echo $curso['foto']; ?>" class="card-img-top" style="height: 180px; object-fit: contain;">
                
                <div class="card-body">
                    <h5 class="fw-bold text-dark"><?php echo $curso['nome_curso']; ?></h5>
                </div>

                <div class="card-body border-top">
                    <h6 class="text-muted">Descrição</h6>
                    <p><?php echo $curso['decricao']; ?></p>
                </div>

                <div class="card-body border-top mt-auto">
                    <h6 class="text-muted">Valor</h6>
                    <p class="text-success fw-bold">R$ <?php echo number_format($curso['preco'], 2, ',', '.'); ?></p>
                    
                    <a href="confirmar_exclusao.php?id=<?php echo $curso['id_curso']; ?>">
                       
                    </a>
                    <a href="<?php echo $curso['link']?>" class="btn btn-primary btn-sm w-100" >Comprar Agora</a>
                </div>
            </div>
        </div>
    <?php }
    // O motor para aqui e volta para o início até acabar os cursos
    endwhile; 
    endif;
    ?>
    </div>
</div>
</main>
<footer class="footer">
    <p>&copy; <?= date('Y') ?> <strong>🔥 TopOfertas</strong>. Todos os direitos reservados.</p>
    <p>Deseja ter um site responsivo e dinâmico? Entre em contato com o desenvolvedor: <a class="whats" href="https://wa.me/77999384424?text=<?= urlencode('Olá Henrique! Quero ter um site responsivo e dinâmico  ') ?>">Whatswapp</a></p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>