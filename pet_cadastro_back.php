<?php
require "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $raca = $_POST["raca"];
    $idade = $_POST["idade"];
    $tipo = $_POST["tipo"];
    $observacoes = $_POST["observacoes"];
    $foto = $_POST["foto"];
    $cliente = $_SESSION["id_cliente"];

    try {
        $sql = "INSERT INTO pets(nome_pet, raca, idade, tipo, observacoes, foto, ID_cliente) VALUES(:nome, :raca, :idade, :tipo, :observacoes, :foto, :cliente)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":raca", $raca);
        $stmt->bindParam(":idade", $idade);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":observacoes", $observacoes);
        $stmt->bindParam(":foto", $foto);
        $stmt->bindParam(":cliente", $cliente);
        $stmt->execute();
    } catch (PDOException $e) {
        $mensagem = "erro ao cadastrar o pet: " . $e->getMessage();
        header("Location: pet_cadastro.php?mensagem=$mensagem");
        exit();
    }
}
?>