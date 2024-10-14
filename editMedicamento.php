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
        echo 'Medicamento alterado com Sucesso!';

        if($sql->rowCount() > 0){
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            header("location:index.php");
            exit;
        }
    ?>

    <form action="editando.php" method="post">
        <input type="hiden" name="id" id="id" value="<?=$dados['id']; ?>">
        <label for="Medicamento">
            Medicamento <input type="text" name="medicamento" value="<?=$dados['medicamento']; ?>">
        </label>
        <label for="valor">
            Valor <input type="number" name="valor" mim="0" step=".01" value="<?=$dados['valor']; ?>">
        </label>
        <label for="estoque">
            Estoque <input type="number" name="estoque" value="<?=$dados['estoque']; ?>">
        </label>
        <label for="categoria">
            Categoria <input type="text" name="categoria" value="<?=$dados['categoria']; ?>">
        </label>
        <label for="validade">
            Validade <input type="date" name="validade" value="<?=$dados['validade']; ?>">
        </label>
        <br>
        <button type="submit">Enviar</button>
    </form>
    <br>
    <a href="index.php">Início</a>
</body>
</html>