<?php include("header.php"); ?>

<?php

// Conexão com o banco de dados
include("conexaoBD.php");

// Verifica se o idCurso foi passado
if (isset($_GET['idCurso'])) {
    $idCurso = intval($_GET['idCurso']); // Converte para inteiro para segurança

    // Filtros
    $mes = isset($_GET['mes']) ? $_GET['mes'] : date('m');
    $ano = isset($_GET['ano']) ? $_GET['ano'] : date('Y');


    // Consulta para buscar os relatórios filtrados por curso, mês e ano
    $sql = "SELECT r.semana, r.dia, r.mes, r.ano, r.descricao, d.nomeDisciplina AS disciplina
            FROM relatorio r
            JOIN disciplina d ON r.idDisciplina = d.idDisciplina
            WHERE r.idCurso = ? AND r.mes = ? AND r.ano = ?
            ORDER BY r.ano DESC, r.mes DESC, r.semana DESC, FIELD(r.dia, 'segunda', 'terca', 'quarta', 'quinta', 'sexta')";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'isi', $idCurso, $mes, $ano);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $relatorios = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Função para agrupar relatórios por semana
    function agruparPorSemana($relatorios) {
        $semanas = [];
        foreach ($relatorios as $relatorio) {
            $semana = $relatorio['semana'];
            $dia = $relatorio['dia'];
            $descricao = $relatorio['descricao'];

            if (!isset($semanas[$semana])) {
                $semanas[$semana] = [
                    'segunda' => [],
                    'terca' => [],
                    'quarta' => [],
                    'quinta' => [],
                    'sexta' => []
                ];
            }

            $semanas[$semana][$dia][] = $relatorio['disciplina'] . ': ' . $descricao;
        }
        return $semanas;
    }

    // Função para exibir o relatório agrupado por semana e dias
    function exibirRelatoriosPorSemana($semanas) {
        foreach ($semanas as $semana => $dias) {
            echo "<h2>Semana $semana</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Dia da Semana</th><th>Descrição</th></tr>";

            // Loop pelos dias da semana
            foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta'] as $dia) {
                echo "<tr>";
                echo "<td>" . ucfirst($dia) . "</td>";
                echo "<td>";
                if (!empty($dias[$dia])) {
                    echo implode('<br>', $dias[$dia]); // Agrupa as descrições das disciplinas
                } else {
                    echo "Sem atividades";
                }
                echo "</td>";
                echo "</tr>";
            }

            echo "</table><br>";
        }
    }

    // Agrupa os relatórios por semana
    $semanas = agruparPorSemana($relatorios);
} else {
    echo "Curso não selecionado.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Semanal</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Adicionando Bootstrap -->
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Relatório Semanal do Curso</h1>

        <!-- Filtros -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="idCurso" value="<?= $idCurso ?>">

            <div class="row mb-3">
                <div class="col-sm-6">
                    <div class="form-floating">
                        <select name="mes" id="mes" class="form-select" required>
                            <option value="" disabled selected>Selecione o Mês</option>
                            <option value="Janeiro" <?= $mes == 'Janeiro' ? 'selected' : '' ?>>Janeiro</option>
                            <option value="Fevereiro" <?= $mes == 'Fevereiro' ? 'selected' : '' ?>>Fevereiro</option>
                            <option value="Março" <?= $mes == 'Março' ? 'selected' : '' ?>>Março</option>
                            <option value="Abril" <?= $mes == 'Abril' ? 'selected' : '' ?>>Abril</option>
                            <option value="Maio" <?= $mes == 'Maio' ? 'selected' : '' ?>>Maio</option>
                            <option value="Junho" <?= $mes == 'Junho' ? 'selected' : '' ?>>Junho</option>
                            <option value="Julho" <?= $mes == 'Julho' ? 'selected' : '' ?>>Julho</option>
                            <option value="Agosto" <?= $mes == 'Agosto' ? 'selected' : '' ?>>Agosto</option>
                            <option value="Setembro" <?= $mes == 'Setembro' ? 'selected' : '' ?>>Setembro</option>
                            <option value="Outubro" <?= $mes == 'Outubro' ? 'selected' : '' ?>>Outubro</option>
                            <option value="Novembro" <?= $mes == 'Novembro' ? 'selected' : '' ?>>Novembro</option>
                            <option value="Dezembro" <?= $mes == 'Dezembro' ? 'selected' : '' ?>>Dezembro</option>
                        </select>
                        <label for="mes">Mês:</label>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="number" name="ano" id="ano" class="form-control" value="<?= $ano ?>" min="2020" max="<?= date('Y') ?>" required>
                        <label for="ano">Ano:</label>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-danger" style="background-color: #DC143C;">Filtrar</button>
        </form>

        <!-- Exibe os relatórios agrupados por semana -->
        <?php
        if (!empty($semanas)) {
            exibirRelatoriosPorSemana($semanas);
        } else {
            echo "<p>Nenhum relatório encontrado para os filtros aplicados.</p>";
        }
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
// Fecha a conexão
mysqli_close($conn);
?>

<?php include("footer.php") ?>
