<?php include("header.php"); ?>

<?php
      

// Configurações do curso
$curso = "Informática para Internet 1";
$disciplinas = [
    'Segunda-feira' => ['Química 1', 'Biologia 1'],
    'Terça-feira' => ['Design Gráfico / Tecnologias WEB', 'Design Gráfico / Tecnologias WEB'],
    'Quarta-feira' => ['Língua Portuguesa 1', 'Educação Física 1'],
    'Quinta-feira' => ['Matemática 1', 'Arte 1'],
    'Sexta-feira' => ['Física 1', 'Língua Inglesa 1']
];

// Obtém a data atual
$dataAtual = new DateTime();
$semanaAtual = $dataAtual->format("W");

// Função para exibir o calendário
function exibirCalendario($semana, $disciplinas) {
    echo "<h2>Relatório Semanal</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Dia da Semana</th><th>Disciplinas</th></tr>";
    
    foreach ($disciplinas as $dia => $materias) {
        echo "<tr>";
        echo "<td>{$dia}</td>";
        echo "<td>" . implode(', ', $materias) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Semanal - <?= $curso ?></title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <div class="container">
        <h1><?= $curso ?></h1>
        <h2>Semana <?= $semanaAtual ?></h2>
        <?php exibirCalendario($semanaAtual, $disciplinas); ?>
    </div>
</body>
</html>


<?php include "footer.php"; ?>