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
  ld.id,
  ld.status,
  ld.dt_cadastro,
  ld.nome,
  ld.descricao
  FROM ue_localizacao_diferenciada AS ld
  WHERE ld.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroLocalizacaoDiferenciada = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroLocalizacaoDiferenciada)) {
  $rsRegistroLocalizacaoDiferenciada = array();
  $rsRegistroLocalizacaoDiferenciada['id'] = 0;
  $rsRegistroLocalizacaoDiferenciada['status'] = 1;
  $rsRegistroLocalizacaoDiferenciada['dt_cadastro'] = '';
  $rsRegistroLocalizacaoDiferenciada['nome'] = '';
  $rsRegistroLocalizacaoDiferenciada['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Localização Diferenciada";
$descricaoPagina          = "Informações do localização diferenciada";
$tituloFormulario1        = "Dados do Localização Diferenciada";
$descricaoFormulario1     = "Dados da identificação do localização diferenciada";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro da localização diferenciada está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ld_id" id="ld_id" value="<?= $rsRegistroLocalizacaoDiferenciada['id'] ;?>">
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
            /*string*/    'label'       => 'Nome da Localização Diferenciada',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ld_nome',
            /*string*/    'id'          => 'ld_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome da Localização Diferenciada',
            /*string*/    'value'       => $rsRegistroLocalizacaoDiferenciada['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createTextArea(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'name'        => 'ld_descricao',
            /*string*/    'id'          => 'ld_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Descrição da Localização Diferenciada',
            /*string*/    'value'       => $rsRegistroLocalizacaoDiferenciada['descricao'],
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
              /*string*/    'type'        => 'checkbox',
              /*string*/    'name'        => 'ld_status',
              /*string*/    'id'          => 'ld_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroLocalizacaoDiferenciada['status'],
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