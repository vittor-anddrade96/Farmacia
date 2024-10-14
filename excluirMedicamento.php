<?php

    require 'conexao.php';

    if(isset($_POST['acao'])){
        $medicamento = $_POST['medicamento'];
        $valor = $_POST['valor'];
        $estoque = $_POST['estoque'];
        $categoria = $_POST['categoria'];
        $validade = $_POST['validade'];
        $id = $_POST['id'];

        $sql = $pdo->prepare("DELETE from medicamentos WHERE id = :id");
        $sql->bindValue(':id', $id);

        $sql->execute();
        echo 'Medicamento excluído com Sucesso!';
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Medicamento</title>
</head>
<body>
    <h3>Excluindo Medicamento</h3>
    <?php
        $id = $_REQUEST['id'];
        $dados = [];

        $sql = $pdo->prepare("SELECT * FROM medicamentos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            header('Location:index.php');
            exit;
        }
    ?>
    <h4>ESTÁ CERTO DA EXCLUSÃO DESTE MEDICAMENTO:</h4>
    <form action="excluirMedicamento.php" method="post">
    <input type="hiden" name="id" id="id" value="<?=$dados['id']; ?>">
        <label for="Medicamento">
             <input type="text" name="medicamento" value="<?=$dados['medicamento']; ?>">
        </label>
        <label for="valor">
            <input type="number" name="valor" mim="0" step=".01" value="<?=$dados['valor']; ?>">
        </label>
        <label for="estoque">
            <input type="number" name="estoque" value="<?=$dados['estoque']; ?>">
        </label>
        <label for="categoria">
            <input type="text" name="categoria" value="<?=$dados['categoria']; ?>">
        </label>
        <label for="validade">
            <input type="date" name="validade" value="<?=$dados['validade']; ?>">
        </label>
        <button type="submit">Excluir</button>
    </form>
    <br>
    <a href="index.php">Início</a>
</body>
</html>