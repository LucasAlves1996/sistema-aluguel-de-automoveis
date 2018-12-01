<?php 
require_once "../classes/aluguel.php";

$alg = new aluguel();


/**CLIENTE AINDA NÃO FOI FEITO.... **/

	


	$sol = $alg->buscaSol($_POST['sol']);


	if( $sol == true){
	$data_inicio = $alg->getDataInicio();

	$data_final =  date('Y-m-d', strtotime($_POST['data_entrega']));

	if( ($data_final >= $data_inicio) == true){

		$alg->setIdAluguel($_POST['sol']);
		$alg->setDataentrega($data_final);
 		$alg->setIdMtdPagamento($_POST['pagamento']);
 		$alg->setStatusAluguel(2);
 		$alg->setStatusPagamento(1);
 		$alg->setKmFinal($_POST['km_final']);
 	
 		$alg->finalizaAluguel();
	} else{
		echo "A data informada é menor que a data de inicio";
	}

	
	} else{

		echo "Solicitação não encontrada";
	
	}
 

	



?>