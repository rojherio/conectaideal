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
  eta.id,
  eta.status,
  eta.dt_cadastro,
  eta.nome,
  eta.descricao
  FROM ue_equip_tecn_administrativo AS eta
  WHERE eta.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEquipamentoTecnologicoAdministrativo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEquipamentoTecnologicoAdministrativo)) {
  $rsRegistroEquipamentoTecnologicoAdministrativo = array();
  $rsRegistroEquipamentoTecnologicoAdministrativo['id'] = 0;
  $rsRegistroEquipamentoTecnologicoAdministrativo['status'] = 1;
  $rsRegistroEquipamentoTecnologicoAdministrativo['dt_cadastro'] = '';
  $rsRegistroEquipamentoTecnologicoAdministrativo['nome'] = '';
  $rsRegistroEquipamentoTecnologicoAdministrativo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Equipamento para Uso Técnico e Administrativo";
$descricaoPagina          = "Informações do equipamento para uso técnico e administrativo";
$tituloFormulario1        = "Dados do Equipamento para Uso Técnico e Administrativo";
$descricaoFormulario1     = "Dados da identificação do equipamento para uso técnico e administrativo";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de equipamento para uso técnico e administrativo está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="eta_id" id="eta_id" value="<?= $rsRegistroEquipamentoTecnologicoAdministrativo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Equipamento para Uso Técnico e Administrativo',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'eta_nome',
            /*string*/    'id'          => 'eta_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Equipamento para Uso Técnico e Administrativo',
            /*string*/    'value'       => $rsRegistroEquipamentoTecnologicoAdministrativo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'eta_descricao',
            /*string*/    'id'          => 'eta_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Equipamento para Uso Técnico e Administrativo',
            /*string*/    'value'       => $rsRegistroEquipamentoTecnologicoAdministrativo['descricao'],
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
if (isset($exibeSituação)) {
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
              /*string*/    'name'        => 'eta_status',
              /*string*/    'id'          => 'eta_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEquipamentoTecnologicoAdministrativo['status'],
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
if (isset($exibeButões)) {
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