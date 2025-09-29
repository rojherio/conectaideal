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
  ipt.id,
  ipt.status,
  ipt.dt_cadastro,
  ipt.nome,
  ipt.descricao
  FROM ue_internet_pub_tipo AS ipt
  WHERE ipt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInternetPublicoTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInternetPublicoTipo)) {
  $rsRegistroInternetPublicoTipo = array();
  $rsRegistroInternetPublicoTipo['id'] = 0;
  $rsRegistroInternetPublicoTipo['status'] = 1;
  $rsRegistroInternetPublicoTipo['dt_cadastro'] = '';
  $rsRegistroInternetPublicoTipo['nome'] = '';
  $rsRegistroInternetPublicoTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Público a Usufruir Da Internet da Unidade Escolar";
$descricaoPagina          = "Informações do público a usufruir da internet da unidade escolar";
$tituloFormulario1        = "Dados do Público a Usufruir Da Internet da Unidade Escolar";
$descricaoFormulario1     = "Dados da identificação do público a usufruir da internet da unidade escolar";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de público a usufruir da internet da unidade escolar está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<input type="hidden" name="ipt_id" id="ipt_id" value="<?= $rsRegistroInternetPublicoTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Público a Usufruir Da Internet da Unidade Escolar',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ipt_nome',
            /*string*/    'id'          => 'ipt_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Público a Usufruir Da Internet da Unidade Escolar',
            /*string*/    'value'       => $rsRegistroInternetPublicoTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ipt_descricao',
            /*string*/    'id'          => 'ipt_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Público a Usufruir Da Internet da Unidade Escolar',
            /*string*/    'value'       => $rsRegistroInternetPublicoTipo['descricao'],
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
            /*string*/    'name'        => 'ipt_status',
            /*string*/    'id'          => 'ipt_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroInternetPublicoTipo['status'],
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