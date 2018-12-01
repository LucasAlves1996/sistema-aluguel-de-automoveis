<?php 
require_once "../classes/aluguel.php";

$alg = new aluguel();


/**CLIENTE AINDA NÃO FOI FEITO.... **/



if($_POST['edt'] == 0 ){

$data_formatada_inicio = $_POST['data_inicio'];
$data_formatada_final = $_POST['data_final'];


	//Precisava criar um metodo na classe cliente, mas como não estava pronta, meti um gohorse

	$id_cliente = $alg->buscaCliente($_POST['cpf']);
	
	if($id_cliente != false){
	$alg->setIdCliente($id_cliente);
	
	
	
	$alg->setDataInicio($data_formatada_inicio);


	
	$alg->setDataFinal($data_formatada_final);
	
	
	$alg->setIdVeiculo($_POST['id_veiculo']);
	$alg->setKmInicial($_POST['km_inicial']);
	$alg->setStatusPagamento(0);
	$alg->setStatusAluguel(1);
	
	$alg->insere();
	} else{
		echo "CPF Não cadastrado no sistema";
	}
	


} else if($_POST['edt'] == 1 ) {
	$data_formatada_inicio = $_POST['edt_data_inicio'];
	$data_formatada_final = $_POST['edt_data_final'];
	
	$status = $_POST['status'];
		
		$alg->setDataFinal($data_formatada_final);

		if($status == 2){
			$alg->setStatusAluguel(2);
		} else{
			$alg->setStatusAluguel(1);
		}
		
		
		$alg->AlteraAluguel($_POST['id']);
		
 
	

	//aqui edita
} else if($_POST['baixa'] == 1){

	$sol = $alg->buscaSol($_POST['sol']);


	if( $sol == $_POST['sol']){

	$alg->setIdAluguel($_POST['sol']);
	$alg->setDataentrega($_POST['data_entrega']);
 	$alg->setIdMtdPagamento($_POST['pagamento']);
 	$alg->setStatusAluguel(2);
 	$alg->setStatusPagamento(1);
 	$alg->setKmFinal($_POST['km_final']);
 	
 	$alg->finalizaAluguel();
	} else{
		echo "erro";
		
	}
	 
}