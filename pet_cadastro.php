<?php
require "conexao.php";
session_start();
$_SESSION["id_cliente"] = $_GET["id_cliente"];

if (!$_SESSION["logado"]) {
    header("Location: login.php");
    exit();
}
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
    <form action="pet_cadastro_back.php" method="POST">
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
        <input type="numeric" step="1" class="form-control" name="idade" id="idade" placeholder="Idade">
        <input type="text" class="form-control" name="raca" id="raca" placeholder="Raça">
        <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Tipo">
        <input type="text" class="form-control" name="observacoes" id="observacoes" placeholder="Obervações">
        <input type="text" class="form-control" name="foto" id="foto" placeholder="Foto">
        <button type="submit" class="btn btn-success">Registrar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" 
    crossorigin="anonymous"></script>
</body>
</html>