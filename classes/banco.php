<?php

class banco{

	private $host;
	private $user;
	private $senha;
	private $banco_nome;
	public $mysqli;


	public function __construct() {
		$this->banco_connect();
	}


	private function banco_connect(){
		$this->host = 'localhost';
		$this->user = 'root';
		$this->senha = '';
		$this->banco_nome = 'banco_aluguel';
	}

}


?>