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
  fp.id,
  fp.status,
  fp.dt_cadastro,
  fp.nome,
  fp.descricao
  FROM ue_funcao_tipo AS fp
  WHERE fp.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroFuncaoTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroFuncaoTipo)) {
  $rsRegistroFuncaoTipo = array();
  $rsRegistroFuncaoTipo['id'] = 0;
  $rsRegistroFuncaoTipo['status'] = 1;
  $rsRegistroFuncaoTipo['dt_cadastro'] = '';
  $rsRegistroFuncaoTipo['nome'] = '';
  $rsRegistroFuncaoTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Função Desempenhada por Funcionarios";
$descricaoPagina          = "Informações do tipo de função desempenhada por funcionarios";
$tituloFormulario1        = "Dados do Tipo de Função Desempenhada por Funcionarios";
$descricaoFormulario1     = "Dados da identificação do tipo de função desempenhada por funcionarios";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de função desempenhada por funcionarios está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="fp_id" id="fp_id" value="<?= $rsRegistroFuncaoTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Função Desempenhada por Funcionarios',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'fp_nome',
            /*string*/    'id'          => 'fp_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do tipo de função desempenhada por funcionarios',
            /*string*/    'value'       => $rsRegistroFuncaoTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'fp_descricao',
            /*string*/    'id'          => 'fp_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => '',
            /*string*/    'placeholder' => 'Digite a descrição do tipo de função desempenhada por funcionarios',
            /*string*/    'value'       => $rsRegistroFuncaoTipo['descricao'],
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
              /*string*/    'name'        => 'fp_status',
              /*string*/    'id'          => 'fp_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroFuncaoTipo['status'],
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