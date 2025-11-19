<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  sfcm.id,
  sfcm.status,
  sfcm.dt_cadastro,
  sfcm.c_h,
  sfcm.sme_servidor_id,
  sfcm.ue_compon_curricular_id
  FROM sme_serv_formac_complemen AS sfcm 
  WHERE sfcm.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSFComplemen = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSFComplemen) {
  $rsRegistrosSFComplemen = array();
  $rsRegistrosSFComplemen[0]['id'] = 0;
  $rsRegistrosSFComplemen[0]['status'] = 1;
  $rsRegistrosSFComplemen[0]['dt_cadastro'] = '';
  $rsRegistrosSFComplemen[0]['c_h'] = '';
  $rsRegistrosSFComplemen[0]['sme_servidor_id'] = '';
  $rsRegistrosSFComplemen[0]['ue_compon_curricular_id'] = '';
}
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Componente Curricular - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_compon_curricular  
  WHERE 1 = 1;");
$stmt->execute();
$rsComponCurriculars = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Componente Curricular - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Formação/Complementação Pedagógica do Servidor(a)";
$siDescricaoFormulario1    = "Informações de formações/complementações pedagógicas do servidor(a)";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="sfcm_sme_servidor_id" id="sfcm_sme_servidor_id" value="<?= $idS ;?>">
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
        foreach ($rsRegistrosSFComplemen as $keySFC => $objSFC) {
          ?>
          <div divcount="<?=$keySFC+1;?>" class="div_clonar row border border-outline-info rounded pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Fomacação/Complementação Pedagógica - <span class="span_contador"><?=$keySFC+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="sfcm_sme_serv_formac_complemen_id[]" id="sfcm_sme_serv_formac_complemen_id_<?=$keySFC+1;?>" idbase="sfcm_sme_serv_formac_complemen_id_" value="<?=$objSFC['id'];?>"/>
            <div class="row pe-0">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '8 pe-1',
                /*string*/    'label'       => 'Componente Curricular Cursado',
                /*string*/    'name'        => 'sfcm_ue_compon_curricular_id[]',
                /*string*/    'id'          => 'sfcm_ue_compon_curricular_id_'.$keySFC,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSFC['ue_compon_curricular_id'],
                /*array()*/   'options'     => $rsComponCurriculars,
                /*string*/    'ariaLabel'   => 'Selecione o componente curricular cursado',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sfcm_ue_compon_curricular_id_"'
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Carga-Horária',
                /*string*/    'type'        => 'number',
                /*string*/    'name'        => 'sfcm_c_h[]',
                /*string*/    'id'          => 'sfcm_c_h_'.$keySFC,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 5,
                /*string*/    'placeholder' => 'Digite a carga-horária',
                /*string*/    'value'       => $objSFC['c_h'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sfcm_c_h_"'
              )) ;?>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover esta formação
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar outra formação
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