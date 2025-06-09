<?php
require "conexao.php";
session_start();
$_SESSION["logado"] = false;

session_unset();
session_destroy();

header("Location: login.php");
exit();

?>