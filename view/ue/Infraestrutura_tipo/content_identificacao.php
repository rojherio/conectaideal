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
  it.id,
  it.status,
  it.dt_cadastro,
  it.nome
  FROM ue_infraestrutura_tipo AS it
  WHERE it.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInfraestruturaTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInfraestruturaTipo)) {
  $rsRegistroInfraestruturaTipo = array();
  $rsRegistroInfraestruturaTipo['id'] = 0;
  $rsRegistroInfraestruturaTipo['status'] = 1;
  $rsRegistroInfraestruturaTipo['dt_cadastro'] = '';
  $rsRegistroInfraestruturaTipo['nome'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Infraestrutura";
$descricaoPagina          = "Informações do tipo de infraestrutura";
$tituloFormulario1        = "Dados do Tipo de Infraestrutura";
$descricaoFormulario1     = "Dados da identificação do tipo de infraestrutura";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de infraestrutura está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="it_id" id="it_id" value="<?= $rsRegistroInfraestruturaTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Infraestrutura',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'it_nome',
            /*string*/    'id'          => 'it_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome da Tipo de Infraestrutura',
            /*string*/    'value'       => $rsRegistroInfraestruturaTipo['nome'],
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
              /*string*/    'name'        => 'it_status',
              /*string*/    'id'          => 'it_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroInfraestruturaTipo['status'],
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