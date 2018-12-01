<?php 
 require_once $_SERVER['DOCUMENT_ROOT'] . "/aluguel/classes/aluguel.php";
  $aluga = new aluguel();


  $mtd_pagamento = $aluga->lista_pagamento();

  $veiculo  = $aluga->listaVeic();

  $id = $_GET['id'];

  $aluga->info_sol($id);

 ?>

<form>
  <div class="row">
    
    <div class="col-md-6">

          <label for="edt_data_final_alg"> Data de Devolução do carro</label>
          <input type="text" class="form-control" id="edt_data_final_alg">                    
          </select>

    <br>    <br>    <br>
  
   <div class="form-check">   

    <input type="checkbox" class="form-check-input" id="check_entregue">

    <label class="form-check-label" for="exampleCheck1">Veículo entregue</label>
  
   </div>
    </div>

    <input type="hidden" id="mudei_o_nome">


  </div>  <!-- FINAL DA ROW -->
  
</form>


<script type="text/javascript">     
  var status = "<?php echo $aluga->getStatusAluguel(); ?>";

  
  $(document).ready(function(){
  
  var status_check_mpo = "<?php echo $aluga->getStatusAluguel(); ?>";

    
    $('#edt_data_final_alg').mask('00/00/0000');
   

  
    $("#edt_data_final_alg").val("<?php echo $aluga->getDataFinal(); ?>");
   
     
     console.log("stats"+status_check_mpo);
     
  
     if(status_check_mpo == '2'){
      $("#check_entregue").prop("checked", true);
     } else{
      $("#check_entregue").prop("checked", false);
     }
    
 
    
  });
  

</script>