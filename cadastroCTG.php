<?php
session_start();
require("protecao.php");
require("conexao.php");

var_dump($_POST);

$NovaCate = $_POST['novaCT'];

$sql2 = "INSERT INTO categorias (nome_categoria) VALUES ('$NovaCate')";

if (mysqli_query($conn,$sql2)) {

} else {
    echo "Erro ao cadastror:" . mysqli_error($conn);
}

header("Location:pgadm.php")

?>