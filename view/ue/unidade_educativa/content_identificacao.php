<?php
//Consulta para Edição - BEGIN
if (!isset($id)) {
  $id = ($parametromodulo) ? : 0;
}
//Identiicação - BEGIN
$stmt = $db->prepare("SELECT 
  ue.id,
  ue.status,
  ue.dt_cadastro,
  ue.bsc_pessoa_id,
  ue.inep_cod,
  ue.ue_funcionam_situacao_id,
  ue.ano_letivo_dt_inicio,
  ue.ano_letivo_dt_fim,
  ue.bsc_zona_id,
  ue.ue_localizacao_diferenciada_id,
  ue.bsc_esfera_administrativa_id_dependencia,
  ue.ue_cat_esc_priv_id,
  ue.bsc_esfera_administrativa_id_regulam,
  ue.ue_regulam_situacao_id,
  ue.ue_ue_vinculada_tipo_id,
  ue.ue_ue_id_vinculada,
  ue.regional_cod,
  ue.entidade_superior_acesso,
  ue.ue_infra_local_ocupacao_forma_id,
  ue.fornece_agua_potavel,
  ue.sala_aula_qtd,
  ue.sala_aula_climatizada_qtd,
  ue.sala_aula_acessibilidade_qtd,
  ue.internet_banda_larga_velocidade,
  ue.alimentacao_pnae_fnde_oferece
  FROM ue_ue AS ue
  WHERE ue.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroUEIdent = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroUEIdent)) {
  $id = 0;
  $rsRegistroUEIdent = array();
  $rsRegistroUEIdent['id'] = 0;
  $rsRegistroUEIdent['status'] = 1;
  $rsRegistroUEIdent['dt_cadastro'] = '';
  $rsRegistroUEIdent['bsc_pessoa_id'] = '';
  $rsRegistroUEIdent['inep_cod'] = '';
  $rsRegistroUEIdent['ue_funcionam_situacao_id'] = '';
  $rsRegistroUEIdent['ano_letivo_dt_inicio'] = '';
  $rsRegistroUEIdent['ano_letivo_dt_fim'] = '';
  $rsRegistroUEIdent['bsc_zona_id'] = '';
  $rsRegistroUEIdent['ue_localizacao_diferenciada_id'] = '';
  $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'] = '';
  $rsRegistroUEIdent['ue_cat_esc_priv_id'] = '';
  $rsRegistroUEIdent['bsc_esfera_administrativa_id_regulam'] = '';
  $rsRegistroUEIdent['ue_regulam_situacao_id'] = '';
  $rsRegistroUEIdent['ue_ue_vinculada_tipo_id'] = '';
  $rsRegistroUEIdent['ue_ue_id_vinculada'] = '';
  $rsRegistroUEIdent['regional_cod'] = '';
  $rsRegistroUEIdent['entidade_superior_acesso'] = '';
  $rsRegistroUEIdent['ue_infra_local_ocupacao_forma_id'] = '';
  $rsRegistroUEIdent['fornece_agua_potavel'] = '';
  $rsRegistroUEIdent['sala_aula_qtd'] = '';
  $rsRegistroUEIdent['sala_aula_climatizada_qtd'] = '';
  $rsRegistroUEIdent['sala_aula_acessibilidade_qtd'] = '';
  $rsRegistroUEIdent['internet_banda_larga_velocidade'] = '';
  $rsRegistroUEIdent['alimentacao_pnae_fnde_oferece'] = '';
}
//Identiicação - END
//UO Publicas - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  bsc_uo_publica_id AS tb_ref_id
  FROM ue_ue_uo_publica_vinc
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistrosUOPublicaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//UO Publicas - END
//Ensino Atendimento Tipo - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_ens_atend_tipo_id AS tb_ref_id
  FROM ue_ue_ens_atend_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistrosEnsAtendTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Ensino Atendimento Tipo - END//Ensino Modalidade Etapa - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  ue_ue_id AS tb_base_id,
  ue_ens_modalidade_etapa_id AS tb_ref_id
  FROM ue_ue_ens_modalidade_etapa
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistrosEnsModalidadeEtapaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Ensino Modalidade Etapa - END
//Ensino Profissionalizante Forma - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  ue_ue_id AS tb_base_id,
  ue_ens_profis_forma_id AS tb_ref_id
  FROM ue_ue_ens_profis_forma
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistrosEnsProfisFormaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Ensino Profissionalizante Forma - END
//Locais de Funcionamento - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_local_funcionam_id AS tb_ref_id
  FROM ue_ue_infra_local_funcionam
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistrosInfraLocalFuncionamId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
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
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Código INEP',
            /*string*/    'type'        => 'number',
            /*string*/    'name'        => 'ue_inep_cod',
            /*string*/    'id'          => 'ue_inep_cod',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o código INEP',
            /*string*/    'value'       => $rsRegistroUEIdent['inep_cod'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <label>Selecione uma pessoa jurídica. Caso não a encontre na lista, digite o nome/razão social da pessoa jurídica para efetuar o cadastro.</label>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Pessoa Jurídica',
            /*string*/    'name'        => 'ue_bsc_pessoa_id',
            /*string*/    'id'          => 'ue_bsc_pessoa_id',
            /*string*/    'class'       => 'select2-tags form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['bsc_pessoa_id'],
            /*array()*/   'options'     => $rsPJs,
            /*string*/    'ariaLabel'   => 'Selecione uma pessoa jurídica',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '
            urltosendsub="model/bsc/pessoa_juridica/salvar_identificacao" 
            controller="pj" 
            load="true" 
            loadurl="view/bsc/pessoa_juridica/content_identificacao/" 
            gettextinputid="p_nome" 
            setstatusinputid="p_status" ',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <?php
        $displayPJ = $rsRegistroUEIdent['bsc_pessoa_id'] == '' ? 'style="display: none;"' : '';
        $idAux = $rsRegistroUEIdent['bsc_pessoa_id'];
        ?>
        <div id="div_pj" controlled="pj" control-value="0" <?= $displayPJ ;?>>
          <?php 
          include_once ('view/bsc/pessoa_juridica/content_identificacao.php'); 
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
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $ueTituloFormulario2;?></h5>
        <small><?= $ueDescricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <h6>Situação de funcionamento</h6>
        <!-- <div class="row border border-primary rounded pt-1 pt-3 ms-0 pe-3_5 me-0 mb-3">
          <div class="row border border-primary rounded pt-3 ms-3 me-3 mb-3"> -->
          <!-- </div>
        </div> -->
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Situação de funcionamento',
            /*string*/    'name'        => 'ue_ue_funcionam_situacao_id',
            /*string*/    'id'          => 'ue_ue_funcionam_situacao_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['ue_funcionam_situacao_id'],
            /*array()*/   'options'     => $rsFuncionamSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione uma situação de funcionamento',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <h6>Internvalo do Ano Letivo da Unidade Escolar</h6>
        <div class="row">
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data Inicial',
            /*string*/    'name'        => 'ue_ano_letivo_dt_inicio',
            /*string*/    'id'          => 'ue_ano_letivo_dt_inicio',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '2000-01-01',
            /*int*/       'maxToday'    => false,
            /*string*/    'placeholder' => 'Digite a data inicial do ano letivo',
            /*string*/    'value'       => $rsRegistroUEIdent['ano_letivo_dt_inicio'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?><?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data Final',
            /*string*/    'name'        => 'ue_ano_letivo_dt_fim',
            /*string*/    'id'          => 'ue_ano_letivo_dt_fim',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '2000-01-01',
            /*int*/       'maxToday'    => false,
            /*string*/    'placeholder' => 'Digite a data final do ano letivo',
            /*string*/    'value'       => $rsRegistroUEIdent['ano_letivo_dt_fim'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <h6>Zona de Localização da Unidade Escolar</h6>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Zona',
            /*string*/    'name'        => 'ue_bsc_zona_id',
            /*string*/    'id'          => 'ue_bsc_zona_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['bsc_zona_id'],
            /*array()*/   'options'     => $rsZonas,
            /*string*/    'ariaLabel'   => 'Selecione uma zona',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <h6>Localização Diferenciada da Unidade Escolar</h6>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Localização Diferenciada',
            /*string*/    'name'        => 'ue_ue_localizacao_diferenciada_id',
            /*string*/    'id'          => 'ue_ue_localizacao_diferenciada_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['ue_localizacao_diferenciada_id'],
            /*array()*/   'options'     => $rsLocalizacaoDiferenciadas,
            /*string*/    'ariaLabel'   => 'Selecione uma localização diferenciada',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <h6>Dependência Administrativa da Unidade Escolar</h6>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Dependência Administrativa',
            /*string*/    'name'        => 'ue_bsc_esfera_administrativa_id_dependencia',
            /*string*/    'id'          => 'ue_bsc_esfera_administrativa_id_dependencia',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'],
            /*array()*/   'options'     => $rsEsferaAdmninDepends,
            /*string*/    'ariaLabel'   => 'Selecione uma dependência administrativa',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <h6>Órgão Responsável Pela Criação da Unidade Educativa</h6>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgãos Responsáveis',
            /*string*/    'name'        => 'bsc_uo_publica_id[]',
            /*string*/    'id'          => 'bsc_uo_publica_id',
            /*string*/    'class'       => 'select2 form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUOPublicaId,
            /*array()*/   'options'     => $rsUOPublicas,
            /*string*/    'ariaLabel'   => 'Selecione os locais de funcionamento',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>


        <!-- <h6>Internvalo do Ano Letivo da Unidade Escolar</h6>
        <div class="row border border-primary rounded pt-1 pt-3 ms-0 pe-3_5 me-0 mb-3"> -->
          <?php
          // $countAnoLetivo = 0;
          // foreach ($rsRegistroAnoLetivos as $key => $obj) {
            // $countAnoLetivo++;
          ?>
          <!-- <div class="row border border-primary rounded pt-3 ms-3 me-3 mb-3"> -->
              <?php //createInputDate(array(
                // /*int 1-12*/  'col'         => 6,
                // /*string*/    'label'       => 'Data de Início',
                // /*string*/    'name'        => 'ue_ano_letivo_dt_inicio[]',
                // /*string*/    'id'          => 'ue_ano_letivo_dt_inicio'.$countAnoLetivo,
                // /*string*/    'class'       => 'form-control mask-data',
                // /*int*/       'min'         => '2000-01-01',
                // /*int*/       'maxToday'    => false,
                // /*string*/    'placeholder' => 'Digite a data de início do ano letivo',
                // /*string*/    'value'       => $obj['dt_inicio'],
                // /*bool*/      'required'    => false,
                // /*string*/    'prop'        => ''
              // )) ;?>
              <?php // createInputDate(array(
                // /*int 1-12*/  'col'         => 6,
                // /*string*/    'label'       => 'Data de Início',
                // /*string*/    'name'        => 'ue_ano_letivo_dt_fim[]',
                // /*string*/    'id'          => 'ue_ano_letivo_dt_fim'.$countAnoLetivo,
                // /*string*/    'class'       => 'form-control mask-data',
                // /*int*/       'min'         => '2000-01-01',
                // /*int*/       'maxToday'    => false,
                // /*string*/    'placeholder' => 'Digite a data de início do ano letivo',
                // /*string*/    'value'       => $obj['dt_fim'],
                // /*bool*/      'required'    => false,
                // /*string*/    'prop'        => ''
              // )) ;?>
              <?php // createInput(array(
                // /*int 1-12*/  'col'         => 12,
                // /*string*/    'label'       => 'Observação',
                // /*string*/    'type'        => 'text',
                // /*string*/    'name'        => 'ue_ano_letivo_descricao[]',
                // /*string*/    'id'          => 'ue_ano_letivo_descricao'.$countAnoLetivo,
                // /*string*/    'class'       => 'form-control',
                // /*int*/       'minlength'   => 3,
                // /*int*/       'maxlength'   => 254,
                // /*string*/    'placeholder' => 'Digite a explicação do ano letivo',
                // /*string*/    'value'       => $obj['descricao'],
                // /*bool*/      'required'    => false,
                // /*string*/    'prop'        => ''
              // )) ;?>
              <!-- </div> -->
              <?php
          // }
              ?>
              <!-- </div> -->



              <h6>Categoria de Escola Privada</h6>
              <div class="row">
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Categoria de Escola Privada',
                  /*string*/    'name'        => 'ue_ue_cat_esc_priv_id',
                  /*string*/    'id'          => 'ue_ue_cat_esc_priv_id',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*string*/    'value'       => $rsRegistroUEIdent['ue_cat_esc_priv_id'],
                  /*array()*/   'options'     => $rsCatEscPrivs,
                  /*string*/    'ariaLabel'   => 'Selecione uma categoria de escola privada',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <h6>Tipo de Atendimento de Ensino</h6>
              <div class="row">
                <?= createSelectMultiple(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Tipos de Atendimento',
                  /*string*/    'name'        => 'ue_ens_atend_tipo_id[]',
                  /*string*/    'id'          => 'ue_ens_atend_tipo_id',
                  /*string*/    'class'       => 'select2 form-control form-select',
                  /*array()*/   'value'       => $rsRegistrosEnsAtendTipoId,
                  /*array()*/   'options'     => $rsEnsAtendTipos,
                  /*string*/    'ariaLabel'   => 'Selecione os tipos de atendimentos',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <h6>Modalidade/Etapa de Ensino</h6>
              <div class="row">
                <?= createSelectMultiple(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Modalidade/Etapa de Ensino',
                  /*string*/    'name'        => 'ue_ens_modalidade_etapa_id[]',
                  /*string*/    'id'          => 'ue_ens_modalidade_etapa_id',
                  /*string*/    'class'       => 'select2 form-control form-select',
                  /*array()*/   'value'       => $rsRegistrosEnsModalidadeEtapaId,
                  /*array()*/   'options'     => $rsEnsModalidadeEtapas,
                  /*string*/    'ariaLabel'   => 'Selecione as modalidades/etapas',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <h6>Forma de Ensino Profissionalizante</h6>
              <div class="row">
                <?= createSelectMultiple(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Forma de Ensino Profissionalizante',
                  /*string*/    'name'        => 'ue_ens_profis_forma_id[]',
                  /*string*/    'id'          => 'ue_ens_profis_forma_id',
                  /*string*/    'class'       => 'select2 form-control form-select',
                  /*array()*/   'value'       => $rsRegistrosEnsProfisFormaId,
                  /*array()*/   'options'     => $rsEnsProfisFormas,
                  /*string*/    'ariaLabel'   => 'Selecione as formas de ensino profissionalizante',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <h6>Esfera Administrativa Responsável pela Regulamentação/Autorização de Funcionamento da Unidade Educativa</h6>
              <div class="row">
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Situação de Regulamentação/Autorização',
                  /*string*/    'name'        => 'ue_bsc_esfera_administrativa_id_regulam',
                  /*string*/    'id'          => 'ue_bsc_esfera_administrativa_id_regulam',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*string*/    'value'       => $rsRegistroUEIdent['bsc_esfera_administrativa_id_regulam'],
                  /*array()*/   'options'     => $rsEsferaAdmninRegulams,
                  /*string*/    'ariaLabel'   => 'Selecione uma esfera administriva responsável pela regulamentação/autorização',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <h6>Situação de Regulamentação/Autorização de Funcionamento da Unidade Educativa</h6>
              <div class="row">
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Situação de Regulamentação/Autorização',
                  /*string*/    'name'        => 'ue_ue_regulam_situacao_id',
                  /*string*/    'id'          => 'ue_ue_regulam_situacao_id',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*string*/    'value'       => $rsRegistroUEIdent['ue_regulam_situacao_id'],
                  /*array()*/   'options'     => $rsRegulamSituacoes,
                  /*string*/    'ariaLabel'   => 'Selecione uma situação de regulamentação/autorização',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <h6>Locais de Funcionamento da Unidade Educativa</h6>
              <div class="row">
                <?= createSelectMultiple(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Locais de Funcionamento',
                  /*string*/    'name'        => 'ue_infra_local_funcionam_id[]',
                  /*string*/    'id'          => 'ue_infra_local_funcionam_id',
                  /*string*/    'class'       => 'select2 form-control form-select',
                  /*array()*/   'value'       => $rsRegistrosInfraLocalFuncionamId,
                  /*array()*/   'options'     => $rsInfraLocalFuncionamentos,
                  /*string*/    'ariaLabel'   => 'Selecione os locais de funcionamento',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <!-- div row input - END -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <!-- Título da div de cadastro - BEGIN -->
              <h5><?= $ueTituloFormulario5;?></h5>
              <small><?= $ueDescricaoFormulario5;?></small>
              <!-- Título da div de cadastro - END -->
            </div>
            <div class="card-body">
              <!-- div row input - BEGIN -->
              <div class="row">
                <?= createCheckbox(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Ativo',
                  /*string*/    'type'        => 'checkbox',
                  /*string*/    'name'        => 'ue_status',
                  /*string*/    'id'          => 'ue_status',
                  /*string*/    'class'       => 'toggle',
                  /*string*/    'value'       => 1,
                  /*string*/    'checked'     => $rsRegistroUEIdent['status'],
                  /*string*/    'prop'        => ''
                )) ;?>
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