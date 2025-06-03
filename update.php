<?php
include 'conexao.php';
$id = $_GET['id'];

$sql = "SELECT * FROM camisetas WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Camiseta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">Editar Camiseta</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE camisetas 
            SET modelo='$modelo', cor='$cor', tamanho='$tamanho', preco='$preco', descricao='$descricao'
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Camiseta atualizada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conn->error . "</div>";
    }
}
?>

<form method="POST" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Modelo</label>
        <input type="text" name="modelo" class="form-control" value="<?php echo $row['modelo']; ?>" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Cor</label>
        <input type="text" name="cor" class="form-control" value="<?php echo $row['cor']; ?>" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Tamanho</label>
        <select name="tamanho" class="form-select" required>
            <?php
            $tamanhos = ['PP', 'P', 'M', 'G', 'GG'];
            foreach ($tamanhos as $t) {
                $selected = $row['tamanho'] == $t ? 'selected' : '';
                echo "<option $selected>$t</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="preco" class="form-control" value="<?php echo $row['preco']; ?>" required>
    </div>
    <div class="col-12">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"><?php echo $row['descricao']; ?></textarea>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-warning">Atualizar</button>
        <a href="read.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

</body>
</html>