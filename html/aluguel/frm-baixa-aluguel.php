<?php

$alg = new aluguel();

$veiculo = $alg->listaVeic();

$mtd_pgt = $alg->lista_pagamento();
 ?>

<form>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
          
          <label for="data_entrega_alg"> Data de entrega </label>
          <input type="text" class="form-control" id="data_entrega_alg">



           <label for="km_final"> Quilometragem Final </label>
          <input type="text" class="form-control" id="km_final">

       </div>
    </div>   <!-- FINAL DA COL -->


    <div class="col-md-6">

          <label for="mtd_pagamento"> Método de pagamento</label>
          <select class="form-control" id="mtd_pagamento">
          <?php 

            foreach ($mtd_pgt as $key => $value) {
              echo '<option value="'.$value['idMtd_pagamento'].'">'.utf8_encode($value['tipo_pagamento']).' </option>';
            }

           ?>
          </select>

           <label for="nrm_aluguel">Número da solicitação</label>
          <input type="text" id="nrm_aluguel" value="" class="form-control">

      
    </div>


  </div>  <!-- FINAL DA ROW -->

  
</form>
		

<script type="text/javascript">

  $(document).ready(function(){

    

        //MASK
     $('#data_entrega_alg').mask('00/00/0000');
});



</script>