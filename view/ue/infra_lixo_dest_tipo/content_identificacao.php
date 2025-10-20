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
  ildt.id,
  ildt.status,
  ildt.dt_cadastro,
  ildt.nome,
  ildt.descricao
  FROM ue_infra_lixo_dest_tipo AS ildt
  WHERE ildt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInfraLixoDestTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInfraLixoDestTipo)) {
  $rsRegistroInfraLixoDestTipo = array();
  $rsRegistroInfraLixoDestTipo['id'] = 0;
  $rsRegistroInfraLixoDestTipo['status'] = 1;
  $rsRegistroInfraLixoDestTipo['dt_cadastro'] = '';
  $rsRegistroInfraLixoDestTipo['nome'] = '';
  $rsRegistroInfraLixoDestTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Destinação do Lixo";
$descricaoPagina          = "Informações do tipo de destinação do lixo";
$tituloFormulario1        = "Dados do Tipo de Destinação do Lixo";
$descricaoFormulario1     = "Dados da identificação do tipo de destinação do lixo";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de destinação do lixo está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ildt_id" id="ildt_id" value="<?= $rsRegistroInfraLixoDestTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Destinação do Lixo',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ildt_nome',
            /*string*/    'id'          => 'ildt_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do tipo de destinação do lixo',
            /*string*/    'value'       => $rsRegistroInfraLixoDestTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'ildt_descricao',
            /*string*/    'id'          => 'ildt_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Digite a descrição do tipo de destinação do lixo',
            /*string*/    'value'       => $rsRegistroInfraLixoDestTipo['descricao'],
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
              /*string*/    'name'        => 'ildt_status',
              /*string*/    'id'          => 'ildt_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroInfraLixoDestTipo['status'],
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