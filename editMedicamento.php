<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando Medicamentos</title>
</head>
<body>
    <h3>Editando Medicamento</h3>
    <?php
    require 'conexao.php';

    // Captura o ID antes de processar o formulário
    if (isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];

        // Seleciona o medicamento para edição
        $sql = $pdo->prepare("SELECT * FROM medicamentos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            header("location:home.php");
            exit;
        }
    }

    if (isset($_POST['acao'])) {
        // Capture o ID do formulário
        $id = $_POST['id']; // Aqui você captura o ID

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
            echo 'Medicamento alterado com Sucesso!';
            header("Location:home.php");
            exit; // É importante adicionar exit após header
        } else {
            print_r($sql->errorInfo());
        }
    }
    ?>

    <form method="post">
        <input type="hidden" name="id" value="<?= $dados['id']; ?>">
        <label for="medicamento">
            Medicamento <input type="text" name="medicamento" value="<?= $dados['medicamento']; ?>" required>
        </label>
        <label for="valor">
            Valor <input type="number" name="valor" min="0" step=".01" value="<?= $dados['valor']; ?>" required>
        </label>
        <label for="estoque">
            Estoque <input type="number" name="estoque" value="<?= $dados['estoque']; ?>" required>
        </label>
        <label for="categoria">
            Categoria <input type="text" name="categoria" value="<?= $dados['categoria']; ?>" required>
        </label>
        <label for="validade">
            Validade <input type="date" name="validade" value="<?= $dados['validade']; ?>" required>
        </label>
        <br><br>
        <input type="submit" name="acao" value="Enviar" />
    </form>
    <br>
    <a href="home.php">Início</a>
</body>
</html>
