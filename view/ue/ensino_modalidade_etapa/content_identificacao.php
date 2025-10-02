<?php
//Consulta para Edição - BEGIN
if (!isset($id)) {
  $id = ($parametromodulo) ? : 0;
}
if (isset($idAux)) {
  $id = $idAux ? : 0;
}
//Identiicação - BEGIN
$stmt = $db->prepare("SELECT 
  eme.id,
  eme.status,
  eme.dt_cadastro,
  eme.nome,
  eme.descricao,
  eme.ue_ens_modalidade_tipo_id
  FROM ue_ens_modalidade_etapa AS eme
  WHERE eme.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEnsinoModalidadeEtapa = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEnsinoModalidadeEtapa)) {
  $rsRegistroEnsinoModalidadeEtapa = array();
  $rsRegistroEnsinoModalidadeEtapa['id'] = 0;
  $rsRegistroEnsinoModalidadeEtapa['status'] = 1;
  $rsRegistroEnsinoModalidadeEtapa['dt_cadastro'] = '';
  $rsRegistroEnsinoModalidadeEtapa['nome'] = '';
  $rsRegistroEnsinoModalidadeEtapa['descricao'] = '';
  $rsRegistroEnsinoModalidadeEtapa['ue_ens_modalidade_tipo_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  emt.id,
  emt.nome
  FROM ue_ens_modalidade_tipo AS emt
  ORDER BY emt.nome");
$stmt->execute();
$rsRegistroEnsinoModalidadeEtapa2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Etapa de Ensino";
$descricaoPagina          = "Informações da etapa de ensino";
$tituloFormulario1        = "Dados da etapa de Ensino";
$descricaoFormulario1     = "Dados da identificação da etapa de ensino";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de etapa de ensino está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="eme_id" id="eme_id" value="<?= $rsRegistroEnsinoModalidadeEtapa['id'] ;?>">
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
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Nome da Etapa de Ensino',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'eme_nome',
            /*string*/    'id'          => 'eme_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome da Etapa de Ensino',
            /*string*/    'value'       => $rsRegistroEnsinoModalidadeEtapa['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Modalidade de Ensino',
            /*string*/    'name'        => 'eme_ue_ens_modalidade_tipo_id',
            /*string*/    'id'          => 'eme_ue_ens_modalidade_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroEnsinoModalidadeEtapa['ue_ens_modalidade_tipo_id'],
            /*array()*/   'options'     => $rsRegistroEnsinoModalidadeEtapa2,
            /*string*/    'ariaLabel'   => 'Selecione uma modalidade de ensino',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'eme_descricao',
            /*string*/    'id'          => 'eme_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Descreva a Etapa de Ensino',
            /*string*/    'value'       => $rsRegistroEnsinoModalidadeEtapa['descricao'],
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
        <h5><?= $tituloFormulario5;?></h5>
        <small><?= $descricaoFormulario5;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Ativo',
            /*string*/    'type'        => 'checkbox',
            /*string*/    'name'        => 'eme_status',
            /*string*/    'id'          => 'eme_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroEnsinoModalidadeEtapa['status'],
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
            <button type="reset" class="btn btn-outline-danger b-r-22" id="btn_cancelar">
              <i class="ti ti-eraser"></i> Cancelar
            </button>
            <button type="button" id="submit" class="btn btn-outline-success waves-light b-r-22">
              <i class="ti ti-writing"></i> Cadastrar
            </button>
          </div>
        </div>
        <!-- div row buttons - END -->
      </div>
    </div>
  </div>
</div>
<!-- Main Section - END-->
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/ue/ensino_modalidade_etapa/cadastrar.js"></script>