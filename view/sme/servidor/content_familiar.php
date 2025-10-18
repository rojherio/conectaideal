<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Contato - BEGIN
$stmt = $db->prepare("
  SELECT 
  sf.id,
  sf.status,
  sf.dt_cadastro,
  sf.sme_servidor_id,
  sf.bsc_estado_civil_id,
  sf.conjuge_dt_casamento,
  sf.conjuge_nome,
  sf.conjuge_cpf,
  sf.conjuge_dt_nascimento,
  sf.bsc_pais_id_conjuge,
  sf.bsc_municipio_id_conjuge,
  sf.conjuge_natural_estrangeiro_cidade,
  sf.conjuge_natural_estrangeiro_estado,
  sf.conjuge_local_trabalho,
  sf.reg_civil_modelo,
  sf.reg_civil_numero,
  sf.reg_civil_livro,
  sf.reg_civil_folha,
  sf.reg_civil_cartorio,
  sf.reg_civil_dt_emissao,
  sf.bsc_municipio_id_reg_civil,
  sf.averbacao_tipo,
  sf.averbacao_numero,
  sf.averbacao_dt_emissao,
  sf.averbacao_cartorio,
  sf.bsc_municipio_id_averbacao
  FROM sme_serv_familiar AS sf 
  WHERE sf.sme_servidor_id = ?;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistroSFamiliar = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroSFamiliar)) {
  $rsRegistroSFamiliar = array();
  $rsRegistroSFamiliar['id'] = 0;
  $rsRegistroSFamiliar['status'] = 1;
  $rsRegistroSFamiliar['sme_servidor_id'] = $idS;
  $rsRegistroSFamiliar['bsc_estado_civil_id'] = '';
  $rsRegistroSFamiliar['conjuge_dt_casamento'] = '';
  $rsRegistroSFamiliar['conjuge_nome'] = '';
  $rsRegistroSFamiliar['conjuge_cpf'] = '';
  $rsRegistroSFamiliar['conjuge_dt_nascimento'] = '';
  $rsRegistroSFamiliar['bsc_pais_id_conjuge'] = '';
  $rsRegistroSFamiliar['bsc_municipio_id_conjuge'] = '';
  $rsRegistroSFamiliar['conjuge_natural_estrangeiro_cidade'] = '';
  $rsRegistroSFamiliar['conjuge_natural_estrangeiro_estado'] = '';
  $rsRegistroSFamiliar['conjuge_local_trabalho'] = '';
  $rsRegistroSFamiliar['reg_civil_modelo'] = 'Novo';
  $rsRegistroSFamiliar['reg_civil_numero'] = '';
  $rsRegistroSFamiliar['reg_civil_livro'] = '';
  $rsRegistroSFamiliar['reg_civil_folha'] = '';
  $rsRegistroSFamiliar['reg_civil_cartorio'] = '';
  $rsRegistroSFamiliar['reg_civil_dt_emissao'] = '';
  $rsRegistroSFamiliar['bsc_municipio_id_reg_civil'] = '';
  $rsRegistroSFamiliar['averbacao_tipo'] = '';
  $rsRegistroSFamiliar['averbacao_numero'] = '';
  $rsRegistroSFamiliar['averbacao_dt_emissao'] = '';
  $rsRegistroSFamiliar['averbacao_cartorio'] = '';
  $rsRegistroSFamiliar['bsc_municipio_id_averbacao'] = '';
}
//Contato - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM bsc_estado_civil;");
$stmt->execute();
$rsEstadoCivils = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM bsc_pais;");
$stmt->execute();
$rsPaiss = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  m.id, 
  CONCAT(m.nome, ' - ', e.sigla) AS nome
  FROM bsc_municipio AS m 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
  WHERE m.id IN (?, ?, ?)
  ORDER BY e.sigla ASC, m.nome;");
$stmt->bindValue(1, $rsRegistroSFamiliar['bsc_municipio_id_conjuge']);
$stmt->bindValue(2, $rsRegistroSFamiliar['bsc_municipio_id_reg_civil']);
$stmt->bindValue(3, $rsRegistroSFamiliar['bsc_municipio_id_averbacao']);
$stmt->execute();
$rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Dados Civís";
$descricaoFormulario1     = "Dados civís do servidor";
$tituloFormulario2        = "Registro Civil";
$descricaoFormulario2     = "Dados do registro civil do servidor";
$tituloFormulario3        = "Averbação";
$descricaoFormulario3     = "Dados da averbação do registro civil do servidor";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pf_id" id="pf_id" value="<?= $rsRegistroSFamiliar['id'] ;?>">
  <input type="hidden" name="sf_sme_servidor_id" id="sf_sme_servidor_id" value="<?= $rsRegistroSIdent['id'] ;?>">
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
            /*string*/    'label'       => 'Estado Civil',
            /*string*/    'name'        => 'sf_bsc_estado_civil_id',
            /*string*/    'id'          => 'sf_bsc_estado_civil_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSFamiliar['bsc_estado_civil_id'],
            /*array()*/   'options'     => $rsEstadoCivils,
            /*string*/    'ariaLabel'   => 'Selecione uma estado civil',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de Casamento',
            /*string*/    'name'        => 'sf_conjuge_dt_casamento',
            /*string*/    'id'          => 'sf_conjuge_dt_casamento',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de casamento',
            /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_dt_casamento'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Nome do(a) Conjuge',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_conjuge_nome',
            /*string*/    'id'          => 'sf_conjuge_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 130,
            /*string*/    'placeholder' => 'Digite o nome do(a) conjuge',
            /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_nome'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'CPF do(a) Conjuge',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_conjuge_cpf',
            /*string*/    'id'          => 'sf_conjuge_cpf',
            /*string*/    'class'       => 'form-control mask-cpf',
            /*int*/       'minlength'   => 14,
            /*int*/       'maxlength'   => 14,
            /*string*/    'placeholder' => 'Digite o CPF do(a) conjuge',
            /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_cpf'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de Nascimento do(a) Conjuge',
            /*string*/    'name'        => 'sf_conjuge_dt_nascimento',
            /*string*/    'id'          => 'sf_conjuge_dt_nascimento',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de nascimento do(a) conjuge',
            /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_dt_nascimento'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '6 " controller="naturalidade_conjuge',
            /*string*/    'label'       => 'Nascionalidade do(a) Conjuge',
            /*string*/    'name'        => 'sf_bsc_pais_id_conjuge',
            /*string*/    'id'          => 'sf_bsc_pais_id_conjuge',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSFamiliar['bsc_pais_id_conjuge'],
            /*array()*/   'options'     => $rsPaiss,
            /*string*/    'ariaLabel'   => 'Selecione a nascionalidade do(a) conjuge',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => 'controller="naturalidade_conjuge" controller-values="0|1"'
          )); ?>
          <?php
          //Parámetros de exibir/ocultar div - BEGIN
          $displayNacionalConjuge      = $rsRegistroSFamiliar['bsc_pais_id_conjuge'] != 1 ? 'style="display: none;"' : '';
          $displayExtranjeiroConjuge   = $rsRegistroSFamiliar['bsc_pais_id_conjuge'] <= 1 ? 'style="display: none;"' : '';
          //Parámetros de exibir/ocultar div - NED
          ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => '6 " '.$displayNacionalConjuge.' controlled="naturalidade_conjuge" control-value="1' ,
            /*string*/    'label'       => 'Naturalidade do(a) Conjuge',
            /*string*/    'name'        => 'sf_bsc_municipio_id_conjuge',
            /*string*/    'id'          => 'sf_bsc_municipio_id_conjuge',
            /*string*/    'class'       => 'select2_municipio form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSFamiliar['bsc_municipio_id_conjuge'],
            /*array()*/   'options'     => $rsMunicipios,
            /*string*/    'ariaLabel'   => 'Selecione a naturalidade do(a) conjuge',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => 'controlled="naturalidade_conjuge" control-value="1"'
          )); ?>
        </div>
        <div controlled="naturalidade_conjuge" control-value="0" <?= $displayExtranjeiroConjuge ;?>>
          <div class="row">
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Nome da Cidade do(a) Conjuge',
              /*string*/    'type'        => 'text',
              /*string*/    'name'        => 'sf_conjuge_natural_estrangeiro_cidade',
              /*string*/    'id'          => 'sf_conjuge_natural_estrangeiro_cidade',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 3,
              /*int*/       'maxlength'   => 70,
              /*string*/    'placeholder' => 'Digite o nome da cidade de nascimento do(a) conjuge',
              /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_natural_estrangeiro_cidade'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="naturalidade_conjuge" control-value="0"'
            )) ;?>
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Nome do Estado do(a) Conjuge',
              /*string*/    'type'        => 'text',
              /*string*/    'name'        => 'sf_conjuge_natural_estrangeiro_estado',
              /*string*/    'id'          => 'sf_conjuge_natural_estrangeiro_estado',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 3,
              /*int*/       'maxlength'   => 50,
              /*string*/    'placeholder' => 'Digite o nome do estado de nascimento do(a) conjuge',
              /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_natural_estrangeiro_estado'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="naturalidade_conjuge" control-value="0"'
            )) ;?>
          </div>
          <div class="row">
            <?= createInput(array(
              /*int 1-12*/  'col'         => 12,
              /*string*/    'label'       => 'Local de Trabalho do(a) Conjuge',
              /*string*/    'type'        => 'text',
              /*string*/    'name'        => 'sf_conjuge_local_trabalho',
              /*string*/    'id'          => 'sf_conjuge_local_trabalho',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 3,
              /*int*/       'maxlength'   => 70,
              /*string*/    'placeholder' => 'Digite o local de trabalho do(a) conjuge',
              /*string*/    'value'       => $rsRegistroSFamiliar['conjuge_local_trabalho'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="naturalidade_conjuge" control-value="0"'
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
          <?= createRadio(array(
            /*int 1-12*/  'col'         => 12,
            /*int 1-12*/  'colOption'   => 6,
            /*string*/    'label'       => 'Modelo da Certidão',
            /*string*/    'type'        => 'radio',
            /*string*/    'name'        => 'sf_reg_civil_modelo',
            /*array()*/   'id'          => array('sf_reg_civil_modelo_antigo', 'sf_reg_civil_modelo_novo'),
            /*string*/    'class'       => 'radiomark outline-info ms-2',
            /*array()*/   'value'       => $rsRegistroSFamiliar['reg_civil_modelo'],
            /*array()*/   'values'      => array('Antigo', 'Novo'),
            /*array()*/   'options'     => array("Antigo", "Novo"),
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número/Matrícula da Certidão',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_reg_civil_numero',
            /*string*/    'id'          => 'sf_reg_civil_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 37,
            /*string*/    'placeholder' => 'Digite o número/matrícula da certidão',
            /*string*/    'value'       => $rsRegistroSFamiliar['reg_civil_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Livro da Certidão',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_reg_civil_livro',
            /*string*/    'id'          => 'sf_reg_civil_livro',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 37,
            /*string*/    'placeholder' => 'Digite o número do livro da certidão',
            /*string*/    'value'       => $rsRegistroSFamiliar['reg_civil_livro'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Folha da Certidão',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_reg_civil_folha',
            /*string*/    'id'          => 'sf_reg_civil_folha',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 8,
            /*string*/    'placeholder' => 'Digite o número da folha da certidão',
            /*string*/    'value'       => $rsRegistroSFamiliar['reg_civil_folha'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cartório da Certidão',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_reg_civil_cartorio',
            /*string*/    'id'          => 'sf_reg_civil_cartorio',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 5,
            /*string*/    'placeholder' => 'Digite o nome do cartório da certidão',
            /*string*/    'value'       => $rsRegistroSFamiliar['reg_civil_cartorio'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de Expedição da Certidão',
            /*string*/    'name'        => 'sf_reg_civil_dt_emissao',
            /*string*/    'id'          => 'sf_reg_civil_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de expedição da certidão',
            /*string*/    'value'       => $rsRegistroSFamiliar['reg_civil_dt_emissao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Município de Expedição da Certidão',
            /*string*/    'name'        => 'sf_bsc_municipio_id_reg_civil',
            /*string*/    'id'          => 'sf_bsc_municipio_id_reg_civil',
            /*string*/    'class'       => 'select2_municipio form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSFamiliar['bsc_municipio_id_reg_civil'],
            /*array()*/   'options'     => $rsMunicipios,
            /*string*/    'ariaLabel'   => 'Selecione o município de expedição da certidão',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
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
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Tipo de Averbação',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_averbacao_tipo',
            /*string*/    'id'          => 'sf_averbacao_tipo',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o tipo de averbação',
            /*string*/    'value'       => $rsRegistroSFamiliar['averbacao_tipo'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número da Averbação',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_averbacao_numero',
            /*string*/    'id'          => 'sf_averbacao_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número da averbação',
            /*string*/    'value'       => $rsRegistroSFamiliar['averbacao_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de Expedição da Averbvação',
            /*string*/    'name'        => 'sf_averbacao_dt_emissao',
            /*string*/    'id'          => 'sf_averbacao_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de expedição da averbação',
            /*string*/    'value'       => $rsRegistroSFamiliar['averbacao_dt_emissao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cartório de Averbação',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'sf_averbacao_cartorio',
            /*string*/    'id'          => 'sf_averbacao_cartorio',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 70,
            /*string*/    'placeholder' => 'Digite o nome do cartório da averbação',
            /*string*/    'value'       => $rsRegistroSFamiliar['averbacao_cartorio'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Município de Expedição da Averbação',
            /*string*/    'name'        => 'sf_bsc_municipio_id_averbacao',
            /*string*/    'id'          => 'sf_bsc_municipio_id_averbacao',
            /*string*/    'class'       => 'select2_municipio form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSFamiliar['bsc_municipio_id_averbacao'],
            /*array()*/   'options'     => $rsMunicipios,
            /*string*/    'ariaLabel'   => 'Selecione o município de expedicão da averbação',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
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
<!-- formulário de cadastro - END -->