<?php
//Consulta para Edição - BEGIN
$idPessoa = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idPessoa = isset($bsc_pessoa_id) ? $bsc_pessoa_id : $idPessoa;
//Condição Física e Mental - BEGIN
$stmt = $db->prepare("
  SELECT 
  pcfm.id,
  pcfm.status,
  pcfm.dt_cadastro,
  pcfm.bsc_pessoa_id,
  pcfm.bsc_cond_tea_tipo_id
  FROM bsc_pessoa_cond_fis_men AS pcfm 
  WHERE pcfm.bsc_pessoa_id = ?;");
$stmt->bindValue(1, $idPessoa);
$stmt->execute();
$rsRegistroPessoaCond = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroPessoaCond)) {
  $rsRegistroPessoaCond = array();
  $rsRegistroPessoaCond['id'] = 0;
  $rsRegistroPessoaCond['status'] = 1;
  $rsRegistroPessoaCond['bsc_pessoa_id'] = $idPessoa;
  $rsRegistroPessoaCond['bsc_cond_tea_tipo_id'] = '';
}
//Condição Física e Mental - END
//Condição Deficiência - BEGIN
$stmt = $db->prepare("SELECT
  id,
  bsc_pessoa_cond_fis_men_id AS tb_base_id,
  bsc_cond_deficiencia_id AS tb_ref_id
  FROM bsc_pessoa_cond_deficiencia
  WHERE bsc_pessoa_cond_fis_men_id = ?;");
$stmt->bindValue(1, $rsRegistroPessoaCond['id']);
$stmt->execute();
$rsRegistrosCDef = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Condição Deficiência - END
//Condição Superdotação - BEGIN
$stmt = $db->prepare("SELECT
  id,
  bsc_pessoa_cond_fis_men_id AS tb_base_id,
  bsc_cond_superdotacao_id AS tb_ref_id
  FROM bsc_pessoa_cond_superdotacao
  WHERE bsc_pessoa_cond_fis_men_id = ?;");
$stmt->bindValue(1, $rsRegistroPessoaCond['id']);
$stmt->execute();
$rsRegistrosCSDot = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Condição Superdotação - END
//Condição Recurso Uso - BEGIN
$stmt = $db->prepare("SELECT
  id,
  bsc_pessoa_cond_fis_men_id AS tb_base_id,
  bsc_cond_recurso_uso_id  AS tb_ref_id
  FROM bsc_pessoa_cond_recurso_uso
  WHERE bsc_pessoa_cond_fis_men_id = ?;");
$stmt->bindValue(1, $rsRegistroPessoaCond['id']);
$stmt->execute();
$rsRegistrosCRUso = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Condição Recurso Uso - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
//Condição Tea Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_cond_tea_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsCTTs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Condição Tea Tipo - END
//Condição Deficiencia - BEGIN
$stmt = $db->prepare("SELECT 
  cd.id,
  CONCAT(cdt.nome, ' - ', cd.nome) AS nome
  FROM bsc_cond_deficiencia AS cd 
  LEFT JOIN bsc_cond_deficiencia_tipo AS cdt ON cdt.id = cd.bsc_cond_deficiencia_tipo_id
  WHERE 1 = 1;");
$stmt->execute();
$rsCDs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Condição Deficiencia - END
//Condição Superdotação - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_cond_superdotacao 
  WHERE 1 = 1;");
$stmt->execute();
$rsCSs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Condição Superdotação - END
//Condição Recurso Uso - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_cond_recurso_uso 
  WHERE 1 = 1;");
$stmt->execute();
$rsCRUs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Condição Recurso Uso - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Condições Física e Mentais";
$descricaoFormulario1     = "Dados de condições físicas e mentais da pessoa";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pcfm_id" id="pcfm_id" value="<?= $rsRegistroPessoaCond['id'] ;?>">
  <input type="hidden" name="pcfm_bsc_pessoa_id" id="pcfm_bsc_pessoa_id" value="<?= $idPessoa ;?>">
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
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Deficiência',
            /*string*/    'name'        => 'pcfm_bsc_cond_deficiencia_id[]',
            /*string*/    'id'          => 'pcfm_bsc_cond_deficiencia_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosCDef,
            /*array()*/   'options'     => $rsCDs,
            /*string*/    'ariaLabel'   => 'Selecione as deficiências',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Transtorno do Espectro Autista (TEA)',
            /*string*/    'name'        => 'pcfm_bsc_cond_tea_tipo_id',
            /*string*/    'id'          => 'pcfm_bsc_cond_tea_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaCond['bsc_cond_tea_tipo_id'],
            /*array()*/   'options'     => $rsCTTs,
            /*string*/    'ariaLabel'   => 'Selecione um TEA',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Altas Habilidades ou Superdotação',
            /*string*/    'name'        => 'pcfm_bsc_cond_superdotacao_id[]',
            /*string*/    'id'          => 'pcfm_bsc_cond_superdotacao_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosCSDot,
            /*array()*/   'options'     => $rsCSs,
            /*string*/    'ariaLabel'   => 'Selecione as altas habilidades e/ou superdotação',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Recursos de Uso',
            /*string*/    'name'        => 'pcfm_bsc_cond_recurso_uso_id[]',
            /*string*/    'id'          => 'pcfm_bsc_cond_recurso_uso_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosCRUso,
            /*array()*/   'options'     => $rsCRUs,
            /*string*/    'ariaLabel'   => 'Selecione os recursos de Uso',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
<?php
if (isset($exibeButoes)) {
  ?>
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
  <?php
}
?>
<!-- formulário de cadastro - END -->