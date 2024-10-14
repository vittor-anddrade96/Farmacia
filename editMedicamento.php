<?php

require 'conexao.php';

if (isset($_POST['acao'])) {
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
        header("Location:index.php");
    } else {
        print_r($sql->errorInfo());
    }
}
?>
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
    $id = $_REQUEST['id'];
    $dados = [];
    $sql = $pdo->prepare("SELECT * FROM medicamentos WHERE id = :id");
    $sql->bindValue(':id', $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch(PDO::FETCH_ASSOC);
    } else {
        header("location:index.php");
        exit;
    }
    ?>

    <form method="post">
        <input type="hidden" name="id" id="id" value="<?= $dados['id']; ?>">
        <label for="Medicamento">
            Medicamento <input type="text" name="medicamento" value="<?= $dados['medicamento']; ?>">
        </label>
        <label for="valor">
            Valor <input type="number" name="valor" mim="0" step=".01" value="<?= $dados['valor']; ?>">
        </label>
        <label for="estoque">
            Estoque <input type="number" name="estoque" value="<?= $dados['estoque']; ?>">
        </label>
        <label for="categoria">
            Categoria <input type="text" name="categoria" value="<?= $dados['categoria']; ?>">
        </label>
        <label for="validade">
            Validade <input type="date" name="validade" value="<?= $dados['validade']; ?>">
        </label>
        <br><br>
        <input type="submit" name="acao" value="Enviar" />
    </form>
    <br>
    <a href="index.php">Início</a>
</body>

</html>