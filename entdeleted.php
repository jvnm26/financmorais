<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['deleteid'];
$sql = 'SELECT e.id, p.nome, replace(e.valor, ".", ",") valor, e.dataentrada, e.datadocumento, e.documento, e.idpessoa FROM ip_entrada e INNER JOIN ip_pessoa p ON p.id = e.idpessoa where e.id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$valor = $row['valor'];
$documento = $row['documento'];
$dataentrada = $row['dataentrada'];
$datadocumento = $row['datadocumento'];
if (isset($_POST['submit'])) {
    $sql = 'delete from ip_entrada where id =' . $id;
    // executar o sql
    $result = mysqli_query($con, $sql);
    // voltar para o menu
    if ($result) {
        header('location: entselect.php');
    } else {
        die(mysqli_error($con));
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
    <title>Excluír Entrada</title>
</head>

<body
    style="background-image: url('imagens/backin.webp'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
    <div class="row" style="background-color: black; margin-bottom: 30px; color: white;">
        <div class="col" style="padding: 10px; left: 20px;">
            <h2>Usuário:
                <?php echo $_SESSION['nome']; ?>
            </h2>
        </div>
        <div class="col text-right" style="padding: 19px; right: 20px;">
            <a href="logout.php"><button type="button" class="btn btn-danger"
                    style="border-radius: 20px;">SAIR</button></a>
        </div>
    </div>
    <div class="container" style="margin-top: 30px; background-color: white;">
        <h1>Excluír Entrada</h1>
        <hr>
        <form action="" method="post" style="margin-top: 20px;">
            <div class="form-group">
                <h4>Dados Entrada:</h4>
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <input type="text" class="form-control" style="width: 400px; padding: 9px;" readonly
                            value="<?php echo $nome ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col">
                        <label for="">Valor:</label>
                        <input type="text" class="form-control" style="width: 400px; padding: 9px;" readonly value="<?php echo "R$" . $valor ?>">
                    </div>
                    <div class="col">
                        <label for="">Documento:</label>
                        <input type="text" class="form-control" style="width: 400px; padding: 9px;" readonly value="<?php echo $documento ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Data Documento:</label>
                        <input type="date" class="form-control"
                            style="width: 200px; padding: 9px;" readonly value="<?php echo $datadocumento ?>">
                    </div>
                    <div class="col">
                        <label for="">Data Entrada:</label>
                        <input type="date" class="form-control" style="width: 200px; padding: 9px;" readonly value="<?php echo $dataentrada ?>">
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <?php
                        echo
                            "<a href='entselect.php?selectid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                        class='btn btn-dark'>Não, Voltar</button></a>";
                        ?>
                        <button type="submit" name="submit" style="padding: 9px; width: 130px;"
                            class="btn btn-secondary">Sim, Excluir</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>