<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  ss.id,
  ss.status,
  ss.dt_cadastro,
  ss.sme_servidor_id,
  ss.dt_ocorrido,
  ss.descricao,
  ss.dt_inicio,
  ss.dt_fim
  FROM sme_serv_saude AS ss
  WHERE ss.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSSaude = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSSaude) {
  $rsRegistrosSSaude = array();
  $rsRegistrosSSaude[0]['id'] = 0;
  $rsRegistrosSSaude[0]['status'] = 1;
  $rsRegistrosSSaude[0]['dt_cadastro'] = '';
  $rsRegistrosSSaude[0]['sme_servidor_id'] = $idS;
  $rsRegistrosSSaude[0]['dt_ocorrido'] = '';
  $rsRegistrosSSaude[0]['descricao'] = '';
  $rsRegistrosSSaude[0]['dt_inicio'] = '';
  $rsRegistrosSSaude[0]['dt_fim'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Saude do Servidor(a)";
$siDescricaoFormulario1    = "Saude do servidor(a)";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ss_sme_servidor_id" id="ss_sme_servidor_id" value="<?= $idS ;?>">
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
        foreach ($rsRegistrosSSaude as $keySS => $objSS) {
          ?>
          <div divcount="<?=$keySI+1;?>" class="div_clonar row border border-outline-info rounded  pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Saude - <span class="span_contador"><?=$keySS+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="ss_sme_serv_saude_id[]" id="ss_sme_serv_saude_id_<?=$keySS+1;?>" idbase="ss_sme_serv_saude_id_" value="<?=$objSS['id'];?>"/>
            <div class="row">
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '12',
                /*string*/    'label'       => 'Data de Reporte',
                /*string*/    'name'        => 'ss_dt_ocorrido[]',
                /*string*/    'id'          => 'ss_dt_ocorrido_'.$keySS,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data de reporte',
                /*string*/    'value'       => $objSS['dt_ocorrido'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="ss_dt_ocorrido_"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createTextArea(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Descrição',
                /*string*/    'name'        => 'ss_descricao[]',
                /*string*/    'id'          => 'ss_descricao_'.$keySS,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => 'Descreva a descrição do ocorrido',
                /*string*/    'value'       => $objSS['descricao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="ss_descricao_"'
              )) ;?>
            </div>
            <div class="row">
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '12',
                /*string*/    'label'       => 'Data de Inicio da Ocorrência',
                /*string*/    'name'        => 'ss_dt_inicio[]',
                /*string*/    'id'          => 'ss_dt_inicio_'.$keySS,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data de inicio da ocorrência',
                /*string*/    'value'       => $objSS['dt_inicio'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="ss_dt_inicio_"'
              )) ;?>
            </div>
            <div class="row">
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '12',
                /*string*/    'label'       => 'Data de Finalização da Ocorrência',
                /*string*/    'name'        => 'ss_dt_fim[]',
                /*string*/    'id'          => 'ss_dt_fim_'.$keySS,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data de finalização da ocorrência',
                /*string*/    'value'       => $objSS['dt_fim'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="ss_dt_fim_"'
              )) ;?>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover esta saude
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar esta saude
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