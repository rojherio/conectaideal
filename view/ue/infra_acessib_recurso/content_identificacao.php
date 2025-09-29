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
  iar.id,
  iar.status,
  iar.dt_cadastro,
  iar.nome,
  iar.descricao
  FROM ue_infra_acessib_recurso AS iar
  WHERE iar.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInfraestruturaAcessibilidadeRecurso = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInfraestruturaAcessibilidadeRecurso)) {
  $rsRegistroInfraestruturaAcessibilidadeRecurso = array();
  $rsRegistroInfraestruturaAcessibilidadeRecurso['id'] = 0;
  $rsRegistroInfraestruturaAcessibilidadeRecurso['status'] = 1;
  $rsRegistroInfraestruturaAcessibilidadeRecurso['dt_cadastro'] = '';
  $rsRegistroInfraestruturaAcessibilidadeRecurso['nome'] = '';
  $rsRegistroInfraestruturaAcessibilidadeRecurso['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Recurso de Acessibilidade";
$descricaoPagina          = "Informações do recurso de acessibilidade";
$tituloFormulario1        = "Dados do Recurso de Acessibilidade";
$descricaoFormulario1     = "Dados da identificação do recurso de acessibilidade";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de recurso de acessibilidade está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<input type="hidden" name="iar_id" id="iar_id" value="<?= $rsRegistroInfraestruturaAcessibilidadeRecurso['id'] ;?>">
<!-- div de cadastro - BEGIN -->
<div class="row">
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
            /*string*/    'label'       => 'Nome do Recurso de Acessibilidade',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'iar_nome',
            /*string*/    'id'          => 'iar_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Recurso de Acessibilidade',
            /*string*/    'value'       => $rsRegistroInfraestruturaAcessibilidadeRecurso['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'iar_descricao',
            /*string*/    'id'          => 'iar_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Recurso de Acessibilidade',
            /*string*/    'value'       => $rsRegistroInfraestruturaAcessibilidadeRecurso['descricao'],
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
            /*string*/    'name'        => 'iar_status',
            /*string*/    'id'          => 'iar_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroInfraestruturaAcessibilidadeRecurso['status'],
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