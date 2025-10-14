<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
?>
<!-- formulário de cadastro - BEGIN -->
<div>
  <input type="hidden" name="sme_sme_id" id="sme_sme_id" value="<?= $rsRegistroSIdent['id'] ;?>">
</div>

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