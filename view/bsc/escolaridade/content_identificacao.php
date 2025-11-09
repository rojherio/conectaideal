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
  e.id,
  e.status,
  e.dt_cadastro,
  e.nome,
  e.nivel_controle
  FROM bsc_escolaridade AS e
  WHERE e.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEscolaridade = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEscolaridade)) {
  $rsRegistroEscolaridade = array();
  $rsRegistroEscolaridade['id'] = 0;
  $rsRegistroEscolaridade['status'] = 1;
  $rsRegistroEscolaridade['dt_cadastro'] = '';
  $rsRegistroEscolaridade['nome'] = '';
  $rsRegistroEscolaridade['nivel_controle'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Escolaridade";
$descricaoPagina          = "Informações de escolaridade";
$tituloFormulario1        = "Dados de Escolaridade";
$descricaoFormulario1     = "Dados de identificação de escolaridade";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de escolaridade está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="e_id" id="e_id" value="<?= $rsRegistroEscolaridade['id'] ;?>">
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
            /*int 1-12*/  'col'         => 8,
            /*string*/    'label'       => 'Nome do Grau de Escolaridade',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'e_nome',
            /*string*/    'id'          => 'e_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do grau de escolaridade',
            /*string*/    'value'       => $rsRegistroEscolaridade['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Nível de Controle (INEP)',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'e_nivel_controle',
            /*string*/    'id'          => 'e_nivel_controle',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 2,
            /*string*/    'placeholder' => 'Digite o nível de controle (INEP)',
            /*string*/    'value'       => $rsRegistroEscolaridade['nivel_controle'],
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
              /*string*/    'name'        => 'e_status',
              /*string*/    'id'          => 'e_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEscolaridade['status'],
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