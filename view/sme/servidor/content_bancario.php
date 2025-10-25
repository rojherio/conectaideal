<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Bancario - BEGIN
$stmt = $db->prepare("
  SELECT 
  sb.id,
  sb.status,
  sb.dt_cadastro,
  sb.sme_servidor_id,
  sb.bsc_banco_conta_tipo_id,
  sb.bsc_banco_id,
  sb.agencia,
  sb.conta,
  sb.op
  FROM sme_serv_bancario AS sb 
  WHERE sb.sme_servidor_id = ?;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistroSBancario = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroSBancario)) {
  $rsRegistroSBancario = array();
  $rsRegistroSBancario['id'] = 0;
  $rsRegistroSBancario['status'] = 1;
  $rsRegistroSBancario['sme_servidor_id'] = $idS;
  $rsRegistroSBancario['bsc_banco_conta_tipo_id'] = '';
  $rsRegistroSBancario['bsc_banco_id'] = '';
  $rsRegistroSBancario['agencia'] = '';
  $rsRegistroSBancario['conta'] = '';
  $rsRegistroSBancario['op'] = '';
}
//Bancario - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
//Banco Conta Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_banco_conta_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsBancoContaTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Banco Conta Tipo - END
//Bancos - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_banco  
  WHERE 1 = 1;");
$stmt->execute();
$rsBancos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Bancos - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Dados Bancário";
$descricaoFormulario1     = "Dados bancário do servidor";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="sb_id" id="sb_id" value="<?= $rsRegistroSBancario['id'] ;?>">
  <input type="hidden" name="sb_sme_servidor_id" id="sb_sme_servidor_id" value="<?= $idS ;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $tituloFormulario1;?></h5>
        <small><?= $descricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Banco',
            /*string*/    'name'        => 'sb_bsc_banco_id',
            /*string*/    'id'          => 'sb_bsc_banco_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSBancario['bsc_banco_id'],
            /*array()*/   'options'     => $rsBancos,
            /*string*/    'ariaLabel'   => 'Selecione o banco',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Tipo de Conta',
            /*string*/    'name'        => 'sb_bsc_banco_conta_tipo_id',
            /*string*/    'id'          => 'sb_bsc_banco_conta_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSBancario['bsc_banco_conta_tipo_id'],
            /*array()*/   'options'     => $rsBancoContaTipos,
            /*string*/    'ariaLabel'   => 'Selecione o tipo de conta',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Número da Agência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sb_agencia',
            /*string*/    'id'          => 'sb_agencia',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 6,
            /*string*/    'placeholder' => 'Digite o número da agência',
            /*string*/    'value'       => $rsRegistroSBancario['agencia'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Número da Conta',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sb_conta',
            /*string*/    'id'          => 'sb_conta',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número da conta',
            /*string*/    'value'       => $rsRegistroSBancario['conta'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Número da Operação/Variação',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sb_op',
            /*string*/    'id'          => 'sb_op',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 3,
            /*string*/    'placeholder' => 'Digite o número da operação/variação',
            /*string*/    'value'       => $rsRegistroSBancario['op'],
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