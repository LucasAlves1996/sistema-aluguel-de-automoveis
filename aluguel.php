<?php 

require_once ("html/layout-default/top.php");

require ("classes/aluguel.php");
$veiculo = new automovel();
?>


<div class="container-fluid">
  <div class="row"> <!--row funcionalidades -->
    <div class="col-md-2 mt-4">

      <!-- Botão trigger do modal -->
      
      <button id="btn_cadastro_aluguel" type="button" class="btn btn-primary" data-toggle="modal" data-target="#cadastro_aluguel">
      Alugar carro
      </button><br>

     
    </div> <!-- FINAL DA COLUNA -->
    
  </div>  <!-- FINAL DA ROW -->



  </div><!-- FINAL DA ROW -->
</div>



<!-- Modal -->
<div class="modal fade" id="cadastro_aluguel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require_once "html/aluguel/frm-aluguel.php"; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>