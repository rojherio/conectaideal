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
  ect.id,
  ect.status,
  ect.dt_cadastro,
  ect.nome,
  ect.descricao
  FROM ue_equip_comput_tipo AS ect
  WHERE ect.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEquipamentoComputadorTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEquipamentoComputadorTipo)) {
  $rsRegistroEquipamentoComputadorTipo = array();
  $rsRegistroEquipamentoComputadorTipo['id'] = 0;
  $rsRegistroEquipamentoComputadorTipo['status'] = 1;
  $rsRegistroEquipamentoComputadorTipo['dt_cadastro'] = '';
  $rsRegistroEquipamentoComputadorTipo['nome'] = '';
  $rsRegistroEquipamentoComputadorTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Equipamento/Computador para o Aluno";
$descricaoPagina          = "Informações do tipo de equipamento/computador para o aluno";
$tituloFormulario1        = "Dados do Tipo de Equipamento/Computador para o Aluno";
$descricaoFormulario1     = "Dados da identificação do tipo de equipamento/computador para o aluno";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de equipamento/computador para o aluno está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ect_id" id="ect_id" value="<?= $rsRegistroEquipamentoComputadorTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Equipamento/Computador para o Aluno',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ect_nome',
            /*string*/    'id'          => 'ect_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome do tipo de equipamento/computador para o aluno',
            /*string*/    'value'       => $rsRegistroEquipamentoComputadorTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'ect_descricao',
            /*string*/    'id'          => 'ect_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Digite a descrição do tipo de equipamento/computador para o aluno',
            /*string*/    'value'       => $rsRegistroEquipamentoComputadorTipo['descricao'],
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
              /*string*/    'name'        => 'ect_status',
              /*string*/    'id'          => 'ect_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEquipamentoComputadorTipo['status'],
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