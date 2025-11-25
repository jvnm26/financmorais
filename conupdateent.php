<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['updateid'];
$sql = 'SELECT e.id, p.nome, e.valor, e.dataentrada, e.datadocumento, e.documento, e.idpessoa FROM ip_entrada e INNER JOIN ip_pessoa p ON p.id = e.idpessoa where e.id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$valor = $row['valor'];
$documento = $row['documento'];
$dataentrada = $row['dataentrada'];
$datadocumento = $row['datadocumento'];
$idpessoa = $row['idpessoa'];

if (isset($_POST['submit'])) {
    $idpessoa = $_POST['idpessoa'];
    $valor = $_POST['valor'];
    $dataentrada = $_POST['dataentrada'];
    $datadocumento = $_POST['datadocumento'];
    $documento = $_POST['documento'];
    $sql = 'update ip_entrada set idpessoa="' . $idpessoa . '", valor="' . $valor . '", dataentrada="' . $dataentrada . '", datadocumento="' . $datadocumento . '", documento="' . $documento . '" where id=' . $id;
    // executar o sql
    $result = mysqli_query($con, $sql);
    // voltar para o menu
    if ($result) {
        header("location: conselectedent.php?selectid={$row['id']}");
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
    <title>Alterar Entrada</title>
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
        <h1>Alterar Entrada</h1>
        <hr>
        <form action="" method="post" style="margin-top: 20px;">
            <div class="form-group">
                <h4>Dados Entrada:</h4>
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <?php
                $sql = 'select * from ip_pessoa order by nome';
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo '<select class="form-control" name="idpessoa" style="width:400px;">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['id'] == $idpessoa   ) {
                            echo '<option value="' . $row['id'] . '" selected>' . $row['nome'] . '</option>';
                        } else {
                            echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
                        }
                    }
                    echo '</select>';
                }
                ?>
                    </div>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col">
                        <label for="">Valor:</label>
                        <input type="number" step=".01" name="valor" class="form-control" style="width: 400px; padding: 9px;" value="<?php echo $valor ?>">
                    </div>
                    <div class="col">
                        <label for="">Documento:</label>
                        <input type="text" name="documento" class="form-control" style="width: 400px; padding: 9px;" value="<?php echo $documento ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Data Documento:</label>
                        <input type="date" name="datadocumento" class="form-control"
                            style="width: 200px; padding: 9px;" value="<?php echo $datadocumento ?>">
                    </div>
                    <div class="col">
                        <label for="">Data Entrada:</label>
                        <input type="date" name="dataentrada" class="form-control" style="width: 200px; padding: 9px;" value="<?php echo $dataentrada ?>">
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <?php
                        echo
                            "<a href='conselectedent.php?selectid={$id}' style='color:white;'>
                            <button type='button' style='padding: 9px; width: 100px;'
                            class='btn btn-dark'>Não, Voltar</button></a>";
                        ?>
                        <button type="submit" name="submit" style="padding: 9px; width: 130px;"
                            class="btn btn-secondary">Atualizar Dados</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>