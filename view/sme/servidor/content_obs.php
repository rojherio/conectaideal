<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  so.id,
  so.status,
  so.dt_cadastro,
  so.sme_servidor_id,
  so.dt_ocorrido,
  so.descricao
  FROM sme_serv_obs AS so
  WHERE so.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSObs = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSObs) {
  $rsRegistrosSObs = array();
  $rsRegistrosSObs[0]['id'] = 0;
  $rsRegistrosSObs[0]['status'] = 1;
  $rsRegistrosSObs[0]['dt_cadastro'] = '';
  $rsRegistrosSObs[0]['sme_servidor_id'] = '';
  $rsRegistrosSObs[0]['dt_ocorrido'] = '';
  $rsRegistrosSObs[0]['descricao'] = '';
}
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Observações do Servidor(a)";
$siDescricaoFormulario1    = "Observações do servidor(a)";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="so_sme_servidor_id" id="so_sme_servidor_id" value="<?= $rsRegistroSIdent['id'] ;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $siTituloFormulario1;?></h5>
        <small><?= $siDescricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="div_clones card-body pt-0">
        <?php
        foreach ($rsRegistrosSObs as $keySO => $objSO) {
          ?>
          <div divcount="<?=$keySO+1;?>" class="div_clonar row border border-outline-info rounded rounded pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Observação - <span class="span_contador"><?=$keySO+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="so_sme_servidor_obs_id[]" id="so_sme_servidor_obs_id_<?=$keySO+1;?>" idbase="so_sme_servidor_obs_id_" value="<?=$objSO['id'];?>"/>
            <div class="row">
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '12',
                /*string*/    'label'       => 'Data do Ocorrido',
                /*string*/    'name'        => 'so_dt_ocorrido[]',
                /*string*/    'id'          => 'so_dt_ocorrido_'.$keySO,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data do ocorrido',
                /*string*/    'value'       => $objSO['dt_ocorrido'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="so_dt_ocorrido_"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '12',
                /*string*/    'label'       => 'Descrição',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'so_descricao[]',
                /*string*/    'id'          => 'so_descricao_'.$keySO,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 254,
                /*string*/    'placeholder' => 'Digite a descrição do ocorrido',
                /*string*/    'value'       => $objSO['descricao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="so_descricao_"'
              )) ;?>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover esta Observação
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar esta Observação
                </button>
              </div>
            </div>
          </div>
          <!-- div row input - END -->
          <?php
        }
        ?>
      </div>
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