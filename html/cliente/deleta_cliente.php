<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/sistema-de-aluguel-de-automoveis/classes/cliente.php";

$cliente = new cliente();

$cliente->deletebyid($_GET['id']);


?>

<script> location.reload(); </script>;