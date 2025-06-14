<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

$mensagem = $_GET["mensagem"] ?? "";

$id_cliente = $_GET["id_cliente"];
$sql = "SELECT * FROM pets WHERE ID_cliente = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id_cliente, PDO::PARAM_INT);
$stmt->execute();
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <a href="cadastro_cliente.php" class="btn btn-danger">Voltar</a>
    <?php if ($mensagem != ""):?>
        <p class="alert alert-warning m-2"><?= $mensagem;?></p>
    <?php endif;?>
    <?php if ($pets):?>
        <?php foreach ($pets as $pet):?>
            <div class="card">
                <img width="300px" src="<?= $pet['foto'];?>" alt="pet" class="card-top-image">
                <div class="card-body">
                    <h5 class="card-title"><?= $pet['nome_pet'];?></h5>
                    <p class="card-text"><?= $pet['raca'];?></p>
                    <p class="card-text"><?= $pet['idade'];?></p>
                    <p class="card-text"><?= $pet['tipo'];?></p>
                    <p class="card-text"><?= $pet["observacoes"]?></p>
                    <a href="editar_pet.php?id_cliente=<?=$id_cliente;?>&id_pet=<?= $pet["ID"];?>" class="btn btn-primary">Editar</a>
                    <a href="excluir_pet_back.php?pet=<?= $pet["ID"];?>&id_cliente=<?= $id_cliente?>" class="btn btn-danger">Excluir</a>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous">
</script>
</body>
</html>