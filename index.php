<?php

    if($_SERVER["REQUEST METHOD"] == "POST"){
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && password_verify($senha, $user['senha'])){
            session_start();
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];
            header("Location: home.php");
            exit;
        }else{
            echo 'Email ou Senha '
        }
    }