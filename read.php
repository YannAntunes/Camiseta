<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Camisetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

<h2 class="mb-4">Lista de Camisetas</h2>

<a href="create.php" class="btn btn-primary mb-3">Cadastrar Nova Camiseta</a>

<?php
$sql = "SELECT * FROM camisetas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>
            <thead class='table-dark'>
                <tr>
                    <th>ID</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Tamanho</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead><tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['modelo']}</td>
                <td>{$row['cor']}</td>
                <td>{$row['tamanho']}</td>
                <td>R$ {$row['preco']}</td>
                <td>{$row['descricao']}</td>
                <td>
                    <a href='update.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' 
                       onclick=\"return confirm('Tem certeza que deseja excluir?')\">Excluir</a>
                </td>
              </tr>";
    }
    echo "</tbody></table>";
} else {
    echo "<div class='alert alert-info'>Nenhuma camiseta cadastrada.</div>";
}
?>

</body>
</html>
