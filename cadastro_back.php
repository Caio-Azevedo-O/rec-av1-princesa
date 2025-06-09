<?php
session_start();
require "conexao.php";

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $CPF = $_POST["CPF"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];

    try {
        $sql = "INSERT INTO clientes(nome_cliente, CPF, telefone, email, endereco, ID_usuario) VALUES(:nome, :CPF, :telefone, :email, :endereco, :id)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":CPF", $CPF);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":id", $_SESSION["ID_usuario"], PDO::PARAM_INT);
        $stmt->execute();
        header("Location: cadastro_cliente.php");
        exit();
    } catch (PDOException $e) {
        $mensagem = "erro ao cadastrar o cliente: " . $e->getMessage();
        header("Location: cadastro_cliente.php?mensagem=$mensagem");
        exit();
    }
}
?>