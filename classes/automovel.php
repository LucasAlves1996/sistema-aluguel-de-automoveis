<?php

require ("banco.php");

class automovel {

		private $marca;
		private $modelo;
		private $descricao_modelo;
		private $numero_chassi;
		private $placa_carro;
		private $cor_carro;
		private $quilometragem_incial;
		private $avaria;
		private $desc_avaria;
		private $valor_avaria;
		private $valor_km;
		private $valor_diaria;
		private $data;
		private $banco;
		private $status;

	public function __construct(){

		$this->banco = new banco();
		
	}	
	/* GETTERS AND SETTERS */

	public function getstatus()
	{
	    return $this->status;
	}
	
	public function setStatus($status)
	{
	    return $this->status = $status;
	}

		public function getData()
	{
	    return $this->marca;
	}
	
	public function setData($marca)
	{
	    return $this->marca = $marca;
	}
	

	public function getMarca()
	{
	    return $this->marca;
	}
	
	public function setMarca($marca)
	{
	    return $this->marca = $marca;
	}
	
	
	public function getModelo()
	{
	    return $this->modelo;
	}
	
	public function setModelo($modelo)
	{
	    return $this->modelo = $modelo;
	}
	
	public function getDescricao_modelo()
	{
	    return $this->descricao_modelo;
	}
	
	public function setDescricao_modelo($descricao_modelo)
	{
	    return $this->descricao_modelo = $descricao_modelo;
	}
	
	
	public function getNumero_chassi()
	{
	    return $this->numero_chassi;
	}
	
	public function setNumero_chassi($numero_chassi)
	{
	    return $this->numero_chassi = $numero_chassi;
	}
	
	public function getPlaca_carro()
	{
	    return $this->placa_carro;
	}
	
	public function setPlaca_carro($placa_carro)
	{
	    return $this->placa_carro = $placa_carro;
	}
	
	
	public function getCor_carro()
	{
	    return $this->cor_carro;
	}
	
	public function setCor_carro($cor_carro)
	{
	    return $this->cor_carro = $cor_carro;
	}
	
	
	public function getQuilometragem_inicial()
	{
	    return $this->quilometragem_incial;
	}
	
	public function setQuilometragem_inicial($quilometragem_incial)
	{
	    return $this->quilometragem_incial = $quilometragem_incial;
	}
	
	public function getAvaria()
	{
	    return $this->avaria;
	}
	
	public function setAvaria($avaria)
	{
	    return $this->avaria = $avaria;
	}
	
	
	public function getDesc_avaria()
	{
	    return $this->desc_avaria;
	}
	
	public function setDesc_avaria($desc_avaria)
	{
	    return $this->desc_avaria = $desc_avaria;
	}
	
	public function getValor_avaria()
	{
	    return $this->valor_avaria;
	}
	
	public function setValor_avaria($valor_avaria)
	{
	    return $this->valor_avaria = $valor_avaria;
	}
	
	public function getValor_km()
	{
	    return $this->valor_km;
	}
	
	public function setValor_km($valor_km)
	{
	    return $this->valor_km = $valor_km;
	}
	
	
	public function getValor_diaria()
	{
	    return $this->valor_diaria;
	}
	
	public function setValor_diaria($valor_diaria)
	{
	    return $this->valor_diaria = $valor_diaria;
	}




/* METHODS */

	public function gravar(){
		$this->setValor_km();
	}

	public function listaMarca(){
		
		
		$stmt = $this->banco->prepare("SELECT idMarca, nome_marca FROM marca_carro");

		$stmt->execute();

		$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
		
		return $resultado;
	}

		public function listaModelo(){
		
		
		$stmt = $this->banco->prepare("SELECT idModelo,nome_modelo,idMarca FROM modelo_carro");

		$stmt->execute();

		$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
		
		return $resultado;
	}


	public function insere(){

		
		$modelo = $this->getModelo();
		$chassi = $this->getNumero_chassi();
		$cor = $this->getCor_carro();
		$diaria = $this->getValor_diaria();
		$placa = $this->getPlaca_carro();
		$km = $this->getQuilometragem_inicial();
		$valor_km = $this->getValor_km();				
		$data = $this->getData();
		$status = 1;

		$stmt = $this->banco->prepare("INSERT INTO veiculo (numero_chassi, idModelo, status_carro, placa_carro, cor_carro, data_aquisicao, quilometragem_veiculo, valor_diaria, valor_km) VALUES(:CHASSI,:MODELO,:STATUS,:PLACA,:COR,:DATA,:KM,:DIARIA,:KM_VALOR)");

		$stmt->bindParam(":CHASSI", $chassi);
		$stmt->bindParam(":MODELO", $modelo);
		$stmt->bindParam(":STATUS", $status);
		$stmt->bindParam(":PLACA", $placa);
		$stmt->bindParam(":COR", $cor);
		$stmt->bindParam(":DATA", $data);
		$stmt->bindParam(":KM", $km);
		$stmt->bindParam(":DIARIA", $diaria);
		$stmt->bindParam(":KM_VALOR", $valor_km);

		$stmt->execute();

		if ($stmt == true) {
			return true;
		} else{
			return false;
		}

	
		
	

	} // final insere
 	
	public function insereModelo(){

		$marca = $this->getMarca();
		$modelo = $this->getModelo();
		$desc = $this->getDescricao_modelo();


		$stmt = $this->banco->prepare("INSERT INTO modelo_carro (nome_modelo, idMarca, descricao_modelo) VALUES (:MODELO, :MARCA, :DSC)");
		
		$stmt->bindParam(":MODELO", $modelo);
		$stmt->bindParam(":MARCA", $marca);
		$stmt->bindParam(":DSC", $desc);
		$stmt->execute();

		$this->setModelo((int)$this->banco->lastInsertId());

		$this->insere();

	}

	public function MarcaModelo(){

		$marca = $this->getMarca();
		$modelo = $this->getModelo();
		$desc = $this->getDescricao_modelo();	


		$stmt = $this->banco->prepare("INSERT INTO marca_carro (nome_marca) VALUES (:MARCA)");

		$stmt->bindParam(":MARCA", $marca);
		$stmt->execute();

		$marca = (int)$this->banco->lastInsertId();

		$stmt = $this->banco->prepare("INSERT INTO modelo_carro (nome_modelo, idMarca, descricao_modelo) VALUES (:MODELO, :MARCA, :DSC)");
		$stmt->bindParam(":MODELO", $modelo);
		$stmt->bindParam(":MARCA", $marca);
		$stmt->bindParam(":DSC", $desc);

		$stmt->execute();
		
		$modelo =  (int)$this->banco->lastInsertId();

		return $modelo;
	}

	public function listar(){

		$stmt = $this->banco->prepare("
	SELECT 
   		v.idVeiculo,
   		mc.idModelo,
   		v.numero_chassi,
   		mc.nome_modelo,
   		mcc.nome_marca,
   		v.placa_carro,
   		v.cor_carro,
   		v.data_aquisicao,
   		v.quilometragem_veiculo,
   		v.valor_diaria,
   		v.status_carro
	FROM
   		veiculo v
   	INNER JOIN
   		modelo_carro mc ON mc.idModelo = v.idModelo
   	INNER JOIN
   		marca_carro mcc ON mcc.idMarca = mc.idMarca");
		$stmt->execute();

		$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
		
		return $resultado;
	}


	public function buscaDesc($id){
		$stmt = $this->banco->prepare("SELECT descricao_modelo from modelo_carro where idModelo = :ID");

		$stmt->bindParam(":ID", $id);

		$resultado = $stmt->execute();


		$resultado = $stmt->fetchColumn();
		
		return $resultado;
	}



	public function UpdateVeiculo($id){

		$modelo = $this->getModelo();
		$chassi = $this->getNumero_chassi();
		$cor = $this->getCor_carro();
		$diaria = $this->getValor_diaria();
		$placa = $this->getPlaca_carro();
		$km = $this->getQuilometragem_inicial();
		$valor_km = $this->getValor_km();				
		$data = $this->getData();
		$status = $this->getStatus();


		$stmt = $this->banco->prepare ("UPDATE veiculo 
			SET 
			numero_chassi = :CHASSI,
			 idModelo = :MODELO,  
			 status_carro = :STATUS, 
			 placa_carro = :PLACA, 
			 cor_carro = :COR,
			 data_aquisicao = :DATA,
			 quilometragem_veiculo = :KM,
			 valor_diaria =:DIARIA,
			 valor_km = :KM_VALOR 
			WHERE idVeiculo = :ID ");

		$stmt->bindParam(":ID", $id);
		$stmt->bindParam(":CHASSI", $chassi);
		$stmt->bindParam(":MODELO", $modelo);
		$stmt->bindParam(":STATUS", $status);
		$stmt->bindParam(":PLACA", $placa);
		$stmt->bindParam(":COR", $cor);
		$stmt->bindParam(":DATA", $data);
		$stmt->bindParam(":KM", $km);
		$stmt->bindParam(":DIARIA", $diaria);
		$stmt->bindParam(":KM_VALOR", $valor_km);

		$stmt->execute();

	}
						
	public function deletebyid($id){
		$stmt = $this->banco->prepare("DELETE FROM veiculo where idVeiculo = :ID");

		$stmt->bindParam(":ID",$id);
		$stmt->execute();
	}							
												

	public function busca($id){ // EM PRODU~ÇÃO
		$stmt = $this->banco->prepare("SELECT * FROM veiculo where idVeiculo = :ID");

		$stmt->bindParam(":ID", $id);

		$stmt->execute();

		$resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);

		foreach ($resultado as $key => $value) {
			$data_formatada = date('Y-m-d', strtotime($value['data_aquisicao']));

			$this->setData($data_formatada);

		}

	}													
	} // Final da classe


?>


