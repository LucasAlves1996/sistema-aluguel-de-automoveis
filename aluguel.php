<?php

session_start();

require_once ("html/layout-default/top.php");

require ("classes/aluguel.php");

$alg = new aluguel();

if(!isset($_SESSION['user'])){
  $_SESSION['acessoSemLogin'] = "Para acessar esta página você deve fazer login!";
  header('Location: index.php');
}

?>

<div id="dlt_alg" style="display: none;"></div>
<div class="container-fluid">
  <div class="row"> <!--row funcionalidades -->
    <div class="col-md-2 mt-4">

      <!-- Botão trigger do modal -->
      
      <button id="btn_cadastro_aluguel" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastro_aluguel">
      Alugar carro
      </button><br>

     
    </div> <!-- FINAL DA COLUNA -->
    
  
  </div>  <!-- FINAL DA ROW -->

<div class="row">
    <div class="col-md-2 mt-4">
    
    <select id="controle" class="form-control">
      <option value="0" selected>Todos</option>
      <option value="1">Entregue</option>
      <option value="2">Não entregue</option>
      <option value="3">Pago</option>
      <option value="4">Não Pago</option>
    </select>
    <button style="width: 100% ;margin-top: 1%;"type="button" id="filtro" class="btn btn-outline-warning">Filtrar</button>
  </div>


  <div class="col-md-2 mt-4">
        <div class="form-group">          
          <h3>Pesquisar:</h3>
          <input type="text" class="form-control" id="pesquisa_aluguel">       
          
         </div>
       </div>
</div>  <!-- FINAL DA ROW -->






<!-- TABLE -->


 <div class="row"> <!-- ROW TABLEA -->
    <div class="col-md-12 mt-4 responsive-table">

          <table id="table_aluguel" class="table table-dark">
             <thead>

              <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">ID veiculo</th>                
                <th scope="col">Data aluguel</th>
                <th scope="col">Data devolução</th>
                <th scope="col">Data entrega</th>
                <th scope="col">Valor total</th>
                <th scope="col">Status Veículo</th>
                 <th scope="col">Status Pagamento</th>
             
                <th scope="col">Desc</th>
                <th scope="col">Editar</th>
                <th scope="col">Baixa</th>

              </tr>
            </thead>

            <tbody id="body_table">
       
            

             
            </tbody>

          </table>
    </div> <!-- FINAL DA COLUNA -->

  </div><!-- FINAL DA ROW -->


</div> 
<!-- FINAL CONTAINER -->

<script type="text/javascript">

  var data_init ;

  $(document).ready(function(){


     function lista_incio(){
        var SENDVALUE = {
        controle: '4' 
      }

       $.ajax({
          type: "POST",
          url: "html/aluguel/grid-alguel.php",
          data: SENDVALUE,
          beforeSend: function(){
            $("#body_table").html("Carregando....");
          },
          success: function(dados){
              $("#body_table").html(dados);
              
            }            
        });

      
    }
    
    lista_incio();

    $(".edt_alg").click(function(){
      valor_id = $(this).val();
      console.log(valor_id);
    });

    $("#filtro").click(function(){
      var SENDVALUE = {
        controle: $("#controle").val()   
      }

       $.ajax({
          type: "POST",
          url: "html/aluguel/grid-alguel.php",
          data: SENDVALUE,
          beforeSend: function(){
            $("#body_table").html("Carregando....");
          },
          success: function(dados){
              $("#body_table").html(dados);
              
            }            
        });

      
    });

    $("#pesquisa_aluguel").on("keyup", function() {
    
      var value = $(this).val().toLowerCase();
        
        $("#body_table tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    $("#envia_alg").click(function(){
        CadastraAluguel();
  });

    $("#baixa_alg").click(function(){

      baixaAluguel();
    });



    $('#cadastro_aluguel').on('hidden.bs.modal', function () {
    $(this).find("input,textarea").val('').end();
    $(this).find("select").val('0').end();

});



    $('#baixa_aluguel').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});



    function EditaAluguel($id){

          var data_final_edt = $("#edt_data_final_alg").val();
         var edt_status = 1;
          var veic = $("#edt_veiculo_alg").val();

          if( data_final_edt.length != 10){
            return alert("Insira uma previsão da data de devolução do aluguel length");
          }

         
            data_final_edt =  formataData(data_final_edt);
            data_init_teste = formataData(data_init);
            
           if(isNaN(data_final_edt.time) ){
    
              return alert("Insira uma previsão da data de devolução do aluguel válida");
        } else if (data_final_edt.time < data_init_teste.time){
            return alert("data final menor que a data inicial js");
        }


        if ($('#check_entregue').is(':checked')){
          edt_status = 2;
        }

        console.log(data_init);

        var SENDVALUE = {
        id: $id,
        edt: 1,
        status: edt_status,
        edt_data_inicio: data_init,
        edt_data_final:  data_final_edt.data_en,      
          
      }
         $.ajax({
          type: "POST",
          url: "php/salvar-aluguel.php",
          data: SENDVALUE,
          success: function(dados){
            if(dados === ""){
              alert("Aluguel extendido com sucesso!");
              location.reload(); 
               $('#edita_aluguel').modal('hide');
            } else{
              alert(dados);
            } 
          }
            
        });
     }  //FINAL DA FUNLÇÃO

      $("#btn_alg").click(function(){
          EditaAluguel(valor_id);
      });

      
    function formataData($data){

          var data_formatada;        

          data_formatada = $data.split("/").reverse().join("-");

          data_formatada = Date.parse(data_formatada);

          data_formatada = new Date(data_formatada);

          var resultado = {
            time: data_formatada.getTime(),
            data_en: $data.split("/").reverse().join("-")
          }
          return resultado;

    }


    function baixaAluguel(){
        var data_entrega = $("#data_entrega_alg").val();


          if( data_entrega.length != 10){
            return alert("Insira uma a data válida de inicio do aluguel length");
          }
          data_entrega =  formataData(data_entrega);


          if (isNaN(data_entrega.time)){

            return alert("Insira a data válida");
         }

        var SENDVALUE = {
        baixa: 1,
        data_entrega: data_entrega.data_en,
        pagamento: $("#mtd_pagamento").val(),
        km_final: $("#km_final").val(),
        sol: $("#nrm_aluguel").val()
        }

            $.ajax({
          type: "POST",
          url: "php/baixa-aluguel.php",
          data: SENDVALUE,
          success: function(dados){
            if(dados === ""){
               alert("baixa efetuada com sucesso efetuado com sucesso");             
               $('#baixa_aluguel').modal('hide');           
              location.reload(); 
            } else{
              alert(dados);
                           
            }             
              
          }
            
        });
       

    } // Final da função


     function CadastraAluguel(){
          //Variaveis a serem enviadas
          var data_inicio = $("#data_incio_alg").val();
          var data_final = $("#data_final_alg").val();
          var cpf = $("#cpf_alg").val();
          var veic = $("#veiculo_alg").val();
                

          if( data_inicio.length != 10){
            return alert("Insira uma a data válida de inicio do aluguel length");
          }

          if( data_final.length != 10){
            return alert("Insira uma previsão da data de devolução do aluguel length");
          }

         data_inicio =  formataData(data_inicio);
         data_final =  formataData(data_final);
         
         if (isNaN(data_inicio.time)){

            return alert("Insira uma a data válida de inicio do aluguel");
         } else if(isNaN(data_final.time) ){

          return alert("Insira uma previsão da data de devolução do aluguel válida");
         }  else if (data_final.time < data_inicio.time){

          return alert("A data de entrega é menor que a data de aluguel");
         }
        

          if(cpf.length != 11){
            return alert("Insira um CPF válido");
          }
         
          if(  veic  == "0" || veic == null ){
           
            return  alert("Selecione um veículo");         
          }


      var SENDVALUE = {
        edt: 0,
        data_inicio: data_inicio.data_en,
        data_final:  data_final.data_en,
        km_inicial:  $("#km_inicial_alg").val(),
        cpf:  $("#cpf_alg").val(),
        id_veiculo:  $("#veiculo_alg").val()        
      };

      $.ajax({
          type: "POST",
          url: "php/salvar-aluguel.php",
          data: SENDVALUE,
          success: function(dados){
            if(dados === ""){
              alert("Aluguel efetuado com sucesso");
              location.reload(); 
               $('#cadastro_aluguel').modal('hide');
             } else{
              alert(dados);
             }
              
              
              
            }
            
        });
     }  //FINAL DA FUNLÇÃO

    $(document).on("click", ".btn_baixa", function () {
     var id = $(this).data('id');
     $(".modal-body #nrm_aluguel").val(id);
});

     $(document).on("click", ".edt_alg", function () {
     data_init = $(this).data('id');
    
});
    

    }); // FINAL DOOM


</script>
<!-- Modal -->
<div class="modal fade" id="baixa_aluguel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content baixa_aluguel">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Dar baixa no aluguel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require_once "html/aluguel/frm-baixa-aluguel.php"; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        <button type="button" id="baixa_alg" class="btn btn-primary">Finalizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cadastro_aluguel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aluguel de veículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require_once "html/aluguel/frm-aluguel.php"; ?>
      </div>
      <div class="modal-footer">
        <button id="envia_alg" type="button" class="btn btn-primary">Alugar</button>
        <button id="bt-cancelar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="edita_aluguel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Solicitação de Aluguel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require_once "html/aluguel/frm-edita-aluguel.php"; ?>
      </div>
      <div class="modal-footer">
        <button id="btn_alg" type="button" class="btn btn-primary">Finalizar</button>
        <button id="bt-cancelar" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
