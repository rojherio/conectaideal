<?php
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $bsc_pessoa_id : $idUE;
//Consulta para Edição - BEGIN
//Identificação - BEGIN
// $stmt = $db->prepare("SELECT 
//   ue.id,
//   ue.status,
//   ue.dt_cadastro,
//   ue.bsc_pessoa_id,
//   ue.inep_cod,
//   ue.ue_funcionam_situacao_id,
//   ue.ano_letivo_dt_inicio,
//   ue.ano_letivo_dt_fim,
//   ue.bsc_zona_id,
//   ue.ue_localizacao_diferenciada_id,
//   ue.bsc_esfera_administrativa_id_dependencia,
//   ue.ue_cat_esc_priv_id,
//   ue.parceria_see, 
//   ue.parceria_sme, 
//   ue.bsc_esfera_administrativa_id_regulam,
//   ue.ue_regulam_situacao_id,
//   ue.ue_ue_vinculada_tipo_id,
//   ue.ue_ue_id_vinculada,
//   ue.regional_cod,
//   ue.entidade_superior_acesso,
//   ue.ue_infra_local_ocupacao_forma_id,
//   ue.fornece_agua_potavel,
//   ue.sala_aula_qtd,
//   ue.sala_aula_climatizada_qtd,
//   ue.sala_aula_acessibilidade_qtd,
//   ue.internet_banda_larga_velocidade,
//   ue.alimentacao_pnae_fnde_oferece
//   FROM ue_ue AS ue
//   WHERE ue.id = ? ;");
// $stmt->bindValue(1, $idUE);
// $stmt->execute();
// $rsRegistroUEIdent = $stmt->fetch(PDO::FETCH_ASSOC);
// if (!($rsRegistroUEIdent)) {
//   $idUE = 0;
//   $rsRegistroUEIdent = array();
//   $rsRegistroUEIdent['id'] = 0;
//   $rsRegistroUEIdent['status'] = 1;
//   $rsRegistroUEIdent['dt_cadastro'] = '';
//   $rsRegistroUEIdent['bsc_pessoa_id'] = '';
//   $rsRegistroUEIdent['inep_cod'] = '';
//   $rsRegistroUEIdent['ue_funcionam_situacao_id'] = '';
//   $rsRegistroUEIdent['ano_letivo_dt_inicio'] = '';
//   $rsRegistroUEIdent['ano_letivo_dt_fim'] = '';
//   $rsRegistroUEIdent['bsc_zona_id'] = '';
//   $rsRegistroUEIdent['ue_localizacao_diferenciada_id'] = '';
//   $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'] = '';
//   $rsRegistroUEIdent['ue_cat_esc_priv_id'] = '';
//   $rsRegistroUEIdent['parceria_see'] = '';
//   $rsRegistroUEIdent['parceria_sme'] = '';
//   $rsRegistroUEIdent['bsc_esfera_administrativa_id_regulam'] = '';
//   $rsRegistroUEIdent['ue_regulam_situacao_id'] = '';
//   $rsRegistroUEIdent['ue_ue_vinculada_tipo_id'] = '';
//   $rsRegistroUEIdent['ue_ue_id_vinculada'] = '';
//   $rsRegistroUEIdent['regional_cod'] = '';
//   $rsRegistroUEIdent['entidade_superior_acesso'] = '';
//   $rsRegistroUEIdent['ue_infra_local_ocupacao_forma_id'] = '';
//   $rsRegistroUEIdent['fornece_agua_potavel'] = '';
//   $rsRegistroUEIdent['sala_aula_qtd'] = '';
//   $rsRegistroUEIdent['sala_aula_climatizada_qtd'] = '';
//   $rsRegistroUEIdent['sala_aula_acessibilidade_qtd'] = '';
//   $rsRegistroUEIdent['internet_banda_larga_velocidade'] = '';
//   $rsRegistroUEIdent['alimentacao_pnae_fnde_oferece'] = '';
// }
// //Identiicação - END
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
      matricula_qtd,
      descricao,
      ue_ens_atend_tipo_id,
      ue_ue_isnt_parc_conv_forma_id
      FROM ue_ue_inst_parc_conv_ens_atend_tipo
      WHERE ue_ue_isnt_parc_conv_forma_id = ?;");
    $stmt->bindValue(1, $obj['id']);
    $stmt->execute();
    $rsRegistrosEnsAtendTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos'] = $rsRegistrosEnsAtendTipos;
    if (!$rsRegistrosEnsAtendTipos) {
      $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos'] = array();
      $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['id'] = 0;
      $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['matricula_qtd'] = '';
      $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['descricao'] = '';
      $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['ue_ens_atend_tipo_id'] = 0;
      $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['ue_ue_isnt_parc_conv_forma_id'] = 0;
    }
  }
} else {
  $rsRegistrosUOPublicaVinc = array();
  $rsRegistrosUOPublicaVinc[0]['id'] = 0;
  $rsRegistrosUOPublicaVinc[0]['descricao'] = '';
  $rsRegistrosUOPublicaVinc[0]['ue_ue_id'] = $idUE;
  $rsRegistrosUOPublicaVinc[0]['bsc_uo_publica_id'] = 0;
  $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos'] = array();
  $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['id'] = 0;
  $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['matricula_qtd'] = '';
  $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['descricao'] = '';
  $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['ue_ens_atend_tipo_id'] = 0;
  $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['ue_ue_isnt_parc_conv_forma_id'] = 0;
}
//UO Publicas Convenios - END
// //Ensino Atendimento Tipo - BEGIN
// $stmt = $db->prepare("SELECT
//   id,
//   ue_ue_id AS tb_base_id,
//   ue_ens_atend_tipo_id AS tb_ref_id
//   FROM ue_ue_ens_atend_tipo
//   WHERE ue_ue_id = ?;");
// $stmt->bindValue(1, $rsRegistroUEIdent['id']);
// $stmt->execute();
// $rsRegistrosEnsAtendTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
// //Ensino Atendimento Tipo - END//Ensino Modalidade Etapa - BEGIN
// $stmt = $db->prepare("SELECT 
//   id,
//   ue_ue_id AS tb_base_id,
//   ue_ens_modalidade_etapa_id AS tb_ref_id
//   FROM ue_ue_ens_modalidade_etapa
//   WHERE ue_ue_id = ?;");
// $stmt->bindValue(1, $rsRegistroUEIdent['id']);
// $stmt->execute();
// $rsRegistrosEnsModalidadeEtapaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
// //Ensino Modalidade Etapa - END
// //Ensino Profissionalizante Forma - BEGIN
// $stmt = $db->prepare("SELECT 
//   id,
//   ue_ue_id AS tb_base_id,
//   ue_ens_profis_forma_id AS tb_ref_id
//   FROM ue_ue_ens_profis_forma
//   WHERE ue_ue_id = ?;");
// $stmt->bindValue(1, $rsRegistroUEIdent['id']);
// $stmt->execute();
// $rsRegistrosEnsProfisFormaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
// //Ensino Profissionalizante Forma - END
// //Locais de Funcionamento - BEGIN
// $stmt = $db->prepare("SELECT
//   id,
//   ue_ue_id AS tb_base_id,
//   ue_infra_local_funcionam_id AS tb_ref_id
//   FROM ue_ue_infra_local_funcionam
//   WHERE ue_ue_id = ?;");
// $stmt->bindValue(1, $rsRegistroUEIdent['id']);
// $stmt->execute();
// $rsRegistrosInfraLocalFuncionamId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Locais de Funcionamento - END
//UO Publicas - BEGIN
// $stmt = $db->prepare("SELECT 
//   id,
//   status,
//   dt_cadastro,
//   dt_inicio,
//   dt_fim,
//   descricao
//   FROM ue_ue_ano_letivo
//   WHERE ue_ue_id = ? ;");
// $stmt->bindValue(1, $id);
// $stmt->execute();
// $rsRegistroAnoLetivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
// if (!($rsRegistroAnoLetivos)) {
//   $rsRegistroAnoLetivos = array();
//   $rsRegistroAnoLetivos[0]['id'] = 0;
//   $rsRegistroAnoLetivos[0]['status'] = 1;
//   $rsRegistroAnoLetivos[0]['dt_cadastro'] = '';
//   $rsRegistroAnoLetivos[0]['dt_inicio'] = '';
//   $rsRegistroAnoLetivos[0]['dt_fim'] = '';
//   $rsRegistroAnoLetivos[0]['descricao'] = '';
// }
//UO Publicas - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
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
            /*string*/    'type'        => 'checkbox',
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
            /*string*/    'type'        => 'checkbox',
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
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <template>
            <h6>Forma da Contratação da Parceria/Convênio</h6>
            <div class="row">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => 8,
                /*string*/    'label'       => 'Forma da Contratação',
                /*string*/    'name'        => 'ue_ue_parc_conv_forma[]',
                /*string*/    'id'          => 'ue_ue_parc_conv_forma',
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => 0,
                /*array()*/   'options'     => $rsParcConvFormas,
                /*string*/    'ariaLabel'   => 'Selecione uma forma de contratação',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => '',
                /*string*/    'display'     => true
              )); ?>
            </div>
          </template>
          <?php
          foreach ($rsRegistrosUOPublicaVinc as $keyUPPV => $objUPPV) {
            ?>
            <div class="row border border-primary rounded pt-1 pt-3 ms-0 me-0 mb-3">
              <h6>Órgão/Instituição em parceria/convênio</h6>
              <div>
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Órgão(s) em Parceira/Convênio',
                  /*string*/    'name'        => 'bsc_uo_publica_id_vinc[]',
                  /*string*/    'id'          => 'bsc_uo_publica_id_vinc',
                  /*string*/    'class'       => 'select2 form-control form-select',
                  /*array()*/   'value'       => $objUPPV['bsc_uo_publica_id'],
                  /*array()*/   'options'     => $rsUOPublicas,
                  /*string*/    'ariaLabel'   => 'Selecione os órgãos vinculados',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'controller="uopublicavinc" controller-key="'.$keyUPPV.'"',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <?php
              //Parámetros de exibir/ocultar div - BEGIN
              // $displayUEParcForma   = $objUPPV['bsc_esfera_administrativa_id_dependencia'] != 4 ? 'style="display: none;"' : '';
              //Parámetros de exibir/ocultar div - NED
              ?>
              <div id="div_orgao_parc" controlled="div_orgao_parc" control-value="4" >
                <div class="row border border-primary rounded pt-3 ps-3 ms-0 me-0 mb-3">
                  <h6>Forma da Contratação da Parceria/Convênio</h6>
                  <div class="row">
                    <?= createSelect(array(
                      /*int 1-12*/  'col'         => 12,
                      /*string*/    'label'       => 'Forma da Contratação',
                      /*string*/    'name'        => 'ue_ue_parc_conv_forma[]',
                      /*string*/    'id'          => 'ue_ue_parc_conv_forma',
                      /*string*/    'class'       => 'select2 form-control form-select select-basic',
                      /*string*/    'value'       => 0,
                      /*array()*/   'options'     => $rsParcConvFormas,
                      /*string*/    'ariaLabel'   => 'Selecione uma forma de contratação',
                      /*bool*/      'required'    => false,
                      /*string*/    'prop'        => '',
                      /*string*/    'display'     => true
                    )); ?>
                  </div>
                  <div id="div_ue_privada" controlled="ue_privada" control-value="4" >
                    <div class="row me-3 mb-3">
                      <!-- Small Table start -->
                      <div class="col-xl-12">
                        <div class="table-responsive">
                          <table class="table table-sm table-hover table-striped align-middle mb-0">
                            <tbody>
                              <tr>
                                <th scope="col">Qtd Matrículas Ofertadas</th>
                                <th scope="col">Tipo de Atendimento das Turmas</th>
                              </tr>
                              <?php 
                              foreach ($rsEnsAtendTipos as $key1 => $obj1) {
                              ?>
                              <tr>
                                <td><input type="number" id="ue_ue_pcf_eat_qtd" name="ue_ue_pcf_eat_qtd[]" value=""></td>
                                <td><?= $obj1['nome'];?></td>
                              </tr>
                              <?php
                              }
                              ?>
                              <tr>
                                <th scope="col">Qtd Matrículas Ofertadas</th>
                                <th scope="col">Etapas de Ensino</th>
                              </tr>
                              <?php 
                              foreach ($rsEnsModalidadeEtapas as $key1 => $obj1) {
                              ?>
                              <tr>
                                <td><input type="number" id="ue_ue_pcf_eme_qtd" name="ue_ue_pcf_eme_qtd[]" value=""></td>
                                <td><?= $obj1['nome'];?></td>
                              </tr>
                              <?php
                              }
                              ?>
                              <tr>
                                <th scope="col">Qtd Matrículas Ofertadas</th>
                                <th scope="col">Educação Profissional</th>
                              </tr>
                              <?php 
                              foreach ($rsEnsProfisFormas as $key1 => $obj1) {
                              ?>
                              <tr>
                                <td><input type="number" id="ue_ue_pcf_epf_qtd" name="ue_ue_pcf_epf_qtd[]" value=""></td>
                                <td><?= $obj1['nome'];?></td>
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
                </div>
              </div>
            </div>
            <?php
            // $stmt = $db->prepare("SELECT
            //   id,
            //   descricao,
            //   ue_ue_id,
            //   bsc_uo_publica_id
            //   FROM ue_ue_inst_parc_conv
            //   WHERE ue_ue_id = ?;");
            // $stmt->bindValue(1, $idUE);
            // $stmt->execute();
            // $rsRegistrosUOPublicaVinc = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // if ($rsRegistrosUOPublicaVinc) {
            //   foreach ($rsRegistrosUOPublicaVinc as $key => $obj) {
            //     $stmt = $db->prepare("SELECT 
            //       id,
            //       matricula_qtd,
            //       descricao,
            //       ue_ens_atend_tipo_id,
            //       ue_ue_isnt_parc_conv_forma_id
            //       FROM ue_ue_inst_parc_conv_ens_atend_tipo
            //       WHERE ue_ue_isnt_parc_conv_forma_id = ?;");
            //     $stmt->bindValue(1, $obj['id']);
            //     $stmt->execute();
            //     $rsRegistrosEnsAtendTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //     $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos'] = $rsRegistrosEnsAtendTipos;
            //     if (!$rsRegistrosEnsAtendTipos) {
            //       $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos'] = array();
            //       $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['id'] = 0;
            //       $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['matricula_qtd'] = '';
            //       $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['descricao'] = '';
            //       $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['ue_ens_atend_tipo_id'] = 0;
            //       $rsRegistrosUOPublicaVinc[$key]['ens_atend_tipos']['ue_ue_isnt_parc_conv_forma_id'] = 0;
            //     }
            //   }
            // } else {
            //   $rsRegistrosUOPublicaVinc = array();
            //   $rsRegistrosUOPublicaVinc[0]['id'] = 0;
            //   $rsRegistrosUOPublicaVinc[0]['descricao'] = '';
            //   $rsRegistrosUOPublicaVinc[0]['ue_ue_id'] = $idUE;
            //   $rsRegistrosUOPublicaVinc[0]['bsc_uo_publica_id'] = 0;
            //   $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos'] = array();
            //   $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['id'] = 0;
            //   $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['matricula_qtd'] = '';
            //   $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['descricao'] = '';
            //   $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['ue_ens_atend_tipo_id'] = 0;
            //   $rsRegistrosUOPublicaVinc[0]['ens_atend_tipos']['ue_ue_isnt_parc_conv_forma_id'] = 0;
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