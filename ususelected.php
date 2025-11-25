<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['selectid'];
$sql = "select id, nome, email, replace(replace(master, 's', 'SIM'), 'n', 'NÃO') master from usuario where id =" . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$email = $row['email'];
$master = $row['master'];
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
    <title>
        <?php echo $nome; ?>
    </title>
</head>

<body
    style="background-image: url('imagens/backsel.webp'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
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
        <h1>Cadastro</h1>
        <hr>
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
            <div class="conteiner" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <a href="ususelect.php">
                            <button type="button" style="padding: 9px; width: 100px;"
                                class="btn btn-dark">Voltar</button></a>
                        <?php
                        echo "<a href='usuupdate.php?updateid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                                class='btn btn-secondary'>Alterar</button></a>
                        <a href='usudelete.php?deleteid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                                class='btn btn-secondary'>Excluir</button></a>";
                        ?>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</body>

</html>