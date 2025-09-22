<?php
include("controllers/conexao.php");

$login = "master";
$novaSenha = "admin123";
$hash = password_hash($novaSenha, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET senha = ? WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $hash, $login);

if ($stmt->execute()) {
    echo "✅ Senha atualizada com sucesso para o usuário 'master'.";
} else {
    echo "❌ Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>