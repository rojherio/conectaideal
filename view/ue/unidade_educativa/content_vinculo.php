<?php
//Consulta para Edição - BEGIN
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $bsc_pessoa_id : $idUE;
//UO Publicas Convenios - BEGIN
$stmt = $db->prepare("SELECT
  id,
  descricao,
  ue_ue_id,
  bsc_uo_publica_id
  FROM ue_ue_inst_parc_conv
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUOPublicaVinc = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($rsRegistrosUOPublicaVinc) {
  foreach ($rsRegistrosUOPublicaVinc as $key => $obj) {
    $stmt = $db->prepare("SELECT 
      id,
      descricao,
      ue_parc_conv_forma_id,
      ue_ue_inst_parc_conv_id
      FROM ue_ue_isnt_parc_conv_forma
      WHERE ue_ue_inst_parc_conv_id = ?;");
    $stmt->bindValue(1, $obj['id']);
    $stmt->execute();
    $rsRegistrosInstParcConvForma = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rsRegistrosInstParcConvForma as $key1 => $obj1) {
      $stmt = $db->prepare("SELECT 
        eat.id,
        eat.nome,
        ueipceat.matricula_qtd,
        ueipceat.descricao,
        ueipceat.ue_ue_isnt_parc_conv_forma_id
        FROM ue_ens_atend_tipo AS eat
        LEFT JOIN (
          SELECT
          ueueipceat.id,
          ueueipceat.matricula_qtd,
          ueueipceat.descricao,
          ueueipceme.ue_ens_atend_tipo_id,
          ueueipceat.ue_ue_isnt_parc_conv_forma_id
          FROM ue_ue_inst_parc_conv_ens_atend_tipo AS ueueipceat
          WHERE ueueipceat.ue_ue_isnt_parc_conv_forma_id = ? 
          ) AS ueipceat ON ueipceat.ue_ens_atend_tipo_id = eat.id
        WHERE 1 = 1;");
      $stmt->bindValue(1, $obj1['id']);
      $stmt->execute();
      $rsRegistrosInstParcConvForma[$key1]['ensAtendTipos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $db->prepare("SELECT 
        eme.id,
        CONCAT(emt.nome, ' - ', eme.nome) AS nome,
        ueipceme.matricula_qtd,
        ueipceme.descricao,
        ueipceme.ue_ue_isnt_parc_conv_forma_id
        FROM ue_ens_modalidade_etapa AS eme
        LEFT JOIN (
          SELECT
          ueueipceme.id,
          ueueipceme.matricula_qtd,
          ueueipceme.descricao,
          ueueipceme.ue_ens_modalidade_etapa_id,
          ueueipceme.ue_ue_isnt_parc_conv_forma_id
          FROM ue_ue_inst_parc_conv_ens_modalidade_etapa AS ueueipceme
          WHERE ueueipceme.ue_ue_isnt_parc_conv_forma_id = ? 
          ) AS ueipceme ON ueipceme.ue_ens_modalidade_etapa_id = emt.id
        LEFT JOIN ue_ens_modalidade_tipo AS emt ON emt.id = eme.ue_ens_modalidade_tipo_id
        WHERE 1 = 1;");
      $stmt->bindValue(1, $obj1['id']);
      $stmt->execute();
      $rsRegistrosInstParcConvForma[$key1]['ensModalEtapas'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt = $db->prepare("SELECT 
        epf.id,
        CONCAT(ept.nome, ' - ', epf.nome) AS nome,
        ueipceat.matricula_qtd,
        ueipceat.descricao,
        ueipceat.ue_ue_isnt_parc_conv_forma_id
        FROM ue_ens_profis_forma AS epf
        LEFT JOIN (
          SELECT
          ueueipceat.id,
          ueueipceat.matricula_qtd,
          ueueipceat.descricao,
          ueueipceme.ue_ens_profis_forma_id,
          ueueipceat.ue_ue_isnt_parc_conv_forma_id
          FROM ue_ue_inst_parc_conv_ens_profis_forma AS ueueipceat
          WHERE ueueipceat.ue_ue_isnt_parc_conv_forma_id = ? 
          ) AS ueipceat ON ueipceat.ue_ens_profis_forma_id = epf.id
        LEFT JOIN ue_ens_profis_tipo AS ept ON ept.id = epf.ue_ens_profis_tipo_id
        WHERE 1 = 1;");
      $stmt->bindValue(1, $obj1['id']);
      $stmt->execute();
      $rsRegistrosInstParcConvForma[$key1]['ensProfisFormas'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $rsRegistrosUOPublicaVinc[$key]['ParcConvFormas'] = $rsRegistrosInstParcConvForma;
  }
} else {
  $rsRegistrosUOPublicaVinc = array();
  $rsRegistrosUOPublicaVinc[0]['id'] = 0;
  $rsRegistrosUOPublicaVinc[0]['descricao'] = '';
  $rsRegistrosUOPublicaVinc[0]['ue_ue_id'] = $idUE;
  $rsRegistrosUOPublicaVinc[0]['bsc_uo_publica_id'] = 0;
  $rsRegistrosUOPublicaVinc[0]['ParcConvFormas'] = array();
  $rsRegistrosInstParcConvForma = array();
  $rsRegistrosInstParcConvForma[0]['id'] = 0;
  $rsRegistrosInstParcConvForma[0]['descricao'] = '';
  $rsRegistrosInstParcConvForma[0]['ue_parc_conv_forma_id'] = 0;
  $rsRegistrosInstParcConvForma[0]['ue_ue_inst_parc_conv_id'] = 0;
  $stmt = $db->prepare("SELECT 
    eat.id,
    eat.nome,
    '' AS matricula_qtd,
    '' AS descricao,
    0 AS ue_ue_isnt_parc_conv_forma_id
    FROM ue_ens_atend_tipo AS eat
    WHERE 1 = 1;");
  $stmt->execute();
  $rsRegistrosInstParcConvForma[0]['ensAtendTipos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt = $db->prepare("SELECT 
    eme.id,
    CONCAT(emt.nome, ' - ', eme.nome) AS nome,
    '' AS matricula_qtd,
    '' AS descricao,
    0 AS ue_ue_isnt_parc_conv_forma_id
    FROM ue_ens_modalidade_etapa AS eme
    LEFT JOIN ue_ens_modalidade_tipo AS emt ON emt.id = eme.ue_ens_modalidade_tipo_id
    WHERE 1 = 1;");
  $stmt->execute();
  $rsRegistrosInstParcConvForma[0]['ensModalEtapas'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $stmt = $db->prepare("SELECT 
    epf.id,
    CONCAT(ept.nome, ' - ', epf.nome) AS nome,
    '' AS matricula_qtd,
    '' AS descricao,
    0 AS ue_ue_isnt_parc_conv_forma_id
    FROM ue_ens_profis_forma AS epf
    LEFT JOIN ue_ens_profis_tipo AS ept ON ept.id = epf.ue_ens_profis_tipo_id
    WHERE 1 = 1;");
  $stmt->execute();
  $rsRegistrosInstParcConvForma[0]['ensProfisFormas'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $rsRegistrosUOPublicaVinc[0]['ParcConvFormas'] = $rsRegistrosInstParcConvForma;
}
//UO Publicas Convenios - END
//Consulta para Edição - END
//Consultas para Select - BEGIN
//UO Publica - BEGIN
$stmt = $db->prepare("SELECT 
  uop.id,
  p.nome
  FROM bsc_uo_publica AS uop 
  LEFT JOIN bsc_pessoa AS p ON p.id = uop.bsc_pessoa_id
  WHERE 1 = 1;");
$stmt->execute();
$rsUOPublicas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//UO Publicaa - END
//Parceria/Convenio Forma - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome,
  descricao 
  FROM ue_parc_conv_forma
  WHERE 1 = 1;");
$stmt->execute();
$rsParcConvFormas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Parceria/Convenio Forma - END
//Ensino Atendimento Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_ens_atend_tipo
  WHERE 1 = 1;");
$stmt->execute();
$rsEnsAtendTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Ensino Atendimento Tipo - END
//Ensino Modalidade Etapa - BEGIN
$stmt = $db->prepare("SELECT 
  eme.id,
  CONCAT(emt.nome, ' - ', eme.nome) AS nome
  FROM ue_ens_modalidade_etapa AS eme
  LEFT JOIN ue_ens_modalidade_tipo AS emt ON emt.id = eme.ue_ens_modalidade_tipo_id
  WHERE 1 = 1;");
$stmt->execute();
$rsEnsModalidadeEtapas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Ensino Modalidade Etapa - END
//Ensino Profissionalizante Forma - BEGIN
$stmt = $db->prepare("SELECT 
  epf.id,
  CONCAT(ept.nome, ' - ', epf.nome) AS nome
  FROM ue_ens_profis_forma AS epf
  LEFT JOIN ue_ens_profis_tipo AS ept ON ept.id = epf.ue_ens_profis_tipo_id
  WHERE 1 = 1");
$stmt->execute();
$rsEnsProfisFormas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Ensino Profissionalizante Forma - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$uevTituloFormulario1       = "Poder Público Responsável pela Parceria ou Convênio";
$uevDescricaoFormulario1    = "Selecione a(s) sercretaría(s) pareceira(s) ou conveniada(s)";
$uevTituloFormulario2       = "Órgãos/Instituições em Parceria/Convênio";
$uevDescricaoFormulario2    = "Dados das parcerias/convênios com órgãos/instituições";
$uevTituloFormulario3        = "";
$uevDescricaoFormulario3     = "";
$uevTituloFormulario4        = "";
$uevDescricaoFormulario4     = "";
$uevTituloFormulario5        = "Situação";
$uevDescricaoFormulario5     = "Defina se esse cadastro da unidade educativa está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ue_id" id="ue_id" value="<?= $rsRegistroUEIdent['id'] ;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $uevTituloFormulario1;?></h5>
        <small><?= $uevDescricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row mb-3">
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Secretaria Estadual de Educação',
            /*string*/    'name'        => 'ue_parceria_see',
            /*string*/    'id'          => 'ue_parceria_see',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroUEIdent['parceria_see'],
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Secretaria Municipal de Educação',
            /*string*/    'name'        => 'ue_parceria_sme',
            /*string*/    'id'          => 'ue_parceria_sme',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroUEIdent['parceria_sme'],
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $uevTituloFormulario2;?></h5>
        <small><?= $uevDescricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="div_clones card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?php
          foreach ($rsRegistrosUOPublicaVinc as $keyUOPV => $objUOPV) {
            ?>
            <div divcount="<?=$keyUOPV;?>" class="div_clonar border border-outline-info rounded pt-3 pb-0 ps-3 pe-3 mt-0 mb-3">
              <h6>Órgão/Instituição em parceria/convênio - <span class="span_contador"><?=$keyUOPV+1;?></span></h6>
              <div>
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Órgão(s) em Parceira/Convênio',
                  /*string*/    'name'        => 'ue_bsc_uo_publica_id_vinc[]',
                  /*string*/    'id'          => 'ue_bsc_uo_publica_id_vinc_'.$keyUOPV.'',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*array()*/   'value'       => $objUOPV['bsc_uo_publica_id'],
                  /*array()*/   'options'     => $rsUOPublicas,
                  /*string*/    'ariaLabel'   => 'Selecione os órgãos vinculados',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="ue_bsc_uo_publica_id_vinc_" controllerbase="forma_parc_" controller="forma_parc_'.$keyUOPV.'" controller-values="0"'
                )); ?>
              </div>
              <?php
              //Parámetros de exibir/ocultar div - BEGIN
              $displayUOPublicaVinc   = $objUOPV['bsc_uo_publica_id'] == 0 ? 'style="display: none;"' : '';
              //Parámetros de exibir/ocultar div - NED
              ?>
              <div class="div_clones_sub">
                <?php
                foreach ($objUOPV['ParcConvFormas'] as $keyPCF => $objPCF) {
                  ?>
                  <div divcountsub="<?=$keyPCF;?>" controlled="forma_parc_<?=$keyUOPV;?>" control-value="0" class="div_clonar_sub border border-outline-primary rounded pt-3 pb-0 ps-3 pe-3 mt-0 mb-3" <?= $displayUOPublicaVinc ;?>>
                    <h6>Forma da Contratação da Parceria/Convênio -  <span class="span_contador_sub"><?=$keyPCF+1;?></span></h6>
                    <div class="row">
                      <?= createSelect(array(
                        /*int 1-12*/  'col'         => 12,
                        /*string*/    'label'       => 'Forma da Contratação',
                        /*string*/    'name'        => 'ue_ue_parc_conv_forma_id_'.$keyUOPV.'[]',
                        /*string*/    'id'          => 'ue_ue_parc_conv_forma_id_'.$keyUOPV.'_'.$keyPCF.'',
                        /*string*/    'class'       => 'select2 form-control form-select select-basic',
                        /*string*/    'value'       => $objPCF['ue_parc_conv_forma_id'],
                        /*array()*/   'options'     => $rsParcConvFormas,
                        /*string*/    'ariaLabel'   => 'Selecione uma forma de contratação',
                        /*bool*/      'required'    => false,
                        /*string*/    'prop'        => 'idbasesub="ue_ue_parc_conv_forma_id_" controlled="forma_parc_'.$keyUOPV.'" control-value="0" controllerbase="ue_ue_parc_conv_forma_id_" controller="ue_ue_parc_conv_forma_id_'.$keyUOPV.'_'.$keyPCF.'" controller-values="0" '
                      )); ?>
                    </div>
                    <?php
                    //Parámetros de exibir/ocultar div - BEGIN
                    $displayParcConvForma   = $objPCF['ue_parc_conv_forma_id'] == 0 ? 'style="display: none;"' : '';
                    //Parámetros de exibir/ocultar div - NED
                    ?>
                    <div idbasesub="ue_ue_parc_conv_forma_id_" controlled="ue_ue_parc_conv_forma_id_<?=$keyUOPV;?>_<?=$keyPCF;?>" control-value="0" <?= $displayParcConvForma ;?>>
                      <div class="row mt-0 mb-3">
                        <!-- Small Table start -->
                        <div class="col-xl-12">
                          <div class="table-responsive h-350">
                            <table class="table table-dark table-bottom-border table-sm table-hover table-striped align-middle mb-0">
                              <thead>
                                <tr>
                                  <th scope="col">Qtd Matrículas Ofertadas</th>
                                  <th scope="col">Tipo de Atendimento das Turmas</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                foreach ($objPCF['ensAtendTipos'] as $key1 => $obj1) {
                                  ?>
                                  <tr>
                                    <td><input 
                                      type="number" 
                                      idbasesubcontrol="ue_ue_pcf_eat_matricula_qtd_" 
                                      idcontrol="<?=$obj1['id'];?>" 
                                      controlled="ue_ue_parc_conv_forma_id_<?=$keyUOPV;?>_<?=$keyPCF;?>" 
                                      control-value="0" 
                                      controlled-noshow="forma_parc_<?=$keyUOPV;?>" 
                                      id="ue_ue_pcf_eat_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>" 
                                      name="ue_ue_pcf_eat_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>" 
                                      class="" 
                                      minlength="1" 
                                      min="1" 
                                      maxlength="10" 
                                      value="<?=$obj1['matricula_qtd'];?>">
                                    </td>
                                    <td><label for="ue_ue_pcf_eat_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>"><?= $obj1['nome'];?></label></td>
                                  </tr>
                                  <?php
                                }
                                ?>
                              </tbody>
                              <thead>
                                <tr>
                                  <th scope="col">Qtd Matrículas Ofertadas</th>
                                  <th scope="col">Etapas de Ensino</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                foreach ($objPCF['ensModalEtapas'] as $key1 => $obj1) {
                                  ?>
                                  <tr>
                                    <td><input 
                                      type="number" 
                                      idbasesubcontrol="ue_ue_pcf_eme_matricula_qtd_" 
                                      idcontrol="<?=$obj1['id'];?>" 
                                      controlled="ue_ue_parc_conv_forma_id_<?=$keyUOPV;?>_<?=$keyPCF;?>" 
                                      control-value="0" 
                                      controlled-noshow="forma_parc_<?=$keyUOPV;?>" 
                                      id="ue_ue_pcf_eme_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>" 
                                      name="ue_ue_pcf_eme_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>" 
                                      class="" 
                                      minlength="1" 
                                      min="1" 
                                      maxlength="10" 
                                      value="<?=$obj1['matricula_qtd'];?>">
                                    </td>
                                    <td><label for="ue_ue_pcf_eme_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>"><?= $obj1['nome'];?></label></td>
                                  </tr>
                                  <?php
                                }
                                ?>
                              </tbody>
                              <thead>
                                <tr>
                                  <th scope="col">Qtd Matrículas Ofertadas</th>
                                  <th scope="col">Educação Profissional</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php 
                                foreach ($objPCF['ensProfisFormas'] as $key1 => $obj1) {
                                  ?>
                                  <tr>
                                    <td><input 
                                      type="number" 
                                      idbasesubcontrol="ue_ue_pcf_epf_matricula_qtd_" 
                                      idcontrol="<?=$obj1['id'];?>" 
                                      controlled="ue_ue_parc_conv_forma_id_<?=$keyUOPV;?>_<?=$keyPCF;?>" 
                                      control-value="0" 
                                      controlled-noshow="forma_parc_<?=$keyUOPV;?>" 
                                      id="ue_ue_pcf_epf_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>" 
                                      name="ue_ue_pcf_epf_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>" 
                                      class="" 
                                      minlength="1" 
                                      min="1" 
                                      maxlength="10" 
                                      value="<?=$obj1['matricula_qtd'];?>">
                                    </td>
                                    <td><label for="ue_ue_pcf_epf_matricula_qtd_<?=$keyUOPV;?>_<?=$keyPCF;?>_<?=$obj1['id'];?>"><?= $obj1['nome'];?></label></td>
                                  </tr>
                                  <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- Small Table end -->
                      </div>
                    </div>
                    <div idbasesub="ue_ue_parc_conv_forma_id_" controlled="ue_ue_parc_conv_forma_id_<?=$keyUOPV;?>_<?=$keyPCF;?>" control-value="0" controlled-noshow="forma_parc_<?=$keyUOPV;?>" class="row" <?= $displayParcConvForma ;?>>
                      <div class="box-footer text-center mb-3">
                        <button type="button" class="btn_div_n2_remove btn btn-outline-warning waves-light b-r-22">
                          <i class="ti ti-eraser"></i> Remover esta forma de parceria
                        </button>
                        <button type="button" class="btn_div_n2_add btn btn-outline-info b-r-22">
                          <i class="ti ti-plus"></i> Adicionar outra forma de parceria
                        </button>
                      </div>
                    </div>
                  </div>
                  <?php
                }
                ?>
              </div>
              <div class="row" controlled="forma_parc_<?=$keyUOPV;?>" control-value="0" <?= $displayUOPublicaVinc ;?>>
                <div class="box-footer text-center mb-3">
                  <button type="button" class="btn_div_n1_remove btn btn-outline-warning waves-light b-r-22">
                    <i class="ti ti-eraser"></i> Remover esta parceria
                  </button>
                  <button type="button" class="btn_div_n1_add btn btn-outline-info b-r-22">
                    <i class="ti ti-plus"></i> Adicionar outra parceria
                  </button>
                </div>
              </div>
            </div>
            <?php
          }
          ?>
        </div>
        <!-- div row input - END -->
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
<!-- formulário de cadastro - END -->
<!-- <script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/pessoa_juridica/cadastrar.js"></script> -->