<?php
//Consulta para Edição - BEGIN
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
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro2 = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistro2)) {
  $rsRegistro2 = array();
  $rsRegistro2['id'] = 0;
  $rsRegistro2['status'] = 1;
  $rsRegistro2['bsc_pessoa_id'] = $id;
  $rsRegistro2['rg_numero'] = '';
  $rsRegistro2['rg_dt_emissao'] = '';
  $rsRegistro2['rg_orgao_expedidor'] = '';
  $rsRegistro2['pis_numero'] = '';
  $rsRegistro2['pis_dt_cadastro'] = '';
  $rsRegistro2['pis_domicilio_bancario'] = '';
  $rsRegistro2['pis_banco_numero'] = '';
  $rsRegistro2['pis_banco_agencia'] = '';
  $rsRegistro2['pis_banco_end'] = '';
  $rsRegistro2['eleitor_numero'] = '';
  $rsRegistro2['eleitor_zona'] = '';
  $rsRegistro2['eleitor_secao'] = '';
  $rsRegistro2['eleitor_bsc_municipio_id'] = '';
  $rsRegistro2['eleitor_municipio_nome'] = '';
  $rsRegistro2['eleitor_estado_sigla'] = '';
  $rsRegistro2['eleitor_insc_orgao_classe'] = '';
  $rsRegistro2['ctps_numero'] = '';
  $rsRegistro2['ctps_serie'] = '';
  $rsRegistro2['ctps_dt_emissao'] = '';
  $rsRegistro2['ctps_orgao_expedidor'] = '';
  $rsRegistro2['ctps_primeiro_emprego_ano'] = '';
  $rsRegistro2['cnh_numero'] = '';
  $rsRegistro2['cnh_categoria'] = '';
  $rsRegistro2['cnh_dt_emissao'] = '';
  $rsRegistro2['cnh_orgao_expedidor'] = '';
  $rsRegistro2['cnh_validade'] = '';
  $rsRegistro2['cnh_dt_primeira_habilitacao'] = '';
  $rsRegistro2['rm_numero'] = '';
  $rsRegistro2['rm_categoria'] = '';
  $rsRegistro2['rm_emissao_ano'] = '';
  $rsRegistro2['rm_orgao_expedidor'] = '';
  $rsRegistro2['rm_especie'] = '';
  $rsRegistro2['rp_numero'] = '';
  $rsRegistro2['rp_dt_emissao'] = '';
  $rsRegistro2['rp_orgao_expedidor'] = '';
  $rsRegistro2['rp_dt_validade'] = '';
  $rsRegistro2['rne_numero'] = '';
  $rsRegistro2['rne_dt_emissao'] = '';
  $rsRegistro2['rne_orgao_expedidor'] = '';
  $rsRegistro2['fgts_numero'] = '';
  $rsRegistro2['fgts_opcao'] = '';
  $rsRegistro2['fgts_conta_vinculaa_banco'] = '';
  $rsRegistro2['fgts_dt_retificacao'] = '';
  $rsRegistro2['estrangeiro_casado_brasileiro'] = '';
  $rsRegistro2['estrangeiro_filho_brasileiro'] = '';
}
//Documento - END
//Consulta para Edição - END
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
<input type="hidden" name="pd_id" id="pd_id" value="<?= $rsRegistro2['id'] ;?>">
<input type="hidden" name="pd_bsc_pessoa_id" id="pd_bsc_pessoa_id" value="<?= $rsRegistro2['bsc_pessoa_id'] ;?>">
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
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pd_rg_numero',
            /*string*/    'id'          => 'pd_rg_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número do RG',
            /*string*/    'value'       => $rsRegistro2['rg_numero'],
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
            /*string*/    'value'       => $rsRegistro2['rg_dt_emissao'],
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
            /*string*/    'value'       => $rsRegistro2['rg_orgao_expedidor'],
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
            /*string*/    'value'       => $rsRegistro2['pis_numero'],
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
            /*string*/    'value'       => $rsRegistro2['pis_dt_cadastro'],
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
            /*string*/    'value'       => $rsRegistro2['pis_domicilio_bancario'],
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
            /*string*/    'value'       => $rsRegistro2['pis_domicilio_bancario'],
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
            /*string*/    'value'       => $rsRegistro2['pis_banco_agencia'],
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
            /*string*/    'value'       => $rsRegistro2['pis_banco_end'],
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
            /*string*/    'value'       => $rsRegistro2['eleitor_numero'],
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
            /*string*/    'value'       => $rsRegistro2['eleitor_zona'],
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
            /*string*/    'value'       => $rsRegistro2['eleitor_secao'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cidade',
            /*string*/    'name'        => 'pd_eleitor_bsc_municipio_id',
            /*string*/    'id'          => 'pd_eleitor_bsc_municipio_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistro2['eleitor_bsc_municipio_id'],
            /*array()*/   'options'     => $rsMunicipios,
            /*string*/    'ariaLabel'   => 'Selecione uma cidade',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
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
            /*string*/    'value'       => $rsRegistro2['ctps_numero'],
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
            /*string*/    'value'       => $rsRegistro2['ctps_serie'],
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
            /*string*/    'value'       => $rsRegistro2['ctps_dt_emissao'],
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
            /*string*/    'value'       => $rsRegistro2['ctps_orgao_expedidor'],
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
            /*string*/    'value'       => $rsRegistro2['ctps_primeiro_emprego_ano'],
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
            /*string*/    'value'       => $rsRegistro2['cnh_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Categoria',
            /*string*/    'name'        => 'pd_cnh_categoria',
            /*string*/    'id'          => 'pd_cnh_categoria',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistro2['cnh_categoria'],
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
            /*string*/    'prop'        => '',
            /*string*/    'display'     => true
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
            /*string*/    'value'       => $rsRegistro2['cnh_dt_emissao'],
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
            /*string*/    'value'       => $rsRegistro2['cnh_orgao_expedidor'],
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
            /*string*/    'value'       => $rsRegistro2['cnh_validade'],
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
            /*string*/    'value'       => $rsRegistro2['cnh_dt_primeira_habilitacao'],
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
            /*string*/    'value'       => $rsRegistro2['rm_numero'],
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
            /*string*/    'value'       => $rsRegistro2['rm_categoria'],
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
            /*string*/    'value'       => $rsRegistro2['rm_emissao_ano'],
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
            /*string*/    'value'       => $rsRegistro2['rm_orgao_expedidor'],
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
            /*string*/    'value'       => $rsRegistro2['rm_especie'],
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
            /*string*/    'value'       => $rsRegistro2['rp_numero'],
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
            /*string*/    'value'       => $rsRegistro2['rp_dt_emissao'],
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
            /*string*/    'value'       => $rsRegistro2['rp_orgao_expedidor'],
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
            /*string*/    'value'       => $rsRegistro2['rp_dt_validade'],
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
            /*string*/    'value'       => $rsRegistro2['rne_numero'],
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
            /*string*/    'value'       => $rsRegistro2['rne_dt_emissao'],
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
            /*string*/    'value'       => $rsRegistro2['rne_orgao_expedidor'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => '12 mb-3',
            /*string*/    'label'       => 'Casado(a) com brasileiro(a)',
            /*string*/    'type'        => 'checkbox',
            /*string*/    'name'        => 'pd_estrangeiro_casado_brasileiro',
            /*string*/    'id'          => 'pd_estrangeiro_casado_brasileiro',
            /*string*/    'class'       => 'toggle mb-3',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistro2['estrangeiro_casado_brasileiro'],
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => '12 mb-3',
            /*string*/    'label'       => 'Tem filho(a) brasileiro(a)',
            /*string*/    'type'        => 'checkbox',
            /*string*/    'name'        => 'pd_estrangeiro_filho_brasileiro',
            /*string*/    'id'          => 'pd_estrangeiro_filho_brasileiro',
            /*string*/    'class'       => 'toggle mb-3',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistro2['estrangeiro_filho_brasileiro'],
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
            /*string*/    'value'       => $rsRegistro2['fgts_numero'],
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
            /*string*/    'value'       => $rsRegistro2['fgts_opcao'],
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
            /*string*/    'value'       => $rsRegistro2['rne_orgao_expedidor'],
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
            /*string*/    'value'       => $rsRegistro2['fgts_dt_retificacao'],
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