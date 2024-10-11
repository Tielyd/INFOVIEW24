<?php include "header.php"; ?>

<?php
    //Bloco para declaração de variáveis PHP
    $fotoUsuario = $nomeUsuario = $emailUsuario = $senhaUsuario = $confirmarSenhaUsuario = "";
    $erroPreenchimento = false;

    //Verifica o método de requisição do formulário
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        //Validação do campo nomeUsuario utilizando a função empty
        //Verifica se o campo do formulário está vazio e caso sim, exibe mensagem de alerta
        if(empty($_POST["nomeUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>NOME</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        //Se o campo não estiver vazio, ele filtra o dado e armazena na variável PHP
        else {
            $nomeUsuario = filtrar_entrada($_POST["nomeUsuario"]);
        }

        //Validação do campo emailUsuario utilizando a função empty
        if(empty($_POST["emailUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>EMAIL</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else {
            $emailUsuario = filtrar_entrada($_POST["emailUsuario"]);
        }

        //Validação do campo senhaUsuario utilizando a função empty
        if(empty($_POST["senhaUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>SENHA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else {
            $senhaUsuario = md5(filtrar_entrada($_POST["senhaUsuario"]));
        }

        //Validação do campo confirmarSenhaUsuario utilizando a função empty
        if(empty($_POST["confirmarSenhaUsuario"])){
            echo "<div class='alert alert-warning text-center'>O campo <strong>CONFIRMAR SENHA</strong> é obrigatório!</div>";
            $erroPreenchimento = true;
        }
        else {
            $confirmarSenhaUsuario = md5(filtrar_entrada($_POST["confirmarSenhaUsuario"]));
            if($senhaUsuario != $confirmarSenhaUsuario){
                echo "<div class='alert alert-warning text-center'>As <strong>SENHAS</strong> não coincidem!</div>";
                $erroPreenchimento = true;
            }
        }

        //Início do bloco de validação da FOTO
        $diretorio    = "img/"; //Define para qual diretório do sistema as imagens serão movidas
        $fotoUsuario  = $diretorio . basename($_FILES['fotoUsuario']['name']); // img/paulinho.jpg
        $erroUpload   = false; //Variável criada para verificar se houve erro no upload da foto
        $tipoDaImagem = strtolower(pathinfo($fotoUsuario, PATHINFO_EXTENSION)); //Pegar o tipo do arquivo

        //Verificar se o tamanho do arquivo é diferente de ZERO
        if($_FILES['fotoUsuario']['size'] != 0){
            
            //Verificar se o tamanho do arquivo da foto é maior do que 5MB
            if($_FILES['fotoUsuario']['size'] > 5000000){
                echo "<div class='alert alert-warning text-center'>A foto não pode ter <strong>TAMANHO</strong> maior do que 5MB!</div>";
                $erroUpload = true;
            }

            //Verificar o tipo do arquivo (pela extensão)
            if($tipoDaImagem != "jpg" && $tipoDaImagem != "jpeg" && $tipoDaImagem != "png" && $tipoDaImagem != "webp"){
                echo "<div class='alert alert-warning text-center'>A foto precisa estar nos formatos <strong>JPG, JPEG, PNG ou WEBP</strong>!</div>";
                $erroUpload = true;
            }

            //Verificar se o arquivo conseguiu ser movido para o diretório IMG
            if(!move_uploaded_file($_FILES['fotoUsuario']['tmp_name'], $fotoUsuario)){
                echo "<div class='alert alert-danger text-center'>Erro ao tentar <strong>MOVER A FOTO</strong> para o diretório de imagens!</div>";
                $erroUpload = true;
            }

        }
        else{
            echo "<div class='alert alert-warning text-center'>A <strong>foto</strong> é obrigatória!</div>";
            $erroUpload = true;
        }

        //Se não houverem erros de preenchimento, exibe os dados cadastrados!
        if(!$erroPreenchimento && !$erroUpload){

            //Armazena a QUERY na variável $inserirUsuario
            $inserirUsuario = "INSERT INTO Usuarios (fotoUsuario, nomeUsuario, emailUsuario, senhaUsuario) VALUES ('$fotoUsuario', '$nomeUsuario','$emailUsuario', '$senhaUsuario')";

            //Inclui o arquivo de conexao com o banco de dados
            include "conexaoBD.php";

            //Utiliza a função msyqli_query() para executar a QUERY
            //Se a função conseguir executar a query, exibe mensagem e monta a tabela com os dados cadastrados
            if(mysqli_query($conn, $inserirUsuario)){
                echo "
                    <div class='alert alert-success text-center'><strong>Usuário</strong> cadastrado com sucesso!</div>
                    <div class='container mt-3'>
                        <div class='container mt-3 text-center'>
                            <img src='$fotoUsuario' width='150' title='Foto de $nomeUsuario'>
                        </div>
                        <div class='table-responsive'>
                            <table class='table'>
                                <tr>
                                    <th>NOME</th>
                                    <td>$nomeUsuario</td>
                                </tr>
                                <tr>
                                    <th>EMAIL</th>
                                    <td>$emailUsuario</td>
                                </tr>
                                <tr>
                                    <th>SENHA</th>
                                    <td>$senhaUsuario</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                ";
            }
            else{
                echo "<div class='alert alert-danger text-center'>Erro ao tentar cadastrar <strong>Usuário</strong></div>" . mysqli_error($conn);
            }
            
        }

    }

    //Função para filtrar dados do formulário e evitar SQL Injection
    function filtrar_entrada($dado){
        $dado = trim($dado); //Remove espaços desnecessários
        $dado = stripslashes($dado); //Remove as barras invertidas
        $dado = htmlspecialchars($dado); //Converte caracteres especiais em entidades HTML

        return($dado);
    }

?>

<?php include "footer.php"; ?>