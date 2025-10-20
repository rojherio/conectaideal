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
  ilrtt.id,
  ilrtt.status,
  ilrtt.dt_cadastro,
  ilrtt.nome,
  ilrtt.descricao
  FROM ue_infra_lixo_resid_trat_tipo AS ilrtt
  WHERE ilrtt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInfraLixoResidTratTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInfraLixoResidTratTipo)) {
  $rsRegistroInfraLixoResidTratTipo = array();
  $rsRegistroInfraLixoResidTratTipo['id'] = 0;
  $rsRegistroInfraLixoResidTratTipo['status'] = 1;
  $rsRegistroInfraLixoResidTratTipo['dt_cadastro'] = '';
  $rsRegistroInfraLixoResidTratTipo['nome'] = '';
  $rsRegistroInfraLixoResidTratTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de tratamento do Lixo/Resíduos";
$descricaoPagina          = "Informações do tipo de tratamento do lixo/resíduos";
$tituloFormulario1        = "Dados do Tipo de tratamento do Lixo/Resíduos";
$descricaoFormulario1     = "Dados da identificação do tipo de tratamento do lixo/resíduos";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de tratamento do lixo/resíduos está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ilrtt_id" id="ilrtt_id" value="<?= $rsRegistroInfraLixoResidTratTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de tratamento do Lixo/Resíduos',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ilrtt_nome',
            /*string*/    'id'          => 'ilrtt_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do tipo de tratamento do lixo/resíduos',
            /*string*/    'value'       => $rsRegistroInfraLixoResidTratTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'ilrtt_descricao',
            /*string*/    'id'          => 'ilrtt_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Digite a descrição do tipo de tratamento do lixo/resíduos',
            /*string*/    'value'       => $rsRegistroInfraLixoResidTratTipo['descricao'],
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
              /*string*/    'name'        => 'ilrtt_status',
              /*string*/    'id'          => 'ilrtt_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroInfraLixoResidTratTipo['status'],
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