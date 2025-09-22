<?php
session_start();
include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $senha = $_POST["senha"];

        // Consulta agora traz também o tipo de usuário
    $sql = "SELECT senha, tipo FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($senhaHash, $tipo);
        $stmt->fetch();

        if (password_verify($senha, $senhaHash)) {
            // Login válido — salva tipo e login na sessão temporária
            $_SESSION['usuario_temp'] = $login;
            $_SESSION['tipo_temp'] = $tipo;

            // Redireciona para autenticação por nome da mãe
            header("Location: ../verificar.php");
            exit;
        } else {
            echo "❌ Senha incorreta.";
        }
    } else {
        echo "❌ Usuário não encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>