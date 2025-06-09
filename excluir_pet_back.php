<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

$id_cliente = $_GET["id_cliente"];
$id_pet = $_GET["pet"];
try {
    $sql = "DELETE FROM pets WHERE ID = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id_pet, PDO::PARAM_INT);
    $stmt->execute();
    header("Location: mostrar_pets.php?id_cliente=$id_cliente");
    exit();
} catch (PDOException $e) {
    header("Location: mostrar_pets.php?id_cliente=$id_cliente&mensagem={$e->getMessage()}");
    exit();
}


?>