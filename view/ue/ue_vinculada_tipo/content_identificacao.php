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
  uvt.id,
  uvt.status,
  uvt.dt_cadastro,
  uvt.nome,
  uvt.descricao
  FROM ue_ue_vinculada_tipo AS uvt
  WHERE uvt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroUeVinculadaTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroUeVinculadaTipo)) {
  $rsRegistroUeVinculadaTipo = array();
  $rsRegistroUeVinculadaTipo['id'] = 0;
  $rsRegistroUeVinculadaTipo['status'] = 1;
  $rsRegistroUeVinculadaTipo['dt_cadastro'] = '';
  $rsRegistroUeVinculadaTipo['nome'] = '';
  $rsRegistroUeVinculadaTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Tipo de Vínculo a Outra Unidade Escolar";
$descricaoPagina          = "Informações do tipo de vínculo a outra unidade escolar";
$tituloFormulario1        = "Dados do Tipo de Vínculo a Outra Unidade Escolar";
$descricaoFormulario1     = "Dados da identificação do tipo de vínculo a outra unidade escolar";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de vínculo a outra unidade escolar está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<input type="hidden" name="uvt_id" id="uvt_id" value="<?= $rsRegistroUeVinculadaTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Vínculo a Outra Unidade Escolar',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'uvt_nome',
            /*string*/    'id'          => 'uvt_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome do Tipo de Vínculo a Outra Unidade Escolar',
            /*string*/    'value'       => $rsRegistroUeVinculadaTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'uvt_descricao',
            /*string*/    'id'          => 'uvt_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Tipo de Vínculo a Outra Unidade Escolar',
            /*string*/    'value'       => $rsRegistroUeVinculadaTipo['descricao'],
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
            /*string*/    'name'        => 'uvt_status',
            /*string*/    'id'          => 'uvt_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroUeVinculadaTipo['status'],
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