<?php
function registrarLog($usuario, $acao): void {
    // Corrigido: caminho correto para o arquivo de conexão
    require_once __DIR__ .'/conexao.php';
    global $conn;

    // Garante que o nome do usuário esteja definido
    if (empty($usuario)) {
        $usuario = "Anônimo";
    }

    // Query para inserir o log
    $sql = "INSERT INTO logs (usuario, acao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $usuario, $acao);
    $stmt->execute();
    $stmt->close();
}
?>