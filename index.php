<?php
session_start(); // Inicia a sessão

require 'conexao.php';

if (isset($_POST['acao'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta que também busca o campo 'role' para saber se é admin ou atendente
    $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);
    
    $sql->execute();
    
    // Verifica se encontrou algum usuário
    if ($sql->rowCount() > 0) {
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // Armazena as informações de login na sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role']; // Aqui é onde armazenamos o papel (admin ou atendente)

        // Verifica se o usuário é administrador ou atendente
        if ($user['role'] === 'admin') {
            header("Location: home_admin.php"); // Página para administradores
        } else {
            header("Location: home_atendente.php"); // Página para atendentes
        }
        exit(); 
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
        <form method="post">
            <input type="text" name="email" placeholder="Email" required />
            <br><br>
            <input type="password" name="senha" placeholder="Senha" required />
            <br><br>
            <input type="submit" name="acao" value="Entrar" />
        </form>
    </div>
</body>

</html>
