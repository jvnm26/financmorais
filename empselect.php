<?php
session_start();
include('verifica_login.php');
include('connect.php');
$sql = "SELECT * FROM empresa ORDER BY 1";
$pesqempresa= '';
if (isset($_POST['submit'])) {
    $pesqempresa = $_POST['pesqempresa'];
    $sql = "SELECT * FROM empresa
    WHERE nome LIKE '%$pesqempresa%'
    ORDER BY 1";
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
    <title>Empresas</title>
</head>

<body
    style="background-image: url('imagens/background.jpg'); background-attachment: fixed; background-size: 100%; background-repeat: no-repeat; background-color: black;">
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
    <form method="post">
        <div class="container" style="margin-top: 40px;">
            <div class="jumbotron text-center">
                <h1>Consulta Empresas</h1>
                <hr>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-7 text-right">
                        <label for="">Empresa Parcial:</label>
                        <input type="text" name="pesqempresa" style="width: 300px; padding: 9px;"
                            placeholder="..." value="<?php echo $pesqempresa ?>">
                    </div>
                    <div class="col text-left">
                        <button type="submit" name="submit" style="width: 150px; padding: 9px;"
                            class="btn btn-dark">CONSULTA</button>
                    </div>
                </div>
                <?php
    if ($_SESSION['master'] == "s") {
        echo '<div class="row" style="margin-top: 35px;">
        <div class="col-5 text-right">
            <a href="menu.php"><button type="button" style="padding: 7px; width: 100px;"
                    class="btn btn-secondary">MENU</button></a>
        </div>
        <div class="col">
            <a href="empinsert.php"><button type="button" style="padding: 7px; width: 100px;"
                    class="btn btn-secondary">INCLUSÃO</button></a>
        </div>
        <div class="col-5 text-left">
            <a href="empselect.php"><button type="button" style="padding: 7px; width: 100px;"
                    class="btn btn-secondary">LIMPAR</button></a>
        </div>
    </div>';
    } else {
        echo '<div class="row" style="margin-top: 35px;">
        <div class="col text-center">
            <a href="menu.php"><button type="button" style="padding: 7px; width: 100px;"
                    class="btn btn-secondary">MENU</button></a>
        </div></div>';
    }
?>
            </div>

            <table class="table table-bordered" style="background-color: white; opacity: 94%; text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <?php 
                        if ($_SESSION['master'] == "s") {
                            echo '<th scope="col">Operações</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
              <td>" . $row['id'] . " </td>
              <td>" . $row['nome'] . " </td>
            ";
            if ($_SESSION['master'] == "s") {
                echo "<td>
                <a href='empupdate.php?updateid={$row['id']}' style='color:white;'>
                <button type='button' class='btn btn-dark'> 
                Alterar</button></a>
                <a href='empdelete.php?deleteid={$row['id']}' style='color:white;'>
                <button type='button' class='btn btn-dark'> 
                Excluir</button></a>
                    </td></tr>";
                        } else {
                            echo "</tr>";
                        }
                    }
                }
                    ?>

                </tbody>
            </table>
        </div>
    </form>
</body>

</html>