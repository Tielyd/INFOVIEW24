<?php include("header.php") ?>
<?php
include("conexaoBD.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cursoId = $_POST['curso'];
    $nomeDisciplina = $_POST['nomeDisciplina'];

    // Inserir a disciplina no banco de dados associada ao curso
    $sql = "INSERT INTO disciplina (nomeDisciplina, idCurso) VALUES ('$nomeDisciplina', '$cursoId')";
    if ($conn->query($sql) === TRUE) {
        echo '<div style="padding: 15px; border: 2px solid #4CAF50; background-color: #dff0d8; color: #3c763d; border-radius: 5px; font-size: 24px; font-weight: bold; text-align: center; margin: 20px auto; width: 80%; max-width: 600px;">
                Disciplina cadastrada com sucesso!
              </div>';
    } else {
        echo '<div style="padding: 15px; border: 2px solid #dc3545; background-color: #f2dede; color: #a94442; border-radius: 5px; font-size: 24px; font-weight: bold; text-align: center; margin: 20px auto; width: 80%; max-width: 600px;">
                Erro ao cadastrar a disciplina: ' . $conn->error . '
              </div>';
    }
    
    $conn->close();
}
?>
<?php include("footer.php") ?>