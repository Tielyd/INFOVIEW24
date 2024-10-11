
<?php include("header.php") ?>
<?php

include("conexaoBD.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeCurso = $_POST['nomeCurso'];

    // Início do bloco de validação da FOTO
    $diretorio    = "img/"; // Define para qual diretório do sistema as imagens serão movidas
    $urlCurso     = $diretorio . basename($_FILES['urlCurso']['name']); // img/nome_da_foto.jpg
    $erroUpload   = false; // Variável criada para verificar se houve erro no upload da foto
    $tipoDaImagem = strtolower(pathinfo($urlCurso, PATHINFO_EXTENSION)); // Pegar o tipo do arquivo

    // Verificar se o tamanho do arquivo é diferente de ZERO
    if ($_FILES['urlCurso']['size'] != 0) {
        
        // Verificar se o tamanho do arquivo da foto é maior do que 5MB
        if ($_FILES['urlCurso']['size'] > 5000000) {
            echo "<div class='alert alert-warning text-center'>A foto não pode ter <strong>TAMANHO</strong> maior do que 5MB!</div>";
            $erroUpload = true;
        }

        // Verificar o tipo do arquivo (pela extensão)
        if ($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp") {
            echo "<div class='alert alert-warning text-center'>A foto precisa estar nos formatos <strong>JPG, JPEG, PNG ou WEBP</strong>!</div>";
            $erroUpload = true;
        }

        // Verificar se o arquivo conseguiu ser movido para o diretório img
        if (!move_uploaded_file($_FILES['urlCurso']['tmp_name'], $urlCurso)) {
            echo "<div class='alert alert-danger text-center'>Erro ao tentar <strong>MOVER A FOTO</strong> para o diretório de imagens!</div>";
            $erroUpload = true;
        }

    } else {
        echo "<div class='alert alert-warning text-center'>A <strong>foto</strong> é obrigatória!</div>";
        $erroUpload = true;
    }

// Se não houve erro no upload, insere o curso no banco de dados 
if (!$erroUpload) {
    $sql = "INSERT INTO curso (nomeCurso, urlCurso) VALUES ('$nomeCurso', '$urlCurso')";

    if ($conn->query($sql) === TRUE) {
        echo '<div style="padding: 15px; border: 2px solid #4CAF50; background-color: #dff0d8; color: #3c763d; border-radius: 5px; font-size: 24px; font-weight: bold; text-align: center;">
                Curso cadastrado com sucesso!
              </div>';
    } else {
        echo "Erro ao cadastrar o curso: " . $conn->error;
    }
}


    $conn->close();
}
?>
<?php include("footer.php") ?>
