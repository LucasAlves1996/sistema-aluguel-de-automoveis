<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . "/aluguel/classes/automovel.php";

$carro = new automovel();

$carro->deletebyid($_GET['id']);


?>

<script> location.reload(); </script>;