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
  ilof.id,
  ilof.status,
  ilof.dt_cadastro,
  ilof.nome,
  ilof.descricao
  FROM ue_infra_local_ocupacao_forma AS ilof
  WHERE ilof.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroInfraLocalOcupacaoForma = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroInfraLocalOcupacaoForma)) {
  $rsRegistroInfraLocalOcupacaoForma = array();
  $rsRegistroInfraLocalOcupacaoForma['id'] = 0;
  $rsRegistroInfraLocalOcupacaoForma['status'] = 1;
  $rsRegistroInfraLocalOcupacaoForma['dt_cadastro'] = '';
  $rsRegistroInfraLocalOcupacaoForma['nome'] = '';
  $rsRegistroInfraLocalOcupacaoForma['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Forma de Ocupação do Prédio Escolar";
$descricaoPagina          = "Informações do forma de ocupação do prédio escolar";
$tituloFormulario1        = "Dados do Forma de Ocupação do Prédio Escolar";
$descricaoFormulario1     = "Dados da identificação do forma de ocupação do prédio escolar";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de forma de ocupação do prédio escolar está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ilof_id" id="ilof_id" value="<?= $rsRegistroInfraLocalOcupacaoForma['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Forma de Ocupação do Prédio Escolar',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ilof_nome',
            /*string*/    'id'          => 'ilof_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Forma de Ocupação do Prédio Escolar',
            /*string*/    'value'       => $rsRegistroInfraLocalOcupacaoForma['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'ilof_descricao',
            /*string*/    'id'          => 'ilof_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Forma de Ocupação do Prédio Escolar',
            /*string*/    'value'       => $rsRegistroInfraLocalOcupacaoForma['descricao'],
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
              /*string*/    'name'        => 'ilof_status',
              /*string*/    'id'          => 'ilof_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroInfraLocalOcupacaoForma['status'],
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