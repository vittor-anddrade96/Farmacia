<?php

    require 'conexao.php';

    if(isset($_POST['acao'])){
    $medicamento = $_POST['medicamento'];
    $valor = $_POST['valor'];
    $estoque = $_POST['estoque'];
    $categoria = $_POST['categoria'];
    $validade = $_POST['validade'];

    $sql = $pdo->prepare("UPDATE medicamentos SET medicamento = :medicamento, valor = :valor, estoque = :estoque, categoria = :categoria, validade = :validade WHERE id = $id");
    $sql->bindValue(':medicamento', $medicamanto);
    $sql->bindValue(':valor', $valor);
    $sql->bindValue(':estoque', $estoque);
    $sql->bindValue(':categoria', $categoria);
    $sql->bindValue(':validade', $validade);

    $sql->execute();
    header("Location:index.php");
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

        if($sql->rowCount() > 0){
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }else{
            header("location:index.php");
            exit;
        }
    ?>

    <form action="editMedicamento.php" method="post">
        <input type="hiden" name="id" id="id" value="<?=$dados['id']; ?>">
    </form>
</body>
</html>