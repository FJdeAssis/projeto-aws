<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $mae = $_POST["mae"];

    if ($usuario === "master" && $senha === "admin123" && strtolower($mae) === "maria") {
        $_SESSION["tipo"] = "master";
        $_SESSION["usuario"] = $usuario;
        header("Location: ../usuarios.php");
        exit;
    } else {
        echo "<script>alert('Somente o usuário Master tem acesso a esse recurso!'); window.location.href='../index.html';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Master</title>
    <style>
        body {
            background-color: #e3f2fd;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        header {
            background-color: #e1f5fe;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            height: 40px;
            margin-right: 10px;
        }

        header nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #0277bd;
            font-weight: bold;
        }

        main {
            text-align: center;
            padding: 40px;
        }

        form {
            display: inline-block;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }

        input {
            padding: 10px;
            width: 250px;
            margin: 10px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #0277bd;
            color: white;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <a href="../index.html"><img src="../img/img-logo.webp" alt="Logo"></a>
            <h1 style="font-size: 20px; color: #0277bd;">Saúde+Vida</h1>
        </div>
        <nav>
            <a href="../index.html">Início</a>
            <a href="../faleconosco.html">Fale Conosco</a>
            <a href="../login.html">Login</a>
            <a href="../cadastro.html">Cadastro</a>
        </nav>
    </header>

    <main>
        <h2>Área Restrita - Usuário Master</h2>
        <form method="post">
            <input type="text" name="usuario" placeholder="Usuário" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>
            <input type="text" name="mae" placeholder="Nome da mãe" required><br>
            <button type="submit">Entrar</button>
        </form>
    </main>

</body>
</html>