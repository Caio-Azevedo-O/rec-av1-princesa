<?php
session_start();
require "conexao.php";

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

$mensagem = $_GET["mensagem"] ?? "";

$sql = "SELECT * FROM clientes WHERE ID_usuario = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $_SESSION["ID_usuario"], PDO::PARAM_INT);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <a href="logoff.php" class="bn btn-danger">Sair</a>
    <?php if ($mensagem != ""):?>
        <p class="alert alert-warning m-2"><?= $mensagem;?></p>
    <?php endif;?>
    <form action="cadastro_back.php" method="POST" class="bg-dark m-3 p-3 rounded-4">
        <input class="form-control m-2" type="text" require name="nome" id="nome" placeholder="Nome">
        <input class="form-control m-2" type="text" require name="CPF" id="CPF" placeholder="CPF">
        <input class="form-control m-2" type="text" name="telefone" id="telefone" placeholder="Telefone">
        <input class="form-control m-2" type="text" name="email" id="email" placeholder="Email">
        <input class="form-control m-2" type="text" name="endereco" id="endereco" placeholder="Endereço">
        <button type="submit" class="btn btn-success m-2">Enviar</button>
    </form>
    <?php foreach($clientes as $cliente):?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $cliente["nome_cliente"];?></h5>
            <h6 class="card-text"><?= $cliente["CPF"];?></h6>
            <p class="card-text"><?= $cliente["telefone"];?></p>
            <p class="card-text"><?= $cliente["email"];?></p>
            <a href="mostrar_pets.php?id_cliente=<?= $cliente["ID"];?>" class="card-link">Pets</a><br>
            <a href="pet_cadastro.php?id_cliente=<?= $cliente['ID'];?>" class="btn btn-success">Cadastrar pet</a><br>
            <a href="editar_cliente.php?id_cliente=<?= $cliente["ID"];?>" class="btn btn-primary">Editar Cliente</a>
            <a href="excluir_cliente.php?id_cliente=<?= $cliente["ID"];?>" class="btn btn-danger">Excluir Cliente</a>
        </div>
    </div>
    <?php endforeach;?>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous">
    </script>
</body>
</html>