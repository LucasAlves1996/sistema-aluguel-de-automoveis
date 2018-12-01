<?php

$alg = new aluguel();

$veiculo = $alg->listaVeic();


 ?>

<form>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
          
          <label for="data_incio_alg"> Data do aluguel </label>
          <input type="text" class="form-control" id="data_incio_alg">



           <label for="cpf_alg"> CPF do cliente </label>
          <input type="text" class="form-control" id="cpf_alg">

       </div>
    </div>   <!-- FINAL DA COL -->


    <div class="col-md-6">

          <label for="data_final_alg"> Data de Devolução do carro</label>
          <input type="text" class="form-control" id="data_final_alg">


          <label for="km_inicial_alg">Quilometragem Inicial</label>
          <input type="text" id="km_inicial_alg" class="form-control" disabled>
      
    </div>


  </div>  <!-- FINAL DA ROW -->
  
  <div class="row">
    <div class="col-md-12"> 
      
          <label for="veiculo_alg">Veículo</label>
          <select class="form-control" id="veiculo_alg">
            <option value="0" selected hidden>Escolha seu veículo</option>
            <?php             
            
              foreach ($veiculo as $key => $value) {
              
             echo '<option data-value="'.$value['quilometragem_veiculo'].'" value="'.$value['idVeiculo'].'">'.$value['nome_marca'].'/'.$value['nome_modelo'].'/'.$value['cor_carro'].'/ Placa: '.$value['placa_carro'].'</option>';
          }
            ?>
            
           
          </select> 
    </div>    
  </div>
  
</form>
		

<script type="text/javascript">

  $(document).ready(function(){

        

        //MASK
        $('#data_incio_alg').mask('00/00/0000');
        $('#data_final_alg').mask('00/00/0000');
        $("#cpf_alg").mask('99999999999');
        


        $('form select#veiculo_alg').change(function() {
       

         console.log($(this).find('option:selected').data("value"));
        
          
          $("#km_inicial_alg").val($(this).find('option:selected').data("value"));
    });
        


});



</script>