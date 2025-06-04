<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Camisetas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4 text-center">👕 Lista de Camisetas</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="create.php" class="btn btn-primary">+ Cadastrar Nova Camiseta</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Tamanho</th>
                <th>Preço (R$)</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT camisetas.*, categorias.nome as categoria_nome 
                    FROM camisetas 
                    LEFT JOIN categorias ON camisetas.categoria_id = categorias.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['modelo']."</td>
                            <td>".$row['cor']."</td>
                            <td>".$row['tamanho']."</td>
                            <td>".number_format($row['preco'], 2, ',', '.')."</td>
                            <td>".$row['descricao']."</td>
                            <td>".$row['categoria_nome']."</td>
                            <td>
                                <a href='update.php?id=".$row['id']."' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='delete.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick=\"return confirm('Tem certeza que deseja excluir?');\">Excluir</a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>Nenhuma camiseta cadastrada.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>