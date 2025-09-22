<?php
include("controllers/conexao.php");

// Consulta os logs
$sql = "SELECT * FROM logs ORDER BY data_hora DESC";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logs do Sistema - Saúde+Vida</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f7f9fc;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #007BBD;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BBD;
            color: white;
        }
        tr:hover {
            background-color: #f0f8ff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Logs do Sistema</h2>

        <?php if ($resultado->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuário</th>
                        <th>Ação</th>
                        <th>Data e Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($linha = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= $linha['id'] ?></td>
                            <td><?= htmlspecialchars($linha['usuario']) ?></td>
                            <td><?= htmlspecialchars($linha['acao']) ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($linha['data_hora'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum log registrado ainda.</p>
        <?php endif; ?>

        <?php $conn->close(); ?>
    </div>
</body>
</html>