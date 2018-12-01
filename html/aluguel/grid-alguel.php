<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . "/aluguel/classes/aluguel.php";

$controle = $_POST['controle'];

 $alg = new aluguel();

 $resultado = $alg->listar_aluguel($controle);


 	        
              
        $buffer = '';
    foreach ($resultado as $key => $value) {                
    	
    	 $data_formatada_inicio = date('d/m/Y', strtotime($value['data_inicio_aluguel'])); 
    	 $data_formatada_final = date('d/m/Y', strtotime($value['data_devolucao_aluguel']));  
    	 $data_formatada_entrega = $value['data_entrega'];
       $data_inicial=  date("Y-m-d", strtotime($value['data_inicio_aluguel']) ) ;
           
       $buffer.= '<tr>';

        $buffer.= '<td>'.$value['idAluguel'].' </td>'; 
        $buffer.= '<td>'.$value['nome_cliente'].' </td>'; 
        $buffer.= '<td>'.$value['idVeiculo'].' </td>'; 
        $buffer.= '<td>'.$data_formatada_inicio.' </td>'; 
        $buffer.= '<td>'.$data_formatada_final.' </td>';
        
        if($data_formatada_entrega == "") {          
           $buffer.= '<td> </td>';
        } else{
          $data_formatada_entrega = date('d/m/Y', strtotime($value['data_entrega'])); 
          $buffer.= '<td>'.$data_formatada_entrega.' </td>';
        }
         	
        $buffer.= '<td>R$ '.$value['valor_total'].' </td>'; 
        

        if($value['status_aluguel'] == 1){
        	$buffer.= '<td style="color: red;"> Com cliente </td>'; 
        } else if ($value['status_aluguel'] == 2){
        	$buffer.= '<td style="color: green;"> Devolvido </td>';
        }


        if($value['status_pagamento'] == 0 ){
        	$buffer.= '<td style="color: red;"> Não pago</td>';
        } else if($value['status_pagamento'] == 1 ){
        	$buffer.= '<td style="color: green;"> Pago</td>';
        }

                  $buffer.= '<td> <button value="'.$value['idAluguel'].'" class="desc_alg btn btn-primary"> Desc </button> </td>';
                  
                  
                 
                  if($value['status_aluguel'] == 2 && $value['status_pagamento'] == 1){

                    $buffer.= '<td> <button disabled value="'.$value['idAluguel'].'" class="edt_alg btn btn-success"> Editar </button> </td>';

                    $buffer.= '<td> <button disabled value="'.$value['idAluguel'].'" class="btn btn-danger btn_baixa" data-id="'.$value['idAluguel'].'" data-toggle="modal" data-target="#baixa_aluguel"> Baixa </button> </td>';
                  } else{
                    $buffer.= '<td> <button data-id="'.$data_inicial.'" data-toggle="modal" data-target="#edita_aluguel" value="'.$value['idAluguel'].'" class="edt_alg btn btn-success"> Editar </button> </td>';
                   
                    $buffer.= '<td> <button value="'.$value['idAluguel'].'" class="btn btn-danger btn_baixa" data-id="'.$value['idAluguel'].'" data-toggle="modal" data-target="#baixa_aluguel"> Baixa </button> </td>';
                  }
                  
           
                  $buffer.= '</tr>';

        $buffer.= '</tr>';
        
    }

     echo $buffer;


?>


<script type="text/javascript">
        var valor_id = 0; 
        var valor = 0;
        $(document).ready(function(){      


         $(".edt_alg").click(function(){
         valor_id = $(this).val();
        console.log(valor_id);
            $('#edita_aluguel .modal-body').load('html/aluguel/frm-edita-aluguel.php?id='+valor_id,function(){
         $('#edita_aluguel').modal({show:true});
     
    }); // FINAL LOAD
    
     });





        }); // Final dom

     
</script>