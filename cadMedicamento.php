<?php

    require 'conexao.php';

    if(isset($_POST['acao'])){
        $medicamento = $_POST['medicamento'];
        $valor = $_POST['valor'];
        $estoque = $_POST['estoque'];
        $categoria = $_POST['categoria'];
        $validade = $_POST['validade'];

        if(empty($medicamento) || empty($valor) || empty($estoque) || empty($categoria) || empty($validade)){
            echo 'Por favor, preencha todos os campos!';
            exit;
        }

        try{
            $sql = $pdo->prepare("INSERT INTO medicamentos (medicamento,valor,estoque,categoria,validade) VALUES (:medicamento, :valor, :estoque, :categoria, :validade)");
            $sql->bindValue(':medicamento', $medicamento);
            $sql->bindValue(':valor', $valor);
            $sql->bindValue(':estoque', $estoque);
            $sql->bindValue(':categoria', $categoria);
            $sql->bindValue(':validade', $validade);

            $sql->execute();
            echo 'Medicamento cadastrado com sucesso!';
        }catch(PDOException $e){
            echo 'Erro ao cadastrar medicamento: '.$e->getMessage();
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Medicamentos</title>
</head>
<body>
    <form method="post">
        <small>Digite o nome do medicamento</small>
        <br>
        <input type="text" name="medicamento" required />
        <br>
        <small>Digite o valor do medicamento</small>
        <br>
        <input type="number" name="valor" mim="0" value="0" step=".01" required />
        <br>
        <small>Digite a quantidade em estoque</small>
        <br>
        <input type="number" name="estoque" required />
        <br>
        <small>Qual a categoria do medicamento?</small>
        <br>
        <input type="text" name="categoria" required />
        <br>
        <small>Qual a data de validade do medicamento?</small>
        <br>
        <input type="date" id="validade" name="validade" value="2024-12-01" mim="2024-12-01" max="2035-01-01" />
        <br><br>
        <input type="submit" name="acao" value="Enviar" />
        <input type="reset" value="Apagar Informações" />
    </form>
    <br>
    <a href="index.php">Início</a>
</body>
</html>