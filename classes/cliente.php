<?php

include ('banco.php');

class cliente {
	private $nome;
    private $data;
    private $cpf;
    private $telefone;
    private $rua;
    private $numero;
    private $complemento;
    private $cidade;
    private $estado;
    private $pais;
	private $banco;
	
	public function __construct(){
		$this->banco = new banco();
	}

    public function setnome($nome){
        $this->nome = $nome;
    }

    public function getnome(){
        return $this->nome;
    }
	 public function setdata($data){
        $this->data = $data;
    }

    public function getdata(){
        return $this->data;
    }
    public function setemail($email){
        $this->email = $email;
    }
    public function getemail($email){
        return $this-> email;
    }


    public function setcpf ($cpf){
        $this->cpf = $cpf;
    }

    public function getcpf (){
        return $this->cpf;
    }

    public function settelefone ($telefone){
        $this->telefone = $telefone;
    }

    public function gettelefone (){
        return $this->telefone;
    }


    public function setrua($rua){
        $this->rua = $rua;
    }

    public function getrua(){
        return $this->rua;
    }

    public function setnumero($numero){
        $this->numero = $numero;
    }

    public function getnumero(){
        return $this->numero;
    }


    public function setcomplemento($complemento){
        $this->complemento = $complemento;
    }

    public function getcomplemento(){
        return $this->complemento = $complemento;
    }

    public function setcidade($cidade){
        $this->cidade = $cidade;
    }

    public function getcidade(){
        return $this->cidade;
    }

    public function setestado($estado){
        $this->estado = $estado;
    }

    public function getestado(){
        return $this->estado;
    }

    public function setpais($pais){
        $this->pais = $pais;
    }

    public function getpais(){
        return $this->pais;
    }

    public function inserir_cliente(){
        $nome = $this->getnome();
        $cpf = $this->getcpf();
        $telefone = $this->gettelefone();
        $rua = $this->getrua();
        $numero = $this->getnumero();
        $complemento = $this->getcomplemento();
        $pais = $this->getpais();
        $estado = $this->getestado();
        $cidade = $this->getcidade();
        $data = $this->getdata();
		
		$stmt = $this->banco->prepare("INSERT INTO pais_uf (nome_estado, nome_pais) VALUES (:ESTADO, :PAIS)");
		$stmt1 = $this->banco->prepare("INSERT INTO cidade (nome_cidade, idPais_uf) VALUES (:CIDADE, :ESTADO)");
		$stmt2 = $this->banco->prepare("INSERT INTO endereco (nome_rua, numero_residencia, complemento_residencia, idCidade) VALUES (:RUA, :NUMERO, :COMPLEMENTO, :CIDADE)");
        $stmt3 = $this->banco->prepare("INSERT INTO cliente (nome_cliente, data_cadastro_cliente, cpf_cliente, telefone_cliente, idEndereco) VALUES(:NOME, :DATA, :CPF, :TELEFONE, :RUA)");
        $stmt->bindParam(':ESTADO', $estado);
        $stmt->bindParam(':PAIS', $pais);
		$stmt1->bindParam(':PAIS', $pais);
        $stmt1->bindParam(':CIDADE', $cidade);
		$stmt2->bindParam(':RUA', $rua);
		$stmt2->bindParam(':NUMERO', $numero);
		$stmt2->bindParam(':COMPLEMENTO', $complemento);
        $stmt2->bindParam(':CIDADE', $cidade);
        $stmt3->bindParam(':NOME', $nome);
        $stmt3->bindParam(':CPF', $cpf);
        $stmt3->bindParam(':TELEFONE', $telefone);
        $stmt3->bindParam(':DATA',$data);
        $stmt3->bindParam(':RUA', $rua);
		$stmt->execute();
		$stmt1->execute();
		$stmt2->execute();
		$stmt3->execute();
    }

    public function listar(){
        $stmt = $this->banco->prepare("SELECT * FROM cliente");
        $stmt->execute();

        $resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        return $resultado;
    }

}

?>

