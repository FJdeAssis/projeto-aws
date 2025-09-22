<?php
session_start();
include("conexao.php");

// Proteção: só quem estiver logado e autenticado no 2FA
if (!isset($_SESSION["usuario"]) || !isset($_SESSION["autenticado_2fa"])) {
  header("Location: ../login.php?erro=Acesso negado.");
  exit;
}

$login = $_SESSION["usuario"];

$senha_atual = $_POST["senha_atual"];
$nova_senha = $_POST["nova_senha"];
$confirmar_senha = $_POST["confirmar_senha"];

// Verifica se as senhas novas coincidem
if ($nova_senha !== $confirmar_senha) {
  header("Location: ../alterarsenha.php?erro=As senhas não coincidem.");
  exit;
}

// Verifica senha atual no banco
$sql = "SELECT senha FROM usuarios WHERE login = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
  $stmt->bind_result($senha_hash);
  $stmt->fetch();

  if (password_verify($senha_atual, $senha_hash)) {
    // Atualiza com a nova senha criptografada
    $nova_hash = password_hash($nova_senha, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE usuarios SET senha = ? WHERE login = ?");
    $update->bind_param("ss", $nova_hash, $login);

    if ($update->execute()) {
    include("registrar_log.php"); // importa a função
    registrarLog($conn, "Senha alterada pelo usuário."); // registra o log

    header("Location: ../alterarsenha.php?sucesso=Senha atualizada com sucesso.");
    } else {
      header("Location: ../alterarsenha.php?erro=Erro ao atualizar a senha.");
    }

    $update->close();
  } else {
    header("Location: ../alterarsenha.php?erro=Senha atual incorreta.");
  }
} else {
  header("Location: ../alterarsenha.php?erro=Usuário não encontrado.");
}

$stmt->close();
$conn->close();
exit;