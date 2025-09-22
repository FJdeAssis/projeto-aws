<?php
include("conexao.php");
require_once("registrar_log.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $dataNascimento = $_POST["dataNascimento"];
    $nomeMae = $_POST["nomeMae"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmarSenha"];

    // Verificação da confirmação de senha
    if ($senha !== $confirmarSenha) {
        echo "❌ As senhas não coincidem.";
        exit;
    }

    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Query de inserção
    $sql = "INSERT INTO usuarios 
        (nome, data_nascimento, nome_mae, cpf, email, telefone, endereco, login, senha) 
        VALUES 
        ('$nome', '$dataNascimento', '$nomeMae', '$cpf', '$email', '$telefone', '$endereco', '$login', '$senhaHash')";

    if ($conn->query($sql) === TRUE) {
        registrarLog($login, "Novo usuário cadastrado");

        // Mensagem e redirecionamento
        echo "✅ Cadastro realizado com sucesso! Redirecionando para a tela de login...";
        echo "<meta http-equiv='refresh' content='3;url=../login.html'>";
    } else {
        echo "❌ Erro ao cadastrar: " . $conn->error;
    }

    $conn->close();
}
?>