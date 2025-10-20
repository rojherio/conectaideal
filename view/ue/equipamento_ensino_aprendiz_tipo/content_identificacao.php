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
  eeat.id,
  eeat.status,
  eeat.dt_cadastro,
  eeat.nome,
  eeat.descricao
  FROM ue_equip_ens_aprendiz_tipo AS eeat
  WHERE eeat.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEquipamentoEnsinoAprendizTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEquipamentoEnsinoAprendizTipo)) {
  $rsRegistroEquipamentoEnsinoAprendizTipo = array();
  $rsRegistroEquipamentoEnsinoAprendizTipo['id'] = 0;
  $rsRegistroEquipamentoEnsinoAprendizTipo['status'] = 1;
  $rsRegistroEquipamentoEnsinoAprendizTipo['dt_cadastro'] = '';
  $rsRegistroEquipamentoEnsinoAprendizTipo['nome'] = '';
  $rsRegistroEquipamentoEnsinoAprendizTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Equipamento para Ensino e Aprendizagem";
$descricaoPagina          = "Informações do equipamento para ensino e aprendizagem";
$tituloFormulario1        = "Dados do Equipamento para Ensino e Aprendizagem";
$descricaoFormulario1     = "Dados da identificação do equipamento para ensino e aprendizagem";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de equipamento para ensino e aprendizagem está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="eeat_id" id="eeat_id" value="<?= $rsRegistroEquipamentoEnsinoAprendizTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Equipamento para Ensino e Aprendizagem',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'eeat_nome',
            /*string*/    'id'          => 'eeat_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do equipamento para ensino e aprendizagem',
            /*string*/    'value'       => $rsRegistroEquipamentoEnsinoAprendizTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'eeat_descricao',
            /*string*/    'id'          => 'eeat_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Digite a descrição do equipamento para ensino e aprendizagem',
            /*string*/    'value'       => $rsRegistroEquipamentoEnsinoAprendizTipo['descricao'],
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
              /*string*/    'name'        => 'eeat_status',
              /*string*/    'id'          => 'eeat_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEquipamentoEnsinoAprendizTipo['status'],
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