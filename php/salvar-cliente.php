<?php

	include "../classes/cliente.php";

	$cliente = new cliente();

	$cliente->setnome($_POST['nome']);
	$cliente->setdata($_POST['data']);
	$cliente->setcpf($_POST['cpf']);
	$cliente->settelefone($_POST['telefone']);
	$cliente->setrua($_POST['rua']);
	$cliente->setnumero($_POST['numero']);
	$cliente->setcomplemento($_POST['complemento']);
	$cliente->setcidade($_POST['cidade']);
	$cliente->setestado($_POST['estado']);
	$cliente->setpais($_POST['pais']);

	$cliente->inserir_cliente();

?>