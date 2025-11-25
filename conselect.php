<?php
session_start();
include('verifica_login.php');
include('connect.php');
$sql = "SELECT 'Entrada' tipo, p.nome nome, replace(e.valor, '.', ',') valor, '-' valorpago, DATE_FORMAT(e.dataentrada, '%d/%m/%Y') data, DATE_FORMAT(e.datadocumento, '%d/%m/%Y') datadocumento, e.id id FROM ip_pessoa p INNER JOIN ip_entrada e ON p.id = e.idpessoa
UNION ALL
SELECT 'Saída' tipo, f.nome nome, replace(s.valorpagar, '.', ',') valor, replace(s.valorpago, '.', ',') valorpago, DATE_FORMAT(s.datapagar, '%d/%m/%Y') data, '-' datadocumento, s.id id FROM ip_fornecedor f INNER JOIN ip_saida s ON f.id = s.idfornecedor";
$sql2 = "SELECT SUM(s.valorpago) totalsaida FROM ip_saida s";
$sql3 = "SELECT SUM(e.valor) totalentrada FROM ip_entrada e";
$result = mysqli_query($con, $sql2);
$row = mysqli_fetch_assoc($result);
$result2 = mysqli_query($con, $sql3);
$row2 = mysqli_fetch_assoc($result2);
$filtro = '';
$pesqnome = '';
$pesqdata1 = '';
$pesqdata2 = '';
$pesqdatadocumento1 = '';
$pesqdatadocumento2 = '';
$pesqvalor1 = '';
$pesqvalor2 = '';
$pesqvalorpago1 = '';
$pesqvalorpago2 = '';
$nomefornecedor = '';
$nomepessoa = '';
$saldoanterior = '0';
$totalentradas = $row2['totalentrada'];
$totalsaidas = $row['totalsaida'];
$saldoperiodo = $totalentradas - $totalsaidas;
$saldoreal = $saldoanterior + $saldoperiodo;
if (isset($_POST['submit'])) {
    $filtro = $_POST['filtro'];
    $pesqnome = $_POST['pesqnome'];
    $pesqdata1 = $_POST['pesqdata1'];
    $pesqdata2 = $_POST['pesqdata2'];
    $pesqdatadocumento1 = $_POST['pesqdatadocumento1'];
    $pesqdatadocumento2 = $_POST['pesqdatadocumento2'];
    $pesqvalor1 = $_POST['pesqvalor1'];
    $pesqvalor2 = $_POST['pesqvalor2'];
    $pesqvalorpago1 = $_POST['pesqvalorpago1'];
    $pesqvalorpago2 = $_POST['pesqvalorpago2'];
    if ($pesqvalor1 == '') {
        $pesqvalor1 = '0';
    }
    if ($pesqvalor2 == '') {
        $pesqvalor2 = '99999';
    }
    if ($pesqvalorpago1 == '') {
        $pesqvalorpago1 = '0';
    }
    if ($pesqvalorpago2 == '') {
        $pesqvalorpago2 = '99999';
    }
    if ($pesqdata1 == '') {
        $pesqdata1 = '0001-01-01';
    }
    if ($pesqdata2 == '') {
        $pesqdata2 = '9999-01-01';
    }
    if ($pesqdatadocumento1 == '') {
        $pesqdatadocumento1 = '0001-01-01';
    }
    if ($pesqdatadocumento2 == '') {
        $pesqdatadocumento2 = '9999-01-01';
    }
    if ($filtro == "S" || $filtro == "A") {
        $nomefornecedor = "f.nome LIKE '%" . $pesqnome . "%' AND s.valorpagar BETWEEN $pesqvalor1 AND $pesqvalor2 AND s.valorpago BETWEEN $pesqvalorpago1 AND $pesqvalorpago2 AND s.datapagar BETWEEN '$pesqdata1' AND '$pesqdata2'";
    }
    if ($filtro == "E" || $filtro == "A") {
        $nomepessoa = "p.nome LIKE '%" . $pesqnome . "%' AND e.valor BETWEEN $pesqvalor1 AND $pesqvalor2 AND e.dataentrada BETWEEN '$pesqdata1' AND '$pesqdata2' AND e.datadocumento BETWEEN '$pesqdatadocumento1' AND '$pesqdatadocumento2'";
    }
    $sqlentrada = "SELECT 'Entrada' tipo, p.nome nome, replace(e.valor, '.', ',') valor, '-' valorpago, DATE_FORMAT(e.dataentrada, '%d/%m/%Y') data, DATE_FORMAT(e.datadocumento, '%d/%m/%Y') datadocumento, e.id id FROM ip_pessoa p INNER JOIN ip_entrada e ON p.id = e.idpessoa WHERE " . $nomepessoa;
    $sqlsaida = "SELECT 'Saída' tipo, f.nome nome, replace(s.valorpagar, '.', ',') valor, replace(s.valorpago, '.', ',') valorpago, DATE_FORMAT(s.datapagar, '%d/%m/%Y') data, '-' datadocumento, s.id id FROM ip_fornecedor f INNER JOIN ip_saida s ON f.id = s.idfornecedor WHERE " . $nomefornecedor;
    $nomefornecedores = "f.nome LIKE '%" . $pesqnome . "%' AND s.valorpagar BETWEEN $pesqvalor1 AND $pesqvalor2 AND s.valorpago BETWEEN $pesqvalorpago1 AND $pesqvalorpago2 AND s.datapagar BETWEEN '$pesqdata1' AND '$pesqdata2'";
    $nomepessoas = "p.nome LIKE '%" . $pesqnome . "%' AND e.valor BETWEEN $pesqvalor1 AND $pesqvalor2 AND e.dataentrada BETWEEN '$pesqdata1' AND '$pesqdata2' AND e.datadocumento BETWEEN '$pesqdatadocumento1' AND '$pesqdatadocumento2'";
    $totalsaidas = '0';
    $totalentradas = '0';
    if ($filtro == "A") {
        $sql = $sqlsaida . " union all " . $sqlentrada;
        $sqltotalentrada = "SELECT SUM(e.valor) totalentrada FROM ip_pessoa p INNER JOIN ip_entrada e ON p.id = e.idpessoa WHERE " . $nomepessoas;
        $resultadoentrada = mysqli_query($con, $sqltotalentrada);
        $rowentrada = mysqli_fetch_assoc($resultadoentrada);
        $totalentradas = $rowentrada['totalentrada'];
        $sqltotalsaida = "SELECT SUM(s.valorpago) totalsaida FROM ip_fornecedor f INNER JOIN ip_saida s ON f.id = s.idfornecedor WHERE " . $nomefornecedores;
        $resultsaida = mysqli_query($con, $sqltotalsaida);
        $rowsaida = mysqli_fetch_assoc($resultsaida);
        $totalsaidas = $rowsaida['totalsaida'];
        $sqlsaldoanterior = "SELECT SUM(e.valor) somasaldoe FROM ip_entrada e WHERE e.dataentrada < '$pesqdata1'";
        $resultadosaldo = mysqli_query($con, $sqlsaldoanterior);
        $rowsaldo = mysqli_fetch_assoc($resultadosaldo);
        $sqlsaldoanteriorsaida = "SELECT SUM(s.valorpago) somasaldos FROM ip_saida s WHERE s.datapagar < '$pesqdata1'";
        $resultadosaldosaida = mysqli_query($con, $sqlsaldoanteriorsaida);
        $rowsaldosaida = mysqli_fetch_assoc($resultadosaldosaida);
        $saldoanterior = $rowsaldo['somasaldoe'] - $rowsaldosaida['somasaldos'];
    }
    if ($filtro == "S") {
        $sql = $sqlsaida;
        $sqltotalsaida = "SELECT SUM(s.valorpago) totalsaida FROM ip_fornecedor f INNER JOIN ip_saida s ON f.id = s.idfornecedor WHERE " . $nomefornecedores;
        $resultsaida = mysqli_query($con, $sqltotalsaida);
        $rowsaida = mysqli_fetch_assoc($resultsaida);
        $totalsaidas = $rowsaida['totalsaida'];
        $sqlsaldoanterior = "SELECT SUM(e.valor) somasaldoe FROM ip_entrada e WHERE e.dataentrada < '$pesqdata1'";
        $resultadosaldo = mysqli_query($con, $sqlsaldoanterior);
        $rowsaldo = mysqli_fetch_assoc($resultadosaldo);
        $sqlsaldoanteriorsaida = "SELECT SUM(s.valorpago) somasaldos FROM ip_saida s WHERE s.datapagar < '$pesqdata1'";
        $resultadosaldosaida = mysqli_query($con, $sqlsaldoanteriorsaida);
        $rowsaldosaida = mysqli_fetch_assoc($resultadosaldosaida);
        $saldoanterior = $rowsaldo['somasaldoe'] - $rowsaldosaida['somasaldos'];
    }
    if ($filtro == "E") {
        $sql = $sqlentrada;
        $sqltotalentrada = "SELECT SUM(e.valor) totalentrada FROM ip_pessoa p INNER JOIN ip_entrada e ON p.id = e.idpessoa WHERE " . $nomepessoas;
        $resultadoentrada = mysqli_query($con, $sqltotalentrada);
        $rowentrada = mysqli_fetch_assoc($resultadoentrada);
        $totalentradas = $rowentrada['totalentrada'];
        $sqlsaldoanterior = "SELECT SUM(e.valor) somasaldoe FROM ip_entrada e WHERE e.dataentrada < '$pesqdata1'";
        $resultadosaldo = mysqli_query($con, $sqlsaldoanterior);
        $rowsaldo = mysqli_fetch_assoc($resultadosaldo);
        $sqlsaldoanteriorsaida = "SELECT SUM(s.valorpago) somasaldos FROM ip_saida s WHERE s.datapagar < '$pesqdata1'";
        $resultadosaldosaida = mysqli_query($con, $sqlsaldoanteriorsaida);
        $rowsaldosaida = mysqli_fetch_assoc($resultadosaldosaida);
        $saldoanterior = $rowsaldo['somasaldoe'] - $rowsaldosaida['somasaldos'];
    }
    $saldoperiodo = $totalentradas - $totalsaidas;
    $saldoreal = $saldoanterior + $saldoperiodo;
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
    <title>Consulta Geral</title>
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
        <div class="col" style="margin-top: 20px;">
            <div class="jumbotron text-center">
                <h1>Consulta Geral</h1>
                <hr>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-7 text-right">
                        <label for="">Nome Parcial:</label>
                        <input type="text" name="pesqnome" style="width: 300px; padding: 9px;" placeholder="José..."
                            value="<?php echo $pesqnome ?>">
                    </div>
                    <div class="col text-left">
                        <label for="">Filtrar por:</label>
                        <select name="filtro" style="width: 130px; padding: 9px; text-align: center;">
                            <option value="A" <?php if ($filtro == "A") {
                                echo "selected";
                            } ?>></option>
                            <option value="E" <?php if ($filtro == "E") {
                                echo "selected";
                            } ?>>Entrada</option>
                            <option value="S" <?php if ($filtro == "S") {
                                echo "selected";
                            } ?>>Saída</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="col-3">
                        <label for="">Valor de:</label>
                        <input type="number" step=".01" name="pesqvalor1" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqvalor1 ?>">
                    </div>
                    <div class="col">
                        <label for="">Valor Pago de:</label>
                        <input type="number" step=".01" name="pesqvalorpago1" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqvalorpago1 ?>">
                    </div>
                    <div class="col">
                        <label for="">Data de:</label>
                        <input type="date" name="pesqdata1" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqdata1 ?>">
                    </div>
                    <div class="col">
                        <label for="">Documento de:</label>
                        <input type="date" name="pesqdatadocumento1" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqdatadocumento1 ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px;">
                    <div class="col-3" style="left: 17px;">
                        <label for="">Até:</label>
                        <input type="number" step=".01" name="pesqvalor2" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqvalor2 ?>">
                    </div>
                    <div class="col" style="left: 37px;">
                        <label for="">Até:</label>
                        <input type="number" step=".01" name="pesqvalorpago2" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqvalorpago2 ?>">
                    </div>
                    <div class="col-3" style="left: 15px;">
                        <label for="">Até:</label>
                        <input type="date" name="pesqdata2" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqdata2 ?>">
                    </div>

                    <div class="col" style="left: 41px;">
                        <label for="">Até:</label>
                        <input type="date" name="pesqdatadocumento2" style="width: 300px; padding: 9px;"
                            value="<?php echo $pesqdatadocumento2 ?>">
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">


                </div>
                <div class="row" style="margin-top: 5px;">
                    <div class="col-5 text-right">
                        <button type="submit" name="submit" style="width: 100px; padding: 7px;"
                            class="btn btn-dark">CONSULTA</button>
                    </div>
                    <div class="col">
                        <a href="menu.php"><button type="button" style="padding: 7px; width: 100px;"
                                class="btn btn-secondary">MENU</button></a>
                    </div>
                    <div class="col-5 text-left">
                        <a href="conselect.php"><button type="button" style="padding: 7px; width: 100px;"
                                class="btn btn-secondary">LIMPAR</button></a>
                    </div>
                </div>
            </div>
            <div class="container" style="background-color: gray;">
                <div class="row">
                    <div class="col-7" style="margin-top: 15px; margin-bottom: 10px;">
                        <div class="row">
                            <div class="col-5 text-right">
                                <label for="">
                                    <h4>Saldo Anterior =</h4>
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" step=".01" value="<?php echo 'R$' . $saldoanterior ?>"
                                    style="width: 150px;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-right">
                                <label for="">
                                    <h4>Total Entradas =</h4>
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" step=".01" value="<?php echo 'R$' . $totalentradas + 0 ?>"
                                    style="width: 150px;" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-right">
                                <label for="">
                                    <h4>Total Saídas =</h4>
                                </label>
                            </div>
                            <div class="col">
                                <input type="text" step=".01" value="<?php echo 'R$' . $totalsaidas + 0 ?>" style="width: 150px;"
                                    readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 text-right"><label for="">
                                    <h4>Saldo Real =</h4>
                                </label></div>
                            <div class="col">
                                <input type="text" step=".01" value="<?php echo 'R$' . $saldoreal ?>" style="width: 150px;"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col" style="margin-top: 15px; margin-bottom: 10px;">
                        <div class="row" style="margin-top: 55px;">
                            <div class="col"><label for="">
                                    <h3>Saldo Período =</h3>
                                </label></div>
                            <div class="col">
                                <input type="text" step=".01" value="<?php echo 'R$' . $saldoperiodo ?>"
                                    style="width: 150px; padding: 8px;" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered"
                style="background-color: white; opacity: 94%; text-align: center; margin-top: 20px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Valor Pago</th>
                        <th scope="col">Data</th>
                        <th scope="col">Data Documento</th>
                        <th scope="col">Operações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($con, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
              <td>" . $row['tipo'] . " </td>
              <td>" . $row['nome'] . " </td>
              <td>" . $row['valor'] . " </td>
              <td>" . $row['valorpago'] . "</td>
              <td>" . $row['data'] . " </td>
              <td>" . $row['datadocumento'] . " </td>";
                            if ($row['tipo'] == 'Entrada') {
                                echo "<td>
                <a href='conselectedent.php?selectid={$row['id']}' style='color:white;'>
                            <button type='button' class='btn btn-secondary'> 
                            Ver Mais</button></a>
                </td>
                </tr>";
                            } else {
                                echo "<td>
                <a href='conselectedsai.php?selectid={$row['id']}' style='color:white;'>
                            <button type='button' class='btn btn-secondary'> 
                            Ver Mais</button></a>
                </td>
                </tr>";
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