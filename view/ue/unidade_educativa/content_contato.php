<?php
//Consulta para Edição - BEGIN
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $bsc_pessoa_id : $idUE;
//Consulta para Edição - END
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div>
  <input type="hidden" name="ue_id" id="ue_id" value="<?= $rsRegistroUEIdent['id'] ;?>">
</div>
<?php
$bsc_pessoa_id = $rsRegistroUEIdent['bsc_pessoa_id'];
include_once ('view/bsc/pessoa_juridica/content_contato.php'); 
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <!-- div row buttons - BEGIN -->
        <div class="row">
          <div class="box-footer text-center">
            <button type="reset" class="btn_reset btn btn-outline-danger b-r-22" id="btn_cancelar">
              <i class="ti ti-eraser"></i> Cancelar
            </button>
            <button type="button" id="submit" class="btn_submit btn btn-outline-success waves-light b-r-22">
              <i class="ti ti-writing"></i> Cadastrar
            </button>
          </div>
        </div>
        <!-- div row buttons - END -->
      </div>
    </div>
  </div>
</div>