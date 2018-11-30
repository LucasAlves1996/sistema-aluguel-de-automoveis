<?php

	session_start();

	include "../classes/cliente.php";

	$cliente = new cliente();

	$cliente->setnome($_POST['nome']);
	$cliente->setdata($_POST['data']);
	$cliente->setcpf($_POST['cpf']);
	$cliente->settelefone($_POST['telefone']);
	$cliente->setendereco($_POST['rua']." ".$_POST['numero'].", ".$_POST['complemento']." - ".$_POST['cidade']." - ".$_POST['estado']." - ".$_POST['pais']);

	if($_POST['form'] == "cadastro"){
		$cliente->inserir_cliente();
	}else if($_POST['form'] == "update"){
		$cliente->update_cliente($_SESSION['id']);
	}

?>