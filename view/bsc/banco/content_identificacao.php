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
  b.id,
  b.status,
  b.dt_cadastro,
  b.codigo,
  b.nome,
  b.sigla,
  b.ispb
  FROM bsc_banco AS b
  WHERE b.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroBanco = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroBanco)) {
  $rsRegistroBanco = array();
  $rsRegistroBanco['id'] = 0;
  $rsRegistroBanco['status'] = 1;
  $rsRegistroBanco['dt_cadastro'] = '';
  $rsRegistroBanco['codigo'] = '';
  $rsRegistroBanco['nome'] = '';
  $rsRegistroBanco['sigla'] = '';
  $rsRegistroBanco['ispb'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Banco (Instituição Financeira)";
$descricaoPagina          = "Informações do banco (Instituição Financeira)";
$tituloFormulario1        = "Dados do Banco";
$descricaoFormulario1     = "Dados de identificação do banco";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de banco está ativo ou inativo";
//Parámetros de títutlos - END
?>
<input type="hidden" name="b_id" id="b_id" value="<?= $rsRegistroBanco['id'] ;?>">
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
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Nome do Banco',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'b_nome',
            /*string*/    'id'          => 'b_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome do banco',
            /*string*/    'value'       => $rsRegistroBanco['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Sigla',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'b_sigla',
            /*string*/    'id'          => 'b_sigla',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 80,
            /*string*/    'placeholder' => 'Digite o nome curto do banco',
            /*string*/    'value'       => $rsRegistroBanco['sigla'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Código',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'b_codigo',
            /*string*/    'id'          => 'b_codigo',
            /*string*/    'class'       => 'form-control mask-numeros',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 3,
            /*string*/    'placeholder' => 'Digite o código do banco',
            /*string*/    'value'       => $rsRegistroBanco['codigo'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'ISPB',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'b_ispb',
            /*string*/    'id'          => 'b_ispb',
            /*string*/    'class'       => 'form-control mask-numeros',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 8,
            /*string*/    'placeholder' => 'Digite o código ISPB do banco',
            /*string*/    'value'       => $rsRegistroBanco['ispb'],
            /*bool*/      'required'    => true,
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
            /*string*/    'name'        => 'b_status',
            /*string*/    'id'          => 'b_status',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroBanco['status'],
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