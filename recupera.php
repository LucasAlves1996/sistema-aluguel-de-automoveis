<html>
<body>
<h1>Esqueci minha senha</h1>
<form method="post">
  <label for="login"></label>
  <input type="text" name="login" id="login" placeholder ="Digite seu login" required />
  <input type="submit" value="Gerar nova senha"  />
 <br><br> <a href="javascript:history.back()">Voltar</a>
</form><br><br>

<?php
  if(!empty($_POST['login']) ){
	   $link =  mysqli_connect("localhost", "root", "", "banco_aluguel"); 
	   $usuario = $_POST['login'];
	   $pesquisa = mysqli_query($link,"SELECT * FROM cliente WHERE cliente.nome = '$usuario'");
	   $result = mysqli_num_rows($pesquisa);
		if($result != 0){
			 $chave = rand(100,999);
			 $conf = mysqli_query($link,"UPDATE cliente SET senha = '$chave' WHERE cliente.nome = '$usuario'");
			echo "Sua nova senha é: ".$chave;
		}else{
			echo 'Este login não consta na nossa base de dados<br><br>';
		}
  }
?>
</body>
</html>
