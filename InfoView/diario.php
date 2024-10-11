<?php
if (isset($_GET['ano']) && isset($_GET['dia']) && isset($_GET['curso'])) {
    $ano = $_GET['ano'];
    $dia = $_GET['dia'];
    $curso = $_GET['curso'];
    
    echo "O valor do ano é: " . htmlspecialchars($ano) . "<br>";
    echo "O dia da semana é: " . htmlspecialchars($dia) . "<br>";
    echo "O curso é: " . htmlspecialchars($curso);


   /*$sql = "SELECT * FROM `relatorioinfo3` WHERE dia = $dia AND curso = $curso AND ano = $ano";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $dia, $curso, $ano); // 'ssi' indica que dia e curso são strings, e ano é um inteiro
    $stmt->execute();
    $result = $stmt->get_result();
    echo $result; */


} else {
    echo "As variáveis semana e dia não foram definidas.";
}
?>
