<?php
session_start();
require "conexao.php";

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpfAntigo = $_GET["cpf"];
    $id_cliente = $_GET["id_cliente"];
    $nome = $_POST["nome"];
    $CPF = $_POST["CPF"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $endereco = $_POST["endereco"];

    try {
        if ($CPF == $cpfAntigo) {
            $sql = "UPDATE clientes SET nome_cliente = :nome, telefone = :telefone, email = :email, endereco = :endereco WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":endereco", $endereco);
            $stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
            $stmt->execute();
        }else {
            
            $sql = "UPDATE clientes SET nome_cliente = :nome, CPF = :CPF, telefone = :telefone, email = :email, endereco = :endereco WHERE ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":CPF", $CPF);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":endereco", $endereco);
            $stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
            $stmt->execute();
        }

        header("Location: cadastro_cliente.php");
        exit();
    } catch (PDOException $e) {
        $mensagem = "erro ao cadastrar o cliente: " . $e->getMessage();
        header("Location: cadastro_cliente.php?mensagem=$mensagem");
        exit();
    }
}
?>