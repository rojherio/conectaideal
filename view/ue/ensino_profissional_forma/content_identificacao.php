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
  epf.id,
  epf.status,
  epf.dt_cadastro,
  epf.nome,
  epf.descricao,
  epf.ue_ens_profis_tipo_id
  FROM ue_ens_profis_forma AS epf
  WHERE epf.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEnsinoProfissionalForma = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEnsinoProfissionalForma)) {
  $rsRegistroEnsinoProfissionalForma = array();
  $rsRegistroEnsinoProfissionalForma['id'] = 0;
  $rsRegistroEnsinoProfissionalForma['status'] = 1;
  $rsRegistroEnsinoProfissionalForma['dt_cadastro'] = '';
  $rsRegistroEnsinoProfissionalForma['nome'] = '';
  $rsRegistroEnsinoProfissionalForma['descricao'] = '';
  $rsRegistroEnsinoProfissionalForma['ue_ens_profis_tipo_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  ept.id,
  ept.nome
  FROM ue_ens_profis_tipo AS ept
  ORDER BY ept.nome");
$stmt->execute();
$rsRegistroEnsinoProfissionalForma2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Forma de Ensino Profissional";
$descricaoPagina          = "Informações da forma de ensino profissional";
$tituloFormulario1        = "Dados da Forma de Ensino Profissional";
$descricaoFormulario1     = "Dados da identificação Dados forma de ensino profissional";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro da forma de ensino profissional está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="epf_id" id="epf_id" value="<?= $rsRegistroEnsinoProfissionalForma['id'] ;?>">
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
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Nome da Forma de Ensino Profissional',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'epf_nome',
            /*string*/    'id'          => 'epf_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome da Forma de Ensino Profissional',
            /*string*/    'value'       => $rsRegistroEnsinoProfissionalForma['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Tipo de Ensino Profissional',
            /*string*/    'name'        => 'epf_ue_ens_profis_tipo_id',
            /*string*/    'id'          => 'epf_ue_ens_profis_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroEnsinoProfissionalForma['ue_ens_profis_tipo_id'],
            /*array()*/   'options'     => $rsRegistroEnsinoProfissionalForma2,
            /*string*/    'ariaLabel'   => 'Selecione um tipo',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'epf_descricao',
            /*string*/    'id'          => 'epf_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Descreva a Forma de Ensino Profissional',
            /*string*/    'value'       => $rsRegistroEnsinoProfissionalForma['descricao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
<?php
if (isset($exibeSituacao)) {
  ?>
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
              /*string*/    'name'        => 'epf_status',
              /*string*/    'id'          => 'epf_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEnsinoProfissionalForma['status'],
              /*string*/    'prop'        => ''
            )) ;?>
          </div>
          <!-- div row input - END -->
        </div>
      </div>
    </div>
  </div>
  <?php
}
if (isset($exibeButoes)) {
  ?>
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
  <?php
}
?>