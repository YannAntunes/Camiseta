<?php
include 'conexao.php';
$id = $_GET['id'];

$sql = "DELETE FROM camisetas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success'>Camiseta excluída com sucesso!</div>";
} else {
    echo "<div class='alert alert-danger'>Erro ao excluir: " . $conn->error . "</div>";
}
?>
<br>
<a href="read.php" class="btn btn-secondary">Voltar para lista</a>