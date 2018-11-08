<?php

	session_start();

	if(isset($_SESSION['user'])){
		header('Location: inicio.php');
	}

	if(isset($_SESSION['erroLogin'])){
		echo "
			<div class='errorMsg'>".$_SESSION['erroLogin']."</div>
		";
		unset($_SESSION['erroLogin']);
	}

	if(isset($_SESSION['acessoSemLogin'])){
		echo "
			<div class='errorMsg'>".$_SESSION['acessoSemLogin']."</div>
		";
		unset($_SESSION['acessoSemLogin']);
	}

	include "html/layout-default/top.php";

	include "html/layout-default/form-login.php";

?>