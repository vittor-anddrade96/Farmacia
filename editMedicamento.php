<?php

    require 'conexao.php';

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