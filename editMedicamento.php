<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Medicamentos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center text-danger mb-4">Editando Medicamento</h3>

        <?php
        require 'conexao.php';

        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];

            $sql = $pdo->prepare("SELECT * FROM medicamentos WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                header("location:home_admin.php");
                exit;
            }
        }

        if (isset($_POST['acao'])) {
            $id = $_POST['id'];
            $medicamento = $_POST['medicamento'];
            $valor = $_POST['valor'];
            $estoque = $_POST['estoque'];
            $categoria = $_POST['categoria'];
            $validade = $_POST['validade'];

            $sql = $pdo->prepare("UPDATE medicamentos SET medicamento = :medicamento, valor = :valor, estoque = :estoque, categoria = :categoria, validade = :validade WHERE id = :id");
            $sql->bindValue(':medicamento', $medicamento);
            $sql->bindValue(':valor', $valor);
            $sql->bindValue(':estoque', $estoque);
            $sql->bindValue(':categoria', $categoria);
            $sql->bindValue(':validade', $validade);
            $sql->bindValue(':id', $id);

            if ($sql->execute()) {
                echo '<div class="alert alert-success">Medicamento alterado com sucesso!</div>';
                header("Location:home_admin.php");
                exit;
            } else {
                echo '<div class="alert alert-danger">Erro ao atualizar medicamento!</div>';
            }
        }
        ?>

        <form method="post" class="row g-3">
            <input type="hidden" name="id" value="<?= $dados['id']; ?>">

            <div class="col-md-6">
                <label for="medicamento" class="form-label">Medicamento</label>
                <input type="text" class="form-control" name="medicamento" value="<?= $dados['medicamento']; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" class="form-control" name="valor" min="0" step=".01" value="<?= $dados['valor']; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="estoque" class="form-label">Estoque</label>
                <input type="number" class="form-control" name="estoque" value="<?= $dados['estoque']; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria" value="<?= $dados['categoria']; ?>" required>
            </div>

            <div class="col-md-6">
                <label for="validade" class="form-label">Validade</label>
                <input type="date" class="form-control" name="validade" value="<?= $dados['validade']; ?>" required>
            </div>

            <div class="col-12">
                <button type="submit" name="acao" class="btn btn-danger">Salvar Alterações</button>
                <a href="home.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
