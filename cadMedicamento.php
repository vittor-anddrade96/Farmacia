<?php

require 'conexao.php';

if (isset($_POST['acao'])) {
    $medicamento = $_POST['medicamento'];
    $valor = $_POST['valor'];
    $estoque = $_POST['estoque'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    if (empty($medicamento) || empty($valor) || empty($estoque) || empty($categoria) || empty($validade)) {
        echo '<div class="alert alert-danger">Por favor, preencha todos os campos!</div>';
        exit;
    }

    try {
        $sql = $pdo->prepare("INSERT INTO medicamentos (medicamento,valor,estoque,categoria,validade) VALUES (:medicamento, :valor, :estoque, :categoria, :validade)");
        $sql->bindValue(':medicamento', $medicamento);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':estoque', $estoque);
        $sql->bindValue(':categoria', $categoria);
        $sql->bindValue(':validade', $validade);

        $sql->execute();
        echo '<div class="alert alert-success">Medicamento cadastrado com sucesso!</div>';
    } catch (PDOException $e) {
        echo '<div class="alert alert-danger">Erro ao cadastrar medicamento: ' . $e->getMessage() . '</div>';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Medicamentos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            margin-top: 10px;
        }

        .btn {
            margin-top: 20px;
        }

        a {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Cadastro de Medicamentos</h2>
        <form method="post">
            <div class="mb-3">
                <label for="medicamento" class="form-label">Nome do Medicamento</label>
                <input type="text" class="form-control" name="medicamento" id="medicamento" required>
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor do Medicamento</label>
                <input type="number" class="form-control" name="valor" id="valor" min="0" value="0" step=".01" required>
            </div>

            <div class="mb-3">
                <label for="estoque" class="form-label">Quantidade em Estoque</label>
                <input type="number" class="form-control" name="estoque" id="estoque" required>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria do Medicamento</label>
                <input type="text" class="form-control" name="categoria" id="categoria" required>
            </div>

            <div class="mb-3">
                <label for="validade" class="form-label">Data de Validade</label>
                <input type="date" class="form-control" name="validade" id="validade" value="2024-12-01" min="2024-12-01" max="2035-01-01">
            </div>

            <button type="submit" name="acao" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-secondary">Apagar Informações</button>
        </form>
        <a href="home_admin.php" class="btn btn-link">Início</a>
    </div>

    <!-- Bootstrap JS (Opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
