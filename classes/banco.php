<?php



class banco extends PDO {
	
		private $conn;	
		// Função "mágica" para conectar com o banco
		private $user = "root";
		private $pass ="";
		private $name = "mysql:host=localhost;dbname=banco_aluguel";
 
	public function __construct()
		{
		parent::__construct($this->name, $this->user, $this->pass);
		}
				
		
}


?>