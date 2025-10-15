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
  pcf.id,
  pcf.status,
  pcf.dt_cadastro,
  pcf.nome,
  pcf.descricao
  FROM ue_parc_conv_forma AS pcf
  WHERE pcf.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroParceriaConvenioForma = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroParceriaConvenioForma)) {
  $rsRegistroParceriaConvenioForma = array();
  $rsRegistroParceriaConvenioForma['id'] = 0;
  $rsRegistroParceriaConvenioForma['status'] = 1;
  $rsRegistroParceriaConvenioForma['dt_cadastro'] = '';
  $rsRegistroParceriaConvenioForma['nome'] = '';
  $rsRegistroParceriaConvenioForma['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Forma de Contratação de Parceria ou Convênio";
$descricaoPagina          = "Informações da forma de contratação de parceria ou convênio";
$tituloFormulario1        = "Dados do Forma de Contratação de Parceria ou Convênio";
$descricaoFormulario1     = "Dados da identificação da forma de contratação de parceria ou convênio";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de forma de contratação de parceria ou convênio está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pcf_id" id="pcf_id" value="<?= $rsRegistroParceriaConvenioForma['id'] ;?>">
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
            /*string*/    'label'       => 'Nome da Forma de Contratação de Parceria ou Convênio',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pcf_nome',
            /*string*/    'id'          => 'pcf_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome da Forma de Contratação de Parceria ou Convênio',
            /*string*/    'value'       => $rsRegistroParceriaConvenioForma['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pcf_descricao',
            /*string*/    'id'          => 'pcf_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Forma de Contratação de Parceria ou Convênio',
            /*string*/    'value'       => $rsRegistroParceriaConvenioForma['descricao'],
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
              /*string*/    'name'        => 'pcf_status',
              /*string*/    'id'          => 'pcf_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroParceriaConvenioForma['status'],
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