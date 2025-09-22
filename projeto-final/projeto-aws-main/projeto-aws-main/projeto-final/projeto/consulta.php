<?php
session_start();
require_once 'controllers/conexao.php';

// Protege a página para apenas usuários master
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'master') {
    header("Location: erro.php?msg=Acesso negado");
    exit;
}

// Mensagem de retorno
$msg = isset($_GET['msg']) ? $_GET['msg'] : '';

// Excluir usuário
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);

    if ($id == $_SESSION['id']) {
        header("Location: consulta.php?msg=Você não pode excluir a si mesmo.");
        exit;
    }

    // Buscar nome do usuário que será excluído
    $res = $conn->query("SELECT usuario FROM usuarios WHERE id = $id");
    $nomeExcluido = ($res && $res->num_rows > 0) ? $res->fetch_assoc()['usuario'] : 'desconhecido';

    // Executar exclusão
    $conn->query("DELETE FROM usuarios WHERE id = $id");

    // Registrar no log
    include_once 'controllers/registrar_log.php';
    registrarLog($_SESSION['usuario'], "Excluiu o usuário: $nomeExcluido (ID $id)");

    header("Location: consulta.php?msg=Usuário excluído com sucesso.");
    exit;
}

// Campo de busca
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$sql = "SELECT id, usuario, tipo FROM usuarios WHERE usuario LIKE '%$busca%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Consulta de Usuários</title>
    <link rel="stylesheet" href="style.css"> <!-- Usa seu CSS -->
</head>
<body>
    <h2>Consulta de Usuários</h2>

    <?php if ($msg): ?>
        <p style="color: green;"><?php echo htmlspecialchars($msg); ?></p>
    <?php endif; ?>

    <form method="GET" action="consulta.php">
        <input type="text" name="busca" placeholder="Buscar usuário" value="<?php echo htmlspecialchars($busca); ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <br>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Tipo</th>
            <th>Ação</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['usuario']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td>
                    <a href="consulta.php?excluir=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?')">Excluir</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="index.html">
        <button>Voltar ao Início</button>
    </a>
</body>
</html>