<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

$id_cliente = $_GET["id_cliente"];
try {
    $sql = "DELETE FROM clientes WHERE ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: cadastro_cliente.php");
    exit();
} catch (PDOException $e) {
    header("Location: cadastro_cliente.php?mensagem={$e->getMessage()}");
    exit();
}

?>