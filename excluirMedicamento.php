<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Medicamento</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center text-danger mb-4">Excluir Medicamento</h3>

        <?php
        require 'conexao.php';

        if (isset($_POST['acao'])) {
            $id = $_POST['id'];

            $sql = $pdo->prepare("DELETE FROM medicamentos WHERE id = :id");
            $sql->bindValue(':id', $id);

            if ($sql->execute()) {
                echo '<div class="alert alert-success text-center">Medicamento excluído com sucesso!</div>';
            } else {
                echo '<div class="alert alert-danger text-center">Erro ao excluir medicamento!</div>';
            }
        }

        $id = $_REQUEST['id'];
        $dados = [];

        $sql = $pdo->prepare("SELECT * FROM medicamentos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            header('Location:home_admin.php');
            exit;
        }
        ?>

        <h4 class="text-center text-warning">Tem certeza de que deseja excluir o medicamento abaixo?</h4>
        <form method="post" class="mt-4">
            <input type="hidden" name="id" value="<?= $dados['id']; ?>">

            <div class="mb-3">
                <label for="medicamento" class="form-label">Medicamento</label>
                <input type="text" class="form-control" name="medicamento" value="<?= $dados['medicamento']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" class="form-control" name="valor" min="0" step=".01" value="<?= $dados['valor']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="estoque" class="form-label">Estoque</label>
                <input type="number" class="form-control" name="estoque" value="<?= $dados['estoque']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>
                <input type="text" class="form-control" name="categoria" value="<?= $dados['categoria']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="validade" class="form-label">Validade</label>
                <input type="date" class="form-control" name="validade" value="<?= $dados['validade']; ?>" readonly>
            </div>

            <div class="text-center">
                <button type="submit" name="acao" class="btn btn-danger">Excluir</button>
                <a href="home_admin.php" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
