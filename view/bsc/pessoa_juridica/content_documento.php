<?php
//Consulta para Edição - BEGIN
$idPessoa = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idPessoa = isset($bsc_pessoa_id) ? $bsc_pessoa_id : $idPessoa;
//Documento - BEGIN
$stmt = $db->prepare("
  SELECT 
  pd.id,
  pd.status,
  pd.dt_cadastro,
  pd.bsc_pessoa_id,
  pd.rg_numero,
  pd.rg_dt_emissao,
  pd.rg_orgao_expedidor,
  pd.pis_numero,
  pd.pis_dt_cadastro,
  pd.pis_domicilio_bancario,
  pd.pis_banco_numero,
  pd.pis_banco_agencia,
  pd.pis_banco_end,
  pd.eleitor_numero,
  pd.eleitor_zona,
  pd.eleitor_secao,
  pd.eleitor_bsc_municipio_id,
  m.nome AS eleitor_municipio_nome, 
  e.sigla AS eleitor_estado_sigla, 
  pd.eleitor_insc_orgao_classe,
  pd.ctps_numero,
  pd.ctps_serie,
  pd.ctps_dt_emissao,
  pd.ctps_orgao_expedidor,
  pd.ctps_primeiro_emprego_ano,
  pd.cnh_numero,
  pd.cnh_categoria,
  pd.cnh_dt_emissao,
  pd.cnh_orgao_expedidor,
  pd.cnh_validade,
  pd.cnh_dt_primeira_habilitacao,
  pd.rm_numero,
  pd.rm_categoria,
  pd.rm_emissao_ano,
  pd.rm_orgao_expedidor,
  pd.rm_especie,
  pd.rp_numero,
  pd.rp_dt_emissao,
  pd.rp_orgao_expedidor,
  pd.rp_dt_validade,
  pd.rne_numero,
  pd.rne_dt_emissao,
  pd.rne_orgao_expedidor,
  pd.fgts_numero,
  pd.fgts_opcao,
  pd.fgts_conta_vinculaa_banco,
  pd.fgts_dt_retificacao,
  pd.estrangeiro_casado_brasileiro,
  pd.estrangeiro_filho_brasileiro 
  FROM bsc_pessoa_documento AS pd 
  LEFT JOIN bsc_municipio AS m ON m.id = pd.eleitor_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  WHERE pd.bsc_pessoa_id = ?;");
$stmt->bindValue(1, $idPessoa);
$stmt->execute();
$rsRegistroPessoaDoc = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroPessoaDoc)) {
  $rsRegistroPessoaDoc = array();
  $rsRegistroPessoaDoc['id'] = 0;
  $rsRegistroPessoaDoc['status'] = 1;
  $rsRegistroPessoaDoc['bsc_pessoa_id'] = $idPessoa;
  $rsRegistroPessoaDoc['rg_numero'] = '';
  $rsRegistroPessoaDoc['rg_dt_emissao'] = '';
  $rsRegistroPessoaDoc['rg_orgao_expedidor'] = '';
  $rsRegistroPessoaDoc['pis_numero'] = '';
  $rsRegistroPessoaDoc['pis_dt_cadastro'] = '';
  $rsRegistroPessoaDoc['pis_domicilio_bancario'] = '';
  $rsRegistroPessoaDoc['pis_banco_numero'] = '';
  $rsRegistroPessoaDoc['pis_banco_agencia'] = '';
  $rsRegistroPessoaDoc['pis_banco_end'] = '';
  $rsRegistroPessoaDoc['eleitor_numero'] = '';
  $rsRegistroPessoaDoc['eleitor_zona'] = '';
  $rsRegistroPessoaDoc['eleitor_secao'] = '';
  $rsRegistroPessoaDoc['eleitor_bsc_municipio_id'] = '';
  $rsRegistroPessoaDoc['eleitor_municipio_nome'] = '';
  $rsRegistroPessoaDoc['eleitor_estado_sigla'] = '';
  $rsRegistroPessoaDoc['eleitor_insc_orgao_classe'] = '';
  $rsRegistroPessoaDoc['ctps_numero'] = '';
  $rsRegistroPessoaDoc['ctps_serie'] = '';
  $rsRegistroPessoaDoc['ctps_dt_emissao'] = '';
  $rsRegistroPessoaDoc['ctps_orgao_expedidor'] = '';
  $rsRegistroPessoaDoc['ctps_primeiro_emprego_ano'] = '';
  $rsRegistroPessoaDoc['cnh_numero'] = '';
  $rsRegistroPessoaDoc['cnh_categoria'] = '';
  $rsRegistroPessoaDoc['cnh_dt_emissao'] = '';
  $rsRegistroPessoaDoc['cnh_orgao_expedidor'] = '';
  $rsRegistroPessoaDoc['cnh_validade'] = '';
  $rsRegistroPessoaDoc['cnh_dt_primeira_habilitacao'] = '';
  $rsRegistroPessoaDoc['rm_numero'] = '';
  $rsRegistroPessoaDoc['rm_categoria'] = '';
  $rsRegistroPessoaDoc['rm_emissao_ano'] = '';
  $rsRegistroPessoaDoc['rm_orgao_expedidor'] = '';
  $rsRegistroPessoaDoc['rm_especie'] = '';
  $rsRegistroPessoaDoc['rp_numero'] = '';
  $rsRegistroPessoaDoc['rp_dt_emissao'] = '';
  $rsRegistroPessoaDoc['rp_orgao_expedidor'] = '';
  $rsRegistroPessoaDoc['rp_dt_validade'] = '';
  $rsRegistroPessoaDoc['rne_numero'] = '';
  $rsRegistroPessoaDoc['rne_dt_emissao'] = '';
  $rsRegistroPessoaDoc['rne_orgao_expedidor'] = '';
  $rsRegistroPessoaDoc['fgts_numero'] = '';
  $rsRegistroPessoaDoc['fgts_opcao'] = '';
  $rsRegistroPessoaDoc['fgts_conta_vinculaa_banco'] = '';
  $rsRegistroPessoaDoc['fgts_dt_retificacao'] = '';
  $rsRegistroPessoaDoc['estrangeiro_casado_brasileiro'] = '';
  $rsRegistroPessoaDoc['estrangeiro_filho_brasileiro'] = '';
}
//Documento - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("
  SELECT 
  m.id, 
  CONCAT(m.nome, ' - ', e.sigla) AS nome
  FROM bsc_municipio AS m 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
  ORDER BY e.nome ASC, m.nome;");
$stmt->execute();
$rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Registro Geral (RG)";
$descricaoFormulario1     = "Dados do Registro Geral (RG) da pessoa";
$tituloFormulario2        = "PIS/PASEP";
$descricaoFormulario2     = "Dados do PIS/PASEP da pessoa";
$tituloFormulario3        = "Título Eleitoral";
$descricaoFormulario3     = "Dados do título eleitoral da pessoa";
$tituloFormulario4        = "Carteira de Trabalho e Previdência Social (CTPS)";
$descricaoFormulario4     = "Dados da Carteira de Trabalho e Previdência Social (CTPS) da pessoa";
$tituloFormulario5        = "Carteira Nacional de Habilitação (CNH)";
$descricaoFormulario5     = "Dados da Carteira Nacional de Habilitação (CNH) da pessoa";
$tituloFormulario6        = "Registro Militar (Apenas Homens)";
$descricaoFormulario6     = "Dados do registro militar da pessoa";
$tituloFormulario7        = "Registro Profissional";
$descricaoFormulario7     = "Dados do registro profissional da pessoa";
$tituloFormulario8        = "Registro Nacional de Estrangeiro (RNE)";
$descricaoFormulario8     = "Dados do egistro Nacional de Estrangeiro (RNE) da pessoa";
$tituloFormulario9        = "FGTS";
$descricaoFormulario9     = "Dados do FGTS da pessoa";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pd_id" id="pd_id" value="<?= $rsRegistroPessoaDoc['id'] ;?>">
  <input type="hidden" name="pd_bsc_pessoa_id" id="pd_bsc_pessoa_id" value="<?= $rsRegistroPessoaDoc['bsc_pessoa_id'] ;?>">
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
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rg_numero',
            /*string*/    'id'          => 'pd_rg_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número do RG',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rg_numero'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de emissão',
            /*string*/    'name'        => 'pd_rg_dt_emissao',
            /*string*/    'id'          => 'pd_rg_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de emissão do RG',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rg_dt_emissao'],
            /*bool*/      'required'    => true,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgão expedidor',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rg_orgao_expedidor',
            /*string*/    'id'          => 'pd_rg_orgao_expedidor',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o órgão expedidor do RG',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rg_orgao_expedidor'],
            /*bool*/      'required'    => true,
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
        <h5><?= $tituloFormulario2;?></h5>
        <small><?= $descricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_pis_numero',
            /*string*/    'id'          => 'pd_pis_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número do PIS/PASEP',
            /*string*/    'value'       => $rsRegistroPessoaDoc['pis_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de cadastro',
            /*string*/    'name'        => 'pd_pis_dt_cadastro',
            /*string*/    'id'          => 'pd_pis_dt_cadastro',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de cadastro do PIS/PASEP',
            /*string*/    'value'       => $rsRegistroPessoaDoc['pis_dt_cadastro'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Domicílio bancário',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_pis_domicilio_bancario',
            /*string*/    'id'          => 'pd_pis_domicilio_bancario',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o domicílio bancário do PIS/PASEP',
            /*string*/    'value'       => $rsRegistroPessoaDoc['pis_domicilio_bancario'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número do banco',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pis_banco_numero',
            /*string*/    'id'          => 'pis_banco_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número do banco do PIS/PASEP',
            /*string*/    'value'       => $rsRegistroPessoaDoc['pis_domicilio_bancario'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Agência bancária',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_pis_banco_agencia',
            /*string*/    'id'          => 'pd_pis_banco_agencia',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o agência bancária do PIS/PASEP',
            /*string*/    'value'       => $rsRegistroPessoaDoc['pis_banco_agencia'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Endereço da agência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_pis_banco_end',
            /*string*/    'id'          => 'pd_pis_banco_end',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o endereço da agência do PIS/PASEP',
            /*string*/    'value'       => $rsRegistroPessoaDoc['pis_banco_end'],
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
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_eleitor_numero',
            /*string*/    'id'          => 'pd_eleitor_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número do título eleitoral',
            /*string*/    'value'       => $rsRegistroPessoaDoc['eleitor_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Zona',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_eleitor_zona',
            /*string*/    'id'          => 'pd_eleitor_zona',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 5,
            /*string*/    'placeholder' => 'Digite a zona do título eleitoral',
            /*string*/    'value'       => $rsRegistroPessoaDoc['eleitor_zona'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Seção',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_eleitor_secao',
            /*string*/    'id'          => 'pd_eleitor_secao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 5,
            /*string*/    'placeholder' => 'Digite a seção do título eleitoral',
            /*string*/    'value'       => $rsRegistroPessoaDoc['eleitor_secao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cidade',
            /*string*/    'name'        => 'pd_eleitor_bsc_municipio_id',
            /*string*/    'id'          => 'pd_eleitor_bsc_municipio_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaDoc['eleitor_bsc_municipio_id'],
            /*array()*/   'options'     => $rsMunicipios,
            /*string*/    'ariaLabel'   => 'Selecione uma cidade',
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
        <h5><?= $tituloFormulario4;?></h5>
        <small><?= $descricaoFormulario4;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_ctps_numero',
            /*string*/    'id'          => 'pd_ctps_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número da CTPS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['ctps_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Série',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_ctps_serie',
            /*string*/    'id'          => 'pd_ctps_serie',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 10,
            /*string*/    'placeholder' => 'Digite a série da CTPS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['ctps_serie'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de emissão',
            /*string*/    'name'        => 'pd_ctps_dt_emissao',
            /*string*/    'id'          => 'pd_ctps_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de emissão da CTPS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['ctps_dt_emissao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgão expedidor',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_ctps_orgao_expedidor',
            /*string*/    'id'          => 'pd_ctps_orgao_expedidor',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o órgão expedidor da CTPS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['ctps_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Ano do primeiro emprego',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_ctps_primeiro_emprego_ano',
            /*string*/    'id'          => 'pd_ctps_primeiro_emprego_ano',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o ano do primeiro emprego da CTPS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['ctps_primeiro_emprego_ano'],
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
        <h5><?= $tituloFormulario5;?></h5>
        <small><?= $descricaoFormulario5;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_cnh_numero',
            /*string*/    'id'          => 'pd_cnh_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número da CNH',
            /*string*/    'value'       => $rsRegistroPessoaDoc['cnh_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Categoria',
            /*string*/    'name'        => 'pd_cnh_categoria',
            /*string*/    'id'          => 'pd_cnh_categoria',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaDoc['cnh_categoria'],
            /*array()*/   'options'     => array(
              ['id' => 'A', 'nome' => 'A'],
              ['id' => 'B', 'nome' => 'B'],
              ['id' => 'AB', 'nome' => 'AB'],
              ['id' => 'C', 'nome' => 'C'],
              ['id' => 'AC+', 'nome' => 'AC'],
              ['id' => 'D', 'nome' => 'D'],
              ['id' => 'AD', 'nome' => 'AD'],
              ['id' => 'E', 'nome' => 'E'],
              ['id' => 'AE', 'nome' => 'AE']
            ),
            /*string*/    'ariaLabel'   => 'Selecione a categoria da CNH',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de emissão',
            /*string*/    'name'        => 'pd_cnh_dt_emissao',
            /*string*/    'id'          => 'pd_cnh_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de emissão da CNH',
            /*string*/    'value'       => $rsRegistroPessoaDoc['cnh_dt_emissao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgão expedidor',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_cnh_orgao_expedidor',
            /*string*/    'id'          => 'pd_cnh_orgao_expedidor',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o órgão expedidor da CNH',
            /*string*/    'value'       => $rsRegistroPessoaDoc['cnh_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de validade',
            /*string*/    'name'        => 'pd_cnh_validade',
            /*string*/    'id'          => 'pd_cnh_validade',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de validade da CNH',
            /*string*/    'value'       => $rsRegistroPessoaDoc['cnh_validade'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de primeira habilitação',
            /*string*/    'name'        => 'pd_cnh_dt_primeira_habilitacao',
            /*string*/    'id'          => 'pd_cnh_dt_primeira_habilitacao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data da primeira habilitação da CNH',
            /*string*/    'value'       => $rsRegistroPessoaDoc['cnh_dt_primeira_habilitacao'],
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
        <h5><?= $tituloFormulario6;?></h5>
        <small><?= $descricaoFormulario6;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rm_numero',
            /*string*/    'id'          => 'pd_rm_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número do registro militar',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rm_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Categoria',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rm_categoria',
            /*string*/    'id'          => 'pd_rm_categoria',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite a categoria do registro militar',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rm_categoria'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Ano de emissão',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rm_emissao_ano',
            /*string*/    'id'          => 'pd_rm_emissao_ano',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 4,
            /*int*/       'maxlength'   => 4,
            /*string*/    'placeholder' => 'Digite o ano de emissão do registro militar',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rm_emissao_ano'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgão expedidor',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rm_orgao_expedidor',
            /*string*/    'id'          => 'pd_rm_orgao_expedidor',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o órgão expedidor do registro militar',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rm_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Espécie',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rm_especie',
            /*string*/    'id'          => 'pd_rm_especie',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite a espécie do regiatro militar',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rm_especie'],
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
        <h5><?= $tituloFormulario7;?></h5>
        <small><?= $descricaoFormulario7;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rp_numero',
            /*string*/    'id'          => 'pd_rp_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número do registro profissional',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rp_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de emissão',
            /*string*/    'name'        => 'pd_rp_dt_emissao',
            /*string*/    'id'          => 'pd_rp_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de emissão do registro profissional',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rp_dt_emissao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgão expedidor',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rp_orgao_expedidor',
            /*string*/    'id'          => 'pd_rp_orgao_expedidor',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o órgão expedidor do registro profissional',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rp_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de validade',
            /*string*/    'name'        => 'pd_rp_dt_validade',
            /*string*/    'id'          => 'pd_rp_dt_validade',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de validade do registro profissional',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rp_dt_validade'],
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
        <h5><?= $tituloFormulario8;?></h5>
        <small><?= $descricaoFormulario8;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rne_numero',
            /*string*/    'id'          => 'pd_rne_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número do RNE',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rne_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de emissão',
            /*string*/    'name'        => 'pd_rne_dt_emissao',
            /*string*/    'id'          => 'pd_rne_dt_emissao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de emissão do RNE',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rne_dt_emissao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Órgão expedidor',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rne_orgao_expedidor',
            /*string*/    'id'          => 'pd_rne_orgao_expedidor',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o órgão expedidor do RNE',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rne_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => '12 mb-3',
            /*string*/    'label'       => 'Casado(a) com brasileiro(a)',
            
            /*string*/    'name'        => 'pd_estrangeiro_casado_brasileiro',
            /*string*/    'id'          => 'pd_estrangeiro_casado_brasileiro',
            /*string*/    'class'       => 'toggle mb-3',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroPessoaDoc['estrangeiro_casado_brasileiro'],
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => '12 mb-3',
            /*string*/    'label'       => 'Tem filho(a) brasileiro(a)',
            /*string*/    'name'        => 'pd_estrangeiro_filho_brasileiro',
            /*string*/    'id'          => 'pd_estrangeiro_filho_brasileiro',
            /*string*/    'class'       => 'toggle mb-3',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroPessoaDoc['estrangeiro_filho_brasileiro'],
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
        <h5><?= $tituloFormulario9;?></h5>
        <small><?= $descricaoFormulario9;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_fgts_numero',
            /*string*/    'id'          => 'pd_fgts_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite o número do FGTS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['fgts_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Opção',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_fgts_opcao',
            /*string*/    'id'          => 'pd_fgts_opcao',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite a opção do FGTS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['fgts_opcao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Conta bancária vinculada',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_fgts_conta_vinculaa_banco',
            /*string*/    'id'          => 'pd_fgts_conta_vinculaa_banco',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 2,
            /*int*/       'maxlength'   => 18,
            /*string*/    'placeholder' => 'Digite conta bancária vinculada ao FGTS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['rne_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Data de retificação',
            /*string*/    'name'        => 'pd_fgts_dt_retificacao',
            /*string*/    'id'          => 'pd_fgts_dt_retificacao',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de retificação do FGTS',
            /*string*/    'value'       => $rsRegistroPessoaDoc['fgts_dt_retificacao'],
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