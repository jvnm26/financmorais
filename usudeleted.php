<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['deleteid'];
$sql = 'select * from usuario where id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$email = $row['email'];
$master = $row['master'];
if (isset($_POST['submit']) and $id > 1) {
    $sql = 'delete from usuario where id =' . $id;
    // executar o sql
    $result = mysqli_query($con, $sql);
    // voltar para o menu
    if ($result) {
        header('location: ususelect.php');
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
    <title>Excluir Usuário</title>
</head>

<body
    style="background-image: url('imagens/backex.webp'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
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
        <h1>Excluir Usuário</h1><hr>
        <form action="" method="post" style="margin-top: 20px;">
            <h4>Dados do Usuário:</h4>
            <div class="form-group">
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <input type="text" name="nome" class="form-control" style="width: 400px; padding: 9px;" readonly
                            value="<?php echo $nome ?>">
                    </div>
                    <div class="col">
                        <label for="">Administrador:</label>
                        <input type="text" name="master" class="form-control" style="width: 80px; padding: 9px;"
                            readonly value="<?php echo $master ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Endereço de E-mail:</label>
                        <input type="email" name="email" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $email ?>">
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <?php
                        echo
                            "<a href='ususelect.php?selectid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                        class='btn btn-dark'>Não, Voltar</button></a>";
                        ?>
                        <button type="submit" name="submit" style="padding: 9px; width: 130px;" <?php if($id == 1) {echo 'id="excluir"';} ?>
                            class="btn btn-secondary">Sim, Excluir</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <script src="usudeletever.js"></script>
</body>

</html>