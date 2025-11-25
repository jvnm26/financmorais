<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['updateid'];
$sql = 'SELECT s.id, f.nome, s.valorpagar, s.datapagar, s.observacao, s.valorpago, s.datapago, s.idfornecedor FROM ip_fornecedor f INNER JOIN ip_saida s ON f.id = s.idfornecedor where s.id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$valorpagar = $row['valorpagar'];
$datapagar = $row['datapagar'];
$observacao = $row['observacao'];
$valorpago = $row['valorpago'];
$datapago = $row['datapago'];
$idfornecedor = $row['idfornecedor'];

if (isset($_POST['submit'])) {
    $idfornecedor = $_POST['idfornecedor'];
    $valorpagar = $_POST['valorpagar'];
    $datapagar = $_POST['datapagar'];
    $observacao = $_POST['observacao'];
    $valorpago = $_POST['valorpago'];
    $datapago = $_POST['datapago'];
    $sql = 'update ip_saida set idfornecedor="' . $idfornecedor . '", valorpagar="' . $valorpagar . '", datapagar="' . $datapagar . '", observacao="' . $observacao . '", valorpago="' . $valorpago . '", datapago="' . $datapago . '"where id=' . $id;
    // executar o sql
    $result = mysqli_query($con, $sql);
    // voltar para o menu
    if ($result) {
        header("location: saiselected.php?selectid={$row['id']}");
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
    <title>Alterar Saída</title>
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
        <h1>Alterar Saída</h1>
        <hr>
        <form action="" method="post" style="margin-top: 20px;">
            <div class="form-group">
                <h4>Dados Saída:</h4>
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <?php
                $sql = 'select * from ip_fornecedor order by nome';
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo '<select class="form-control" name="idfornecedor" style="width:400px;">';
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['id'] == $idfornecedor   ) {
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
                        <label for="">Valor Pagar:</label>
                        <input type="number" step=".01" name="valorpagar" class="form-control" style="width: 200px; padding: 9px;" value="<?php echo $valorpagar ?>">
                    </div>
                    <div class="col">
                        <label for="">Data Pagar:</label>
                        <input type="date" name="datapagar" class="form-control" style="width: 200px; padding: 9px;" value="<?php echo $datapagar ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Valor Pago:</label>
                        <input type="number" step=".01" name="valorpago" class="form-control"
                            style="width: 200px; padding: 9px;" value="<?php echo $valorpago ?>">
                    </div>
                    <div class="col">
                        <label for="">Data Pago:</label>
                        <input type="date" name="datapago" class="form-control" style="width: 200px; padding: 9px;" value="<?php echo $datapago ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col">
                        <label for="">Observação:</label>
                        <textarea type="text" name="observacao" class="form-control" cols="30" rows="6"
                            style="width: 600px;"><?php echo $observacao ?></textarea>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <?php
                        echo
                            "<a href='saiselected.php?selectid={$id}' style='color:white;'>
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