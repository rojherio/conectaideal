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
  p.dt_nascimento,
  p.sexo,
  p.natural_bsc_pais_id,
  p.natural_bsc_municipio_id,
  m.nome AS natural_municipio_nome, 
  e.id AS natural_estado_id, 
  e.sigla AS natural_estado_sigla, 
  p.natural_estrangeiro_dt_ingresso,
  p.natural_estrangeiro_cidade,
  p.natural_estrangeiro_estado,
  p.natural_estrangeiro_condicao_trabalho,
  p.pai_nome,
  p.pai_natural_bsc_pais_id,
  p.pai_profissao,
  p.mae_nome,
  p.mae_natural_bsc_pais_id,
  p.mae_profissao,
  p.foto,
  p.sangue_tipo,
  p.raca,
  p.enfermidade_portador,
  p.enfermidade_codigo_internacional
  FROM bsc_pessoa AS p
  LEFT JOIN bsc_municipio AS m ON m.id = p.natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  WHERE p.tipo = 1 AND p.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroPessoaIdent = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$rsRegistroPessoaIdent) {
  $rsRegistroPessoaIdent = array();
  $rsRegistroPessoaIdent['id'] = 0;
  $rsRegistroPessoaIdent['status'] = 1;
  $rsRegistroPessoaIdent['tipo'] = 1;
  $rsRegistroPessoaIdent['nome'] = '';
  $rsRegistroPessoaIdent['nome_social'] = '';
  $rsRegistroPessoaIdent['cpf'] = '';
  $rsRegistroPessoaIdent['ie'] = '';
  $rsRegistroPessoaIdent['dt_nascimento'] = '';
  $rsRegistroPessoaIdent['dt_criacao'] = '';
  $rsRegistroPessoaIdent['sexo'] = 'Feminino';
  $rsRegistroPessoaIdent['natural_bsc_pais_id'] = '';
  $rsRegistroPessoaIdent['natural_bsc_municipio_id'] = '';
  $rsRegistroPessoaIdent['natural_municipio_nome'] = '';
  $rsRegistroPessoaIdent['natural_estado_id'] = '';
  $rsRegistroPessoaIdent['natural_estado_sigla'] = '';
  $rsRegistroPessoaIdent['natural_estrangeiro_dt_ingresso'] = '';
  $rsRegistroPessoaIdent['natural_estrangeiro_cidade'] = '';
  $rsRegistroPessoaIdent['natural_estrangeiro_estado'] = '';
  $rsRegistroPessoaIdent['natural_estrangeiro_condicao_trabalho'] = '';
  $rsRegistroPessoaIdent['pai_nome'] = '';
  $rsRegistroPessoaIdent['pai_natural_bsc_pais_id'] = '';
  $rsRegistroPessoaIdent['pai_profissao'] = '';
  $rsRegistroPessoaIdent['mae_nome'] = '';
  $rsRegistroPessoaIdent['mae_natural_bsc_pais_id'] = '';
  $rsRegistroPessoaIdent['mae_profissao'] = '';
  $rsRegistroPessoaIdent['foto'] = '';
  $rsRegistroPessoaIdent['sangue_tipo'] = '';
  $rsRegistroPessoaIdent['raca'] = '';
  $rsRegistroPessoaIdent['enfermidade_portador'] = '';
  $rsRegistroPessoaIdent['enfermidade_codigo_internacional'] = '';
}
//Identiicação - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("
  SELECT 
  id,
  nome
  FROM bsc_pais 
  ORDER BY id ASC;");
$stmt->execute();
$rsPaises = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  m.id, 
  CONCAT(m.nome, ' - ', e.sigla) AS nome
  FROM bsc_municipio AS m 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
  ORDER BY e.nome ASC, m.nome;");
$stmt->execute();
$rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  p.id, 
  CONCAT(p.nome, ' - ', p.grau) AS nome 
  FROM bsc_parentesco_grau AS p ;");
$stmt->execute();
$rsGrausParentesco = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Dados Pessoais";
$descricaoFormulario1     = "Dados de identificação da pessoa";
$tituloFormulario2        = "Filiação";
$descricaoFormulario2     = "Dados de filiação da pessoa";
$tituloFormulario3        = "Naturalidade";
$descricaoFormulario3     = "Dados de naturalidade da pessoa";
$tituloFormulario4        = "Saúde";
$descricaoFormulario4     = "Dados de saúde da pessoa";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de pessoa está ativo ou inativo";
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
            /*string*/    'label'       => 'Nome',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_nome',
            /*string*/    'id'          => 'p_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome da pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['nome'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Nome Social',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_nome_social',
            /*string*/    'id'          => 'p_nome_social',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o nome social da pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['nome_social'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'CPF',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_cpf',
            /*string*/    'id'          => 'p_cpf',
            /*string*/    'class'       => 'form-control mask-cpf',
            /*int*/       'minlength'   => 14,
            /*int*/       'maxlength'   => 14,
            /*string*/    'placeholder' => 'Digite o CPF da pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['cpf'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Data de Nascimento',
            /*string*/    'name'        => 'p_dt_nascimento',
            /*string*/    'id'          => 'p_dt_nascimento',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de nascimento da pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['dt_nascimento'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createRadio(array(
            /*int 1-12*/  'col'         => 4,
            /*int 1-12*/  'colOption'   => 6,
            /*string*/    'label'       => 'Sexo',
            /*string*/    'type'        => 'radio',
            /*string*/    'name'        => 'p_sexo',
            /*array()*/   'id'          => array('p_sexo_F', 'p_sexo_M'),
            /*string*/    'class'       => 'radiomark outline-info ms-2',
            /*array()*/   'value'       => $rsRegistroPessoaIdent['sexo'],
            /*array()*/   'values'      => array('Feminino', 'Masculino'),
            /*array()*/   'options'     => array("Feminino", "Masculino"),
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => '',
          )) ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Tipo Sanaguíneo',
            /*string*/    'name'        => 'p_sangue_tipo',
            /*string*/    'id'          => 'p_sangue_tipo',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaIdent['sangue_tipo'],
            /*array()*/   'options'     => array(
              ['id' => 'O+', 'nome' => 'O+'],
              ['id' => 'O-', 'nome' => 'O-'],
              ['id' => 'A+', 'nome' => 'A+'],
              ['id' => 'A-', 'nome' => 'A-'],
              ['id' => 'B+', 'nome' => 'B+'],
              ['id' => 'B-', 'nome' => 'B-'],
              ['id' => 'AB+', 'nome' => 'AB+'],
              ['id' => 'AB-', 'nome' => 'AB-']
            ),
            /*string*/    'ariaLabel'   => 'Selecione um tipo sanguíneo',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Raça',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_raca',
            /*string*/    'id'          => 'p_raca',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite raça da pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['raca'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $tituloFormulario3;?></h5>
        <small><?= $descricaoFormulario3;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '6 controller="naturalidade"',
            /*string*/    'label'       => 'Nacionalidade',
            /*string*/    'name'        => 'p_natural_bsc_pais_id',
            /*string*/    'id'          => 'p_natural_bsc_pais_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaIdent['natural_bsc_pais_id'],
            /*array()*/   'options'     => $rsPaises,
            /*string*/    'ariaLabel'   => 'Selecione um país',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => 'controller="naturalidade" controller-values="0|1"'
          )); ?>
          <?php
                //Parámetros de exibir/ocultar div - BEGIN
          $displayNaturalidadeNacional      = $rsRegistroPessoaIdent['natural_bsc_pais_id'] != 1 ? 'style="display: none;"' : '';
          $displayNaturalidadeExtranjeiro   = $rsRegistroPessoaIdent['natural_bsc_pais_id'] <= 1 ? 'style="display: none;"' : '';
                //Parámetros de exibir/ocultar div - NED
          ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '6 " '.$displayNaturalidadeNacional.' controlled="naturalidade" control-value="1' ,
            /*string*/    'label'       => 'Naturalidade',
            /*string*/    'name'        => 'p_natural_bsc_municipio_id',
            /*string*/    'id'          => 'p_natural_bsc_municipio_id',
            /*string*/    'class'       => 'select2_naturalidade form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaIdent['natural_bsc_municipio_id'],
            /*array()*/   'options'     => ($rsRegistroPessoaIdent['natural_bsc_municipio_id'] > 0 ? array(array('id' => $rsRegistroPessoaIdent['natural_bsc_municipio_id'], 'nome' => ($rsRegistroPessoaIdent['natural_municipio_nome'].' - '.$rsRegistroPessoaIdent['natural_estado_sigla']))) : NULL),
            /*string*/    'ariaLabel'   => 'Selecione um país',
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => 'controlled="naturalidade" control-value="1"'
          )); ?>
        </div>
        <div id="div_naturalidade_extrangeiro" controlled="naturalidade" control-value="0" <?= $displayNaturalidadeExtranjeiro ;?>>
          <div class="row">
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Nome da Cidade',
              /*string*/    'type'        => 'text',
              /*string*/    'name'        => 'p_natural_estrangeiro_cidade',
              /*string*/    'id'          => 'p_natural_estrangeiro_cidade',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 3,
              /*int*/       'maxlength'   => 130,
              /*string*/    'placeholder' => 'Digite o nome da cidade de nascimento da pessoa',
              /*string*/    'value'       => $rsRegistroPessoaIdent['natural_estrangeiro_cidade'],
              /*bool*/      'required'    => true,
              /*string*/    'prop'        => 'controlled="naturalidade" control-value="0"'
            )) ;?>
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Nome do Estado',
              /*string*/    'type'        => 'text',
              /*string*/    'name'        => 'p_natural_estrangeiro_estado',
              /*string*/    'id'          => 'p_natural_estrangeiro_estado',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 3,
              /*int*/       'maxlength'   => 100,
              /*string*/    'placeholder' => 'Digite o nome do estado de nascimento da pessoa',
              /*string*/    'value'       => $rsRegistroPessoaIdent['natural_estrangeiro_estado'],
              /*bool*/      'required'    => true,
              /*string*/    'prop'        => 'controlled="naturalidade" control-value="0"'
            )) ;?>
          </div>
          <div class="row">
            <?= createInputDate(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Data de Ingreso ao Brasil',
              /*string*/    'name'        => 'p_natural_estrangeiro_dt_ingresso',
              /*string*/    'id'          => 'p_natural_estrangeiro_dt_ingresso',
              /*string*/    'class'       => 'form-control mask-data',
              /*int*/       'min'         => '1900-01-01',
              /*int*/       'maxToday'    => true,
              /*string*/    'placeholder' => 'Digite a data de ingresso da pessoa ao Brasil',
              /*string*/    'value'       => $rsRegistroPessoaIdent['natural_estrangeiro_dt_ingresso'],
              /*bool*/      'required'    => true,
              /*string*/    'prop'        => 'controlled="naturalidade" control-value="0"'
            )) ;?>
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Condição de Trabalho',
              /*string*/    'type'        => 'text',
              /*string*/    'name'        => 'p_natural_estrangeiro_condicao_trabalho',
              /*string*/    'id'          => 'p_natural_estrangeiro_condicao_trabalho',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 3,
              /*int*/       'maxlength'   => 254,
              /*string*/    'placeholder' => 'Digite a condição de trabalho da pessoa',
              /*string*/    'value'       => $rsRegistroPessoaIdent['natural_estrangeiro_condicao_trabalho'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="naturalidade" control-value="0"'
            )) ;?>
          </div>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $tituloFormulario2;?></h5>
        <small><?= $descricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <div class="col-md-6">
            <!-- div row input - BEGIN -->
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Nome do Pai',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'p_pai_nome',
                /*string*/    'id'          => 'p_pai_nome',
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 254,
                /*string*/    'placeholder' => 'Digite o nome do pai da pessoa',
                /*string*/    'value'       => $rsRegistroPessoaIdent['pai_nome'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )) ;?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Nacionalidade do Pai',
                /*string*/    'name'        => 'p_pai_natural_bsc_pais_id',
                /*string*/    'id'          => 'p_pai_natural_bsc_pais_id',
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $rsRegistroPessoaIdent['pai_natural_bsc_pais_id'],
                /*array()*/   'options'     => $rsPaises,
                /*string*/    'ariaLabel'   => 'Selecione um país',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Profissão do Pai',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'p_pai_profissao',
                /*string*/    'id'          => 'p_pai_profissao',
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 254,
                /*string*/    'placeholder' => 'Digite a profissão do pai da pessoa',
                /*string*/    'value'       => $rsRegistroPessoaIdent['pai_profissao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )) ;?>
            </div>
            <!-- div row input - END -->
          </div>
          <div class="col-md-6">
            <div class="row">
              <!-- div row input - BEGIN -->
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Nome da Mãe',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'p_mae_nome',
                /*string*/    'id'          => 'p_mae_nome',
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 254,
                /*string*/    'placeholder' => 'Digite o nome da mãe da pessoa',
                /*string*/    'value'       => $rsRegistroPessoaIdent['mae_nome'],
                /*bool*/      'required'    => true,
                /*string*/    'prop'        => ''
              )) ;?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Nacionalidade da Mãe',
                /*string*/    'name'        => 'p_mae_natural_bsc_pais_id',
                /*string*/    'id'          => 'p_mae_natural_bsc_pais_id',
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $rsRegistroPessoaIdent['mae_natural_bsc_pais_id'],
                /*array()*/   'options'     => $rsPaises,
                /*string*/    'ariaLabel'   => 'Selecione um país',
                /*bool*/      'required'    => true,
                /*string*/    'prop'        => ''
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Profissão da Mãe',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'p_mae_profissao',
                /*string*/    'id'          => 'p_mae_profissao',
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 254,
                /*string*/    'placeholder' => 'Digite a profissão da mãe da pessoa',
                /*string*/    'value'       => $rsRegistroPessoaIdent['mae_profissao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )) ;?>
            </div>
            <!-- div row input - END -->
          </div>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $tituloFormulario4;?></h5>
        <small><?= $descricaoFormulario4;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Enfermidade Portada',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_enfermidade_portador',
            /*string*/    'id'          => 'p_enfermidade_portador',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome enfermidade portada pela pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['enfermidade_portador'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Código Internacional da Enfermidade',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'p_enfermidade_codigo_internacional',
            /*string*/    'id'          => 'p_enfermidade_codigo_internacional',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 10,
            /*string*/    'placeholder' => 'Digite o código internacional da enfermidade portada pela pessoa',
            /*string*/    'value'       => $rsRegistroPessoaIdent['enfermidade_codigo_internacional'],
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
if (isset($exibeButoes)) {
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