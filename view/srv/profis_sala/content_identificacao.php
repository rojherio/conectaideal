<?php
//Consulta para Edição - BEGIN
$idPS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idPS = isset($srv_profis_sala_id) ? $srv_profis_sala_id : $idPS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  ps.id,
  ps.status,
  ps.dt_cadastro,
  ps.cod_inep,
  ps.sme_servidor_id
  FROM srv_profis_sala AS ps
  WHERE ps.id = ? ;");
$stmt->bindValue(1, $idPS);
$stmt->execute();
$rsRegistroPSala = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroPSala)) {
  $idPS = 0;
  $rsRegistroPSala = array();
  $rsRegistroPSala['id'] = 0;
  $rsRegistroPSala['status'] = 1;
  $rsRegistroPSala['dt_cadastro'] = '';
  $rsRegistroPSala['cod_inep'] = '';
  $rsRegistroPSala['sme_servidor_id'] = '';
}
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Servidor - BEGIN
$stmt = $db->prepare("SELECT 
  s.id,
  CONCAT (p.nome, ' (CPF.: ', p.cpf, ')') AS nome
  FROM sme_servidor AS s
  LEFT JOIN bsc_pessoa AS p ON p.id = s.bsc_pessoa_id
  WHERE 1 = 1;");
$stmt->execute();
$rsServs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Servidor - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$ueiTituloFormulario1       = "Identificação do Profissional de Sala";
$ueiDescricaoFormulario1    = "Dados do profissional de sala";
$ueiTituloFormulario2        = "Situação";
$ueiDescricaoFormulario2     = "Defina se esse cadastro deste profissional de sala está ativo ou inatisvo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ps_id" id="ps_id" value="<?= $rsRegistroPSala['id'] ;?>">
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
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Código INEP do Profissional de Sala',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ps_cod_inep',
            /*string*/    'id'          => 'ps_cod_inep',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 11,
            /*string*/    'placeholder' => 'Digite o código INEP do profissional de sala',
            /*string*/    'value'       => $rsRegistroPSala['cod_inep'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row pb-0">
          <label>Selecione um Servidor. Caso não a encontre na lista, digite o nome da pessoa para efetuar o cadastro.</label>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '12" controller="pj',
            /*string*/    'label'       => 'Nome do(a) Servidor(a)',
            /*string*/    'name'        => 'ps_sme_servidor_id',
            /*string*/    'id'          => 'ps_sme_servidor_id',
            /*string*/    'class'       => 'select2-tags-searchable form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPSala['sme_servidor_id'],
            /*array()*/   'options'     => $rsServs,
            /*string*/    'ariaLabel'   => 'Selecione um(a) servidor(a)',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '
            controller="servidor" 
            controller-values="0" 
            searchurl="sme/servidor/get_servidor" 
            idtosetid="s_id" 
            idtosetname="s_bsc_pessoa_id" 
            load="true" 
            loadurl="sme/servidor/content_identificacao/" 
            loadidtextget="s_bsc_pessoa_id" 
            loadidstatusset="s_status" 
            urltosendsub="sme/servidor/salvar_identificacao" '
          )); ?>
        </div>
        <?php
        $displayServidor = $rsRegistroPSala['sme_servidor_id'] == '' ? 'style="display: none;"' : '';
        $sme_servidor_id = $rsRegistroPSala['sme_servidor_id'];
        ?>
        <div id="div_servidor" controlled="servidor" control-value="0" <?=$displayServidor;?> class="border border-outline-info rounded mb-1 ms-0 me-0">
          <?php 
          include_once ('view/sme/servidor/content_identificacao.php'); 
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
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Ativo',
            /*string*/    'name'        => 'ps_status',
            /*string*/    'id'          => 'ps_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroPSala['status'],
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