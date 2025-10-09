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
  up.id,
  up.status,
  up.dt_cadastro,
  up.bsc_setor_publico_id,
  up.bsc_pessoa_id
  FROM bsc_uo_publica AS up
  WHERE up.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroUoPublica = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroUoPublica)) {
  $rsRegistroUoPublica = array();
  $rsRegistroUoPublica['id'] = 0;
  $rsRegistroUoPublica['status'] = 1;
  $rsRegistroUoPublica['dt_cadastro'] = '';
  $rsRegistroUoPublica['bsc_setor_publico_id'] = '';
  $rsRegistroUoPublica['bsc_pessoa_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  sp.id,
  sp.nome
  FROM bsc_setor_publico AS sp
  ORDER BY sp.nome");
$stmt->execute();
$rsRegistroUoPublica2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM bsc_pessoa AS p 
  WHERE p.tipo = 2 
  ORDER BY p.nome");
$stmt->execute();
$rsRegistroUoPublica3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Unidade Organizacional/Órgão Público(a)";
$descricaoPagina          = "Informações da unidade organizacional/órgão público(a)";
$tituloFormulario1        = "Dados da Unidade Organizacional/Órgão Público(a)";
$descricaoFormulario1     = "Dados da identificação da unidade organizacional/órgão público(a)";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de unidade organizacional/orgão público(a) está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="up_id" id="up_id" value="<?= $rsRegistroUoPublica['id'] ;?>">
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
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Setor Publico',
            /*string*/    'name'        => 'up_bsc_setor_publico_id',
            /*string*/    'id'          => 'up_bsc_setor_publico_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUoPublica['bsc_setor_publico_id'],
            /*array()*/   'options'     => $rsRegistroUoPublica2,
            /*string*/    'ariaLabel'   => 'Selecione uma Setor Publico',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Pessoa',
            /*string*/    'name'        => 'up_bsc_pessoa_id',
            /*string*/    'id'          => 'up_bsc_pessoa_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroUoPublica['bsc_pessoa_id'],
            /*array()*/   'options'     => $rsRegistroUoPublica3,
            /*string*/    'ariaLabel'   => 'Selecione uma Pessoa',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )); ?>
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
              /*string*/    'name'        => 'up_status',
              /*string*/    'id'          => 'up_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroUoPublica['status'],
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