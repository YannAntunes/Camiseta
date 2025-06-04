<?php
include 'conexao.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    die("ID da camiseta não fornecido.");
}

$id = intval($_GET['id']);

// Busca os dados da camiseta
$sql = "SELECT * FROM camisetas WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    die("Camiseta não encontrada.");
}
$row = $result->fetch_assoc();

// Busca as categorias
$catSql = "SELECT * FROM categorias";
$catResult = $conn->query($catSql);

// Atualização dos dados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modelo = $_POST['modelo'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria_id = $_POST['categoria_id'];

    $sql = "UPDATE camisetas SET 
            modelo='$modelo', 
            cor='$cor', 
            tamanho='$tamanho', 
            preco='$preco', 
            descricao='$descricao',
            categoria_id='$categoria_id' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Camiseta atualizada com sucesso!</div>";
        echo "<meta http-equiv='refresh' content='2;url=read.php'>";
    } else {
        echo "<div class='alert alert-danger'>Erro: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Camiseta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">✍️ Editar Camiseta</h2>

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
                echo "<option value='$t' $selected>$t</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Preço (R$)</label>
        <input type="number" step="0.01" name="preco" class="form-control" value="<?php echo $row['preco']; ?>" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Categoria</label>
        <select name="categoria_id" class="form-select" required>
            <option value="">Selecione</option>
            <?php
            while ($cat = $catResult->fetch_assoc()) {
                $selected = ($cat['id'] == $row['categoria_id']) ? 'selected' : '';
                echo "<option value='".$cat['id']."' $selected>".$cat['nome']."</option>";
            }
            ?>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"><?php echo $row['descricao']; ?></textarea>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-warning">Salvar Alterações</button>
        <a href="read.php" class="btn btn-secondary">Voltar</a>
    </div>
</form>

</body>
</html>