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
  ief.id,
  ief.status,
  ief.dt_cadastro,
  ief.nome,
  ief.descricao
  FROM ue_infra_espaco_fisico AS ief
  WHERE ief.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInfraEspacoFisico = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInfraEspacoFisico)) {
  $rsRegistroInfraEspacoFisico = array();
  $rsRegistroInfraEspacoFisico['id'] = 0;
  $rsRegistroInfraEspacoFisico['status'] = 1;
  $rsRegistroInfraEspacoFisico['dt_cadastro'] = '';
  $rsRegistroInfraEspacoFisico['nome'] = '';
  $rsRegistroInfraEspacoFisico['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Dependência/Espaço Físico";
$descricaoPagina          = "Informações de dependência/espaço físico";
$tituloFormulario1        = "Dados de Dependência/Espaço Físico";
$descricaoFormulario1     = "Dados da identificação de dependência/espaço físico";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de dependência/espaço físico está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<input type="hidden" name="ief_id" id="ief_id" value="<?= $rsRegistroInfraEspacoFisico['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Dependência/Espaço Físico',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ief_nome',
            /*string*/    'id'          => 'ief_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Dependência/Espaço Físico',
            /*string*/    'value'       => $rsRegistroInfraEspacoFisico['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ief_descricao',
            /*string*/    'id'          => 'ief_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Dependência/Espaço Físico',
            /*string*/    'value'       => $rsRegistroInfraEspacoFisico['descricao'],
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
            /*string*/    'name'        => 'ief_status',
            /*string*/    'id'          => 'ief_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroInfraEspacoFisico['status'],
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