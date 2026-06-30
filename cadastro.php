<?php 
    session_start();
    require("protecao.php"); // Garante que é o Admin
    require("conexao.php"); // Abre a porta do banco de dados

    $nome = $_POST['nome_curso'];
    $descr = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = $_FILES['foto']['name'];
    $link = $_POST['link'];
    $categoria = $_POST['categoria'];

    $destino = "imagens/" . $foto;
    move_uploaded_file($_FILES['foto']['tmp_name'], $destino ) ;

    
    $sql = "INSERT INTO cursos (nome_curso,decricao,preco,foto,link,id_categoria) VALUES ('$nome','$descr','$preco','$foto','$link', $categoria)";
    

    if (mysqli_query($conn,$sql)) {
       
    } else {
         echo "Erro ao cadastror:" . mysqli_error($conn);
    }
    mysqli_close($conn);
    header("Location: pgadm.php");

    
?>