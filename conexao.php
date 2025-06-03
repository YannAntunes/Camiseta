<?php
$servidor = "localhost";
$usuario = "root";
$senha = ""; // No XAMPP padrão, a senha é vazia
$banco = "loja_camisetas";

// Criando a conexão
$conn = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// echo "Conexão bem-sucedida!"; // (opcional, pode testar)
?>
