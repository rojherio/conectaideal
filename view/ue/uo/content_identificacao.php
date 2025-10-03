<?php
//Consulta para Edição - BEGIN
if (!isset($id)) {
  $id = ($parametromodulo) ? : 0;
}
if (isset($idAux)) {
  $id = $idAux ? : 0;
}
//Identificação - BEGIN
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  u.id,
  u.status,
  u.dt_cadastro,
  u.nome,
  u.ue_uo_tipo_id
  FROM ue_uo AS u
  WHERE u.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroUo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroUo)) {
  $rsRegistroUo = array();
  $rsRegistroUo['id'] = 0;
  $rsRegistroUo['status'] = 1;
  $rsRegistroUo['dt_cadastro'] = '';
  $rsRegistroUo['nome'] = '';
  $rsRegistroUo['ue_uo_tipo_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  ut.id,
  ut.nome
  FROM ue_uo_tipo AS ut
  ORDER BY ut.nome");
$stmt->execute();
$rsRegistroUo2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Unidade Organizacional";
$descricaoPagina          = "Informações da unidade organizacional";
$tituloFormulario1        = "Dados da Unidade Organizacional";
$descricaoFormulario1     = "Dados da identificação da unidade organizacional";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de unidade organizacional está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="u_id" id="u_id" value="<?= $rsRegistroUo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome da Unidade Organizacional',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'u_nome',
            /*string*/    'id'          => 'u_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 45,
            /*string*/    'placeholder' => 'Digite o nome da Unidade Organizacional',
            /*string*/    'value'       => $rsRegistroUo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Tipo de Unidade Organizacional',
            /*string*/    'name'        => 'u_ue_uo_tipo_id',
            /*string*/    'id'          => 'u_ue_uo_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUo['ue_uo_tipo_id'],
            /*array()*/   'options'     => $rsRegistroUo2,
            /*string*/    'ariaLabel'   => 'Selecione um tipo',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
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
              /*string*/    'name'        => 'u_status',
              /*string*/    'id'          => 'u_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroUo['status'],
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