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
  p.id,
  p.status,
  p.dt_cadastro,
  p.nome,
  p.descricao,
  p.pasta,
  p.caminho,
  p.seg_submodulo_id
  FROM seg_pasta AS p
  WHERE p.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroPasta = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroPasta)) {
  $rsRegistroPasta = array();
  $rsRegistroPasta['id'] = 0;
  $rsRegistroPasta['status'] = 1;
  $rsRegistroPasta['dt_cadastro'] = '';
  $rsRegistroPasta['nome'] = '';
  $rsRegistroPasta['descricao'] = '';
  $rsRegistroPasta['pasta'] = '';
  $rsRegistroPasta['caminho'] = '';
  $rsRegistroPasta['seg_submodulo_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  sm.id,
  sm.nome
  FROM seg_submodulo AS  sm
  ORDER BY sm.nome");
$stmt->execute();
$rsSegSubModulo = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Pasta";
$descricaoPagina          = "Informações de pasta";
$tituloFormulario1        = "Dados da Pasta";
$descricaoFormulario1     = "Dados da identificação de pasta";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de pasta está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="p_id" id="p_id" value="<?= $rsRegistroPasta['id'] ;?>">
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
            /*string*/    'label'       => 'Nome da Pasta',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_nome',
            /*string*/    'id'          => 'p_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome da Pasta',
            /*string*/    'value'       => $rsRegistroPasta['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_descricao',
            /*string*/    'id'          => 'p_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite a Descrição',
            /*string*/    'value'       => $rsRegistroPasta['descricao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Pasta',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_pasta',
            /*string*/    'id'          => 'p_pasta',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite a Pasta',
            /*string*/    'value'       => $rsRegistroPasta['pasta'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Caminho',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_caminho',
            /*string*/    'id'          => 'p_caminho',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o Caminho',
            /*string*/    'value'       => $rsRegistroPasta['caminho'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'SubModulo',
            /*string*/    'name'        => 'p_seg_submodulo_id',
            /*string*/    'id'          => 'p_seg_submodulo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPasta['seg_submodulo_id'],
            /*array()*/   'options'     => $rsSegSubModulo,
            /*string*/    'ariaLabel'   => 'Selecione um SubModulo',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
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
              /*string*/    'name'        => 'p_status',
              /*string*/    'id'          => 'p_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroPasta['status'],
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