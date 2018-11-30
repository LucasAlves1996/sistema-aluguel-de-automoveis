<?php

	session_start();

	require_once $_SERVER['DOCUMENT_ROOT'] . "/sistema-de-aluguel-de-automoveis/classes/cliente.php";

	$_SESSION['id'] = $_GET['id'];

	/*$cliente = new cliente();

	$atualiza_cliente = $cliente->selectbyid($_GET['id']);

	$nome = $atualiza_cliente[0]['nome_cliente'];
    $data = $atualiza_cliente[0]['data_cadastro_cliente'];
    $cpf = $atualiza_cliente[0]['cpf_cliente'];
    $telefone = $atualiza_cliente[0]['telefone_cliente'];
*/
?>
<form method="POST">
        <div class="row">					
			<div class="col-md-12">
				<div class="form-group">
				<label>Nome</label>							
				<input type="text"  id="nome" name="nome" class="form-control">
			    </div>
			</div>
			<div class="form-group">
				<div class="col-md-12 mt-4">
				<label>CPF</label>
				<input type="text"  id="cpf" name="cpf"class="form-control">
				</div>
			</div>
			<div class="form-group">
			<div class="col-md-12 mt-4">
				<label>Telefone</label>
				<input type="text"  id="telefone" name="telefone" class="form-control">
			</div>
			</div>			
			<div class="form-group">
				<div class="col-md-12">
					<label>Rua</label>
					<input type="text" id="rua"  name="rua" class="form-control">
				</div>
			</div>				
			<div class="form-group">
				<div class="col-md-6">
					<label >Número</label>
					<input type="text" id="numero" name="numero" class="form-control">
				</div>
			</div>
			<div class="form-group">
			<div class="col-md-6">			
				<label>Complemento</label>
				<input type="text"  id="complemento" name="complemento" class="form-control">
			</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<label>País</label>
					<input type="text" id="pais" value="Brasil" name="pais" class="form-control">
				</div>
			</div>
			<div class="col-md-12 row">
				<div class="form-group" >
					<div class="col-md-12">
						<label>Estado</label>
						<select type="text" id="estado"  name="estados" class="form-control">					
							<option value=""></option>
						</select>							
					</div>
				</div>	
				<div class="form-group">
					<div class="col-md-12">	
						<label>Cidade</label>
						<select type="text" id="cidade"  name="cidades" class="form-control" >						
							<option value=""></option>
						</select>
					</div>
				</div>
			</div>
			
			<div class="form-group">
			    <div class="col-md-12">	
					<label>Data do cadastro</label>
					<input type="date"  id="data" maxlength="10" name="data" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" min="2018-08-01" max="2054-01-01"class="form-control" />
				</div>
			</div>
 			
        </div>   
		
	</form>

	<script type="text/javascript">	
		$(document).ready(function () {
				
			$.getJSON('estados_cidades.json', function (data) {

				var items = [];
				var options = '<option value=""></option>';	

				$.each(data, function (key, val) {
					options += '<option value="' + val.nome + '">' + val.nome + '</option>';
				});					

				$("#estado").html(options);				
							
				$("#estado").change(function () {				
							
					var options_cidades = '';
					var str = "";					
								
					$("#estado option:selected").each(function () {
						str += $(this).text();
					});
								
					$.each(data, function (key, val) {
						if(val.nome == str) {							
							$.each(val.cidades, function (key_city, val_city) {
								options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
							});							
						}
					});

					$("#cidade").html(options_cidades);
								
				}).change();		
						
			});
					
		});
	</script>