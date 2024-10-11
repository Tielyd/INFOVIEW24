<?php

    $servidorBD = "localhost"; //Define a localização do servidor de BD
    $usuarioBD  = "root"; //Define o nome do usuário do servidor de BD
    $senhaBD    = "root"; //Define a senha do usuário do servidor de BD
    $database   = "InfoView"; //Define o banco de dados que a aplicação PHP conectará

    //A função mysqli_connect conecta o BD à Aplicação
    $conn       = mysqli_connect($servidorBD, $usuarioBD, $senhaBD, $database); 

    if(!$conn){
        echo "<p>Erro ao tentar conectar ao BD
                <strong>$database</strong></p>" . mysqli_error($conn);
        //A função mysqli_error() serve para emitir uma mensagem de erro
    }

?>