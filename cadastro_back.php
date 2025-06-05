<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $CPF = $_POST["CPF"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];

    try {
        $sql = "INSERT INTO clientes(nome_cliente, CPF, telefone, email, endereco) VALUES(:nome, :CPF, :telefone, :email, :endereco)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":CPF", $CPF);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->execute();
    } catch (PDOException $e) {
        $mensagem = "erro ao cadastrar o cliente: " . $e->getMessage();
        header("Location: cadastro_cliente.php?mensagem=$mensagem");
        exit();
    }
}
?>