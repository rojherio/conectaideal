<?php
//Consulta para Edição - BEGIN
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $bsc_pessoa_id : $idUE;
//Parámetros de títutlos - BEGIN
$ueTituloFormulario1        = "Identificação da Unidade Educativa";
$ueDescricaoFormulario1     = "Seleção da pessoa jurídica referente a esta unidade educativa";
$ueTituloFormulario2        = "Conceitos da Unidade Escolar";
$ueDescricaoFormulario2     = "Conceitos do INEP que identificam a Unidade Escolar";
$ueTituloFormulario3        = "";
$ueDescricaoFormulario3     = "";
$ueTituloFormulario4        = "";
$ueDescricaoFormulario4     = "";
$ueTituloFormulario5        = "Situação";
$ueDescricaoFormulario5     = "Defina se esse cadastro da unidade educativa está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<input type="hidden" name="ue_id" id="ue_id" value="<?= $rsRegistroUEIdent['id'] ;?>">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $ueTituloFormulario1;?></h5>
        <small><?= $ueDescricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row pb-0">
        </div>
        <?php
        $bsc_pessoa_id = $rsRegistroUEIdent['bsc_pessoa_id'];
        ?>
        <div>
          <?php 
          include_once ('view/bsc/pessoa_juridica/content_contato.php'); 
          ?>
        </div>
      </div>
      <!-- div row input - END -->
    </div>
  </div>
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