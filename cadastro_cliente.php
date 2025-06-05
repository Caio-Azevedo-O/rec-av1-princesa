<?php
require "conexao.php";

$mensagem = $_GET["mensagem"] ?? "";

$sql = "SELECT * FROM clientes";
$stmt = $pdo->prepare($sql);
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
    <?php if ($mensagem != ""):?>
        <p class="alert alert-warning"><?= $mensagem;?></p>
    <?php endif;?>
    <form action="cadastro_back.php" method="POST" class="bg-dark rounded-5">
        <input type="text" require name="nome" id="nome" placeholder="Nome">
        <input type="text" require name="CPF" id="CPF" placeholder="CPF">
        <input type="text" name="telefone" id="telefone" placeholder="Telefone">
        <input type="text" name="email" id="email" placeholder="Email">
        <input type="text" name="endereco" id="endereco" placeholder="Endereço">
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    <?php foreach($clientes as $cliente):?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $cliente["nome_cliente"];?></h5>
            <h6 class="card-text"><?= $cliente["CPF"];?></h6>
            <p class="card-text"><?= $cliente["telefone"];?></p>
            <p class="card-text"><?= $cliente["email"];?></p>
            <a href="mostrar_pet.php?id_cliente=<?= $cliente["ID"];?>" class="card-link">Pets</a>
            <a href="pet_cadastro.php?id_cliente=<?= $cliente['ID'];?>" class="btn btn-success">Cadastrar pet</a>
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