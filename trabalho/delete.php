<?php
include 'conexao.php';

if (!isset($_GET['id'])) {
    die("ID da camiseta não informado.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM camisetas WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: read.php");
    exit;
} else {
    echo "<div class='alert alert-danger'>Erro ao excluir: " . $conn->error . "</div>";
}
?>