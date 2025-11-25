<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['deleteid'];
$sql = 'select * from ip_fornecedor where id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$telefone = $row['telefone'];
$observacao = $row['observacao'];
$naoexcluir = '1';
$verificasql = "SELECT * FROM ip_saida WHERE idfornecedor = $id";
$verificaresultado = mysqli_query($con, $verificasql);
$verificalinha = mysqli_fetch_assoc($verificaresultado);
if (isset($_POST['submit'])) {
    if ($verificalinha == 0) {
        $sql = 'delete from ip_fornecedor where id =' . $id;
        // executar o sql
        $result = mysqli_query($con, $sql);
        // voltar para o menu
        if ($result) {
            header('location: forselect.php');
        } else {
            die(mysqli_error($con));
        }
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
    <title>Excluir Pessoa</title>
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
        <h1>Excluir Fornecedor</h1><hr>
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
                        <?php
                        echo
                            "<a href='forselect.php?selectid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                        class='btn btn-dark'>Não, Voltar</button></a>";
                        ?>
                        <button type="submit" <?php if ($verificalinha > 0) {
                            echo 'id="excluir"';
                        } ?> name="submit"
                            style="padding: 9px; width: 130px;" class="btn btn-secondary">Sim, Excluir</button>
                    </div>
                </div>
            </div>


        </form>
    </div>
    <script src="fordeletever.js"></script>
</body>

</html>