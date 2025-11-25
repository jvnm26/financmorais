<!DOCTYPE html>
<html>
<head>
    <title>Opção Sim ou Não</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div id="options">
    <button onclick="executarFuncao('SIM')">Sim</button>
    <button onclick="executarFuncao('NÃO')">Não</button>
</div>

<script>
function executarFuncao(escolha) {
    $.ajax({
        type: 'POST',
        url: 'funcao.php',
        data: { escolha: escolha },
        success: function(response) {
            console.log(response); // Exibe a resposta do servidor (opcional)
            // Aqui você pode realizar outras ações com base na resposta do servidor
            alert('ok: '+escolha);
        }
    });
}
</script>

</body>
</html>
