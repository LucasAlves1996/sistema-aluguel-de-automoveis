<?php

	include "../classes/banco.php";

	$user = $_POST['user'];
	$pass = $_POST['password'];

	$banco = new banco();

	$stmt = $banco->prepare("SELECT nome_funcionario, senha_funcionario FROM funcionario WHERE nome_funcionario = '$user'");

	$stmt->execute();

	$res = $stmt->fetchALL(PDO::FETCH_ASSOC);

	if(isset($res[0]['nome_funcionario']) && $pass == $res[0]['senha_funcionario']){
		session_start();
		$_SESSION['user'] = $res[0]['nome_funcionario'];
		header("Location: ../inicio.php");
	}else if(isset($res[0]['nome_funcionario']) && $pass != $res[0]['senha_funcionario']){
		session_start();
		$_SESSION['erroLogin'] = "Senha incorreta!";
		header("Location: ../index.php");
	}else{
		session_start();
		$_SESSION['erroLogin'] = "Nome de usuário incorreto!";
		header("Location: ../index.php");
	}

?>