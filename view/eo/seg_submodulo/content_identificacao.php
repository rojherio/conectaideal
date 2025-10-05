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
  sm.id,
  sm.status,
  sm.dt_cadastro,
  sm.nome,
  sm.descricao,
  sm.pasta,
  sm.caminho,
  sm.seg_modulo_id
  FROM seg_submodulo AS sm
  WHERE sm.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroSubModulo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroSubModulo)) {
  $rsRegistroSubModulo = array();
  $rsRegistroSubModulo['id'] = 0;
  $rsRegistroSubModulo['status'] = 1;
  $rsRegistroSubModulo['dt_cadastro'] = '';
  $rsRegistroSubModulo['nome'] = '';
  $rsRegistroSubModulo['descricao'] = '';
  $rsRegistroSubModulo['pasta'] = '';
  $rsRegistroSubModulo['caminho'] = '';
  $rsRegistroSubModulo['seg_modulo_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  m.id,
  m.nome
  FROM seg_modulo AS  m
  ORDER BY m.nome");
$stmt->execute();
$rsSegModulo = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de SubModulo";
$descricaoPagina          = "Informações de submodulo";
$tituloFormulario1        = "Dados da SubModulo";
$descricaoFormulario1     = "Dados da identificação de submodulo";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de submodulo está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="sm_id" id="sm_id" value="<?= $rsRegistroSubModulo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Modulo',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sm_nome',
            /*string*/    'id'          => 'sm_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o nome do Modulo',
            /*string*/    'value'       => $rsRegistroSubModulo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sm_descricao',
            /*string*/    'id'          => 'sm_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite a Descrição',
            /*string*/    'value'       => $rsRegistroSubModulo['descricao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Pasta',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sm_pasta',
            /*string*/    'id'          => 'sm_pasta',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite a Pasta',
            /*string*/    'value'       => $rsRegistroSubModulo['pasta'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Caminho',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sm_caminho',
            /*string*/    'id'          => 'sm_caminho',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o Caminho',
            /*string*/    'value'       => $rsRegistroSubModulo['caminho'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Modulo',
            /*string*/    'name'        => 'sm_seg_modulo_id',
            /*string*/    'id'          => 'sm_seg_modulo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSubModulo['seg_modulo_id'],
            /*array()*/   'options'     => $rsSegModulo,
            /*string*/    'ariaLabel'   => 'Selecione um Modulo',
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
              /*string*/    'name'        => 'sm_status',
              /*string*/    'id'          => 'sm_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroSubModulo['status'],
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