<?php
// Inicia a sessão
session_start();

// Conexão com o banco de dados
include("conexaoBD.php");

// Verifica se o idCurso foi passado
if (isset($_GET['idCurso'])) {
    $idCurso = intval($_GET['idCurso']); // Converte para inteiro para segurança

    // Prepara a consulta SQL para buscar as disciplinas relacionadas ao curso
    $query = "SELECT idDisciplina, nomeDisciplina FROM disciplina WHERE idCurso = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }

    // Liga os parâmetros
    mysqli_stmt_bind_param($stmt, 'i', $idCurso);

    // Executa a consulta
    mysqli_stmt_execute($stmt);

    // Obtém o resultado
    $result = mysqli_stmt_get_result($stmt);
    $disciplinas = [];

    // Armazena as disciplinas em um array
    while ($row = mysqli_fetch_assoc($result)) {
        $disciplinas[] = $row;
    }

    // Retorna as disciplinas em formato JSON
    echo json_encode($disciplinas);

    // Fecha a declaração
    mysqli_stmt_close($stmt);
} else {
    echo json_encode([]); // Retorna um array vazio se idCurso não foi passado
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
