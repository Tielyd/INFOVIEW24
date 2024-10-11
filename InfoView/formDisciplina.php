<?php include("header.php") ?>

<div class="container-fluid text-center">
    <h2>Cadastro de Disciplina:</h2>
    <div class="d-flex justify-content-center mb-3">
        <div class="row">
            <div class="col-sm-12">
                <form action="actionDisciplina.php" class="was-validated" method="POST" enctype="multipart/form-data">
                    <!-- Seleção de Curso -->
                    <div class="form-floating mb-3 mt-3">
                        <select class="form-select" id="curso" name="curso" required>
                            <option value="" disabled selected>Selecione o Curso</option>
                            <?php
                            include("conexaoBD.php");
                            $sql = "SELECT idCurso, nomeCurso FROM curso";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['idCurso'] . "'>" . $row['nomeCurso'] . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>Nenhum curso disponível</option>";
                            }
                            $conn->close();
                            ?>
                        </select>
                        <label for="curso" class="form-label">Curso:</label>
                    </div>

                    <!-- Nome da Disciplina -->
                    <div class="form-floating mb-3 mt-3">
                        <input type="text" class="form-control" id="nomeDisciplina" placeholder="Informe o nome da disciplina" name="nomeDisciplina" required>
                        <label for="nomeDisciplina" class="form-label">Nome da Disciplina:</label>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-danger" style="background-color: #DC143C;">Cadastrar Disciplina</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php") ?>
