<?php
// iniciar ou confirmar (atualizar) uma sessão
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Financeiro</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon" />
</head>

<body
    style="background-image: url('imagens/backlog.jpg'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
    <h6>versão: 2.0</h6>
    <section>
        <div class="container" style="padding: 300px;">
            <div class="row">
                <div class="col text-center" style="background-color: black;">
                    <h1 style="color: white;">Login</h1>
                </div>
            </div>
          
            <div class="row text-center" style="background-color: white;">
                <div class="col" style="margin-top: 80px;">
                    <?php

                    if (isset($_SESSION['nao_autenticado'])):
                        ?>
                        <div class="notification is-danger">
                            <p style="color: red;">ERRO: Usuário e/ou senha inválidos.</p>
                        </div>
                        <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);
                    ?>
                </div>
            </div>
            <form action="login.php" method="POST">
                <div class="row text-center" style="background-color: white;">
                    <div class="col">
                        <input name="email" type="text" placeholder="E-mail" style="width: 250px;">
                    </div>
                </div>
                <div class="row text-center" style="background-color: white;">
                    <div class="col">
                        <input name="senha" type="password" placeholder="Senha" style="width: 250px;">
                    </div>
                </div>
                <div class="row" style="background-color: white;">
                    <div class="col text-center" style="margin-top: 50px; margin-bottom: 20px;">
                        <button type="submit" style="padding: 7px; width: 100px;"
                            class="btn btn-secondary">Entrar</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
</body>

</html>