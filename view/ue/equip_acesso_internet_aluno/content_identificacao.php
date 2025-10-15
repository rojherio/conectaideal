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
  eaia.id,
  eaia.status,
  eaia.dt_cadastro,
  eaia.nome,
  eaia.descricao
  FROM ue_equip_acesso_internet_aluno AS eaia
  WHERE eaia.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroEquipAcessoInternetAluno = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistroEquipAcessoInternetAluno)) {
  $rsRegistroEquipAcessoInternetAluno = array();
  $rsRegistroEquipAcessoInternetAluno['id'] = 0;
  $rsRegistroEquipAcessoInternetAluno['status'] = 1;
  $rsRegistroEquipAcessoInternetAluno['dt_cadastro'] = '';
  $rsRegistroEquipAcessoInternetAluno['nome'] = '';
  $rsRegistroEquipAcessoInternetAluno['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Equipamento para Acessar a Internet";
$descricaoPagina          = "Informações do equipamento para acessar a internet";
$tituloFormulario1        = "Dados do Equipamento para Acessar a Internet";
$descricaoFormulario1     = "Dados da identificação do equipamento para acessar a internet";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de Equipamento para Acessar a Internet está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- Main Section - BEGIN-->
<!-- div de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="eaia_id" id="eaia_id" value="<?= $rsRegistroEquipAcessoInternetAluno['id'] ;?>">
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
            /*string*/    'label'       => 'Nome do Equipamento para Acessar a Internet',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'eaia_nome',
            /*string*/    'id'          => 'eaia_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do Equipamento para Acessar a Internet',
            /*string*/    'value'       => $rsRegistroEquipAcessoInternetAluno['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Descrição',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'eaia_descricao',
            /*string*/    'id'          => 'eaia_descricao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 256,
            /*string*/    'placeholder' => 'Digite a descrição do Equipamento para Acessar a Internet',
            /*string*/    'value'       => $rsRegistroEquipAcessoInternetAluno['descricao'],
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
              /*string*/    'name'        => 'eaia_status',
              /*string*/    'id'          => 'eaia_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroEquipAcessoInternetAluno['status'],
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