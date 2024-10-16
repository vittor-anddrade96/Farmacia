<?php
require 'conexao.php';

if (isset($_POST['confirmar'])) {
    $ids = $_POST['id'];
    $quantidades = $_POST['quantidade'];


    foreach ($ids as $index => $id) {
        $quantidade = $quantidades[$index];


        $sql = $pdo->prepare("SELECT estoque FROM medicamentos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $medicamento = $sql->fetch(PDO::FETCH_ASSOC);

        if ($medicamento['estoque'] >= $quantidade) {

            $novoEstoque = $medicamento['estoque'] - $quantidade;
            $sql = $pdo->prepare("UPDATE medicamentos SET estoque = :estoque WHERE id = :id");
            $sql->bindValue(':estoque', $novoEstoque);
            $sql->bindValue(':id', $id);
            $sql->execute();
        } else {
            echo "<div class='alert alert-danger'>Estoque insuficiente para o medicamento ID: $id.</div>";
        }
    }

    echo "<div class='alert alert-success'>Compra confirmada e estoque atualizado!</div>";
}


$sql = $pdo->query("SELECT * FROM medicamentos WHERE estoque > 0");
$medicamentos = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia Vida Saudável - Vendas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center text-success mb-4">Vendas de Medicamentos</h3>

        <form method="post">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>Medicamento</th>
                            <th>Valor (R$)</th>
                            <th>Estoque</th>
                            <th>Categoria</th>
                            <th>Validade</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicamentos as $med): ?>
                            <tr>
                                <td><?= $med['id']; ?></td>
                                <td><?= $med['medicamento']; ?></td>
                                <td><?= number_format($med['valor'], 2, ',', '.'); ?></td>
                                <td><?= $med['estoque']; ?></td>
                                <td><?= $med['categoria']; ?></td>
                                <td><?= date('d/m/Y', strtotime($med['validade'])); ?></td>
                                <td>
                                    <input type="hidden" name="id[]" value="<?= $med['id']; ?>">
                                    <input type="number" name="quantidade[]" class="form-control" min="1" max="<?= $med['estoque']; ?>" value="1" required>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="confirmar" class="btn btn-success">Confirmar Compra</button>
                <a href="home_atendente.php" class="btn btn-secondary">Cancelar</a>
                <a href="home_atendente.php" class="btn btn-secondary">Voltar</a>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
