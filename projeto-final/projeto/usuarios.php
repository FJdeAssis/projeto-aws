<?php
session_start();
if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'master') {
    header("Location: erro.php?msg=Acesso negado");
    exit;
}
require_once 'controllers/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários Cadastrados - Saúde+Vida</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e3f2fd;
            padding: 30px;
        }
        h2 {
            color: #1565c0;
            margin-bottom: 20px;
        }
        table {
            background-color: white;
        }
        .btn-danger {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Lista de Usuários Cadastrados</h2>

    <form method="GET" class="form-inline mb-3">
        <label class="mr-2">Buscar por nome:</label>
        <input type="text" name="busca" class="form-control mr-2" placeholder="Digite o nome">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $busca = isset($_GET['busca']) ? trim($_GET['busca']) : '';

            if ($busca !== '') {
                $sql = "SELECT id, nome, email, cpf, telefone, data_nascimento FROM usuarios WHERE nome LIKE ? ORDER BY id ASC";
                $stmt = $conn->prepare($sql);
                $termoBusca = "%$busca%";
                $stmt->bind_param("s", $termoBusca);
            } else {
                $sql = "SELECT id, nome, email, cpf, telefone, data_nascimento FROM usuarios ORDER BY id ASC";
                $stmt = $conn->prepare($sql);
            }

            $stmt->execute();
            $resultado = $stmt->get_result();

            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["nome"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cpf"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["telefone"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["data_nascimento"]) . "</td>";
                echo "<td><a href='controllers/excluir_usuario.php?id=" . $row["id"] . "' class='btn btn-danger' onclick=\"return confirm('Tem certeza que deseja excluir este usuário?');\">Excluir</a></td>";
                echo "</tr>";
            }

            $stmt->close();
            ?>
        </tbody>
    </table>
    <br><br>
<a href="index.html" style="text-decoration: none;">
  <button style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
    ⬅ Voltar para o Início
  </button>
</a>

<a href="diagrama.html" style="text-decoration: none;">
  <button style="padding: 10px 20px; background-color: #2196F3; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
    Diagrama
  </button>
</a>

</body>
</html>