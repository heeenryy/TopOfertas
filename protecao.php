<?php 

    if (!isset($_SESSION['adm'])) {
    // Se entrar aqui, é porque o crachá NÃO foi encontrado
    header("Location: login.php");
    exit(); // Encerra o script para não carregar o resto da página
}
// Se o código chegar aqui, significa que o Admin está logado!

?>