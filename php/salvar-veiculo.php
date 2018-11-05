<?php 
require_once "../classes/automovel.php";

$carro = new automovel();


if($_POST['edt'] == 0 ){


$data_formatada = date('Y-m-d', strtotime($_POST['data']));
$carro->setData($data_formatada);

$diaria_carro = str_replace( ',', '.', $_POST['diaria']);
$carro->setValor_diaria($diaria_carro);

$valor_km_carro = str_replace( ',', '.', $_POST['valor_quilometragem']);
$carro->setValor_km($valor_km_carro);

$carro->setNumero_chassi($_POST['chassi']);
$carro->setCor_carro($_POST['cor']);

$carro->setPlaca_carro($_POST['placa']);
$carro->setQuilometragem_inicial($_POST['quilometragem']);

if($_POST['outra_marca'] != ""){	
	
	$carro->setMarca($_POST['outra_marca']);
	$carro->setModelo($_POST['outro_modelo']);
	$carro->setDescricao_modelo($_POST['desc']);

	$modelo_novo = $carro->MarcaModelo();

	$carro->setModelo($modelo_novo);

	$carro->insere();

} else if ($_POST['outra_marca'] == "" && $_POST['outro_modelo'] != "") {
	
	$carro->setMarca($_POST['marca']);
	$carro->setModelo($_POST['outro_modelo']);
	$carro->setDescricao_modelo($_POST['desc']);

	$carro->insereModelo();
} 

else {

$carro->setModelo($_POST['modelo']);

$carro->insere();

}
		//EDIÇÃO
} else if($_POST['edt'] == 1 ) {

		$data_formatada = date('Y-m-d', strtotime($_POST['edt_data']));
		$carro->setData($data_formatada);
		
		$diaria_carro = str_replace( ',', '.', $_POST['edt_diaria']);
		$carro->setValor_diaria($diaria_carro);
		
		$valor_km_carro = str_replace( ',', '.', $_POST['edt_valor_quilometragem']);
		$carro->setValor_km($valor_km_carro);
		
		$carro->setNumero_chassi($_POST['edt_chassi']);
		$carro->setCor_carro($_POST['edt_cor']);
		
		$carro->setPlaca_carro($_POST['edt_placa']);
		$carro->setQuilometragem_inicial($_POST['edt_quilometragem']);
		$carro->setStatus($_POST['edt_status']);


	if($_POST['edt_outra_marca'] != ""){	
	
	$carro->setMarca($_POST['edt_outra_marca']);
	$carro->setModelo($_POST['edt_outro_modelo']);
	$carro->setDescricao_modelo($_POST['edt_desc']);

	$modelo_novo = $carro->MarcaModelo();

	$carro->setModelo($modelo_novo);

	$carro->UpdateVeiculo($_POST['id_edita']);
	

} else if ($_POST['edt_outra_marca'] == "" && $_POST['edt_outro_modelo'] != "") {
	echo "entrou aqui";
	$carro->setMarca($_POST['edt_marca']);
	$carro->setModelo($_POST['edt_outro_modelo']);
	$carro->setDescricao_modelo($_POST['edt_desc']);
	$carro->UpdateVeiculo($_POST['id_edita']);
	
} 

else {

$carro->setModelo($_POST['edt_modelo']);

$carro->UpdateVeiculo($_POST['id_edita']);

	}
	
} // Final ifzao


?>