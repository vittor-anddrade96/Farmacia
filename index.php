<?php

    require 'conexao.php';    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $sql = $pdo->prepare("SELECT * FROM funcionarios WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();

        $user = $sql->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($senha, $user['senha'])){
            session_start();
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            header("Location: home.php");
            exit;
        }else{
            echo 'Email ou Senha inválidos.';
        }
    }
    ?>
    
    <!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <form method="post" action=""> 

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required> 

    <br>
    <button type="submit">Entrar</button>
  </form> 

</body>
</html>