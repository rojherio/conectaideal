<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $bsc_pessoa_id : $idS;
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
//Ensino Modalidade Etapa - BEGIN
//Parámetros de títutlos - BEGIN
$ueiTituloFormulario1       = "Identificação do Servidor";
$ueiDescricaoFormulario1    = "Seleção da pessoa jurídica referente a este servidor";
$ueiTituloFormulario2       = "Dados do Servidor(a)";
$ueiDescricaoFormulario2    = "Dados que identificam o Servidor(a)";
$ueiTituloFormulario3        = "";
$ueiDescricaoFormulario3     = "";
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
        <div class="row pb-0">
          <label>Selecione uma pessoa física. Caso não a encontre na lista, digite o nome da pessoa para efetuar o cadastro.</label>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '12 controller="pj"',
            /*string*/    'label'       => 'Pessoa Jurídica',
            /*string*/    'name'        => 's_bsc_pessoa_id',
            /*string*/    'id'          => 's_bsc_pessoa_id',
            /*string*/    'class'       => 'select2-tags form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['bsc_pessoa_id'],
            /*array()*/   'options'     => $rsPJs,
            /*string*/    'ariaLabel'   => 'Selecione uma pessoa jurídica',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '
            urltosendsub="model/bsc/pessoa_fisica/salvar_identificacao" 
            controller="pj"
            controller-values="0" 
            load="true" 
            loadurl="view/bsc/pessoa_fisica/content_identificacao/" 
            gettextinputid="p_nome" 
            setstatusinputid="p_status" '
          )); ?>
        </div>
        <?php
        $displayPJ = $rsRegistroSIdent['bsc_pessoa_id'] == '' ? 'style="display: none;"' : '';
        $bsc_pessoa_id = $rsRegistroSIdent['bsc_pessoa_id'];
        ?>
        <div id="div_pj" controlled="pj" control-value="0" <?= $displayPJ ;?>>
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
            /*int 1-12*/  'col'         => 12,
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
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
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
            /*string*/    'type'        => 'checkbox',
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