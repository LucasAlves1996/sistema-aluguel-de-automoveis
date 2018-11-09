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




    public function inserir_cliente(){
        $nome = $_POST['nome'];
    	$data = $_POST['data'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $cidade = $_POST['cidades'];
        $estado = $_POST['estados'];
		if($this->procura_cpf($cpf) == true){
			$stmt = $this->banco->prepare("insert into cliente (nome_cliente,data_cadastro, cpf, telefone) values ( :NOME,:DATA,:CPF,:TELEFONE)");
			$stmt1 = $this->banco->prepare("insert into endereco (nome_rua, numero_residencia, complemento_residencia) values ( :RUA,:NUMERO,:COMPLEMENTO)");
			$stmt2 = $this->banco->prepare("insert into cidade (nome_cidade) values(:CIDADE");
			$stmt3 = $this->banco->prepare("insert into pais_uf (nome estado) values(:ESTADO"); 
			$stmt->bindParam(':NOME', $nome);
			$stmt->bindParam(':DATA',$data);
			$stmt->bindParam(':CPF', $cpf);	
			$stmt->bindParam(':TELEFONE', $telefone);	
			$stmt1->bindParam(':RUA', $rua);				
			$stmt1->bindParam(':NUMERO', $numero);
			$stmt1->bindParam(':COMPLEMENTO', $complemento);
			$stmt2->bindParam(':CIDADE', $cidade);	
			$stmt3->bindParam(':ESTADO', $estado);	
			$stmt->execute();
			$stmt1->execute();
			$stmt2->execute();
			$stmt3->execute();	

			if ($stmt == true){
			  echo "<script>('Dados cadastrados com sucesso!')</script>";
		    } else{
			    echo  "<script>('Erro ao cadastrar Dados!')</script>";
		    }
		} else {
			echo "<script> alert('ja existe cpf cadastrado')</script>";			
		}		
}

    public function listar(){
        
    }

	public function procura_cpf($cpf){  
	 
	  $stmt = $this->banco->prepare("select cpf from cliente where cpf = :CPF");
	  $stmt->bindParam(":CPF", $cpf);
	  
	  $stmt->execute();
	  
	if($stmt->rowCount() == 0 ) {

		return true;
		
	} else{
		
		return false;
	}

	}

}

?>

