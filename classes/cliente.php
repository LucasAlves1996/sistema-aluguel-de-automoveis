<?php

include ('banco.php');

class cliente {
	private $nome;
    private $data;
    private $cpf;
    private $telefone;
    private $endereco;
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

    public function setendereco($endereco){
        $this->endereco = $endereco;
    }

    public function getendereco(){
        return $this->endereco;
    }

    public function inserir_cliente(){
        $nome = $this->getnome();
        $cpf = $this->getcpf();
        $telefone = $this->gettelefone();
        $endereco = $this->getendereco();
        $data = $this->getdata();
		
        $stmt = $this->banco->prepare("INSERT INTO cliente (nome_cliente, data_cadastro_cliente, cpf_cliente, telefone_cliente, endereco) VALUES(:NOME, :DATA, :CPF, :TELEFONE, :ENDERECO)");
		       
        $stmt->bindParam(':NOME', $nome);
        $stmt->bindParam(':DATA',$data);
        $stmt->bindParam(':CPF', $cpf);
        $stmt->bindParam(':TELEFONE', $telefone);
        $stmt->bindParam(':ENDERECO', $endereco);
        
		$stmt->execute();
    }

    public function listar(){
        $stmt = $this->banco->prepare("SELECT * FROM cliente");
        $stmt->execute();

        $resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        return $resultado;
    }

    public function deletebyid($id){
        $stmt = $this->banco->prepare("DELETE FROM cliente where idCliente = :ID");

        $stmt->bindParam(":ID",$id);
        $stmt->execute();
    }

    public function selectbyid($id){
        $stmt = $this->banco->prepare("SELECT * FROM cliente where idCliente = :ID");

        $stmt->bindParam(":ID",$id);
        $stmt->execute();

        $resultado = $stmt->fetchALL(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function update_cliente($id){
        $nome = $this->getnome();
        $cpf = $this->getcpf();
        $telefone = $this->gettelefone();
        $endereco = $this->getendereco();
        $data = $this->getdata();

        $stmt = $this->banco->prepare("UPDATE cliente
            SET
            nome_cliente = :NOME,
            data_cadastro_cliente = :DATA,
            cpf_cliente = :CPF,
            telefone_cliente = :TELEFONE,
            endereco = :ENDERECO
            WHERE idCliente = :ID");

        $stmt->bindParam(':ID', $id);
        $stmt->bindParam(':NOME', $nome);
        $stmt->bindParam(':DATA', $data);
        $stmt->bindParam(':CPF', $cpf);
        $stmt->bindParam(':TELEFONE', $telefone);
        $stmt->bindParam(':ENDERECO', $endereco);
        
        $stmt->execute();
        
    }

    /*public function update_cliente($id){
        $nome = $this->getnome();
        $cpf = $this->getcpf();
        $telefone = $this->gettelefone();
        $endereco = $this->getendereco();
        $data = $this->getdata();

        $stmt1 = $this->banco->prepare("UPDATE cliente SET nome_cliente = :NOME WHERE idCliente = :ID");
        $stmt2 = $this->banco->prepare("UPDATE cliente SET data_cadastro_cliente = :DATA WHERE idCliente = :ID");
        $stmt3 = $this->banco->prepare("UPDATE cliente SET cpf_cliente = :CPF WHERE idCliente = :ID");
        $stmt4 = $this->banco->prepare("UPDATE cliente SET telefone_cliente = :TELEFONE WHERE idCliente = :ID");
        $stmt5 = $this->banco->prepare("UPDATE cliente SET endereco = :ENDERECO WHERE idCliente = :ID");

        $stmt1->bindParam(':ID', $id);
        $stmt1->bindParam(':NOME', $nome);
        $stmt2->bindParam(':ID', $id);
        $stmt2->bindParam(':DATA', $data);
        $stmt3->bindParam(':ID', $id);
        $stmt3->bindParam(':CPF', $cpf);
        $stmt4->bindParam(':ID', $id);
        $stmt4->bindParam(':TELEFONE', $telefone);
        $stmt5->bindParam(':ID', $id);
        $stmt5->bindParam(':ENDERECO', $endereco);
        
        if($nome != ""){
            $stmt1->execute();
        }
        if($data != ""){
            $stmt2->execute();
        }
        if($cpf != ""){
            $stmt3->execute();
        }
        if($telefone != ""){
            $stmt4->execute();
        }
        if($endereco != ""){
            $stmt5->execute();
        }
        
    }*/

}

?>

