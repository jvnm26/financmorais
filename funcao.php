<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['escolha'])) {
        $escolha = $_POST['escolha'];

        if ($escolha === 'SIM') {
            funcaoSim();
        } elseif ($escolha === 'NÃO') {
            funcaoNao();
        }
    }
}

function funcaoSim() {
    // Código a ser executado para a escolha 'SIM' no lado do servidor
    echo 'Função Sim executada no servidor';
}

function funcaoNao() {
    // Código a ser executado para a escolha 'NÃO' no lado do servidor
    echo 'Função Não executada no servidor';
}
?>
