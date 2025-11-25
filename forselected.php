<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['selectid'];
$sql = 'select * from ip_fornecedor where id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$telefone = $row['telefone'];
$observacao = $row['observacao'];
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
        <h1>Fornecedor</h1>
        <hr>
        <form action="" method="post" style="margin-top: 20px;">
            <h4>Dados Fornecedor:</h4>
            <div class="form-group">
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <input type="text" name="nome" class="form-control" style="width: 400px; padding: 9px;" readonly
                            value="<?php echo $nome ?>">
                    </div>
                    <div class="col">
                        <label for="">Telefone:</label>
                        <input type="number" name="telefone" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $telefone ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 50px;">
                    <div class="col">
                        <label for="">Observação:</label>
                        <textarea type="text" name="observacao" class="form-control" cols="30" rows="6"
                            style="width: 600px;" readonly><?php echo $observacao ?></textarea>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <a href="forselect.php">
                            <button type="button" style="padding: 9px; width: 100px;"
                                class="btn btn-dark">Voltar</button></a>
                        <?php
                        echo "<a href='forupdate.php?updateid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                                class='btn btn-secondary'>Alterar</button></a>
                        <a href='fordelete.php?deleteid={$row['id']}' style='color:white;'>
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