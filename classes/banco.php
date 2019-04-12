<?php

	class banco extends PDO{

		public function __construct(){

			parent::__construct('mysql:host=localhost;dbname=banco_aluguel','root','');

		}

	}

?>