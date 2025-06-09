<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

$id_cliente = $_GET["id_cliente"];

$sql = "SELECT * FROM clientes WHERE ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
$stmt->execute();

$cliente = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
    crossorigin="anonymous">
</head>
<body>
    <a href="cadastro_cliente.php" class="btn btn-danger">Voltar</a>
    <form action="editar_cliente_back.php?cpf=<?= $cliente["CPF"]?>&id_cliente=<?= $id_cliente?>" method="POST" class="bg-dark m-3 p-3 rounded-4">
        <input class="form-control m-2" value="<?= $cliente["nome_cliente"];?>" type="text" require name="nome" id="nome" placeholder="Nome">
        <input class="form-control m-2" value="<?= $cliente["CPF"];?>" type="text" require name="CPF" id="CPF" placeholder="Nome">
        <input class="form-control m-2" value="<?= $cliente["telefone"];?>" type="text" name="telefone" id="telefone" placeholder="Telefone">
        <input class="form-control m-2" value="<?= $cliente["email"];?>" type="text" name="email" id="email" placeholder="Email">
        <input class="form-control m-2" value="<?= $cliente["endereco"];?>" type="text" name="endereco" id="endereco" placeholder="Endereço">
        <button type="submit" class="btn btn-success m-2">Enviar</button>
    </form>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous">
    </script>
</body>
</html>