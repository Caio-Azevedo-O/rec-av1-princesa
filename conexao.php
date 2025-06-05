<?php
$host = "localhost";
$banco = "sistemapets";

$dsn = "mysql:hots=$host;dbname=$banco";

$usuario = "root";
$senha = "";
try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "erro ao conectar o banco de dados" . $e->getMessage();
    exit();
}
?>