<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Camiseta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">Cadastrar Camiseta</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria_id']; // 🔥 ESSA LINHA É FUNDAMENTAL

    $sql = "INSERT INTO camisetas (modelo, cor, tamanho, preco, descricao, categoria_id) 
    VALUES ('$modelo', '$cor', '$tamanho', '$preco', '$descricao', '$categoria_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Camiseta cadastrada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conn->error . "</div>";
    }
}
?>

<form method="POST" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Modelo</label>
        <input type="text" name="modelo" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Cor</label>
        <input type="text" name="cor" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Tamanho</label>
        <select name="tamanho" class="form-select" required>
            <option>PP</option>
            <option>P</option>
            <option>M</option>
            <option>G</option>
            <option>GG</option>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="preco" class="form-control" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Categoria</label>
        <select name="categoria_id" class="form-select" required>
            <option value="">Selecione</option>
            <?php
            $catSql = "SELECT * FROM categorias";
            $catResult = $conn->query($catSql);
            while($cat = $catResult->fetch_assoc()) {
                echo "<option value='".$cat['id']."'>".$cat['nome']."</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"></textarea>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">Cadastrar</button>
        <a href="read.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

</body>
</html>