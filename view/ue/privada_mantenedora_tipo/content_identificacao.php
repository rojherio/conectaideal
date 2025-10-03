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
  pmt.id,
  pmt.status,
  pmt.dt_cadastro,
  pmt.nome,
  pmt.descricao
  FROM ue_priv_mantenedora_tipo AS pmt
  WHERE pmt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroPrivadaMantenedoraTipo = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroPrivadaMantenedoraTipo)) {
  $rsRegistroPrivadaMantenedoraTipo = array();
  $rsRegistroPrivadaMantenedoraTipo['id'] = 0;
  $rsRegistroPrivadaMantenedoraTipo['status'] = 1;
  $rsRegistroPrivadaMantenedoraTipo['dt_cadastro'] = '';
  $rsRegistroPrivadaMantenedoraTipo['nome'] = '';
  $rsRegistroPrivadaMantenedoraTipo['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro do Tipo de Mantenedora de Escola Privada";
$descricaoPagina          = "Informações do tipo de mantenedora de escola privada";
$tituloFormulario1        = "Dados do Tipo de Mantenedora de Escola Privada";
$descricaoFormulario1     = "Dados do tipo de mantenedora de escola privada";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de tipo de mantenedora de escola privada está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pmt_id" id="pmt_id" value="<?= $rsRegistroPrivadaMantenedoraTipo['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Tipo de Mantenedora de Escola Privada',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pmt_nome',
            /*string*/    'id'          => 'pmt_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Tipo de Mantenedora de Escola Privada',
            /*string*/    'value'       => $rsRegistroPrivadaMantenedoraTipo['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pmt_descricao',
            /*string*/    'id'          => 'pmt_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Tipo de Mantenedora de Escola Privada',
            /*string*/    'value'       => $rsRegistroPrivadaMantenedoraTipo['descricao'],
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
              /*string*/    'name'        => 'pmt_status',
              /*string*/    'id'          => 'pmt_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroPrivadaMantenedoraTipo['status'],
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