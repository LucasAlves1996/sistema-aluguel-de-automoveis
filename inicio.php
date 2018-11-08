<?php

	session_start();

	if(!isset($_SESSION['user'])){
		$_SESSION['acessoSemLogin'] = "Para acessar esta página você deve fazer login!";
		header('Location: index.php');
	}

	include "html/layout-default/top.php";

	include "html/layout-default/menu.php";

?>