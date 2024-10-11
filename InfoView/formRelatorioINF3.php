<?php include("header.php") ?>
<?php 
// Conexão com o banco de dados
include("conexaoBD.php");

// Função para carregar os cursos do banco de dados
function carregarCursos($conn) {
    $query = "SELECT * FROM curso";
    $result = mysqli_query($conn, $query);
    $cursos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $cursos[] = $row;
    }
    return $cursos;
}

$cursos = carregarCursos($conn);
?>

<div class="container-fluid text-center">
    <h2>Cadastro de Relatório Semanal:</h2>
    <div class="d-flex justify-content-center mb-3">
        <form action="actionRelatorio.php" class="was-validated" method="POST" enctype="multipart/form-data">
            <!-- Início da Linha da GRID -->
            <div class="row">
                <!-- Campos de Curso e Ano lado a lado -->
                <div class="col-sm-6">
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="curso" name="curso" required onchange="carregarDisciplinas(this.value)">
                            <option value="" disabled selected>Selecione o Curso</option>
                            <?php foreach ($cursos as $curso) { ?>
                                <option value="<?= $curso['idCurso'] ?>"><?= $curso['nomeCurso'] ?></option>
                            <?php } ?>
                        </select>
                        <label for="curso" class="form-label">Curso:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="anoCurso" name="anoCurso" required>
                            <option value="" disabled selected>Selecione o Ano</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <label for="anoCurso" class="form-label">Ano do Curso:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <!-- Fim da linha de Curso e Ano -->

            <!-- Início da linha de Semana e Mês -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="semana" name="semana" required>
                            <option value="" disabled selected>Selecione a Semana</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <label for="semana" class="form-label">Semana:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="mes" name="mes" required>
                            <option value="" disabled selected>Selecione o Mês</option>
                            <option value="Janeiro">Janeiro</option>
                            <option value="Fevereiro">Fevereiro</option>
                            <option value="Março">Março</option>
                            <option value="Abril">Abril</option>
                            <option value="Maio">Maio</option>
                            <option value="Junho">Junho</option>
                            <option value="Julho">Julho</option>
                            <option value="Agosto">Agosto</option>
                            <option value="Setembro">Setembro</option>
                            <option value="Outubro">Outubro</option>
                            <option value="Novembro">Novembro</option>
                            <option value="Dezembro">Dezembro</option>
                        </select>
                        <label for="mes" class="form-label">Mês:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <!-- Fim da linha de Semana e Mês -->

            <div class="row">
            <div class="col-sm-6">
                    <div class="form-floating">
                        <input type="number" name="ano" id="ano" class="form-control" value="<?= $ano ?>" min="2020" max="<?= date('Y') ?>" required>
                        <label for="ano">Ano:</label>
                    </div>
                </div>
            </div>


            <!-- Início da linha de Dia e Disciplinas -->
            <div class="row">
                <div class="col-sm-16">
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="dia" name="dia" required>
                            <option value="" disabled selected>Selecione o Dia</option>
                            <option value="segunda">Segunda-Feira</option>
                            <option value="terca">Terça-Feira</option>
                            <option value="quarta">Quarta-Feira</option>
                            <option value="quinta">Quinta-Feira</option>
                            <option value="sexta">Sexta-Feira</option>
                        </select>
                        <label for="dia" class="form-label">Dia da Semana:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="disciplina" name="disciplina" required>
                            <option value="" disabled selected>Selecione a Disciplina</option>
                            <!-- Disciplinas serão carregadas via AJAX -->
                        </select>
                        <label for="disciplina" class="form-label">Disciplina:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <!-- Fim da linha de Disciplinas -->

        



            <!-- Campo de Descrição -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-3 mt-3">
                        <textarea class="form-control" id="descricao" name="descricao" rows="4" maxlength="500" required></textarea>
                        <label for="descricao" class="form-label">Descrição do Relatório (máx. 500 caracteres):</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-danger" style="background-color: #DC143C;">Cadastrar</button>
        </form>
    </div>
</div>

<!-- Script para carregar disciplinas com base no curso selecionado -->
<script>
function carregarDisciplinas(idCurso) {
    const disciplinaSelect = document.getElementById("disciplina");
    disciplinaSelect.innerHTML = '<option value="" disabled selected>Carregando Disciplinas...</option>';

    fetch('carregar_disciplinas.php?idCurso=' + idCurso)
        .then(response => response.json())
        .then(disciplinas => {
            disciplinaSelect.innerHTML = '';
            disciplinas.forEach(disciplina => {
                let option = document.createElement('option');
                option.value = disciplina.idDisciplina;
                option.textContent = disciplina.nomeDisciplina;
                disciplinaSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Erro ao carregar disciplinas:', error);
        });
}
</script>

<?php include("footer.php") ?>
