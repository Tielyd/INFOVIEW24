<?php include("header.php"); ?>

<div class="container text-center mt-3 mb-5">

    <!-- Formulário para aplicar filtros aos produtos -->
    <form name="formFiltro" action="sobre.php" method="GET" style="width:50%; margin:auto;">
        <!-- Aqui você pode adicionar filtros, se necessário -->
    </form>

    <!-- Início da primeira linha da GRID -->
    <div class="row mt-5">
        <?php
        // Conexão com o banco de dados
        include("conexaoBD.php");

        // Função para carregar os cursos do banco de dados
        function carregarCursos($conn) {
            $query = "SELECT * FROM curso"; // Ajuste a tabela conforme seu banco de dados
            $result = mysqli_query($conn, $query);
            $cursos = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $cursos[] = $row;
            }
            return $cursos;
        }

        // Carrega os cursos
        $cursos = carregarCursos($conn);

        // Exibe os cursos em cards
        foreach ($cursos as $curso) {
        ?>
        <div class="col-sm-3">
            <div class="card" style="width:100%; height:100%;">
                <img src="<?= htmlspecialchars($curso['urlCurso']) ?>" class="card-img-top" alt="<?= htmlspecialchars($curso['nomeCurso']) ?>" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h4 class="card-title"><?= htmlspecialchars($curso['nomeCurso']) ?></h4>
                    <a href="ver_relatorios.php?idCurso=<?= $curso['idCurso'] ?>" class="btn btn-danger" style="background-color:#DC143C;">Ver Relatórios</a>
                </div>
            </div>
        </div>

        <?php
        }
        ?>
    </div>
</div>

<?php include("footer.php"); ?>
