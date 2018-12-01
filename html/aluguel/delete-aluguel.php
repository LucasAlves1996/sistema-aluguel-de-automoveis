<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . "/sistema-de-aluguel-de-automoveis/classes/aluguel.php";

$sol = new aluguel();


$sol->deletebyid($_GET['id']);


?>
