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
  ec.id,
  ec.status,
  ec.dt_cadastro,
  ec.nome,
  ec.exige_registro
  FROM bsc_estado_civil AS ec
  WHERE ec.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEstadoCivil = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEstadoCivil)) {
  $rsRegistroEstadoCivil = array();
  $rsRegistroEstadoCivil['id'] = 0;
  $rsRegistroEstadoCivil['status'] = 1;
  $rsRegistroEstadoCivil['dt_cadastro'] = '';
  $rsRegistroEstadoCivil['nome'] = '';
  $rsRegistroEstadoCivil['exige_registro'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Estado Civil";
$descricaoPagina          = "Informações de estado civil";
$tituloFormulario1        = "Dados de estado civil";
$descricaoFormulario1     = "Dados de identificação de estado civil";
$tituloFormulario2        = "Exigencia de Registro";
$descricaoFormulario2     = "Defina se esse cadastro de estado civil exige registro";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de estado civil está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ec_id" id="ec_id" value="<?= $rsRegistroEstadoCivil['id'] ;?>">
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
            /*int 1-12*/  'col'         => 8,
            /*string*/    'label'       => 'Nome do Estado Civil',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ec_nome',
            /*string*/    'id'          => 'ec_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o estado civil',
            /*string*/    'value'       => $rsRegistroEstadoCivil['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Exige Registro',
            /*string*/    'type'        => 'checkbox',
            /*string*/    'name'        => 'ec_exige_registro',
            /*string*/    'id'          => 'ec_exige_registro',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroEstadoCivil['exige_registro'],
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
              /*string*/    'name'        => 'ec_status',
              /*string*/    'id'          => 'ec_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEstadoCivil['status'],
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