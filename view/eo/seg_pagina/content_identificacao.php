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
  pa.id,
  pa.status,
  pa.dt_cadastro,
  pa.nome,
  pa.descricao,
  pa.pasta,
  pa.caminho,
  pa.seg_pasta_id
  FROM seg_pagina AS pa
  WHERE pa.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroPagina = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroPagina)) {
  $rsRegistroPagina = array();
  $rsRegistroPagina['id'] = 0;
  $rsRegistroPagina['status'] = 1;
  $rsRegistroPagina['dt_cadastro'] = '';
  $rsRegistroPagina['nome'] = '';
  $rsRegistroPagina['descricao'] = '';
  $rsRegistroPagina['pasta'] = '';
  $rsRegistroPagina['caminho'] = '';
  $rsRegistroPagina['seg_pasta_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM seg_pasta AS  p
  ORDER BY p.nome");
$stmt->execute();
$rsSegPasta = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Pagina";
$descricaoPagina          = "Informações de pagina";
$tituloFormulario1        = "Dados da Pagina";
$descricaoFormulario1     = "Dados da identificação de pagina";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de pagina está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pa_id" id="pa_id" value="<?= $rsRegistroPagina['id'] ;?>">
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
            /*string*/    'label'       => 'Nome da Pagina',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pa_nome',
            /*string*/    'id'          => 'pa_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome da Pagina',
            /*string*/    'value'       => $rsRegistroPagina['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pa_descricao',
            /*string*/    'id'          => 'pa_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite a Descrição',
            /*string*/    'value'       => $rsRegistroPagina['descricao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Pasta',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pa_pasta',
            /*string*/    'id'          => 'pa_pasta',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite a Pasta',
            /*string*/    'value'       => $rsRegistroPagina['pasta'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Caminho',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pa_caminho',
            /*string*/    'id'          => 'pa_caminho',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o Caminho',
            /*string*/    'value'       => $rsRegistroPagina['caminho'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Pasta',
            /*string*/    'name'        => 'pa_seg_pasta_id',
            /*string*/    'id'          => 'pa_seg_pasta_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPagina['seg_pasta_id'],
            /*array()*/   'options'     => $rsSegPasta,
            /*string*/    'ariaLabel'   => 'Selecione uma Pasta',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
          )); ?>
        </div>
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
              /*string*/    'name'        => 'pa_status',
              /*string*/    'id'          => 'pa_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroPagina['status'],
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