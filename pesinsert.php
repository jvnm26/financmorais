<?php
session_start();
include('verifica_login.php');
include('connect.php');
$cep = "";
$logradouro = "";
$bairro = "";
$cidade = "";
$uf = "";
$nome = "";
$tipo = "";
$numero = "";
$email = "";
$telefone = "";
$complemento = "";
$datanascimento = "";
$databatizado = "";
$cepcorreto = "";
if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $complemento = $_POST['complemento'];
    $datanascimento = $_POST['datanascimento'];
    $databatizado = $_POST['databatizado'];
    $sql = 'insert into ip_pessoa (nome, tipo, cep, logradouro, numero, bairro, cidade, uf, email, telefone, complemento, datanascimento, databatizado) values ("' . $nome . '","' . $tipo . '","' . $cep . '","' . $logradouro . '","' . $numero . '","' . $bairro . '","' . $cidade . '","' . $uf . '","' . $email . '","' . $telefone . '","' . $complemento . '","' . $datanascimento . '","' . $databatizado . '")';
    echo $sql;
    // executar o sql
    $result = mysqli_query($con, $sql);
    // voltar para o menu
    if ($result) {
        header('location: pesselect.php');
    } else {
        die(mysqli_error($con));
    }
}
if (isset($_POST['pegacep'])) {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['uf'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $complemento = $_POST['complemento'];
    $datanascimento = $_POST['datanascimento'];
    $databatizado = $_POST['databatizado'];
    if ($_POST['cep'] >= 10000000 and $_POST['cep'] <= 99999999) {
        $url = "https://viacep.com.br/ws/{$cep}/json/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        if ($response === false) {
            echo "Erro na requisição: " . curl_error($ch);
        } else {
            $data = json_decode($response, true);

            if (isset($data['erro'])) {
                $cepcorreto = 1;
            } else {
                $logradouro = $data['logradouro'];
                $bairro = $data['bairro'];
                $cidade = $data['localidade'];
                $uf = $data['uf'];
            }
        }
        curl_close($ch);
    } else {
        $cepcorreto = 2;
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
    <title>Incluir Pessoa</title>
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
        <h1>Incluir Pessoa</h1>
        <hr>
        <form action="" method="post" style="margin-top: 20px;">
            <h4>Dados Pessoais:</h4>
            <div class="form-group">
                <div class="row" style="margin-top: 30px;">
                    <div class="col">
                        <label for="">Nome:</label>
                        <input type="text" name="nome" class="form-control" style="width: 400px; padding: 9px;" value="<?php echo $nome?>">
                    </div>
                    <div class="col">
                        <label for="">Tipo de pessoa:</label>
                        <input type="number" name="tipo" class="form-control" style="width: 80px; padding: 9px;" value="<?php echo $tipo?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Telefone/Contato:</label>
                        <input type="text" name="telefone" class="form-control" style="width: 400px; padding: 9px;" value="<?php echo $telefone ?>">
                    </div>
                    <div class="col">
                        <label for="">Endereço de E-mail:</label>
                        <input type="email" name="email" class="form-control" style="width: 400px; padding: 9px;" value="<?php echo $email?>">
                    </div>
                </div>
                <div class="row" style="margin-bottom: 50px;">
                    <div class="col">
                        <label for="">Data de Nascimento:</label>
                        <input type="date" name="datanascimento" class="form-control"
                            style="width: 200px; padding: 9px;" value="<?php echo $datanascimento?>">
                    </div>
                    <div class="col">
                        <label for="">Data de Batismo:</label>
                        <input type="date" name="databatizado" class="form-control" style="width: 200px; padding: 9px;" value="<?php echo $databatizado?>">
                    </div>
                </div>
                <hr>
                <h4>Endereço:</h4>
                <div class="row" style="margin-top: 30px;">
                    <div class="col-3">
                        <label for="">CEP:</label>
                        <input type="text" class="form-control" style="width: 300px; padding: 9px;" name="cep"
                            value="<?php if (isset($_POST['pegacep'])) {
                                echo $cep;
                            } ?>"
                            style="width: 300px; background-color:lightskyblue;font-family: 'Courier New', Courier, monospace;"
                            \>
                    </div>
                    <div class="col text-left" style="margin-top: 29px; left: 20px;">
                        <button type="submit" style="padding: 9px; width: 100px;" class="btn btn-secondary"
                            name="pegacep">CONSULTAR</button>
                    </div>
                </div>
                <?php if ($cepcorreto == 1) {
                    echo '<p style="color: red;"> CEP não encontrado </p>';
                } else {
                    if ($cepcorreto == 2) {
                        echo '<p style="color: red;"> CEP inválido </p>';
                    }
                } ?>
                <div class="row" style="margin-top: 40px;">
                    <div class="col">
                        <label for="">Cidade:</label>
                        <input type="text" name="cidade" class="form-control" style="width: 400px; padding: 9px;"
                            value="<?php echo $cidade; ?>">
                    </div>
                    <div class="col">
                        <label for="">UF:</label>
                        <input type="text" name="uf" class="form-control" style="width: 80px; padding: 9px;"
                            value="<?php echo $uf; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Bairro:</label>
                        <input type="text" name="bairro" class="form-control" style="width: 400px; padding: 9px;"
                            value="<?php echo $bairro; ?>">
                    </div>
                    <div class="col">
                        <label for="">Número:</label>
                        <input type="text" name="numero" class="form-control" style="width: 80px; padding: 9px;" value="<?php echo $numero?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Logradouro:</label>
                        <input type="text" name="logradouro" class="form-control" style="width: 400px; padding: 9px;"
                            value="<?php echo $logradouro; ?>">
                    </div>
                    <div class="col">
                        <label for="">Complemento:</label>
                        <input type="text" name="complemento" class="form-control" style="width: 400px; padding: 9px;" value="<?php echo $complemento?>">
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 40px;">
                <div class="row">
                    <div class="col" style="margin-bottom: 30px;">
                        <a href="pesselect.php">
                            <button type="button" style="padding: 9px; width: 100px;"
                                class="btn btn-dark">Voltar</button></a>
                        <button type="submit" name="submit" style="padding: 9px; width: 100px;"
                            class="btn btn-secondary">Adicionar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>