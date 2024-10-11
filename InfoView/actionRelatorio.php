<?php
// Inicia a sessão
session_start();

// Conexão com o banco de dados
include("conexaoBD.php");

// Verifica se o usuário está logado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php"); // Redireciona para a página de login se não estiver logado
    exit();
}

// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiza as entradas do formulário
    $curso = mysqli_real_escape_string($conn, $_POST['curso']);
    $ano = mysqli_real_escape_string($conn, $_POST['ano']);
    $anoCurso = mysqli_real_escape_string($conn, $_POST['anoCurso']);
    $semana = mysqli_real_escape_string($conn, $_POST['semana']);
    $mes = mysqli_real_escape_string($conn, $_POST['mes']);
    $dia = mysqli_real_escape_string($conn, $_POST['dia']);
    $disciplina = mysqli_real_escape_string($conn, $_POST['disciplina']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);

    // Insere o relatório no banco de dados
    $query = "INSERT INTO relatorio (idUsuario, idCurso, ano, anoCurso, semana, mes, dia, idDisciplina, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    
    // Verifica se a preparação da declaração foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }

    // Liga os parâmetros
    mysqli_stmt_bind_param($stmt, 'iiiisssis', $_SESSION['idUsuario'], $curso, $ano, $anoCurso, $semana, $mes, $dia, $disciplina, $descricao);
    
    // Executa a consulta e verifica se foi bem-sucedida
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Relatório cadastrado com sucesso!'); window.location.href='index.php';</script>";
    } else {
        echo "Erro ao cadastrar relatório: " . mysqli_error($conn);
    }

    // Fecha a declaração
    mysqli_stmt_close($stmt);
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
