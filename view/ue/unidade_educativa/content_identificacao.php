<?php
//Consulta para Edição - BEGIN
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $ue_ue_id : $idUE;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  ue.id,
  ue.status,
  ue.dt_cadastro,
  ue.bsc_pessoa_id,
  ue.inep_cod,
  ue.orgao_regional_cod,
  ue.orgao_regional_nome,
  ue.ue_funcionam_situacao_id,
  ue.ano_letivo_dt_inicio,
  ue.ano_letivo_dt_fim,
  ue.bsc_zona_id,
  ue.ue_localizacao_diferenciada_id,
  ue.bsc_esfera_administrativa_id_dependencia,
  ue.ue_cat_esc_priv_id,
  ue.parceria_see, 
  ue.parceria_sme, 
  ue.bsc_esfera_administrativa_id_regulam,
  ue.ue_regulam_situacao_id
  FROM ue_ue AS ue
  WHERE ue.id = ? ;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistroUEIdent = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroUEIdent)) {
  $idUE = 0;
  $rsRegistroUEIdent = array();
  $rsRegistroUEIdent['id'] = 0;
  $rsRegistroUEIdent['status'] = 1;
  $rsRegistroUEIdent['dt_cadastro'] = '';
  $rsRegistroUEIdent['bsc_pessoa_id'] = '';
  $rsRegistroUEIdent['inep_cod'] = '';
  $rsRegistroUEIdent['orgao_regional_cod'] = '';
  $rsRegistroUEIdent['orgao_regional_nome'] = '';
  $rsRegistroUEIdent['ue_funcionam_situacao_id'] = '';
  $rsRegistroUEIdent['ano_letivo_dt_inicio'] = '';
  $rsRegistroUEIdent['ano_letivo_dt_fim'] = '';
  $rsRegistroUEIdent['bsc_zona_id'] = '';
  $rsRegistroUEIdent['ue_localizacao_diferenciada_id'] = '';
  $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'] = '';
  $rsRegistroUEIdent['ue_cat_esc_priv_id'] = '';
  $rsRegistroUEIdent['parceria_see'] = '';
  $rsRegistroUEIdent['parceria_sme'] = '';
  $rsRegistroUEIdent['bsc_esfera_administrativa_id_regulam'] = '';
  $rsRegistroUEIdent['ue_regulam_situacao_id'] = '';
}
//Identiicação - END
//UO Publicas - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  bsc_uo_publica_id AS tb_ref_id
  FROM ue_ue_uo_publica_vinc
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
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
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosEnsAtendTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Ensino Atendimento Tipo - END//Ensino Modalidade Etapa - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  ue_ue_id AS tb_base_id,
  ue_ens_modalidade_etapa_id AS tb_ref_id
  FROM ue_ue_ens_modalidade_etapa
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
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
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosEnsProfisFormaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Ensino Profissionalizante Forma - END
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Pessoas Jurídicas - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM bsc_pessoa AS p
  WHERE p.tipo = 2;");
$stmt->execute();
$rsPJs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Pessoas Jurídicas - END
//Situação Funcionamento - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM ue_funcionam_situacao AS p
  WHERE 1 = 1;");
$stmt->execute();
$rsFuncionamSituacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Situação Funcionamento - END
//Zona - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_zona
  WHERE 1 = 1;");
$stmt->execute();
$rsZonas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Zona - END
//Localização Diferenciada - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_localizacao_diferenciada
  WHERE 1 = 1;");
$stmt->execute();
$rsLocalizacaoDiferenciadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Localização Diferenciada - END
//Esfera Administrativa Dependência - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_esfera_administrativa
  WHERE 1 = 1;");
$stmt->execute();
$rsEsferaAdmninDepends = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Esfera Administrativa Dependência - END
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
//Categoria de Escola Privada - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_cat_esc_priv
  WHERE 1 = 1;");
$stmt->execute();
$rsCatEscPrivs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Categoria de Escola Privada - END
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
//Situação Regulamentação/Autorização - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_regulam_situacao
  WHERE 1 = 1;");
$stmt->execute();
$rsRegulamSituacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Situação Regulamentação/Autorização - END
//Esfera Responsável Regulamentação - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_esfera_administrativa
  WHERE id <> 4;");
$stmt->execute();
$rsEsferaAdmninRegulams = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Esfera Responsável Regulamentação - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$ueiTituloFormulario1       = "Identificação da Unidade Educativa";
$ueiDescricaoFormulario1    = "Seleção da pessoa jurídica referente a esta unidade educativa";
$ueiTituloFormulario2       = "Conceitos da Unidade Educativa";
$ueiDescricaoFormulario2    = "Conceitos do INEP que identificam a Unidade Educativa";
$ueiTituloFormulario3        = "";
$ueiDescricaoFormulario3     = "";
$ueiTituloFormulario4        = "";
$ueiDescricaoFormulario4     = "";
$ueiTituloFormulario5        = "Situação";
$ueiDescricaoFormulario5     = "Defina se esse cadastro da unidade educativa está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ue_id" id="ue_id" value="<?= $rsRegistroUEIdent['id'] ;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $ueiTituloFormulario1;?></h5>
        <small><?= $ueiDescricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row pb-0">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 3,
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
          <?= createInput(array(
            /*int 1-12*/  'col'         => 3,
            /*string*/    'label'       => 'Código do Órgão Regional',
            /*string*/    'type'        => 'number',
            /*string*/    'name'        => 'ue_orgao_regional_cod',
            /*string*/    'id'          => 'ue_orgao_regional_cod',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 30,
            /*string*/    'placeholder' => 'Digite o código do órgão',
            /*string*/    'value'       => $rsRegistroUEIdent['orgao_regional_cod'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Nome do Órgão Regional',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ue_orgao_regional_nome',
            /*string*/    'id'          => 'ue_orgao_regional_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 130,
            /*string*/    'placeholder' => 'Digite o nome do órgão',
            /*string*/    'value'       => $rsRegistroUEIdent['orgao_regional_nome'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <label>Selecione uma pessoa jurídica. Caso não a encontre na lista, digite o nome/razão social da pessoa jurídica para efetuar o cadastro.</label>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '12',
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
            controller-values="0" 
            load="true" 
            loadurl="view/bsc/pessoa_juridica/content_identificacao/" 
            gettextinputid="p_nome" 
            setstatusinputid="p_status" '
          )); ?>
        </div>
        <?php
        $displayPJ = $rsRegistroUEIdent['bsc_pessoa_id'] == '' ? 'style="display: none;"' : '';
        $bsc_pessoa_id = $rsRegistroUEIdent['bsc_pessoa_id'];
        ?>
        <div id="div_pj" controlled="pj" control-value="0" <?= $displayPJ ;?> class="border border-outline-info rounded  mb-1 ms-0 me-0">
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
        <h5><?= $ueiTituloFormulario2;?></h5>
        <small><?= $ueiDescricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <!-- <div class="row border border-primary rounded pt-3 ms-0 pe-3_5 me-0 mb-3">
          <div class="row border border-primary rounded pt-3 ms-3 me-3 mb-3"> -->
          <!-- </div>
        </div> -->
        <div class="row">
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data Inicial do Ano Letivo',
            /*string*/    'name'        => 'ue_ano_letivo_dt_inicio',
            /*string*/    'id'          => 'ue_ano_letivo_dt_inicio',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '2000-01-01',
            /*int*/       'maxToday'    => false,
            /*string*/    'placeholder' => 'Digite a data inicial do ano letivo',
            /*string*/    'value'       => $rsRegistroUEIdent['ano_letivo_dt_inicio'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data Final do Ano Letivo',
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
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Situação de funcionamento',
            /*string*/    'name'        => 'ue_ue_funcionam_situacao_id',
            /*string*/    'id'          => 'ue_ue_funcionam_situacao_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['ue_funcionam_situacao_id'],
            /*array()*/   'options'     => $rsFuncionamSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione a situação de funcionamento',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Zona de Localização',
            /*string*/    'name'        => 'ue_bsc_zona_id',
            /*string*/    'id'          => 'ue_bsc_zona_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['bsc_zona_id'],
            /*array()*/   'options'     => $rsZonas,
            /*string*/    'ariaLabel'   => 'Selecione a zona',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Localização Diferenciada',
            /*string*/    'name'        => 'ue_ue_localizacao_diferenciada_id',
            /*string*/    'id'          => 'ue_ue_localizacao_diferenciada_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['ue_localizacao_diferenciada_id'],
            /*array()*/   'options'     => $rsLocalizacaoDiferenciadas,
            /*string*/    'ariaLabel'   => 'Selecione a localização diferenciada',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '4 controller="ue_privada"',
            /*string*/    'label'       => 'Dependência Administrativa',
            /*string*/    'name'        => 'ue_bsc_esfera_administrativa_id_dependencia',
            /*string*/    'id'          => 'ue_bsc_esfera_administrativa_id_dependencia',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'],
            /*array()*/   'options'     => $rsEsferaAdmninDepends,
            /*string*/    'ariaLabel'   => 'Selecione a dependência administrativa',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => 'controller="ue_privada" controller-values="4"'
          )); ?>
        </div>
        <?php
        //Parámetros de exibir/ocultar div - BEGIN
        $displayUEPrivada   = $rsRegistroUEIdent['bsc_esfera_administrativa_id_dependencia'] != 4 ? 'style="display: none;"' : '';
        //Parámetros de exibir/ocultar div - NED
        ?>
        <div controlled="ue_privada" control-value="4" <?= $displayUEPrivada ;?>>
          <div class="row">
            <div class="col-md-8"></div>
            <?= createSelect(array(
              /*int 1-12*/  'col'         => 4,
              /*string*/    'label'       => 'Categoria de Escola Privada',
              /*string*/    'name'        => 'ue_ue_cat_esc_priv_id',
              /*string*/    'id'          => 'ue_ue_cat_esc_priv_id',
              /*string*/    'class'       => 'select2 form-control form-select select-basic',
              /*string*/    'value'       => $rsRegistroUEIdent['ue_cat_esc_priv_id'],
              /*array()*/   'options'     => $rsCatEscPrivs,
              /*string*/    'ariaLabel'   => 'Selecione a categoria de escola privada',
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="ue_privada" control-value="4"'
            )); ?>
          </div>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Órgão Responsável (Regulamentação/Autorização de Funcionamento)',
            /*string*/    'name'        => 'ue_bsc_esfera_administrativa_id_regulam',
            /*string*/    'id'          => 'ue_bsc_esfera_administrativa_id_regulam',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['bsc_esfera_administrativa_id_regulam'],
            /*array()*/   'options'     => $rsEsferaAdmninRegulams,
            /*string*/    'ariaLabel'   => 'Selecione o órgão responsável pela regulamentação/autorização',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Situação de Regulamentação/Autorização de Funcionamento',
            /*string*/    'name'        => 'ue_ue_regulam_situacao_id',
            /*string*/    'id'          => 'ue_ue_regulam_situacao_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUEIdent['ue_regulam_situacao_id'],
            /*array()*/   'options'     => $rsRegulamSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione a situação de regulamentação/autorização',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgãos Responsáveis Pela Criação, Repasse e Normas da Unidade Educativa',
            /*string*/    'name'        => 'bsc_uo_publica_id[]',
            /*string*/    'id'          => 'bsc_uo_publica_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUOPublicaId,
            /*array()*/   'options'     => $rsUOPublicas,
            /*string*/    'ariaLabel'   => 'Selecione os órgãos responsáveis',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Tipos de Atendimento de Ensino',
            /*string*/    'name'        => 'ue_ens_atend_tipo_id[]',
            /*string*/    'id'          => 'ue_ens_atend_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosEnsAtendTipoId,
            /*array()*/   'options'     => $rsEnsAtendTipos,
            /*string*/    'ariaLabel'   => 'Selecione os tipos de atendimentos',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Modalidades/Etapas de Ensino',
            /*string*/    'name'        => 'ue_ens_modalidade_etapa_id[]',
            /*string*/    'id'          => 'ue_ens_modalidade_etapa_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosEnsModalidadeEtapaId,
            /*array()*/   'options'     => $rsEnsModalidadeEtapas,
            /*string*/    'ariaLabel'   => 'Selecione as modalidades/etapas',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Formas de Ensino Profissionalizante',
            /*string*/    'name'        => 'ue_ens_profis_forma_id[]',
            /*string*/    'id'          => 'ue_ens_profis_forma_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosEnsProfisFormaId,
            /*array()*/   'options'     => $rsEnsProfisFormas,
            /*string*/    'ariaLabel'   => 'Selecione as formas de ensino profissionalizante',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
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
        <h5><?= $ueiTituloFormulario5;?></h5>
        <small><?= $ueiDescricaoFormulario5;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Ativo',
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