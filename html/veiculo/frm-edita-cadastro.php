<?php

 require_once $_SERVER['DOCUMENT_ROOT'] . "/aluguel/classes/automovel.php";

 $carro = new automovel(); 

 $carro->busca($_GET['id']);

 ?>

<form id="cadastro_veiculo_form" method="POST">			
	<div class="row">
		<div class="col-md-6">
	 			
  		
  			<div class="form-group">    
  			  <label for="edt_marca_cadastro">Marca</label>
  			  
          <select id="edt_marca_cadastro" class="form-control" ">
             <option selected disabled hidden>Escolha a marca</option>
  			   <?php 
           $marca = $carro->listaMarca();
           echo $marca;
           foreach ($marca as $key => $value) {
             echo '<option value="'.$value['idMarca'].'">'.$value['nome_marca'].'</option>';
           }
            ?>
           <option value="666"> Outra </option>
  			  </select> 
        
          <div class="form-group" id="edt_div_marca" style="display: none;">
          
          <label for="edt_outra_marca">Nome da marca: </label>
          <input type="text" class="form-control" id="edt_outra_marca">
          </div>
       
  			</div>
			
			<div class="form-group">
   				<label for="edt_nrm_chassi">Número do chassi</label>
   				
   				<input type="text" class="form-control" id="edt_nrm_chassi">
  			</div>



  			<div class="form-group">    
  			  <label for="edt_cor_cadastro">Cor do carro</label>
  			  <select class="form-control" id="edt_cor_cadastro">
  			    
  			  </select> 
  			</div>

  			<div class="form-group">
   				<label for="edt_diaria_cadastro">Valor diária</label>
   				
   				<input type="text" class="form-control" id="edt_diaria_cadastro">
  			</div>
  			
		</div> <!--Final coluna 1 -->

		<div class="col-md-6">
			<div class="form-group">    
  			  <label for="edt_modelo_cadastro">Modelo</label>
  			  <select class="form-control" id="edt_modelo_cadastro">
            <option value="default" selected disabled hidden>Escolha seu modelo</option>
  			     <?php             
               $modelo = $carro->listaModelo();
                echo $modelo;
               foreach ($modelo as $key => $value) {
                $key++;
               echo '<option data-value="'.$value['idMarca'].'" value="'.$value['idModelo'].'">'.$value['nome_modelo'].'</option>';
           }
            ?>
  			    
  			    <option value="666">Outra</option>
  			  </select> 

            <div id="edt_div_modelo"style="display: none;">
              
          <label for="edt_outro_modelo">Nome do modelo: </label>
          <input type="text" class="form-control" id="edt_outro_modelo" ">
            </div>
          
        </div>		
        

  				<div class="form-group">
   				<label for="edt_placa_cadastro">Placa do carro</label>
   				
   				<input type="text" class="form-control" id="edt_placa_cadastro"">
  			</div>


  			<div class="form-group">
   				<label for="edt_km_cadastro">Quilometragem inicial</label>
   				
   				<input type="text" class="form-control" id="edt_km_cadastro"">
  			</div>

  			<div class="form-group">
   				<label for="edt_km_valor_cadastro">Valor quilometragem</label>
   				
   				<input type="text" class="form-control" id="edt_km_valor_cadastro">
  			</div>
 			
		</div> <!-- Final coluna 2 -->
	
	</div> <!-- Final da row -->


  <div class="row">
       
    <div class="col-md-6">
          <label for="edt_data_cadastro">Data de aquisição</label>
          
          <input type="text" class="form-control" id="edt_data_cadastro">
    </div>


      <div class="col-md-6">
        
         <label for="edt_status">Status</label>
          
          <select id="edt_status" class="form-control" >
                    <option selected value="1" > Ativo </option>
                    <option value="2"> Alugado </option>
                    <option value="3"> Inativo </option>
          </select> 

      </div>
         
      
  </div>

	<div class="row" id="edt_desc_modelo" style="display: none;">

		<div class="col-md-12">
			  <div class="form-group">
   				 <label for="edt_desc_cadastro">Descrição do modelo</label>
   				 <textarea class="form-control" id="edt_desc_cadastro" rows="3"></textarea>
  			</div>
		
		</div> <!-- final coluna 1 -->
		
	</div> <!-- Final da row -->

		
</form>

			
<script type="text/javascript">
  
  $(document).ready(function() {
    //remove valores padrões do select
  $("select option").removeAttr('selected');
    

    // MASK
   $("#edt_diaria_cadastro").mask("999,99");
    $("#edt_km_valor_cadastro").mask("999,99");
    $("#edt_placa_cadastro").mask("AAA-9999");
    $('#edt_data_cadastro').mask('00/00/0000');
  

    // $modelo = $this->getModelo();
    // $chassi = $this->getNumero_chassi();
    
  
    // $km = $this->getQuilometragem_inicial();
    // $valor_km = $this->getValor_km();       
    // $data = $this->getData();


    //TRATATIVA PARA ADICIONAR MARCA OU MODELO
      var marca = $(this).val();
      $("#edt_modelo_cadastro").find("option").hide();

      $("#edt_modelo_cadastro").find("[data-value='"+marca+"']").show();


    $("#edt_marca_cadastro").change(function(){
       marca = $(this).val();
 
      if($("#edt_marca_cadastro").val() == "666"){    
      $("#edt_div_marca").show();
      $("#edt_div_modelo").show();
      $( "#edt_modelo_cadastro" ).prop( "disabled", true );
      $("#edt_desc_modelo").show();

    } else{
      $("#edt_desc_modelo").hide();
      $("#edt_div_marca").hide();
      $("#edt_div_modelo").hide();
      $( "#edt_modelo_cadastro" ).prop( "disabled", false );
    }
        
        $("#edt_modelo_cadastro").find("option").hide(); 
          $("#edt_modelo_cadastro").find("[data-value='"+marca+"'],[value='666']").show();
        $("#edt_modelo_cadastro").find("[value='default']").prop("selected", true);  
       
     
     

    });


    $("#edt_modelo_cadastro").change(function(){
        if($("#edt_modelo_cadastro").val() == '666'){

          $("#edt_div_modelo").show(); 
           $("#edt_desc_modelo").show();

        } else{
          $("#edt_div_modelo").hide();
           $("#edt_desc_modelo").hide();
        }
    });



    $.getJSON('./cores.json', function (data) {

              var items = [];
              var options = '<option value="">escolha uma cor</option>';              
              
              var str = "";         
               

                $.each(data, function (key, val) {
                               
                    $.each(val.Cores, function (key_cor, val_cor) {
                      options += '<option value="' + val_cor + '">' + val_cor + '</option>';
                  });             
                
                    
                });
                $("#edt_cor_cadastro").html(options);
             
            $('#edt_cor_cadastro option[value="<?php echo $carro->getCor_carro(); ?>"]').prop({defaultSelected: true});
         });

          
    //values
   



    $("#edt_nrm_chassi").val("<?php echo $carro->getNumero_chassi(); ?>");
    $("#edt_placa_cadastro").val("<?php echo $carro->getPlaca_carro(); ?>");    
    $("#edt_diaria_cadastro").val("<?php echo $carro->getValor_diaria(); ?>");
    $("#edt_data_cadastro").val("<?php echo $carro->getData(); ?>");
    $("#edt_km_valor_cadastro").val("<?php echo $carro->getValor_km(); ?>");
    $("#edt_diaria_cadastro").val("<?php echo $carro->getValor_diaria(); ?>");

    $("#edt_km_cadastro").val("<?php echo $carro->getQuilometragem_inicial(); ?>");


    //Valores Select
       $('#edt_marca_cadastro option[value="<?php echo $carro->getMarca(); ?>"]').prop({defaultSelected: true});
      $('#edt_modelo_cadastro option[value="<?php echo $carro->getModelo(); ?>"]').prop({defaultSelected: true});

       $('#edt_status option[value="<?php echo $carro->getStatus(); ?>"]').prop({defaultSelected: true});
    
    
     
   



}); // FINAL DOM




</script>
			
		