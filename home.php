<?php

require 'conexao.php';
$sql = $pdo->query("SELECT * FROM medicamentos");

$lista = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmácia Vida Saudável</title>
</head>

<body>
    <header>
        <div id="elemento-pai">
            <a href="index.php"><img id="logo" src="imagens/farmacia.png" width="150"></a>
        </div>
        <div id="login">
            <small><a href="Login.php">Login</a></small>
        </div>
        <style>
            body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            }

            .login {
                text-align: right;
                margin: 5px auto;
                padding-right: 10px;
            }

            .login>small a {
                position: right;
                text-decoration: none;
                color: crimson;
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                border-left: 1px solid crimson;
                padding-left: 5px;
            }

            .menu {
                width: 900px;
                text-align: center;
                margin: 5px auto;
                padding-left: 5px;
                padding-right: 5px;
                padding-top: 5px;
                padding-bottom: 5px;
            }

            .menu>a {
                text-decoration: none;
                color: crimson;
                font-size: 20px;
                margin: 0 20px;
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
                font-weight: bold;
            }

            h3 {
                color: crimson;
                font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            }
            tr {
                color: crimson;
            }
        </style>
    </header>
    <nav>
        <div class="menu">
            <a href="cadMedicamento.php">Cadastro de Medicamentos</a>
            <hr>
        </div>
    </nav>
    <h3>MEDICAMENTOS EM ESTOQUE</h3>
    <table border="1px">
        <tr>
            <th>ID</th>
            <th>MEDICAMENTO</th>
            <th>VALOR</th>
            <th>ESTOQUE</th>
            <th>CATEGORIA</th>
            <th>VALIDADE</th>
        </tr>
        <?php foreach ($lista as $a): ?>
            <tr>
                <td><?php echo $a['id']; ?> </td>
                <td><?php echo $a['medicamento']; ?> </td>
                <td><?php echo $a['valor']; ?> </td>
                <td><?php echo $a['estoque']; ?> </td>
                <td><?php echo $a['categoria']; ?> </td>
                <td><?php echo $a['validade']; ?> </td>
                <td>
                    <a href="editMedicamento.php?id=<?= $a['id']; ?>">[Editar]</a>
                    <a href="excluirMedicamento.php?id=<?= $a['id']; ?>">[Excluir]</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="vender.php">Iniciar Venda</a>
</body>

</html>