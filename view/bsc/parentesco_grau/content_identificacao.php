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
  pg.id,
  pg.status,
  pg.dt_cadastro,
  pg.nome,
  pg.grau
  FROM bsc_parentesco_grau AS pg
  WHERE pg.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroParentescoGrau = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroParentescoGrau)) {
  $rsRegistroParentescoGrau = array();
  $rsRegistroParentescoGrau['id'] = 0;
  $rsRegistroParentescoGrau['status'] = 1;
  $rsRegistroParentescoGrau['dt_cadastro'] = '';
  $rsRegistroParentescoGrau['nome'] = '';
  $rsRegistroParentescoGrau['grau'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Grau de Parentesco";
$descricaoPagina          = "Informações de grau de parentesco";
$tituloFormulario1        = "Dados de Grau de Parentesco";
$descricaoFormulario1     = "Dados de identificação de grau de parentesco";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de grau de parentesco está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pg_id" id="pg_id" value="<?= $rsRegistroParentescoGrau['id'] ;?>">
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
            /*string*/    'label'       => 'Nome',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pg_nome',
            /*string*/    'id'          => 'pg_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome de parentesco',
            /*string*/    'value'       => $rsRegistroParentescoGrau['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Grau de Parentesco',
            /*string*/    'name'        => 'pg_grau',
            /*string*/    'id'          => 'pg_grau',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroParentescoGrau['grau'],
            /*array()*/   'options'     => array(
              ['id' => '1º grau', 'nome' => '1º grau'],
              ['id' => '2º grau', 'nome' => '2º grau'],
              ['id' => '3º grau', 'nome' => '3º grau'],
              ['id' => '4º grau', 'nome' => '4º grau']
            ),
            /*string*/    'ariaLabel'   => 'Seleciona um grau de parentesco',
            /*bool*/      'required'    => false,
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
              /*string*/    'name'        => 'pg_status',
              /*string*/    'id'          => 'pg_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroParentescoGrau['status'],
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