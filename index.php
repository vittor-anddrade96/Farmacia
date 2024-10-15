<?php

require 'conexao.php';

if (isset($_POST['acao'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE email = ':email' AND senha = ':senha'");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);

    $result = $pdo->query($sql);
    if ($result->rowCount() > 0) {
        header("Location:home.php");
    } else {
        echo 'Email ou Senha inválidos';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            background-image: linear-gradient(45deg, crimson, purple);
        }

        div {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: white;
        }

        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div>
        <h1>Login</h1>
        <h4>Farmácia Vida Saudável</h4>
        <input type="text" placeholder="Email" required />
        <br><br>
        <input type="password" placeholder="Senha" required />
        <br><br>
        <input type="submit" name="acao" value="Entrar" />
    </div>
</body>

</html>