<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_GET["id_cliente"];
    $id_pet = $_GET["id_pet"];
    $nome = $_POST["nome"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $tipo = $_POST["tipo"];
    $obs = $_POST["observacoes"];

    try {
        $sql = "UPDATE pets SET nome_pet = :nome, raca = :raca, idade = :idade, observacoes = :obs, foto = :foto WHERE ID_cliente = :id_cliente AND ID = :id_pet";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(":id_pet", $id_pet, PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":raca", $raca);
        $stmt->bindParam(":idade", $idade);
        $stmt->bindParam(":obs", $obs);
        $stmt->bindParam(":foto", $foto);
        $stmt->execute();
        
        header("Location: mostrar_pets.php?id_cliente=$id_cliente");
        exit();
        
    } catch (PDOException $e) {
        header("Location: editar_pets.php?mensagem=Erro ao editar pet: {$e->getMessage()}");
        exit();
    }
}

?>