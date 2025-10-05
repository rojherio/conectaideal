<?php
//Consulta para Edição - BEGIN
if (!isset($id)) {
  $id = ($parametromodulo) ? : 0;
}
if (isset($idAux)) {
  $id = $idAux ? : 0;
}
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  ut.id,
  ut.status,
  ut.dt_cadastro,
  ut.nome
  FROM eo_uo_tipo AS ut
  WHERE ut.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroUoTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroUoTipo)) {
  $rsRegistroUoTipo = array();
  $rsRegistroUoTipo['id'] = 0;
  $rsRegistroUoTipo['status'] = 1;
  $rsRegistroUoTipo['dt_cadastro'] = '';
  $rsRegistroUoTipo['nome'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Unidade Organizacional";
$descricaoPagina          = "Informações do tipo de unidade organizacional";
$tituloFormulario1        = "Dados do Horário de Tipo de Unidade Organizacional";
$descricaoFormulario1     = "Dados da identificação do tipo de unidade organizacional";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de unidade organizacional está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ut_id" id="ut_id" value="<?= $rsRegistroUoTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Unidade Organizacional',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ut_nome',
            /*string*/    'id'          => 'ut_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome do Tipo de Unidade Organizacional',
            /*string*/    'value'       => $rsRegistroUoTipo['nome'],
            /*bool*/      'required'    => true,
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
              /*string*/    'name'        => 'ut_status',
              /*string*/    'id'          => 'ut_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroUoTipo['status'],
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