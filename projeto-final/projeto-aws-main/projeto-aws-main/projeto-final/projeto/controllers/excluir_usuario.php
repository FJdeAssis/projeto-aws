<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'master') {
    header("Location: ../erro.php?msg=Acesso negado");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: ../erro.php?msg=ID de usuário não informado");
    exit;
}

require_once 'conexao.php';

$id = intval($_GET['id']);

// Evita que o próprio usuário master se exclua
if ($id === $_SESSION['id']) {
    header("Location: ../erro.php?msg=Você não pode se excluir.");
    exit;
}

$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: ../usuarios.php");
        exit;
    } else {
        header("Location: ../erro.php?msg=Erro ao excluir o usuário");
        exit;
    }
} else {
    header("Location: ../erro.php?msg=Erro na preparação da exclusão");
    exit;
}
?>