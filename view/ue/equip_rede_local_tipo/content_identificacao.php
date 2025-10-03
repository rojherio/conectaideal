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
  erlt.id,
  erlt.status,
  erlt.dt_cadastro,
  erlt.nome,
  erlt.descricao
  FROM ue_equip_rede_local_tipo AS erlt
  WHERE erlt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEquipRedeLocalTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEquipRedeLocalTipo)) {
  $rsRegistroEquipRedeLocalTipo = array();
  $rsRegistroEquipRedeLocalTipo['id'] = 0;
  $rsRegistroEquipRedeLocalTipo['status'] = 1;
  $rsRegistroEquipRedeLocalTipo['dt_cadastro'] = '';
  $rsRegistroEquipRedeLocalTipo['nome'] = '';
  $rsRegistroEquipRedeLocalTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Rede Local de Interligação de computadores";
$descricaoPagina          = "Informações do tipo de rede local de interligação de computadores";
$tituloFormulario1        = "Dados do Tipo de Rede Local de Interligação de computadores";
$descricaoFormulario1     = "Dados da identificação do tipo de rede local de interligação de computadores";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de rede local de interligação de computadores está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="erlt_id" id="erlt_id" value="<?= $rsRegistroEquipRedeLocalTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Rede Local de Interligação de computadores',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'erlt_nome',
            /*string*/    'id'          => 'erlt_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Tipo de Rede Local de Interligação de computadores',
            /*string*/    'value'       => $rsRegistroEquipRedeLocalTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'erlt_descricao',
            /*string*/    'id'          => 'erlt_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Tipo de Rede Local de Interligação de computadores',
            /*string*/    'value'       => $rsRegistroEquipRedeLocalTipo['descricao'],
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
              /*string*/    'name'        => 'erlt_status',
              /*string*/    'id'          => 'erlt_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEquipRedeLocalTipo['status'],
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