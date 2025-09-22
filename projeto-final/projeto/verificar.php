<?php
session_start();
include("controllers/conexao.php");

// Evita acesso direto sem login
if (!isset($_SESSION['usuario_temp']) || !isset($_SESSION['tipo_temp'])) {
    header("Location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeMaeInformado = trim($_POST["nomeMae"]);
    $login = $_SESSION['usuario_temp'];

    // Busca o nome da mãe
    $sql = "SELECT nome_mae FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->bind_result($nomeMaeCorreto);
    $stmt->fetch();
    $stmt->close();

    if (strcasecmp($nomeMaeInformado, $nomeMaeCorreto) === 0) {
        // Autenticação OK → salva sessão final e redireciona
        $_SESSION['usuario'] = $login;
        $_SESSION['tipo'] = $_SESSION['tipo_temp'];
        unset($_SESSION['usuario_temp']);
        unset($_SESSION['tipo_temp']);

        // Redireciona para plano.html
        header("Location: plano.html");
        exit;
    } else {
        $erro = "❌ Nome da mãe incorreto!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Confirmação de Identidade</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            color: #0275d8;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            background-color: #0275d8;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .erro {
            color: red;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Confirmação de Identidade</h2>
        <p>Digite o nome completo da sua mãe</p>
        <form action="verificar.php" method="post">
            <input type="text" name="nomeMae" required placeholder="Nome da mãe">
            <button type="submit">Verificar</button>
        </form>
        <?php if (isset($erro)) echo "<p class='erro'>$erro</p>"; ?>
    </div>
</body>
</html>