<?php
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : "Algo deu errado. Tente novamente.";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Erro</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #fbeaea;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      text-align: center;
      max-width: 400px;
    }

    h1 {
      color: #d32f2f;
      font-size: 36px;
      margin-bottom: 10px;
    }

    p {
      color: #444;
      font-size: 18px;
      margin-bottom: 30px;
      word-wrap: break-word;
    }

    a {
      background-color: #d32f2f;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    a:hover {
      background-color: #b71c1c;
    }

    .emoji {
      font-size: 48px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="emoji">❌</div>
    <h1>Erro</h1>
    <p><?php echo htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?></p>
    <a href="javascript:history.back()">🔙 Voltar</a>
  </div>

</body>
</html>