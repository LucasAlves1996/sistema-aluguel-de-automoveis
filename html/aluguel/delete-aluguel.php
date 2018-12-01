<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . "/aluguel/classes/aluguel.php";

$sol = new aluguel();


$sol->deletebyid($_GET['id']);


?>
