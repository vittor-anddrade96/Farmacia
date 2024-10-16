<?php
require 'conexao.php';
$sql = $pdo->query("SELECT * FROM medicamentos");
$lista = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia Vida Saudável</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="bg-light py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php"><img src="imagens/farmacia.png" alt="Logo Farmácia" width="150"></a>
            <div>
                <a href="Login.php" class="btn btn-outline-danger btn-sm">Login</a>
            </div>
        </div>
    </header>

    <nav class="bg-danger py-2">
        <div class="container text-center">
            <a href="cadMedicamento.php" class="text-white text-decoration-none fw-bold">Cadastro de Medicamentos</a>
        </div>
    </nav>

    <main class="container my-5">
        <h3 class="text-danger text-center mb-4">MEDICAMENTOS EM ESTOQUE</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-danger">
                    <tr>
                        <th>ID</th>
                        <th>MEDICAMENTO</th>
                        <th>VALOR</th>
                        <th>ESTOQUE</th>
                        <th>CATEGORIA</th>
                        <th>VALIDADE</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista as $a): ?>
                        <tr>
                            <td><?= $a['id']; ?></td>
                            <td><?= $a['medicamento']; ?></td>
                            <td><?= $a['valor']; ?></td>
                            <td><?= $a['estoque']; ?></td>
                            <td><?= $a['categoria']; ?></td>
                            <td><?= $a['validade']; ?></td>
                            <td>
                                <a href="editMedicamento.php?id=<?= $a['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluirMedicamento.php?id=<?= $a['id']; ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="vender.php" class="btn btn-success">Iniciar Venda</a>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
