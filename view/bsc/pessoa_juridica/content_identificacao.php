<?php
//Consulta para Edição - BEGIN
$idPessoa = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idPessoa = isset($bsc_pessoa_id) ? $bsc_pessoa_id : $idPessoa;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.status,
  p.dt_cadastro,
  p.tipo,
  p.nome,
  p.nome_social,
  p.cpf,
  p.ie,
  p.dt_criacao
  FROM bsc_pessoa AS p
  WHERE p.tipo = 2 AND p.id = ? ;");
$stmt->bindValue(1, $idPessoa);
$stmt->execute();
$rsRegistroPessoaIdent = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroPessoaIdent)) {
  $idPessoa = 0;
  $rsRegistroPessoaIdent = array();
  $rsRegistroPessoaIdent['id'] = 0;
  $rsRegistroPessoaIdent['status'] = 1;
  $rsRegistroPessoaIdent['tipo'] = 2;
  $rsRegistroPessoaIdent['nome'] = '';
  $rsRegistroPessoaIdent['nome_social'] = '';
  $rsRegistroPessoaIdent['cpf'] = '';
  $rsRegistroPessoaIdent['ie'] = '';
  $rsRegistroPessoaIdent['dt_criacao'] = '';
}
//Identiicação - END
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Identificação da Pessoa Jurídica";
$descricaoFormulario1     = "Dados de identificação da pessoa jurídica";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de pessoa jurídica está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="p_id" id="p_id" value="<?= $rsRegistroPessoaIdent['id'] ;?>">
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
            /*string*/    'label'       => 'Nome/Razão Social',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_nome',
            /*string*/    'id'          => 'p_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome/razão social da pessoa jurídica',
            /*string*/    'value'       => $rsRegistroPessoaIdent['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Nome Fantasia',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_nome_social',
            /*string*/    'id'          => 'p_nome_social',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome fantasia da pessoa jurídica',
            /*string*/    'value'       => $rsRegistroPessoaIdent['nome_social'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'CNPJ',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_cpf',
            /*string*/    'id'          => 'p_cpf',
            /*string*/    'class'       => 'form-control mask-cnpj',
            /*int*/       'minlength'   => 18,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o CNPJ da pessoa jurídica',
            /*string*/    'value'       => $rsRegistroPessoaIdent['cpf'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'IE (Inscrição Estadual)',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_ie',
            /*string*/    'id'          => 'p_ie',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 45,
            /*string*/    'placeholder' => 'Digite o numero de inscrição estadual da pessoa jurídica',
            /*string*/    'value'       => $rsRegistroPessoaIdent['ie'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data de Criação',
            /*string*/    'name'        => 'p_dt_criacao',
            /*string*/    'id'          => 'p_dt_criacao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de criação da pessoa jurídica',
            /*string*/    'value'       => $rsRegistroPessoaIdent['dt_criacao'],
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
              /*string*/    'name'        => 'p_status',
              /*string*/    'id'          => 'p_status',
              /*string*/    'class'       => 'toggle',
              /*string*/    'value'       => 1,
              /*string*/    'checked'     => $rsRegistroPessoaIdent['status'],
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
              <button type="reset" class="btn_reset btn btn-outline-danger b-r-22" id="btn_cancelar">
                <i class="ti ti-eraser"></i> Cancelar
              </button>
              <button type="button" id="submit" class="btn_submit btn btn-outline-success waves-light b-r-22">
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
<!-- formulário de cadastro - END -->