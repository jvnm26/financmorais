<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['updateid'];
$sql = "select nome from empresa where id =" . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$empresa = $row['nome'];

if (isset($_POST['submit'])) {
    $empresa = $_POST['empresa'];
    $sql = 'update empresa set nome="' . $empresa . '" where id=' . $id;
    // executar o sql
    $result = mysqli_query($con, $sql);
    // voltar para o menu
    if ($result) {
        header("location: empselect.php?selectid={$row['id']}");
    } else {
        die(mysqli_error($con));
    }
}
if ($_SESSION['master'] == "n") {
    session_destroy();
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
    <title>Alterar Empresa</title>
</head>

<body
    style="background-image: url('imagens/backal.webp'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
    <div class="row" style="background-color: black; margin-bottom: 30px; color: white;">
        <div class="col" style="padding: 10px; left: 20px;">
            <h2>Empresa:
                <?php echo $_SESSION['nome']; ?>
            </h2>
        </div>
        <div class="col text-right" style="padding: 19px; right: 20px;">
            <a href="logout.php"><button type="button" class="btn btn-danger"
                    style="border-radius: 20px;">SAIR</button></a>
        </div>
    </div>
    <div class="container" style="margin-top: 30px; background-color: white;">
        <h1>Alterar Empresa</h1>
        <hr>
        <form action="" method="post" style="margin-top: 20px;">
            <h4>Dados do Empresa:</h4>
            <div class="form-group">
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Novo nome da Empresa:</label>
                        <input type="text" name="empresa" class="form-control" style="width: 400px; padding: 9px;"
                            value="<?php echo $empresa ?>">
                    </div>

                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <?php
                        echo
                            "<a href='empselect.php?selectid={$row['id']}' style='color:white;'>
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