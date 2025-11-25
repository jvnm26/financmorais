<?php
session_start();
include('verifica_login.php');
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
    <title>Financeiro</title>
</head>

<body
    style="background-image: url('imagens/background.jpg'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
    <div class="row" style="background-color: black; margin-bottom: 30px; color: white;">
        <div class="col" style="padding: 10px; left: 20px;">
            <h2>Bem vindo
                <?php echo $_SESSION['nome']; ?>
            </h2>
        </div>
        <div class="col text-right" style="padding: 19px; right: 20px;">
            <a href="logout.php"><button type="button" class="btn btn-danger" style="border-radius: 20px;">SAIR</button></a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>FINANCEIRO</h1>
            </div>
        </div>
    </div>
    <div class="container" style="background-color: white; margin-top: 150px;">
        <div class="row">
            <div class="col" style="margin-top: 15px;">
                <h3>Entradas</h3>
                <hr>
            </div>
            <div class="col" style="margin-top: 15px;">
                <h3>Saídas</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="pesselect.php"><button type="button" style="width: 200px; padding: 15px;"
                            class="btn btn-dark"><h5>PESSOAS</h5></button></a><br>
                <a href="entselect.php"><button type="button" style="width: 200px; padding: 15px; margin-top: 5px;"
                            class="btn btn-dark"><h5>ENTRADAS</h5></button></a>
            </div>
            <div class="col">
                <a href="forselect.php"><button type="button" style="width: 200px; padding: 15px;"
                            class="btn btn-dark"><h5>FORNECEDORES</h5></button></a><br>
                <a href="saiselect.php"><button type="button" style="width: 200px; padding: 15px; margin-top: 5px;"
                            class="btn btn-dark"><h5>SAÍDAS</h5></button></a>
            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col">
                <h3>Consultas</h3>
                <hr>
            </div>
            <div class="col">
                <h3>Usuários</h3>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col" style="margin-bottom: 25px;">
                <a href="conselect.php"><button type="button" style="width: 200px; padding: 15px;"
                            class="btn btn-dark"><h5>CONSULTA GERAL</h5></button></a><br>
                <a href=""><button type="button" style="width: 200px; padding: 15px; margin-top: 5px;"
                            class="btn btn-dark"><h5>DASHBOARD</h5></button></a>
            </div>
            <div class="col" style="margin-bottom: 25px;">
                <a href="ususelect.php"><button type="button" style="width: 200px; padding: 15px;"
                            class="btn btn-dark"><h5>USUÁRIOS</h5></button></a><br>
            </div>
            <div class="col" style="margin-bottom: 25px;">
                <a href="teste.php"><button type="button" style="width: 200px; padding: 15px;"
                            class="btn btn-dark"><h5>teste</h5></button></a><br>
            </div>
        </div>
    </div>
</body>

</html>