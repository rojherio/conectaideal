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
  f.id,
  f.status,
  f.dt_cadastro,
  f.nome,
  f.ue_funcao_tipo_id
  FROM ue_funcao AS f
  WHERE f.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroFuncao = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroFuncao)) {
  $rsRegistroFuncao = array();
  $rsRegistroFuncao['id'] = 0;
  $rsRegistroFuncao['status'] = 1;
  $rsRegistroFuncao['dt_cadastro'] = '';
  $rsRegistroFuncao['nome'] = '';
  $rsRegistroFuncao['ue_funcao_tipo_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  ft.id,
  ft.nome
  FROM ue_funcao_tipo AS ft
  ORDER BY ft.nome");
$stmt->execute();
$rsRegistroFuncao2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Função Desempenhada por Funcionarios";
$descricaoPagina          = "Informações da função desempenhada por funcionarios";
$tituloFormulario1        = "Dados da Função Desempenhada por Funcionarios";
$descricaoFormulario1     = "Dados da identificação da função desempenhada por funcionarios";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de função desempenhada por funcionarios está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="f_id" id="f_id" value="<?= $rsRegistroFuncao['id'] ;?>">
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
            /*string*/    'label'       => 'Nome da Função Desempenhada por Funcionarios',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'f_nome',
            /*string*/    'id'          => 'f_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 45,
            /*string*/    'placeholder' => 'Digite o nome da Função Desempenhada por Funcionarios',
            /*string*/    'value'       => $rsRegistroFuncao['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Tipo de Função',
            /*string*/    'name'        => 'f_ue_funcao_tipo_id',
            /*string*/    'id'          => 'f_ue_funcao_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroFuncao['ue_funcao_tipo_id'],
            /*array()*/   'options'     => $rsRegistroFuncao2,
            /*string*/    'ariaLabel'   => 'Selecione um tipo',
            /*bool*/      'required'    => true,
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
              /*string*/    'name'        => 'f_status',
              /*string*/    'id'          => 'f_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroFuncao['status'],
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