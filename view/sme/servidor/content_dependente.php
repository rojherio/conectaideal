<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  sd.id,
  sd.status,
  sd.dt_cadastro,
  sd.sme_servidor_id,
  sd.codigo,
  sd.nome,
  sd.bsc_parentesco_grau_id,
  sd.parentesco_grau_outro,
  sd.dt_nascimento,
  sd.dt_casamento,
  sd.cpf,
  sd.benef_rg_numero,
  sd.benef_rg_dt_emissao,
  sd.benef_rg_orgao_expedidor,
  sd.benef_tel_residencial,
  sd.benef_tel_celular,
  sd.benef_end_cep,
  sd.benef_end_logradouro,
  sd.benef_end_numero,
  sd.benef_end_complemento,
  sd.benef_end_bairro,
  sd.benef_bsc_municipio_id,
  sd.benef_autos_numero,
  sd.benef_bsc_banco_conta_tipo_id,
  sd.benef_bsc_banco_id,
  sd.benef_agencia,
  sd.benef_conta,
  sd.benef_op,
  sd.benef_repres_nome,
  sd.benef_repres_cpf,
  sd.benef_repres_rg_numero,
  sd.benef_repres_rg_dt_emissao,
  sd.benef_repres_rg_orgao_expedidor,
  sd.benef_repres_end_cep,
  sd.benef_repres_end_logradouro,
  sd.benef_repres_end_numero,
  sd.benef_repres_end_complemento,
  sd.benef_repres_end_bairro,
  sd.benef_repres_bsc_municipio_id,
  sd.benef_repres_tel_residencial,
  sd.benef_repres_tel_celular
  FROM sme_serv_dependente AS sd
  WHERE sd.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistroSDependente = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistroSDependente) {
  $rsRegistroSDependente = array();
  $rsRegistroSDependente[0]['id'] = 0;
  $rsRegistroSDependente[0]['status'] = 1;
  $rsRegistroSDependente[0]['id'] = 0;
  $rsRegistroSDependente[0]['status'] = 1;
  $rsRegistroSDependente[0]['dt_cadastro'] = '';
  $rsRegistroSDependente[0]['sme_servidor_id'] = $idS;
  $rsRegistroSDependente[0]['codigo'] = '';
  $rsRegistroSDependente[0]['nome'] = '';
  $rsRegistroSDependente[0]['bsc_parentesco_grau_id'] = '';
  $rsRegistroSDependente[0]['parentesco_grau_outro'] = '';
  $rsRegistroSDependente[0]['benef_rg_numero'] = '';
  $rsRegistroSDependente[0]['dt_nascimento'] = '';
  $rsRegistroSDependente[0]['dt_casamento'] = '';
  $rsRegistroSDependente[0]['cpf'] = '';
  $rsRegistroSDependente[0]['benef_rg_numero'] = '';
  $rsRegistroSDependente[0]['benef_rg_numero'] = '';
  $rsRegistroSDependente[0]['benef_rg_dt_emissao'] = '';
  $rsRegistroSDependente[0]['benef_rg_orgao_expedidor'] = '';
  $rsRegistroSDependente[0]['benef_tel_residencial'] = '';
  $rsRegistroSDependente[0]['benef_tel_celular'] = '';
  $rsRegistroSDependente[0]['benef_end_cep'] = '';
  $rsRegistroSDependente[0]['benef_end_logradouro'] = '';
  $rsRegistroSDependente[0]['benef_end_numero'] = '';
  $rsRegistroSDependente[0]['benef_end_complemento'] = '';
  $rsRegistroSDependente[0]['benef_end_bairro'] = '';
  $rsRegistroSDependente[0]['benef_bsc_municipio_id'] = '';
  $rsRegistroSDependente[0]['benef_autos_numero'] = '';
  $rsRegistroSDependente[0]['benef_bsc_banco_conta_tipo_id'] = '';
  $rsRegistroSDependente[0]['benef_bsc_banco_id'] = '';
  $rsRegistroSDependente[0]['benef_agencia'] = '';
  $rsRegistroSDependente[0]['benef_conta'] = '';
  $rsRegistroSDependente[0]['benef_op'] = '';
  $rsRegistroSDependente[0]['benef_repres_nome'] = '';
  $rsRegistroSDependente[0]['benef_repres_cpf'] = '';
  $rsRegistroSDependente[0]['benef_repres_rg_numero'] = '';
  $rsRegistroSDependente[0]['benef_repres_rg_dt_emissao'] = '';
  $rsRegistroSDependente[0]['benef_repres_rg_orgao_expedidor'] = '';
  $rsRegistroSDependente[0]['benef_repres_end_cep'] = '';
  $rsRegistroSDependente[0]['benef_repres_end_logradouro'] = '';
  $rsRegistroSDependente[0]['benef_repres_end_numero'] = '';
  $rsRegistroSDependente[0]['benef_repres_end_complemento'] = '';
  $rsRegistroSDependente[0]['benef_repres_end_bairro'] = '';
  $rsRegistroSDependente[0]['benef_repres_bsc_municipio_id'] = '';
  $rsRegistroSDependente[0]['benef_repres_tel_residencial'] = '';
  $rsRegistroSDependente[0]['benef_repres_tel_celular'] = '';
}
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Municipios - BEGIN
$rsMunicipios = [];
foreach ($rsRegistroSDependente as $k => $v) {
  $stmt = $db->prepare("SELECT 
    m.id,
    CONCAT(m.nome, ' - ', e.sigla) AS nome
    FROM bsc_municipio AS m 
    LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
    WHERE m.id IN (?, ?)
    ORDER BY e.sigla ASC, m.nome ASC;");
  $stmt->bindValue(1, $v['benef_bsc_municipio_id']);
  $stmt->bindValue(2, $v['benef_repres_bsc_municipio_id']);
  $stmt->execute();
  $rsMunicipio = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $rsMunicipio ? array_push($rsMunicipios, $Municipio) : '';
}
//Municipios - END
//Parentesco Grau - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_parentesco_grau  
  WHERE 1 = 1 
  ORDER BY nome;");
$stmt->execute();
$rsParentescoGraus = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Parentesco Grau - END
//Banco Conta Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_banco_conta_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsBancoContaTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Banco Conta Tipo - END
//Bancos - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_banco  
  WHERE 1 = 1;");
$stmt->execute();
$rsBancos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Bancos - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Dependentes do Servidor";
$siDescricaoFormulario1    = "Informações dos dependentes do servidor ";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="sd_sme_servidor_id" id="sd_sme_servidor_id" value="<?= $idS ;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $siTituloFormulario1;?></h5>
        <small><?= $siDescricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="div_clones card-body pt-0">
        <?php
        foreach ($rsRegistroSDependente as $keySD => $objSD) {
          ?>
          <div divcount="<?=$keySD+1;?>" class="div_clonar row border border-outline-info rounded pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Dependentes - <span class="span_contador"><?=$keySD+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="sd_sme_serv_dependente_id[]" id="sd_sme_serv_dependente_id_<?=$keySD+1;?>" idbase="sd_sme_serv_dependente_id_" value="<?=$objSD['id'];?>"/>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Código',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_codigo[]',
                /*string*/    'id'          => 'sd_codigo_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 8,
                /*string*/    'placeholder' => 'Digite o código',
                /*string*/    'value'       => $objSD['codigo'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_codigo_"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '8 pe-1',
                /*string*/    'label'       => 'Nome',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_nome[]',
                /*string*/    'id'          => 'sd_nome_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 130,
                /*string*/    'placeholder' => 'Digite o nome',
                /*string*/    'value'       => $objSD['nome'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_nome_"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Grau de Parentesco',
                /*string*/    'name'        => 'sd_bsc_parentesco_grau_id[]',
                /*string*/    'id'          => 'sd_bsc_parentesco_grau_id_'.$keySD,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSD['bsc_parentesco_grau_id'],
                /*array()*/   'options'     => $rsParentescoGraus,
                /*string*/    'ariaLabel'   => 'Selecione um grau de parentesco',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_bsc_parentesco_grau_id_"'
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '8 pe-1',
                /*string*/    'label'       => 'Outro Grau de Parentesco',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_parentesco_grau_outro[]',
                /*string*/    'id'          => 'sd_parentesco_grau_outro_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 50,
                /*string*/    'placeholder' => 'Digite outro grau de parentesco',
                /*string*/    'value'       => $objSD['parentesco_grau_outro'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_parentesco_grau_outro_"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Data de Nascimento',
                /*string*/    'name'        => 'sd_dt_nascimento[]',
                /*string*/    'id'          => 'sd_dt_nascimento_'.$keySD,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data de nascimento',
                /*string*/    'value'       => $objSD['dt_nascimento'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_dt_nascimento_"'
              )) ;?>
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Data de Casamento',
                /*string*/    'name'        => 'sd_dt_casamento[]',
                /*string*/    'id'          => 'sd_dt_casamento_'.$keySD,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data de casamento',
                /*string*/    'value'       => $objSD['dt_casamento'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_dt_casamento_"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'CPF',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_cpf[]',
                /*string*/    'id'          => 'sd_cpf_'.$keySD,
                /*string*/    'class'       => 'form-control mask-cpf',
                /*int*/       'minlength'   => 14,
                /*int*/       'maxlength'   => 14,
                /*string*/    'placeholder' => 'Digite o CPF',
                /*string*/    'value'       => $objSD['cpf'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_cpf_"'
              )) ;?>
            </div>
            <div class="row pb-0">
              <?= createRadio(array(
                /*int 1-12*/  'col'         => '6 pe-1',
                /*int 1-12*/  'colOption'   => 6,
                /*string*/    'label'       => 'O Dependente é Beneficiário de Pensão?',
                /*string*/    'type'        => 'radio',
                /*string*/    'name'        => 'sd_beneficiario_'.$keySD,
                /*array()*/   'id'          => array('sd_beneficiario_nao_'.$keySD, 'sd_beneficiario_sim_'.$keySD),
                /*string*/    'class'       => 'radiomark outline-info ms-2',
                /*array()*/   'value'       => $objSD['benef_rg_numero'] != '' ? 'Sim' : 'Não',
                /*array()*/   'values'      => array('Não', 'Sim'),
                /*array()*/   'options'     => array("Não", "Sim"),
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => '" controller="benef_'.$keySD.'" controller-values="Sim"',
                /*string*/    'prop_aux'    => array('idbase="sd_beneficiario_nao_"', 'idbase="sd_beneficiario_sim_"')
              )) ?>
            </div>
            <?php
              //Parámetros de exibir/ocultar div - BEGIN
            $displayBenef        = $objSD['benef_rg_numero'] == '' ? 'style="display: none;"' : '';
              //Parámetros de exibir/ocultar div - NED
            ?>
            <div controlled="benef_<?=$keySD;?>" control-value="Sim" <?= $displayBenef ;?>>
            <h6>Dados complementários do dependente beneficiário de pensão</h6>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '6 pe-1',
                /*string*/    'label'       => 'Número dos Autos',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_autos_numero[]',
                /*string*/    'id'          => 'sd_benef_autos_numero_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 0,
                /*int*/       'maxlength'   => 100,
                /*string*/    'placeholder' => 'Digite o número dos autos',
                /*string*/    'value'       => $objSD['benef_autos_numero'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_autos_numero_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Número do RG',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_rg_numero[]',
                /*string*/    'id'          => 'sd_benef_rg_numero_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 15,
                /*string*/    'placeholder' => 'Digite o número do RG',
                /*string*/    'value'       => $objSD['benef_rg_numero'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_rg_numero_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Data de emissão',
                /*string*/    'name'        => 'sd_benef_rg_dt_emissao[]',
                /*string*/    'id'          => 'sd_benef_rg_dt_emissao_'.$keySD,
                /*string*/    'class'       => 'form-control mask-data',
                /*int*/       'min'         => '1900-01-01',
                /*int*/       'maxToday'    => true,
                /*string*/    'placeholder' => 'Digite a data de emissão do RG',
                /*string*/    'value'       => $objSD['benef_rg_dt_emissao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_rg_dt_emissao_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Órgão expedidor',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_rg_orgao_expedidor[]',
                /*string*/    'id'          => 'sd_benef_rg_orgao_expedidor_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 18,
                /*string*/    'placeholder' => 'Digite o órgão expedidor do RG',
                /*string*/    'value'       => $objSD['benef_rg_orgao_expedidor'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_rg_orgao_expedidor_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '6 pe-1',
                /*string*/    'label'       => 'Telefone Residencial',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_tel_residencial[]',
                /*string*/    'id'          => 'sd_benef_tel_residencial_'.$keySD,
                /*string*/    'class'       => 'form-control mask-tel-resid',
                /*int*/       'minlength'   => 11,
                /*int*/       'maxlength'   => 15,
                /*string*/    'placeholder' => 'Digite o número telefônico residencial',
                /*string*/    'value'       => $objSD['benef_tel_residencial'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_tel_residencial_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '6 pe-1',
                /*string*/    'label'       => 'Telefone Celular',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_tel_celular[]',
                /*string*/    'id'          => 'sd_benef_tel_celular_'.$keySD,
                /*string*/    'class'       => 'form-control mask-tel-cel',
                /*int*/       'minlength'   => 11,
                /*int*/       'maxlength'   => 15,
                /*string*/    'placeholder' => 'Digite o número telefônico celular',
                /*string*/    'value'       => $objSD['benef_tel_celular'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_tel_celular_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'CEP',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_end_cep[]',
                /*string*/    'id'          => 'sd_benef_end_cep_'.$keySD,
                /*string*/    'class'       => 'form-control mask-cep',
                /*int*/       'minlength'   => 10,
                /*int*/       'maxlength'   => 10,
                /*string*/    'placeholder' => 'Digite o cep do endereço',
                /*string*/    'value'       => $objSD['benef_end_cep'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_end_cep_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '10 pe-1',
                /*string*/    'label'       => 'Logradouro',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_end_logradouro[]',
                /*string*/    'id'          => 'sd_benef_end_logradouro_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 100,
                /*string*/    'placeholder' => 'Digite o logradouro do endereço',
                /*string*/    'value'       => $objSD['benef_end_logradouro'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_end_logradouro_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '2 pe-1',
                /*string*/    'label'       => 'Número',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_end_numero[]',
                /*string*/    'id'          => 'sd_benef_end_numero_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 10,
                /*string*/    'placeholder' => 'Digite o número do endereço',
                /*string*/    'value'       => $objSD['benef_end_numero'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_end_numero_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Complemento',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_end_complemento[]',
                /*string*/    'id'          => 'sd_benef_end_complemento_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 0,
                /*int*/       'maxlength'   => 100,
                /*string*/    'placeholder' => 'Digite o complemento do endereço',
                /*string*/    'value'       => $objSD['benef_end_complemento'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_end_complemento_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Bairro',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_end_bairro[]',
                /*string*/    'id'          => 'sd_benef_end_bairro_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 0,
                /*int*/       'maxlength'   => 50,
                /*string*/    'placeholder' => 'Digite o bairro do endereço',
                /*string*/    'value'       => $objSD['benef_end_bairro'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_end_bairro_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Cidade',
                /*string*/    'name'        => 'sd_benef_bsc_municipio_id[]',
                /*string*/    'id'          => 'sd_benef_bsc_municipio_id_'.$keySD,
                /*string*/    'class'       => 'select2-municipio form-control form-select select-basic',
                /*string*/    'value'       => $objSD['benef_bsc_municipio_id'],
                /*array()*/   'options'     => $rsMunicipios,
                /*string*/    'ariaLabel'   => 'Digite o nome da cidade',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_bsc_municipio_id_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )); ?>
            </div>
            <div class="row pe-0">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Tipo de Conta Bancaria',
                /*string*/    'name'        => 'sd_benef_bsc_banco_conta_tipo_id[]',
                /*string*/    'id'          => 'sd_benef_bsc_banco_conta_tipo_id_'.$keySD,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSD['benef_bsc_banco_conta_tipo_id'],
                /*array()*/   'options'     => $rsBancoContaTipos,
                /*string*/    'ariaLabel'   => 'Selecione um tipo de conta bancaria',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_bsc_banco_conta_tipo_id_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )); ?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '8 pe-1',
                /*string*/    'label'       => 'Banco',
                /*string*/    'name'        => 'sd_benef_bsc_banco_id[]',
                /*string*/    'id'          => 'sd_benef_bsc_banco_id_'.$keySD,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSD['benef_bsc_banco_id'],
                /*array()*/   'options'     => $rsBancos,
                /*string*/    'ariaLabel'   => 'Selecione um Banco',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_bsc_banco_id_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )); ?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Agência bancária',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_agencia[]',
                /*string*/    'id'          => 'sd_benef_agencia_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 6,
                /*string*/    'placeholder' => 'Digite o numero da agencia',
                /*string*/    'value'       => $objSD['benef_agencia'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_agencia_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Número da Conta',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_conta[]',
                /*string*/    'id'          => 'sd_benef_conta_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 15,
                /*string*/    'placeholder' => 'Digite o número da conta',
                /*string*/    'value'       => $objSD['benef_conta'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_conta_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Número da Operação',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sd_benef_op[]',
                /*string*/    'id'          => 'sd_benef_op_'.$keySD,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 3,
                /*string*/    'placeholder' => 'Digite o número da operação da conta bancaria',
                /*string*/    'value'       => $objSD['benef_op'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sd_benef_op_" controlled="benef_'.$keySD.'" control-value="Sim"'
              )) ;?>
            </div>
            <div class="row pb-0">
              <?= createRadio(array(
                /*int 1-12*/  'col'         => '6 pe-1',
                /*int 1-12*/  'colOption'   => 6,
                /*string*/    'label'       => 'O Dependente Beneficiário tem Representante?',
                /*string*/    'type'        => 'radio',
                /*string*/    'name'        => 'sd_representante_'.$keySD,
                /*array()*/   'id'          => array('sd_representante_nao_'.$keySD, 'sd_representante_sim_'.$keySD),
                /*string*/    'class'       => 'radiomark outline-info ms-2',
                /*array()*/   'value'       => $objSD['benef_repres_nome'] != '' ? 'Sim' : 'Não',
                /*array()*/   'values'      => array('Não', 'Sim'),
                /*array()*/   'options'     => array("Não", "Sim"),
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'controller="repres_benef_'.$keySD.'" controller-values="Sim" controlled="benef_'.$keySD.'" control-value="Sim"',
                /*string*/    'prop_aux'    => array('idbase="sd_representante_nao_"', 'idbase="sd_representante_sim_"')
              )) ?>
            </div>
            <?php
              //Parámetros de exibir/ocultar div - BEGIN
            $displayRepres        = $objSD['benef_repres_nome'] == '' ? 'style="display: none;"' : '';
              //Parámetros de exibir/ocultar div - NED
            ?>
            <div controlled="repres_benef_<?=$keySD;?> benef_<?=$keySD;?>" control-value="Sim" controlled-noshow="benef_<?=$keySD;?>" <?= $displayRepres ;?>>
              <h6>Dados complementários do representante do dependente beneficiário de pensão</h6>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '12 pe-1',
                  /*string*/    'label'       => 'Nome do Representante do Beneficiario',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_nome[]',
                  /*string*/    'id'          => 'sd_benef_repres_nome_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 130,
                  /*string*/    'placeholder' => 'Digite o nome',
                  /*string*/    'value'       => $objSD['benef_repres_nome'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_nome_" controlled="benef_'.$keySD.' repres_benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
              </div>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '12 pe-1',
                  /*string*/    'label'       => 'CPF',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_cpf[]',
                  /*string*/    'id'          => 'sd_benef_repres_cpf_'.$keySD,
                  /*string*/    'class'       => 'form-control mask-cpf',
                  /*int*/       'minlength'   => 14,
                  /*int*/       'maxlength'   => 14,
                  /*string*/    'placeholder' => 'Digite o CPF',
                  /*string*/    'value'       => $objSD['benef_repres_cpf'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_cpf_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
              </div>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '4 pe-1',
                  /*string*/    'label'       => 'Número do RG',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_rg_numero[]',
                  /*string*/    'id'          => 'sd_benef_repres_rg_numero_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 15,
                  /*string*/    'placeholder' => 'Digite o número do RG',
                  /*string*/    'value'       => $objSD['benef_repres_rg_numero'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_rg_numeroo_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
                <?= createInputDate(array(
                  /*int 1-12*/  'col'         => '4 pe-1',
                  /*string*/    'label'       => 'Data de emissão',
                  /*string*/    'name'        => 'sd_benef_repres_rg_dt_emissao[]',
                  /*string*/    'id'          => 'sd_benef_repres_rg_dt_emissao_'.$keySD,
                  /*string*/    'class'       => 'form-control mask-data',
                  /*int*/       'min'         => '1900-01-01',
                  /*int*/       'maxToday'    => true,
                  /*string*/    'placeholder' => 'Digite a data de emissão do RG',
                  /*string*/    'value'       => $objSD['benef_repres_rg_dt_emissao'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_rg_dt_emissao_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '4 pe-1',
                  /*string*/    'label'       => 'Órgão expedidor',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_rg_orgao_expedidor[]',
                  /*string*/    'id'          => 'sd_benef_repres_rg_orgao_expedidor_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 18,
                  /*string*/    'placeholder' => 'Digite o órgão expedidor do RG',
                  /*string*/    'value'       => $objSD['benef_repres_rg_orgao_expedidor'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_rg_orgao_expedidor_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
              </div>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '6 pe-1',
                  /*string*/    'label'       => 'CEP',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_end_cep[]',
                  /*string*/    'id'          => 'sd_benef_repres_end_cep_'.$keySD,
                  /*string*/    'class'       => 'form-control mask-cep',
                  /*int*/       'minlength'   => 10,
                  /*int*/       'maxlength'   => 10,
                  /*string*/    'placeholder' => 'Digite o cep do endereço',
                  /*string*/    'value'       => $objSD['benef_repres_end_cep'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_end_cep_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
              </div>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '10 pe-1',
                  /*string*/    'label'       => 'Logradouro',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_end_logradouro[]',
                  /*string*/    'id'          => 'sd_benef_repres_end_logradouro_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 100,
                  /*string*/    'placeholder' => 'Digite o logradouro do endereço',
                  /*string*/    'value'       => $objSD['benef_repres_end_logradouro'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_end_logradouro_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '2 pe-1',
                  /*string*/    'label'       => 'Número',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_end_numero[]',
                  /*string*/    'id'          => 'sd_benef_repres_end_numero_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 1,
                  /*int*/       'maxlength'   => 10,
                  /*string*/    'placeholder' => 'Digite o número do endereço',
                  /*string*/    'value'       => $objSD['benef_repres_end_numero'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_end_numero_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
              </div>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '4 pe-1',
                  /*string*/    'label'       => 'Complemento',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_end_complemento[]',
                  /*string*/    'id'          => 'sd_benef_repres_end_complemento_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 0,
                  /*int*/       'maxlength'   => 100,
                  /*string*/    'placeholder' => 'Digite o complemento do endereço',
                  /*string*/    'value'       => $objSD['benef_repres_end_complemento'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_end_complemento_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '4 pe-1',
                  /*string*/    'label'       => 'Bairro',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_end_bairro[]',
                  /*string*/    'id'          => 'sd_benef_repres_end_bairro_'.$keySD,
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 0,
                  /*int*/       'maxlength'   => 50,
                  /*string*/    'placeholder' => 'Digite o bairro do endereço',
                  /*string*/    'value'       => $objSD['benef_repres_end_bairro'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_end_bairro_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => '4 pe-1',
                  /*string*/    'label'       => 'Cidade',
                  /*string*/    'name'        => 'sd_benef_repres_bsc_municipio_id[]',
                  /*string*/    'id'          => 'sd_benef_repres_bsc_municipio_id_'.$keySD,
                  /*string*/    'class'       => 'select2-municipio form-control form-select select-basic',
                  /*string*/    'value'       => $objSD['benef_repres_bsc_municipio_id'],
                  /*array()*/   'options'     => $rsMunicipios,
                  /*string*/    'ariaLabel'   => 'Digite o nome da cidade',
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_bsc_municipio_id_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )); ?>
              </div>
              <div class="row pe-3">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '6 pe-1',
                  /*string*/    'label'       => 'Telefone Residencial',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_tel_residencial[]',
                  /*string*/    'id'          => 'sd_benef_repres_tel_residencial_'.$keySD,
                  /*string*/    'class'       => 'form-control mask-tel-resid',
                  /*int*/       'minlength'   => 11,
                  /*int*/       'maxlength'   => 15,
                  /*string*/    'placeholder' => 'Digite o número telefônico residencial',
                  /*string*/    'value'       => $objSD['benef_repres_tel_residencial'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_tel_residencial_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => '6 pe-1',
                  /*string*/    'label'       => 'Telefone Celular',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'sd_benef_repres_tel_celular[]',
                  /*string*/    'id'          => 'sd_benef_repres_tel_celular_'.$keySD,
                  /*string*/    'class'       => 'form-control mask-tel-cel',
                  /*int*/       'minlength'   => 11,
                  /*int*/       'maxlength'   => 15,
                  /*string*/    'placeholder' => 'Digite o número telefônico celular',
                  /*string*/    'value'       => $objSD['benef_repres_tel_celular'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'idbase="sd_benef_repres_tel_celular_" controlled="repres_benef_'.$keySD.' benef_'.$keySD.'" control-value="Sim" controlled-noshow="benef_'.$keySD.'"'
                )) ;?>
              </div>
            </div>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover este Dependente
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar outro Dependente
                </button>
              </div>
            </div>
          </div>
          <!-- div row input - END -->
          <?php
        }
        ?>
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