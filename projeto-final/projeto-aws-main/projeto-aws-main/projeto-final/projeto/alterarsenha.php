<?php
session_start();

// Proteção: só quem está logado e passou pelo 2FA
if (!isset($_SESSION["usuario"]) || !isset($_SESSION["autenticado_2fa"])) {
  header("Location: login.php?erro=Acesso negado. Faça login.");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Alterar Senha - Saúde+Vida</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .container {
      max-width: 450px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #1d72b8;
      margin-bottom: 25px;
    }

    label {
      font-weight: bold;
      margin-top: 15px;
      display: block;
    }

    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 15px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #1d72b8;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #155a96;
    }

    .mensagem {
      text-align: center;
      margin-bottom: 15px;
      padding: 10px;
      border-radius: 6px;
    }

    .erro {
      background-color: #f8d7da;
      color: #721c24;
    }

    .sucesso {
      background-color: #d4edda;
      color: #155724;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Alterar Senha</h2>

    <?php if (isset($_GET["erro"])): ?>
      <div class="mensagem erro">❌ <?= htmlspecialchars($_GET["erro"]) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET["sucesso"])): ?>
      <div class="mensagem sucesso">✅ <?= htmlspecialchars($_GET["sucesso"]) ?></div>
    <?php endif; ?>

    <form method="POST" action="controllers/alterarsenha.php">
      <label for="senha_atual">Senha Atual:</label>
      <input type="password" name="senha_atual" required>

      <label for="nova_senha">Nova Senha:</label>
      <input type="password" name="nova_senha" required>

      <label for="confirmar_senha">Confirmar Nova Senha:</label>
      <input type="password" name="confirmar_senha" required>

      <button type="submit">Atualizar Senha</button>
    </form>
  </div>

</body>
</html>