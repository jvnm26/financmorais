<?php
session_start();
include('verifica_login.php');
include('connect.php');
$id = $_GET['selectid'];
$sql = 'select * from ip_pessoa where id =' . $id;
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$nome = $row['nome'];
$tipo = $row['tipo'];
$cep = $row['cep'];
$logradouro = $row['logradouro'];
$numero = $row['numero'];
$bairro = $row['bairro'];
$cidade = $row['cidade'];
$uf = $row['uf'];
$email = $row['email'];
$telefone = $row['telefone'];
$complemento = $row['complemento'];
$datanascimento = $row['datanascimento'];
$databatizado = $row['databatizado'];
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
            <h4>Dados Pessoais:</h4>
            <div class="form-group">
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <input type="text" name="nome" class="form-control" style="width: 400px; padding: 9px;" readonly
                            value="<?php echo $nome ?>">
                    </div>
                    <div class="col">
                        <label for="">Tipo de pessoa:</label>
                        <input type="number" name="tipo" class="form-control" style="width: 80px; padding: 9px;"
                            readonly value="<?php echo $tipo ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Telefone/Contato:</label>
                        <input type="text" name="telefone" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $telefone ?>">
                    </div>
                    <div class="col">
                        <label for="">Endereço de E-mail:</label>
                        <input type="email" name="email" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $email ?>">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 50px;">
                    <div class="col">
                        <label for="">Data de Nascimento:</label>
                        <input type="date" name="datanascimento" class="form-control"
                            style="width: 200px; padding: 9px;" readonly value="<?php echo $datanascimento ?>">
                    </div>
                    <div class="col">
                        <label for="">Data de Batismo:</label>
                        <input type="date" name="databatizado" class="form-control" style="width: 200px; padding: 9px;"
                            readonly value="<?php echo $databatizado ?>">
                    </div>
                </div>
                <hr>
                <h4>Endereço:</h4>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-4">
                        <label for="">CEP:</label>
                        <input type="number" name="cep" class="form-control" style="width: 300px; padding: 9px;"
                            readonly value="<?php echo $cep ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 40px;">
                    <div class="col">
                        <label for="">Cidade:</label>
                        <input type="text" name="cidade" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $cidade ?>">
                    </div>
                    <div class="col">
                        <label for="">UF:</label>
                        <input type="text" name="uf" class="form-control" style="width: 80px; padding: 9px;" readonly
                            value="<?php echo $uf ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Bairro:</label>
                        <input type="text" name="bairro" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $bairro ?>">
                    </div>
                    <div class="col">
                        <label for="">Número:</label>
                        <input type="text" name="numero" class="form-control" style="width: 80px; padding: 9px;"
                            readonly value="<?php echo $numero ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Logradouro:</label>
                        <input type="text" name="logradouro" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $logradouro ?>">
                    </div>
                    <div class="col">
                        <label for="">Complemento:</label>
                        <input type="text" name="complemento" class="form-control" style="width: 400px; padding: 9px;"
                            readonly value="<?php echo $complemento ?>">
                    </div>
                </div>
            </div>
            <div class="conteiner" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <a href="pesselect.php">
                            <button type="button" style="padding: 9px; width: 100px;"
                                class="btn btn-dark">Voltar</button></a>
                        <?php
                        echo "<a href='pesupdate.php?updateid={$row['id']}' style='color:white;'>
                        <button type='button' style='padding: 9px; width: 100px;'
                                class='btn btn-secondary'>Alterar</button></a>
                        <a href='pesdelete.php?deleteid={$row['id']}' style='color:white;'>
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