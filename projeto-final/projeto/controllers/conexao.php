<?php
$servidor = "localhost";
$usuario  = "root";
$senha    = "";
$banco    = "plano_de_saude";

global $conn; // <-- ADICIONE ESTA LINHA
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>