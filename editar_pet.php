<?php
require "conexao.php";
session_start();

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}

$mensagem = $_GET["mensagem"] ?? "";

$id_cliente = $_GET["id_cliente"];
$id_pet = $_GET["id_pet"];
$sql = "SELECT * FROM pets WHERE ID_cliente = :id_cliente AND ID = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
$stmt->bindParam(":id", $id_pet, PDO::PARAM_INT);
$stmt->execute();
$pet = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <div class="card">
        <div class="card-body">
            <form action="editar_pet_back.php?id_cliente=<?= $id_cliente?>&id_pet=<?= $id_pet?>" method="POST">
                <h5 class="card-title"><input class="form-control" name="nome" id="nome" type="text" value="<?= $pet['nome_pet'];?>"></h5>
                <p class="card-text"><input class="form-control" name="raca" id="raca" type="text" value="<?= $pet['raca'];?>"></p>
                <p class="card-text"><input class="form-control" name="idade" id="idade" type="text" value="<?= $pet['idade'];?>"></p>
                <p class="card-text"><input class="form-control" name="tipo" id="tipo" type="text" value="<?= $pet['tipo'];?>"></p>
                <p class="card-text"><input class="form-control" name="observacoes" id="observacoes" type="text" value="<?= $pet['observacoes'];?>"></p>
                <p class="card-text"><input class="form-control" name="foto" id="foto" type="text" value="<?= $pet['foto'];?>"></p>
                <button class="btn btn-success" type="submit">Editar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous">
</script>
</body>
</html>