<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  s.id,
  s.status,
  s.dt_cadastro,
  s.bsc_pessoa_id,
  s.matricula,
  s.sme_serv_tipo_id,
  s.eo_cargo_id,
  s.sme_serv_situacao_id,
  s.situacao_trabalho_decreto,
  s.situacao_trabalho_doe,
  s.situacao_trabalho_dt_inicio,
  s.situacao_trabalho_dt_fim,
  s.situacao_trabalho_obs,
  s.matricula_2,
  s.sme_serv_tipo_id_2,
  s.eo_cargo_id_2,
  s.sme_serv_situacao_id_2,
  s.situacao_trabalho_decreto_2,
  s.situacao_trabalho_doe_2,
  s.situacao_trabalho_dt_inicio_2,
  s.situacao_trabalho_dt_fim_2,
  s.situacao_trabalho_obs_2,
  s.foto,
  s.senha_nome,
  s.sme_sme_id
  FROM sme_servidor AS s
  WHERE s.id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistroSIdent = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroSIdent)) {
  $idS = 0;
  $rsRegistroSIdent = array();
  $rsRegistroSIdent['id'] = 0;
  $rsRegistroSIdent['status'] = 1;
  $rsRegistroSIdent['dt_cadastro'] = '';
  $rsRegistroSIdent['bsc_pessoa_id'] = '';
  $rsRegistroSIdent['matricula'] = '';
  $rsRegistroSIdent['sme_serv_tipo_id'] = '';
  $rsRegistroSIdent['eo_cargo_id'] = '';
  $rsRegistroSIdent['sme_serv_situacao_id'] = '';
  $rsRegistroSIdent['situacao_trabalho_decreto'] = '';
  $rsRegistroSIdent['situacao_trabalho_doe'] = '';
  $rsRegistroSIdent['situacao_trabalho_dt_inicio'] = '';
  $rsRegistroSIdent['situacao_trabalho_dt_fim'] = '';
  $rsRegistroSIdent['situacao_trabalho_obs'] = '';
  $rsRegistroSIdent['matricula_2'] = '';
  $rsRegistroSIdent['sme_serv_tipo_id_2'] = '';
  $rsRegistroSIdent['eo_cargo_id_2'] = '';
  $rsRegistroSIdent['sme_serv_situacao_id_2'] = '';
  $rsRegistroSIdent['situacao_trabalho_decreto_2'] = '';
  $rsRegistroSIdent['situacao_trabalho_doe_2'] = '';
  $rsRegistroSIdent['situacao_trabalho_dt_inicio_2'] = '';
  $rsRegistroSIdent['situacao_trabalho_dt_fim_2'] = '';
  $rsRegistroSIdent['situacao_trabalho_obs_2'] = '';
  $rsRegistroSIdent['foto'] = '';
  $rsRegistroSIdent['senha_nome'] = '';
  $rsRegistroSIdent['sme_sme_id'] = '';
}
//Secretaria Municipal de Educação - BEGIN
$stmt = $db->prepare("SELECT 
  s.id,
  p.nome
  FROM sme_sme AS s 
  LEFT JOIN bsc_pessoa AS p ON p.id = s.bsc_pessoa_id
  WHERE 1 = 1;");
$stmt->execute();
$rsSMEs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Secretaria Municipal de Educação - END
//Pessoas Física - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM bsc_pessoa AS p
  WHERE p.tipo = 1;");
$stmt->execute();
$rsPFs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Pessoas Física - END
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Tipos de Servidor - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM sme_serv_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsServidorTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Tipos de Servidor - END
//Cargo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM eo_cargo  
  WHERE 1 = 1;");
$stmt->execute();
$rsServidorCargos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Cargo - END
//Situação do Servidor - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM sme_serv_situacao  
  WHERE 1 = 1;");
$stmt->execute();
$rsServidorSituacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Situação do Servidor - END
//Identiicação - END
//UO Publicas - BEGIN
// $stmt = $db->prepare("SELECT
//   id,
//   ue_ue_id AS tb_base_id,
//   bsc_uo_publica_id AS tb_ref_id
//   FROM ue_ue_uo_publica_vinc
//   WHERE ue_ue_id = ?;");
// $stmt->bindValue(1, $rsRegistroSIdent['id']);
// $stmt->execute();
// $rsRegistrosUOPublicaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
// //UO Publicas - END
// //Ensino Atendimento Tipo - BEGIN
// $stmt = $db->prepare("SELECT
//   id,
//   ue_ue_id AS tb_base_id,
//   ue_ens_atend_tipo_id AS tb_ref_id
//   FROM ue_ue_ens_atend_tipo
//   WHERE ue_ue_id = ?;");
// $stmt->bindValue(1, $rsRegistroSIdent['id']);
// $stmt->execute();
// $rsRegistrosEnsAtendTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Ensino Atendimento Tipo - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$ueiTituloFormulario1       = "Identificação do Servidor";
$ueiDescricaoFormulario1    = "Dados de identificação do servidor";
$ueiTituloFormulario2       = "Matricula 1";
$ueiDescricaoFormulario2    = "Dados de identificação da primeira matricula";
$ueiTituloFormulario3        = "Matricula 2";
$ueiDescricaoFormulario3     = "Dados de identificação da segunda matricula";
$ueiTituloFormulario4        = "";
$ueiDescricaoFormulario4     = "";
$ueiTituloFormulario5        = "Situação";
$ueiDescricaoFormulario5     = "Defina se esse cadastro deste(a) servidor(a) está ativo ou inatisvo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="s_id" id="s_id" value="<?= $rsRegistroSIdent['id'] ;?>">
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
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 8,
            /*string*/    'label'       => 'Secretaria Municipal de Educação',
            /*string*/    'name'        => 's_sme_sme_id',
            /*string*/    'id'          => 's_sme_sme_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_sme_id'],
            /*array()*/   'options'     => $rsSMEs,
            /*string*/    'ariaLabel'   => 'Selecione uma secretaria municipal',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row pb-0">
          <label>Selecione uma pessoa física. Caso não a encontre na lista, digite o nome da pessoa para efetuar o cadastro.</label>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '12 controller="pj"',
            /*string*/    'label'       => 'Pessoa Jurídica',
            /*string*/    'name'        => 's_bsc_pessoa_id',
            /*string*/    'id'          => 's_bsc_pessoa_id',
            /*string*/    'class'       => 'select2-tags form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['bsc_pessoa_id'],
            /*array()*/   'options'     => $rsPFs,
            /*string*/    'ariaLabel'   => 'Selecione uma pessoa jurídica',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '
            urltosendsub="model/bsc/pessoa_fisica/salvar_identificacao" 
            controller="pf" 
            controller-values="0" 
            load="true" 
            loadurl="view/bsc/pessoa_fisica/content_identificacao/" 
            gettextinputid="p_nome" 
            setstatusinputid="p_status" '
          )); ?>
        </div>
        <?php
        $displayPF = $rsRegistroSIdent['bsc_pessoa_id'] == '' ? 'style="display: none;"' : '';
        $bsc_pessoa_id = $rsRegistroSIdent['bsc_pessoa_id'];
        ?>
        <div id="div_pf" controlled="pf" control-value="0" <?= $displayPF ;?> class="border border-outline-info rounded  mb-1 ms-0 me-0">
          <?php 
          include_once ('view/bsc/pessoa_fisica/content_identificacao.php'); 
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
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Matrícula',
            /*string*/    'type'        => 'number',
            /*string*/    'name'        => 's_matricula',
            /*string*/    'id'          => 's_matricula',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 11,
            /*string*/    'placeholder' => 'Digite a matrícula',
            /*string*/    'value'       => $rsRegistroSIdent['matricula'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Tipo de Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_tipo_id',
            /*string*/    'id'          => 's_sme_serv_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_tipo_id'],
            /*array()*/   'options'     => $rsServidorTipos,
            /*string*/    'ariaLabel'   => 'Selecione um tipo de servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Situação do Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_situacao_id',
            /*string*/    'id'          => 's_sme_serv_situacao_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_situacao_id'],
            /*array()*/   'options'     => $rsServidorSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione uma situação do servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Cargo',
            /*string*/    'name'        => 's_eo_cargo_id',
            /*string*/    'id'          => 's_eo_cargo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['eo_cargo_id'],
            /*array()*/   'options'     => $rsServidorCargos,
            /*string*/    'ariaLabel'   => 'Selecione um cargo',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Decreto',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_decreto',
            /*string*/    'id'          => 's_situacao_trabalho_decreto',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o decreto da situação de trabalho',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_decreto'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'DOE(Diario Oficial do Estado)',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_doe',
            /*string*/    'id'          => 's_situacao_trabalho_doe',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o DOE(diario oficial do estado)',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_doe'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data de Inicio',
            /*string*/    'name'        => 's_situacao_trabalho_dt_inicio',
            /*string*/    'id'          => 's_situacao_trabalho_dt_inicio',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de inicio',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_inicio'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data de Finalização',
            /*string*/    'name'        => 's_situacao_trabalho_dt_fim',
            /*string*/    'id'          => 's_situacao_trabalho_dt_fim',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de finalização',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_fim'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Observação',
            /*string*/    'name'        => 's_situacao_trabalho_obs',
            /*string*/    'id'          => 's_situacao_trabalho_obs',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Descreva a observação',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_obs'],
            /*bool*/      'required'    => false,
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
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $ueiTituloFormulario3;?></h5>
        <small><?= $ueiDescricaoFormulario3;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Matrícula',
            /*string*/    'type'        => 'number',
            /*string*/    'name'        => 's_matricula_2',
            /*string*/    'id'          => 's_matricula_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 11,
            /*string*/    'placeholder' => 'Digite a matrícula',
            /*string*/    'value'       => $rsRegistroSIdent['matricula_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Tipo de Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_tipo_id_2',
            /*string*/    'id'          => 's_sme_serv_tipo_id_2',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_tipo_id_2'],
            /*array()*/   'options'     => $rsServidorTipos,
            /*string*/    'ariaLabel'   => 'Selecione um tipo de servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Situação do Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_situacao_id_2',
            /*string*/    'id'          => 's_sme_serv_situacao_id_2',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_situacao_id_2'],
            /*array()*/   'options'     => $rsServidorSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione uma situação do servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Cargo',
            /*string*/    'name'        => 's_eo_cargo_id_2',
            /*string*/    'id'          => 's_eo_cargo_id_2',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['eo_cargo_id_2'],
            /*array()*/   'options'     => $rsServidorCargos,
            /*string*/    'ariaLabel'   => 'Selecione um cargo',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Decreto',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_decreto_2',
            /*string*/    'id'          => 's_situacao_trabalho_decreto_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o decreto da situação de trabalho_2',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_decreto'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'DOE(Diario Oficial do Estado)',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_doe_2',
            /*string*/    'id'          => 's_situacao_trabalho_doe_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o DOE(diario oficial do estado)',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_doe_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data de Inicio',
            /*string*/    'name'        => 's_situacao_trabalho_dt_inicio_2',
            /*string*/    'id'          => 's_situacao_trabalho_dt_inicio_2',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de inicio',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_inicio_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data de Finalização',
            /*string*/    'name'        => 's_situacao_trabalho_dt_fim_2',
            /*string*/    'id'          => 's_situacao_trabalho_dt_fim_2',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de finalização',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_fim_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Observação',
            /*string*/    'name'        => 's_situacao_trabalho_obs_2',
            /*string*/    'id'          => 's_situacao_trabalho_obs_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Descreva a observação',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_obs_2'],
            /*bool*/      'required'    => false,
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
            /*string*/    'name'        => 's_status',
            /*string*/    'id'          => 's_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroSIdent['status'],
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