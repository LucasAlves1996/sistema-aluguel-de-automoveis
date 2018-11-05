<?php
include ("cliente.php");
$cliente = new cliente();

	if(isset($_POST['enviar_form'])){
		$cliente->inserir_cliente();
		  echo "<script>('Dados cadastrados com sucesso!')</script>";
		} else{
		echo  "<script>('Erro ao cadastrar Dados!')</script>";
	}
   

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body>
  <div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
      <div class="modal-header">
<h2 class="modal-title" id="exampleModalLongTitle">Cadastro cliente</h2>
    <form method="POST">
        <div class="row">					
			<div class="col-md-12">
				<div class="form-group">
				<br><label>Nome</label><br>							
				<input type="text" name="nome" class="form-control" placeholder="Digite o nome do cliente" >
			    </div>
            </div>	
            <div class="col-md-12">
				<div class="form-group">
				<br><label>Email</label><br>							
				<input type="email" name="email" class="form-control" placeholder="Digite o email do cliente" >
			    </div>
            </div>				
			<div class="form-group">
				<div class="col-md-6">
				<label>CPF</label>
				<input type="text" name="cpf"class="form-control" placeholder="Digite CPF do cliente" >
				</div>
			</div>
			<div class="form-group">
			<div class="col-md-6">
				<label>Telefone</label>
				<input type="text" name="telefone" class="form-control" placeholder="Digite o telefone do cliente" >
			</div>
			</div>			
			<div class="form-group">
				<div class="col-md-6">
					<label>Rua</label>
					<input type="text"  name="rua" class="form-control"  placeholder="Digite o nome da rua ">
				</div>
			</div>				
			<div class="form-group">
			<div class="col-md-3">
				<label >Número</label>
				<input type="text"  name="numero" class="form-control"   placeholder="n°">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<label>Complemento</label>
				<input type="text"  name="complemento" class="form-control" >
				</div>
		    </div>
			<div class="form-group">
				<div class="col-md-3">
					<label>País</label>
					<input type="text" value="BR" name="pais" class="form-control" >;
				</div>
			</div>
			<div class="form-group" >
				<div class="col-md-3">
					<label>Estado</label>
					<select type="text" id="estados"  name="estados" class="form-control">;						
						<option value=""></option>
					</select>							
				</div>
			</div>	
			<div class="form-group">
				<div class="col-md-3">	
					<label>Cidade</label>
					<select type="text" id="cidades"  name="cidades" class="form-control">;						
						<option value=""></option>
					</select>
				</div>
			</div>		
			<div class="form-group">
			    <div class="col-md-3">	
					<label>Data cadastro</label>
					<input type="date"  placeholder="" required="required" maxlength="10" name="data" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2018-08-01" max="2054-01-01"class="form-control" /><br><br>
				</div>
			</div>
 			
                <div class="modal-footer">
				<button type="submit" name="enviar_form" class="registerbtn btn btn-primary">Cadastrar</button>
			</div>			
		</div>		<!-- final da row -->

		
	</form>

</body>

</html>


<script type="text/javascript">	
			$(document).ready(function () {
					
						$.getJSON('estados_cidades.json', function (data) {

							var items = [];
							var options = '<option value="">escolha um estado</option>';	

							$.each(data, function (key, val) {
								options += '<option value="' + val.nome + '">' + val.nome + '</option>';
							});					
							$("#estados").html(options);				
							
							$("#estados").change(function () {				
							
								var options_cidades = '';
								var str = "";					
								
								$("#estados option:selected").each(function () {
									str += $(this).text();
								});
								
								$.each(data, function (key, val) {
									if(val.nome == str) {							
										$.each(val.cidades, function (key_city, val_city) {
											options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
										});							
									}
								});

								$("#cidades").html(options_cidades);
								
							}).change();		
						
						});
					
					});
		
	</script>		