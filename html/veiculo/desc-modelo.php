<?php 

  require_once $_SERVER['DOCUMENT_ROOT'] . "/aluguel/classes/automovel.php";

 $carros = new automovel(); 

       if(isset($_GET['id'])) {           
        
          
          $result = $carros->buscaDesc($_GET['id']);

           echo '<p>'.$result.'</p>';
                   
     }     
      
       
         
         ?>

