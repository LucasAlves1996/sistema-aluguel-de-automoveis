<?php

session_start();

include ("html/layout-default/top.php");

include ("classes/cliente.php");
$cliente = new cliente();

?>

<div id="dlt" style="display: none;">
  
</div>
<div class="container-fluid">
  <div class="row"> <!--row funcionalidades -->
    <div class="col-md-2 mt-4">

      <!-- Botão trigger do modal -->
      
      <button id="btn_cadastro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_cadastro">
      Cadastrar cliente
      </button><br>

     
    </div> <!-- FINAL DA COLUNA -->
    
  </div>  <!-- FINAL DA ROW -->

  <div class="row mt-4""> <!-- ROW PESQUISA -->
    <div class="col-md-2">
      <div class="form-group">          
        <label for="pesquisa_cliente">Pesquisar: </label>
        <input type="text" class="form-control" id="pesquisa_cliente">             
      </div>
    </div> <!-- FINAL COLUNA -->
  </div> <!-- FINAL DA ROW -->

  <?php $cliente_view = $cliente->listar(); ?>

  <div class="row"> <!-- ROW TABLEA -->
    <div class="col-md-12 mt-4 responsive-table">

          <table id="table_cliente" class="table table-dark">
             <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Data de cadastro</th>
                <th scope="col">CPF</th>
                <th scope="col">Tipo</th>
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
                <th scope="col">Deletar</th>
              </tr>
            </thead>

            <tbody>
              
              <?php

                $buffer = '';

                foreach ($cliente_view as $key => $value) {
                  $buffer.= '<tr>';
                  $buffer.= '<td>'.$value['idCliente'].' </td>';
                  $buffer.=' <td>'.$value['nome_cliente'].' </td>';
                  $buffer.= '<td>'.date('d/m/Y', strtotime($value['data_cadastro_cliente'])).' </td>';
                  $buffer.= '<td>'.$value['cpf_cliente'].'</td>';
                  if($buffer.= '<td>'.$value['tipo_cliente'].'</td>' == 1){
                    $buffer.= '<td>FREE</td>';
                  }else if($buffer.= '<td>'.$value['tipo_cliente'].'</td>' == 2){
                    $buffer.= '<td>PREMIUM</td>';
                  }
                  $buffer.= ' <td>'.$value['status_cliente'].'</td>';
                  $buffer.= '<td> <button value="'.$value['idCliente'].'" class="btn btn-success"> Editar </button> </td>';
                  $buffer.= '<td> <button value="'.$value['idCliente'].'" class="btn btn-danger"> Deletar </button> </td>';
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

     $("#pesquisa_cliente").on("keyup", function() {
    
      var value = $(this).val().toLowerCase();
        
        $("#table_cliente tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

    //Limpa os campos do modal pós cadastro

    $('#modal_cadastro').on('hidden.bs.modal', function () {
    $(this).find("input,textarea,select").val('').end();

});

    $("#edt_client_frm").click(function(){
      editaVeiculo(valor_id);
    });


    //Envia POST ajax para cadastro 
    $("#bt-cadastrar").click(function(){   
      cadastrarCliente();
    });


    // Adiciona conteudo no modal descrição via get.
    $(".edt_client").click(function(){
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

    // FUNÇÃO CADASTRO DE CLIENTE
    function cadastrarCliente(){
      //Variaveis a serem enviadas
      var SENDVALUE = {
        edt: 0,        
        nome: $("#nome").val(),
        cpf: $("#cpf").val(),
        telefone: $("#telefone").val(),
        rua: $("#rua").val(),
        numero: $("#numero").val(),
        complemento: $("#complemento").val(),
        pais: $("#pais").val(),
        estado: $("#estado").val(),
        cidade: $("#cidade").val(),
        data: $("#data").val(),
      }

      $.ajax({
          type: "POST",
          url: "php/salvar-cliente.php",
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

<!-- Modal Cadastro cliente -->
<div class="modal fade" id="modal_cadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?php require_once ("html/cliente/cadastro_cliente.php"); ?>
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