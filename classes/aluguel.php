<?php

require ("banco.php");

class aluguel{

    private $idAluguel;
    private $cliente;
    private $data_inicio;
    private $data_final;
    private $km_inicial;
    private $km_final; 
    private $idVeiculo;
    private $status_aluguel; 
    private $status_pagamento;
    private $valor_total;
    private $idMtd_pagamento;
    private $banco;
    private $data_entrega;
  
	public function __construct(){

		$this->banco = new banco();
		
	}	

	public function getDataEntrega()
	{
	    return $this->data_entrega;
	}
	
	public function setDataEntrega($dataEntrega)
	{
	    return $this->data_entrega = $dataEntrega;
	}
	public function getIdCliente() {
        return $this->cliente;
    }

    public function setIdCliente($cliente) {
        $this->cliente = $cliente;
    }

	public function getStatusPagamento() {
        return $this->status_pagamento;
    }

    public function setStatusPagamento($status_pagamento) {
        $this->status_pagamento = $status_pagamento;
    }


    public function getIdAluguel() {
        return $this->idAluguel;
    }

    public function setIdAluguel($idAluguel) {
        $this->idAluguel = $idAluguel;
    }

    

    public function getDataInicio() {
        return $this->data_inicio;
    }

   
    public function setDataInicio($dataInicio) {
        $this->data_inicio = $dataInicio;
    }

  
    public function getDataFinal() {
        return $this->data_final;
    }

   
    public function setDataFinal($dataFinal) {
        $this->data_final = $dataFinal;
    }

 
    public function getKmInicial() {
        return $this->km_inicial;
    }

 
    public function setKmInicial($kmInicial) {
        $this->km_inicial = $kmInicial;
    }

  
    public function getKmFinal() {
        return $this->km_final;
    }

  
    public function setKmFinal($kmFinal) {
        $this->km_final = $kmFinal;
    }

  
    public function getIdVeiculo() {
        return $this->idVeiculo;
    }

   

    public function setIdVeiculo($idVeiculo) {
        $this->idVeiculo = $idVeiculo;
    }


    public function getStatusAluguel() {
        return $this->status_aluguel;
    }


    public function setStatusAluguel($statusAluguel) {
        $this->status_aluguel = $statusAluguel;
    }

 
    public function getValorTotal() {
        return $this->valor_total;
    }


    public function setValorTotal($valorTotal) {
        $this->valor_total = $valorTotal;
    }

 
    public function getIdMtdPagamento() {
        return $this->idMtd_pagamento;
    }

    
    public function setIdMtdPagamento($idMtdPagamento) {
        $this->idMtd_pagamento = $idMtdPagamento;
    }

    public function listaVeic(){

    	$stmt = $this->banco->prepare("
   			 SELECT 
   				 v.*, mc.idMarca, mc.nome_marca,mm.nome_modelo
    		FROM
    			veiculo v
        	INNER JOIN
    			modelo_carro mm ON v.idModelo = mm.idModelo
       		 INNER JOIN
    			marca_carro mc ON mc.idMarca = mm.idMarca where status_carro = 1");

    	$resultado = $stmt->execute();

    	$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
		
    	return $resultado;
    } // Final lista veic




    public function valor_total($inicio,$final,$id){
    		
            $date1 = new DateTime($inicio);
            $date2 = new DateTime($final);

            $interval = $date1->diff($date2);

            $dias = $interval->days;		

			$stmt = $this->banco->prepare("select valor_diaria from veiculo where idVeiculo = :ID");

			$stmt->bindParam(":ID",$id);
			$stmt->execute();
			$resultado = $stmt->fetchColumn();
			
			$valor_final = $resultado * $dias;
		
			return $valor_final;
		
		
			
	}

	public function buscaCliente($cpf){
		$stmt = $this->banco->prepare("SELECT idCliente from cliente where cpf_cliente = :CPF");

		$stmt->bindParam(":CPF", $cpf);
		$rs = $stmt->execute();

        if($stmt->rowCount()){
            $id = $stmt->fetchColumn();
        return $id;
    } else{
        return false;
    }
		
	}

	public function lista_pagamento(){
		$stmt = $this->banco->prepare( "SELECT * from mtd_pagamento" ) ;

		
		$resultado = $stmt->execute();

		$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
		return $resultado;
	}


	public function listar_aluguel($controle){
				if($controle == 0){
		$stmt = $this->banco->prepare( "SELECT a.*, c.nome_cliente FROM aluguel a INNER JOIN cliente c on c.idCliente = a.idCliente" ); 
		 	
		 } else if ($controle == 1){ 	//ENTREGUE
		 
			$stmt = $this->banco->prepare( "SELECT a.*, c.nome_cliente FROM aluguel a INNER JOIN cliente c on c.idCliente = a.idCliente where status_aluguel = 2" ); 

		 } else if ($controle == 2){ // Não entregue

			$stmt = $this->banco->prepare( "SELECT a.*, c.nome_cliente FROM aluguel a INNER JOIN cliente c on c.idCliente = a.idCliente  where status_aluguel = 1" ); 

		 } else if ($controle == 3){ // Pago
			$stmt = $this->banco->prepare( "SELECT a.*, c.nome_cliente FROM aluguel a INNER JOIN cliente c on c.idCliente = a.idCliente where status_pagamento = 1" ); 	
		 } else if ($controle == 4){ // Não pago
			$stmt = $this->banco->prepare( "SELECT a.*, c.nome_cliente FROM aluguel a INNER JOIN cliente c on c.idCliente = a.idCliente where status_pagamento = 0 " ); 	
		 }


		
		$resultado = $stmt->execute();

		$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
		return $resultado;
	}


	public function buscaSol($id){
		$stmt = $this->banco->prepare("SELECT data_inicio_aluguel,idVeiculo,quilometragem_inicial from aluguel where idAluguel = :ID");
		$stmt->bindParam(":ID",$id);
		
         $stmt->execute();

         if($stmt->rowCount()){
             $resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);

          foreach ($resultado as $key => $value) {
                
                $this->setDataInicio($value['data_inicio_aluguel']);
                $this->setIdVeiculo($value['idVeiculo']);
                $this->setKmInicial($value['quilometragem_inicial']);
          }
            return true;
         }

		 
		return false;
	}


    public function insere(){

            $cliente = $this->getIdCliente();
            $inicio = $this->getDataInicio();
            $final = $this->getDataFinal();         
            $id_veic = $this->getIdVeiculo();   
            $km_inicio = $this->getKmInicial();
            $status_alg = $this->getStatusAluguel();
            $status_pgt = 0;
            $pgt = 1;
            $data_entrega = 0;            
           
            $stmt = $this->banco->prepare ("INSERT INTO aluguel (data_inicio_aluguel, data_devolucao_aluguel,quilometragem_inicial,idVeiculo,status_aluguel, idCliente, status_pagamento, idMtd_pagamento) VALUES (:DATA_INICIO, :DATA_FINAL, :KM_INCIAL,:VEIC,:STATUS_ALG,:CLIENTE,:STATUS_PGT,:PGT)");


            $stmt->bindParam(":DATA_INICIO", $inicio);
            $stmt->bindParam(":DATA_FINAL", $final);
            $stmt->bindParam(":KM_INCIAL", $km_inicio);
            $stmt->bindParam(":VEIC", $id_veic);
            $stmt->bindParam(":STATUS_ALG", $status_alg);
            $stmt->bindParam(":STATUS_PGT", $status_pgt);
            $stmt->bindParam(":CLIENTE", $cliente);
            $stmt->bindParam(":PGT", $pgt);
             

            $stmt->execute();
           

            $stmt_1 = $this->banco->prepare("UPDATE veiculo set status_carro = 2 where idVeiculo = $id_veic");
            $stmt_1->execute();

            return true;
    }

	public function finalizaAluguel(){
     

		$pgt = $this->getIdMtdPagamento();
		$alg =	$this->getIdAluguel();
		$data_entrega=	$this->getDataEntrega();
		$pagamento_id=	$this->getIdMtdPagamento();
		$status_aluguel=	$this->getStatusAluguel();
		$status_pagamento=	$this->getStatusPagamento();
		$km_final=	$this->getKmFinal();
		
        
        
        $inicio = $this->getDataInicio();
        $id_veic = $this->getIdVeiculo();


         $valor_final_not = $this->valor_total($inicio,$data_entrega,$id_veic);
            
         $valor_final = str_replace( ',', '.', $valor_final_not);

		$stmt = $this->banco->prepare("UPDATE aluguel set quilometragem_final = :KM_FINAL, status_aluguel = :STS_A, status_pagamento = :STS_P, data_entrega = :DATA, idMtd_pagamento = :PGT, valor_total = :VALOR where idAluguel = :ID");

		$stmt->bindParam(":ID", $alg);
        $stmt->bindParam(":VALOR",$valor_final);
		$stmt->bindParam(":DATA", $data_entrega);
		$stmt->bindParam(":PGT", $pagamento_id);
		$stmt->bindParam(":STS_A", $status_aluguel);
		$stmt->bindParam(":STS_P", $status_pagamento);
		$stmt->bindParam(":KM_FINAL", $km_final);

		$stmt->execute();

        $km_atual = $km_final + $this->getKmInicial();

        $stmt = $this->banco->prepare("UPDATE veiculo set status_carro = 1, quilometragem_veiculo = $km_atual where idVeiculo = $id_veic");
        $stmt->execute();

        return;
	}


  public function info_sol($id){

      $stmt = $this->banco->prepare("SELECT a.*,c.cpf_cliente FROM aluguel a inner join cliente c on c.idCliente = a.idCliente where idAluguel = :ID ");
      $stmt->bindParam(":ID",$id);
     
       $resultado = $stmt->execute();

       $resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);

      foreach ($resultado as $key => $value) {
       
        
        $inicio = date('d/m/Y', strtotime($value['data_inicio_aluguel'])); 
        $final = date('d/m/Y', strtotime($value['data_devolucao_aluguel'])); 
        $entrega = date('d/m/Y', strtotime($value['data_entrega'])); 
      
        $this->setDataEntrega($entrega);
        $this->setDataFinal($final);
        $this->setDataInicio($inicio);
        $this->setStatusAluguel($value['status_aluguel']);
        $this->setStatusPagamento($value['status_pagamento']);
        $this->setKmFinal($value['quilometragem_final']);
        $this->setIdMtdPagamento($value['idMtd_pagamento']);
        $this->setValorTotal($value['valor_total']);
        $this->setIdCliente($value['cpf_cliente']);
        $this->setIdVeiculo($value['idVeiculo']);


      }
  }


  public function AlteraAluguel($id){

        $id_aluguel = $id;
       
        $final = $this->getDataFinal();       
        $status = $this->getStatusAluguel();
        
        $stmt = $this->banco->prepare("UPDATE aluguel set data_devolucao_aluguel = '$final' , status_aluguel = $status where idAluguel = $id");   

          $stmt->execute();     

         
  }

  public function deletebyid($id){

    $stmt = $this->banco->prepare("DELETE FROM aluguel where idAluguel = :ID");
    $stmt->bindParam(":ID",$id);
    $stmt->execute();
  }

} // Final da classe
?>