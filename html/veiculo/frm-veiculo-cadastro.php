<?php

$carro = new automovel();

 ?>

<form id="cadastro_veiculo_form" method="POST">			
	<div class="row">
		<div class="col-md-6">
	 			
  		
  			<div class="form-group">    
  			  <label for="marca_cadastro">Marca</label>
  			  
          <select id="marca_cadastro" class="form-control" ">
             <option value="default" selected hidden>Escolha a marca</option>
  			   <?php 
           $marca = $carro->listaMarca();
           echo $marca;
           foreach ($marca as $key => $value) {
             echo '<option value="'.$value['idMarca'].'">'.$value['nome_marca'].'</option>';
           }
            ?>
           <option value="666"> Outra </option>
  			  </select> 
        
          
       
  			</div>

        <div class="form-group" id="div_marca" style="display: none;">
          
          <label for="outra_marca">Nome da marca: </label>
          <input type="text" class="form-control" id="outra_marca">
          </div>
			
			<div class="form-group">
   				<label for="nrm_chassi">Número do chassi</label>
   				
   				<input type="text" class="form-control" id="nrm_chassi_cadastro">
  			</div>



  			<div class="form-group">    
  			  <label for="cor_cadastro">Cor do carro</label>
  			  <select class="form-control" id="cor_cadastro">
  			    
  			  </select> 
  			</div>

  			<div class="form-group">
   				<label for="diaria_cadastro">Valor diária</label>
   				
   				<input type="text" class="form-control" id="diaria_cadastro">
  			</div>
  			
		</div> <!--Final coluna 1 -->

		<div class="col-md-6">
			
      <div class="form-group">    
  			  <label for="modelo_cadastro">Modelo</label>
  			  <select class="form-control" id="modelo_cadastro">
            <option value="default" selected hidden>Escolha seu modelo</option>
  			     <?php             
               $modelo = $carro->listaModelo();
              
               foreach ($modelo as $key => $value) {
                $key++;
               echo '<option data-value="'.$value['idMarca'].'" value="'.$value['idModelo'].'">'.$value['nome_modelo'].'</option>';
           }
            ?>
  			    
  			    <option value="666">Outro</option>
  			  </select> 

    
        
          </div>


              <div classs="form-group">

            <div id="div_modelo"style="display: none;">
              
              <label for="outro_modelo">Nome do modelo: </label>
              <input type="text" class="form-control" id="outro_modelo" ">
           
            </div>
          
        </div>		
        

  				<div class="form-group">
   				<label for="placa_cadastro">Placa do carro</label>
   				
   				<input type="text" class="form-control" id="placa_cadastro"">
  			</div>


  			<div class="form-group">
   				<label for="km_cadastro">Quilometragem inicial</label>
   				
   				<input type="text" class="form-control" id="km_cadastro"">
  			</div>

  			<div class="form-group">
   				<label for="km_valor_cadastro">Valor quilometragem</label>
   				
   				<input type="text" class="form-control" id="km_valor_cadastro">
  			</div>
 			
		</div> <!-- Final coluna 2 -->
	
	</div> <!-- Final da row -->


  <div class="row">
    <div class="col-md-6">
          <label for="data_cadastro">Data de aquisição</label>
          
          <input type="text" class="form-control" id="data_cadastro">
    </div>
  </div>

	<div class="row" id="desc_modelo" style="display: none;">

		<div class="col-md-12">
			  <div class="form-group">
   				 <label for="desc_cadastro">Descrição do modelo</label>
   				 <textarea class="form-control" id="desc_cadastro" rows="3"></textarea>
  			</div>
		
		</div> <!-- final coluna 1 -->
		
	</div> <!-- Final da row -->

		
</form>

			
<script type="text/javascript">
  
  $(document).ready(function() {

    // MASK

    $("#diaria_cadastro").mask("999,99");
    $("#km_valor_cadastro").mask("999,99");
    $("#placa_cadastro").mask("AAA-9999");
    $('#data_cadastro').mask('00/00/0000');
    $('#nrm_chassi_cadastro').mask('99999999999999999');

    //TRATATIVA PARA ADICIONAR MARCA OU MODELO
      var marca = $(this).val();
      $("#modelo_cadastro").find("option").hide();

      $("#modelo_cadastro").find("[data-value='"+marca+"']").show();


    $("#marca_cadastro").change(function(){
       marca = $(this).val();
 
      if($("#marca_cadastro").val() == "666"){    
      $("#div_marca").show();
      $("#div_modelo").show();
      $( "#modelo_cadastro" ).prop( "disabled", true );
      $("#desc_modelo").show();

    } else{
      $("#desc_modelo").hide();
      $("#div_marca").hide();
      $("#div_modelo").hide();
      $( "#modelo_cadastro" ).prop( "disabled", false );
    }
        
        $("#modelo_cadastro").find("option").hide(); 
        $("#modelo_cadastro").find("[data-value='"+marca+"'],[value='666']").show();
        $("#modelo_cadastro").find("[value='default']").prop("selected", true);  
       
     
     

    });

    $("#modelo_cadastro").change(function(){
        if($("#modelo_cadastro").val() == '666'){

          $("#div_modelo").show(); 
           $("#desc_modelo").show();

        } else{
          $("#div_modelo").hide();
           $("#desc_modelo").hide();
        }
    });



    $.getJSON('cores.json', function (data) {

              var items = [];
              var options = '<option value="">escolha uma cor</option>';              
              
              var str = "";         
               

                $.each(data, function (key, val) {
                               
                    $.each(val.Cores, function (key_cor, val_cor) {
                      options += '<option value="' + val_cor + '">' + val_cor + '</option>';
                  });             
                
                    
                });
                $("#cor_cadastro").html(options);
             

         });

          



}); // FINAL DOM




</script>
			
		