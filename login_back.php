<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE usuario = :user";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":user", $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if ($usuario == $user["usuario"] && $senha = $user["senha"]) {
            $_SESSION["logado"] = true;
            header("Location: cadastro_cliente.php");
            exit();
        }
        else{
            echo "Nome de usuario ou senha errados";
        }
    }
    else{
        echo "usuario não existe";
    }
}
?>