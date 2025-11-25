<?php
session_start();
include('verifica_login.php');
include('connect.php');
$sql = "SELECT e.id id, p.nome nome, e.valor valor, DATE_FORMAT(e.dataentrada, '%d/%m/%Y') dataentrada, DATE_FORMAT(e.datadocumento, '%d/%m/%Y') datadocumento, e.documento documento FROM ip_entrada e INNER JOIN ip_pessoa p ON p.id = e.idpessoa ORDER BY 1";
$pesqnome = '';
if (isset($_POST['submit'])) {
    $pesqnome = $_POST['pesqnome'];
    $sql = "SELECT e.id id, p.nome nome, replace(e.valor, '.', ',') valor, DATE_FORMAT(e.dataentrada, '%d/%m/%Y') dataentrada, DATE_FORMAT(e.datadocumento, '%d/%m/%Y') datadocumento, e.documento documento FROM ip_entrada e INNER JOIN ip_pessoa p ON p.id = e.idpessoa
    WHERE nome LIKE '%$pesqnome%'
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
    <title>Entradas</title>
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
                <h1>Consulta Entradas</h1>
                <hr>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-7 text-right">
                        <label for="">Nome Parcial:</label>
                        <input type="text" name="pesqnome" style="width: 300px; padding: 9px;"
                            placeholder="Maria..." value="<?php echo $pesqnome ?>">
                    </div>
                    <div class="col text-left">
                        <button type="submit" name="submit" style="width: 150px; padding: 9px;"
                            class="btn btn-dark">CONSULTA</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 35px;">
                    <div class="col-5 text-right">
                        <a href="menu.php"><button type="button" style="padding: 7px; width: 100px;"
                                class="btn btn-secondary">MENU</button></a>
                    </div>
                    <div class="col">
                        <a href="entinsert.php"><button type="button" style="padding: 7px; width: 100px;"
                                class="btn btn-secondary">INCLUSÃO</button></a>
                    </div>
                    <div class="col-5 text-left">
                        <a href="entselect.php"><button type="button" style="padding: 7px; width: 100px;"
                                class="btn btn-secondary">LIMPAR</button></a>
                    </div>
                </div>
            </div>

            <table class="table table-bordered" style="background-color: white; opacity: 94%; text-align: center;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Data Entrada</th>
                        <th scope="col">Data Documento</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Operações</th>
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
              <td>" . "R$ " . str_replace($valor,'.',',') . " </td>
              <td>" . $row['dataentrada'] . " </td>
              <td>" . $row['datadocumento'] . " </td>
              <td>" . $row['documento'] . " </td>
            <td>
            <a href='entselected.php?selectid={$row['id']}' style='color:white;'>
                        <button type='button' class='btn btn-secondary'> 
                        Ver Mais</button></a>
            </td>
            <td>
                        <a href='entupdated.php?updateid={$row['id']}' style='color:white;'>
                        <button type='button' class='btn btn-dark'> 
                        Alterar</button></a>
                        <a href='entdeleted.php?deleteid={$row['id']}' style='color:white;'>
                        <button type='button' class='btn btn-dark'> 
                        Excluir</button></a>
            </td>
          </tr>";
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </form>
</body>

</html>