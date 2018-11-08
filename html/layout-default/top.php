<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title></title>
	<!-- jquery-->
	<script
		src="https://code.jquery.com/jquery-3.3.1.min.js"> 	
	</script>
	
	<!-- CSS default -->
	<link rel="stylesheet" href="css/layout-default.css">
	
	<!-- BOOTSTRAP -->
	<!-- Latest compiled and minified CSS -->
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		
	</script>
	<!-- FINAL BOOTSTRAP -->

	<!-- JQUERY VALIDATION -->
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js">
		
	</script>
	<!-- Css Custom Rafael -->
	<link rel="stylesheet" href="css/layout_custom.css">


	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!--MASK JQUERY PLUGIN  -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


	<!-- jquery validate plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>

	<meta name="viewport" content="width=device-width">
	<meta charset="utf-8">
</head>
<body>
	<header>
		<div id="banner">
			<a href="./index.php">
				<div id="bannerImg">
					<img src="./imgs/logo.png" style="width:80px; height:38px; margin:24px 0px 0px 20px">
				</div>
			</a>
		</div>
	</header>
	<?php
		if(isset($_SESSION['user'])){
	?>
	<nav id="nav">
		<ul>
			<li><a href="index.php">Início</a></li>
			<li><a href="">Minha conta</a></li>
			<li><a href="./php/logout.php">Sair</a></li>
		</ul>
	</nav>
	<?php
		}
	?>
