<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
$usuarioLogado = isset($_SESSION['idUsuario']); // Verifica se a sessão do usuário está ativa
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoView</title>

    <!-- Última versão compilada e minimizada CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Última versão compilada JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CDNs para Máscaras JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Script para Máscaras do Formulário -->
    <script>
        $(document).ready(function(){
            $("#telefoneUsuario").mask("(00) 00000-0000");
        });
    </script>

</head>
<body>

    <!-- Container de Logotipo do Sistema -->
    <div class="container-fluid text-center">
        <a href="index.php" title="Retornar à Página Inicial">
            <img src="img/logo.png" width="200">
        </a>
    </div>

    <!-- Barra de Navegação do Sistema -->
    <nav  class="navbar navbar-expand-sm navbar-dark sticky-top" style="background-color:#3fa14c;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php" title="Ir para a Página Inicial">Início</a>
                    </li>
                    <?php if ($usuarioLogado): ?>
                        <!-- Exibe estas opções apenas se o usuário estiver logado -->
                        <li class="nav-item">
                            <a class="nav-link active" href="formRelatorioINF3.php" title="Cadastrar Relatório">Cadastrar Relatório</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="formCurso.php" title="Cadastrar Curso">Cadastrar Curso</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="formDisciplina.php" title="Cadastrar Disciplina">Cadastrar Disciplina</a>
                        </li>
                    <?php else: ?>
                        <!-- Exibe apenas estas opções se o usuário NÃO estiver logado -->
                        <li class="nav-item">
                            <a class="nav-link active" href="formLogin.php" title="Acessar o Sistema">Login</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="sobre.php" title="Sobre Nós">Sobre Nós</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container PRINCIPAL do Sistema-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
