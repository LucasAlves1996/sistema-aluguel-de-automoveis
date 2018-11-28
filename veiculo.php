<?php

session_start();

if(!isset($_SESSION['user'])){
	$_SESSION['acessoSemLogin'] = "Para acessar esta página você deve fazer login!";
	header('Location: index.php');
}

include ("html/layout-default/top.php");

require ("classes/automovel.php");
$veiculo = new automovel();
?>



<div id="dlt" style="display: none;">
  
</div>
<div class="container-fluid">
  <div class="row"> <!--row funcionalidades -->
    <div class="col-md-2 mt-4">

      <!-- Botão trigger do modal -->
      
      <button id="btn_cadastro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cadastro">
      Cadastrar veículo
      </button><br>

     
    </div> <!-- FINAL DA COLUNA -->
    
  </div>  <!-- FINAL DA ROW -->

    <div class="row mt-4""> <!-- ROW PESQUISA -->
      <div class="col-md-2">
        <div class="form-group">          
          <label for="pesquisa_carro">Pesquisar: </label>
          <input type="text" class="form-control" id="pesquisa_carro">       
          
         </div>
      </div> <!-- FINAL COLUNA -->

      <div class="col-md-2">
        <label for="select_pesquisa">Filtro: </label>
      <div>
        <select id="select_pesquisa" class="form-control">
          <option>ID</option>
          <option>Modelo</option>
          <option>Marca</option>
          <option>Placa do Carro</option>
          <option>Nº Chassi</option>
          <option>Valor Diária</option>
          <option>Data</option>
        </select>
        </div>
      </div>
    </div> <!-- FINAL DA ROW -->


  <?php $veiculo_view = $veiculo->listar(); ?>

  <div class="row"> <!-- ROW TABLEA -->
    <div class="col-md-12 mt-4 responsive-table">

          <table id="table_carro" class="table table-dark">
             <thead>

              <tr>
                <th scope="col">ID</th>
                <th scope="col">Modelo</th>
                <th scope="col">Marca</th>
                <th scope="col">Nº Chassi</th>
                <th scope="col">Placa do carro</th>
                <th scope="col">Cor do carro</th>
                <th scope="col">Quilometragem</th>
                <th scope="col">Valor Diária</th>
                <th scope="col">Status</th>
                 <th scope="col">Aquisição</th>
                <th scope="col">Desc</th>
                <th scope="col">Editar</th>
                <th scope="col">Deletar</th>

              </tr>
            </thead>

            <tbody>
              
              <?php 
                  $buffer = '';
              foreach ($veiculo_view as $key => $value) {                
              
                  $buffer.= '<tr>';
                  $buffer.= '<td>'.$value['idVeiculo'].' </td>';
                  $buffer.=' <td>'.$value['nome_modelo'].' </td>';
                  $buffer.= '<td>'.$value['nome_marca'].' </td>';
                  $buffer.= '<td>'.$value['numero_chassi'].'</td>';
                  $buffer.= '<td>'.$value['placa_carro'].'</td>';
                  $buffer.= ' <td>'.$value['cor_carro'].'</td>';
                  $buffer.= '<td>'.$value['quilometragem_veiculo'].'</td>';
                  $buffer.= ' <td>'.$value['valor_diaria'].'</td>';

                  if($value['status_carro'] == 1 ){
                   $buffer.= ' <td> Livre </td>';
                  } else if($value['status_carro'] == 2){
                    $buffer.= ' <td> Alugado </td>';
                  } else if($value['status_carro'] == 3){
                    $buffer.= ' <td> inativo </td>';
                  }
                 
                  $data_formatada_view = date('d/m/Y', strtotime($value['data_aquisicao']));  
                  $buffer.= ' <td>'.$data_formatada_view.'</td>';
                  $buffer.= '<td> <button value="'.$value['idModelo'].'" class="desc_mod btn btn-primary"> Desc </button> </td>';
                  $buffer.= '<td> <button value="'.$value['idVeiculo'].'" class="edt_veic btn btn-success"> Editar </button> </td>';
                  $buffer.= '<td> <button value="'.$value['idVeiculo'].'" class="dlt_veic btn btn-danger"> Deletar </button> </td>';
                  $buffer.= '</tr>';
                  
              }

              echo $buffer;

              ?>
            

             
            </tbody>

          </table>
    </div> <!-- FINAL DA COLUNA -->

  </div><!-- FINAL DA ROW -->
</div>



<script type="text/javascript">

  var valor_id = 0;

  $(document).ready(function(){

    // filtro

     $("#pesquisa_carro").on("keyup", function() {
    
      var value = $(this).val().toLowerCase();
        
        $("#table_carro tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    //Limpa os campos do modal pós cadastro

    $('#modal_cadastro').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});

    $("#edt_veic_frm").click(function(){
      editaVeiculo(valor_id);
    });


    //Envia POST ajax para cadastro 
    $("#bt-cadastrar").click(function(){   
      cadastrarVeiculo();
    });


    // Adiciona conteudo no modal descrição via get.
    $(".edt_veic").click(function(){
      valor_id = $(this).val();
      
       $('#edita_cadastro .modal-body').load('html/veiculo/frm-edita-cadastro.php?id='+valor_id,function(){
         $('#edita_cadastro').modal({show:true});
     
    }); // FINAL LOAD
     });   // FINAL ON CLICK


    $(".desc_mod").click(function(){
      valor = $(this).val();
      
       $('#desc_modal .modal-body').load('html/veiculo/desc-modelo.php?id='+valor,function(){
         $('#desc_modal').modal({show:true});
     
    }); // FINAL LOAD
     });   // FINAL ON CLICK


      $(".dlt_veic").click(function(){
      valor = $(this).val();
      console.log(valor);
        var r = confirm("Você tem certeza que deseja deletar esse veiculo?");
           if (r == true) {               
               $("#dlt").load('html/veiculo/deleta-veiculo.php?id='+valor);                
                }       
     
     // FINAL LOAD
     
     });   // FINAL ON CLICK


    // FUNÇÃO CADASTRO DE VEICULO
    function cadastrarVeiculo(){
      //Variaveis a serem enviadas
      var SENDVALUE = {
        edt: 0,        
        marca: $("#marca_cadastro").val(),
        modelo: $("#modelo_cadastro").val(),
        chassi: $("#nrm_chassi_cadastro").val(),
        cor: $("#cor_cadastro").val(),
        diaria: $("#diaria_cadastro").val(),
        placa: $("#placa_cadastro").val(),
        quilometragem: $("#km_cadastro").val(),
        valor_quilometragem: $("#km_valor_cadastro").val(),
        desc: $("#desc_cadastro").val(),
        outra_marca : $("#outra_marca").val(),
        outro_modelo : $("#outro_modelo").val(),
        data: $("#data_cadastro").val()
      }

      $.ajax({
          type: "POST",
          url: "php/salvar-veiculo.php",
          data: SENDVALUE,
          success: function(dados){
            alert("Cadastro incluido com sucesso");
               $('#modal_cadastro').modal('hide');
               $('#modal_cadastro').find("input,textarea,select").val('');
              location.reload(); 
              
            }
            
        });
     }  //FINAL DA FUNLÇÃO


     function editaVeiculo($valor){
          //Variaveis a serem enviadas
     
      
      console.log($valor);

      var SENDVALUE = {
        edt: 1,
        id_edita: $valor,
        edt_marca: $("#edt_marca_cadastro").val(),
        edt_modelo: $("#edt_modelo_cadastro").val(),
        edt_chassi: $("#edt_nrm_chassi_cadastro").val(),
        edt_cor: $("#edt_cor_cadastro").val(),
        edt_diaria: $("#edt_diaria_cadastro").val(),
        edt_placa: $("#edt_placa_cadastro").val(),
        edt_quilometragem: $("#edt_km_cadastro").val(),
        edt_valor_quilometragem: $("#edt_km_valor_cadastro").val(),
        edt_desc: $("#edt_desc_cadastro").val(),
        edt_outra_marca : $("#edt_outra_marca").val(),
        edt_outro_modelo : $("#edt_outro_modelo").val(),
        edt_data: $("#edt_data_cadastro").val(),
        edt_status: $("#edt_status").val()
      }

      $.ajax({
          type: "POST",
          url: "php/salvar-veiculo.php",
          data: SENDVALUE,
          success: function(dados){
            alert("Veiculo editado com sucesso");
               $('#edita_cadastro').modal('hide');
              location.reload(); 
              
            }
            
        });
     }  //FINAL DA FUNLÇÃO
         
          
          

  }); // Final dom



</script>

  



<!-- ************************************************** MODAL ****************************************** -->

<!-- Modal Cadastro veiculo -->
<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar veículo</h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
       
        </button>
      
      </div>

      <div class="modal-body">
        <?php require_once ("html/veiculo/frm-veiculo-cadastro.php"); ?>
      </div>

      <div class="modal-footer">
        <button id="bt-cadastrar" type="button" class="btn btn-primary">Cadastrar</button>
        <button id="bt-cancelar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>




 <!-- MODAL DESCRIÇÃO --> 
<div class="modal fade" id="desc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Descrição modelo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">                    

           
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>


<!-- MODAL EDITA CADASTRO -->

<div class="modal fade" id="edita_cadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edita veículo</h5>
       
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
       
        </button>
      
      </div>

      <div class="modal-body">
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="edt_veic_frm" type="button" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>