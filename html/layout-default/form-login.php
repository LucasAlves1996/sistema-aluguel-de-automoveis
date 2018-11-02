	<section id="secaoLogin">	
		<div id="formLogin">
			<h1>Login</h1>
			<div id="form">
				<form method="POST" action="./php/valida_login.php">
					<label>User:</label><br>
					<input type="text" name="user" id="user" placeholder="Digite o nome de usuário..." required><br>
					<label>Password:</label><br>
					<input type="password" name="password" id="password" placeholder="Digite a senha..." required><br>
					<input type="submit" value="Entrar" id="submit">
				</form>
			</div>
		</div>
	</section>