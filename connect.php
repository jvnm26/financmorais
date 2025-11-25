<?php
$local = $_SERVER['HTTP_HOST'];
define('HOST', '127.0.0.1');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'financeiroipa');
if ($local == 'localhost') {
  $con = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('Não foi possível conectar');
} else {
  $con = new mysqli('108.179.192.85', 'avisnetc_senac', 'senac123**', 'avisnetc_bi');
}

if (!$con) {
  die(mysqli_error($con));
}
 
?>
