<?php
//Consulta para Edição - BEGIN
$idPessoa = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idPessoa = isset($bsc_pessoa_id) ? $bsc_pessoa_id : $idPessoa;
//Contato - BEGIN
$stmt = $db->prepare("
  SELECT 
  pc.id,
  pc.status,
  pc.dt_cadastro,
  pc.bsc_pessoa_id,
  pc.end_cep,
  pc.end_logradouro,
  pc.end_numero,
  pc.end_complemento,
  pc.end_bairro,
  pc.bsc_municipio_id,
  pc.tel_residencial,
  pc.tel_celular,
  pc.tel_recado,
  pc.tel_recado_nome,
  pc.bsc_parentesco_grau_id,
  pc.email_institucional,
  pc.email_pessoal,
  pc.email_alternativo,
  pc.site,
  pc.emergencia_nome,
  pc.emergencia_end,
  pc.emergencia_tel,
  pc.bsc_pais_id_residencia,
  pc.bsc_zona_id,
  pc.ue_localizacao_diferenciada_id,
  pc.end_latitude,
  pc.end_longitude
  FROM bsc_pessoa_contato AS pc 
  WHERE pc.bsc_pessoa_id = ?;");
$stmt->bindValue(1, $idPessoa);
$stmt->execute();
$rsRegistroPessoaCont = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroPessoaCont)) {
  $rsRegistroPessoaCont = array();
  $rsRegistroPessoaCont['id'] = 0;
  $rsRegistroPessoaCont['status'] = 1;
  $rsRegistroPessoaCont['bsc_pessoa_id'] = $idPessoa;
  $rsRegistroPessoaCont['end_cep'] = '';
  $rsRegistroPessoaCont['end_logradouro'] = '';
  $rsRegistroPessoaCont['end_numero'] = '';
  $rsRegistroPessoaCont['end_complemento'] = '';
  $rsRegistroPessoaCont['end_bairro'] = '';
  $rsRegistroPessoaCont['bsc_municipio_id'] = '';
  $rsRegistroPessoaCont['tel_residencial'] = '';
  $rsRegistroPessoaCont['tel_celular'] = '';
  $rsRegistroPessoaCont['tel_recado'] = '';
  $rsRegistroPessoaCont['tel_recado_nome'] = '';
  $rsRegistroPessoaCont['bsc_parentesco_grau_id'] = '';
  $rsRegistroPessoaCont['email_institucional'] = '';
  $rsRegistroPessoaCont['email_pessoal'] = '';
  $rsRegistroPessoaCont['email_alternativo'] = '';
  $rsRegistroPessoaCont['site'] = '';
  $rsRegistroPessoaCont['emergencia_nome'] = '';
  $rsRegistroPessoaCont['emergencia_end'] = '';
  $rsRegistroPessoaCont['emergencia_tel'] = '';
  $rsRegistroPessoaCont['bsc_pais_id_residencia'] = '';
  $rsRegistroPessoaCont['bsc_zona_id'] = '';
  $rsRegistroPessoaCont['ue_localizacao_diferenciada_id'] = '';
  $rsRegistroPessoaCont['end_latitude'] = '';
  $rsRegistroPessoaCont['end_longitude'] = '';
}
//Contato - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("
  SELECT 
  m.id, 
  CONCAT(m.nome, ' - ', e.sigla) AS nome
  FROM bsc_municipio AS m 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
  WHERE m.id IN (?)
  ORDER BY e.sigla ASC, m.nome;");
$stmt->bindValue(1, $rsRegistroPessoaCont['bsc_municipio_id']);
$stmt->execute();
$rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  p.id, 
  CONCAT(p.nome, ' - ', p.grau) AS nome 
  FROM bsc_parentesco_grau AS p ;");
$stmt->execute();
$rsGrausParentesco = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM bsc_pais 
  ORDER BY id;");
$stmt->execute();
$rsPaiss = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM bsc_zona 
  ORDER BY nome;");
$stmt->execute();
$rsZonas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
  id, 
  nome 
  FROM ue_localizacao_diferenciada 
  ORDER BY nome;");
$stmt->execute();
$rsLocalizacaoDiferenciadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Endereço";
$descricaoFormulario1     = "Dados de endereço da pessoa";
$tituloFormulario2        = "Contato Telefônico";
$descricaoFormulario2     = "Dados do contato telefônico da pessoa";
$tituloFormulario3        = "Contato Eletrônico";
$descricaoFormulario3     = "Dados do contato eletrônico da pessoa";
$tituloFormulario4        = "Contato de Emergência";
$descricaoFormulario4     = "Dados do contato de emergência da pessoa";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="pc_id" id="pc_id" value="<?= $rsRegistroPessoaCont['id'] ;?>">
  <input type="hidden" name="pc_bsc_pessoa_id" id="pc_bsc_pessoa_id" value="<?= $idPessoa ;?>">
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
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'CEP',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_cep',
            /*string*/    'id'          => 'pc_end_cep',
            /*string*/    'class'       => 'form-control mask-cep',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 10,
            /*string*/    'placeholder' => 'Digite o cep do endereço',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_cep'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Latitude Geográfica',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_latitude',
            /*string*/    'id'          => 'pc_end_latitude',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 6,
            /*int*/       'maxlength'   => 12,
            /*string*/    'placeholder' => 'Digite a latitude geográfica',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_latitude'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Longitude Geográfica',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_longitude',
            /*string*/    'id'          => 'pc_end_longitude',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 6,
            /*int*/       'maxlength'   => 12,
            /*string*/    'placeholder' => 'Digite a longitude geográfica',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_longitude'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 10,
            /*string*/    'label'       => 'Logradouro',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_logradouro',
            /*string*/    'id'          => 'pc_end_logradouro',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o logradouro do endereço',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_logradouro'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 2,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_numero',
            /*string*/    'id'          => 'pc_end_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 10,
            /*string*/    'placeholder' => 'Digite o número do endereço',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Complemento',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_complemento',
            /*string*/    'id'          => 'pc_end_complemento',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 0,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o complemento do endereço',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_complemento'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Bairro',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_bairro',
            /*string*/    'id'          => 'pc_end_bairro',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 0,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o bairro do endereço',
            /*string*/    'value'       => $rsRegistroPessoaCont['end_bairro'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Cidade',
            /*string*/    'name'        => 'pc_bsc_municipio_id',
            /*string*/    'id'          => 'pc_bsc_municipio_id',
            /*string*/    'class'       => 'select2-municipio form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaCont['bsc_municipio_id'],
            /*array()*/   'options'     => $rsMunicipios,
            /*string*/    'ariaLabel'   => 'Digite o nome da cidade',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'País de Residência',
            /*string*/    'name'        => 'pc_bsc_pais_id_residencia',
            /*string*/    'id'          => 'pc_bsc_pais_id_residencia',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaCont['bsc_pais_id_residencia'],
            /*array()*/   'options'     => $rsPaiss,
            /*string*/    'ariaLabel'   => 'Selecione um país de residência',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Zona',
            /*string*/    'name'        => 'pc_bsc_zona_id',
            /*string*/    'id'          => 'pc_bsc_zona_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaCont['bsc_zona_id'],
            /*array()*/   'options'     => $rsZonas,
            /*string*/    'ariaLabel'   => 'Selecione um grau de parentesco',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Localização diferenciada',
            /*string*/    'name'        => 'pc_ue_localizacao_diferenciada_id',
            /*string*/    'id'          => 'pc_ue_localizacao_diferenciada_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaCont['ue_localizacao_diferenciada_id'],
            /*array()*/   'options'     => $rsLocalizacaoDiferenciadas,
            /*string*/    'ariaLabel'   => 'Selecione uma localização diferenciada',
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
        <h5><?= $tituloFormulario2;?></h5>
        <small><?= $descricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Telefone Residencial',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_residencial',
            /*string*/    'id'          => 'pc_tel_residencial',
            /*string*/    'class'       => 'form-control mask-tel-resid',
            /*int*/       'minlength'   => 13,
            /*int*/       'maxlength'   => 13,
            /*string*/    'placeholder' => 'Digite o número telefônico residencial',
            /*string*/    'value'       => $rsRegistroPessoaCont['tel_residencial'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Telefone Celular',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_celular',
            /*string*/    'id'          => 'pc_tel_celular',
            /*string*/    'class'       => 'form-control mask-tel-cel',
            /*int*/       'minlength'   => 15,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número telefônico celular',
            /*string*/    'value'       => $rsRegistroPessoaCont['tel_celular'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Telefone para Recado',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_recado',
            /*string*/    'id'          => 'pc_tel_recado',
            /*string*/    'class'       => 'form-control mask-tel-geral',
            /*int*/       'minlength'   => 13,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número telefônico para recado',
            /*string*/    'value'       => $rsRegistroPessoaCont['tel_recado'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Nome do Contato para Recado',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_recado_nome',
            /*string*/    'id'          => 'pc_tel_recado_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o nome do contato para recado',
            /*string*/    'value'       => $rsRegistroPessoaCont['tel_recado_nome'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Grau de Parentesco do Contato para Recado',
            /*string*/    'name'        => 'pc_bsc_parentesco_grau_id',
            /*string*/    'id'          => 'pc_bsc_parentesco_grau_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroPessoaCont['bsc_parentesco_grau_id'],
            /*array()*/   'options'     => $rsGrausParentesco,
            /*string*/    'ariaLabel'   => 'Selecione um grau de parentesco',
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
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'E-mail Institucional',
            /*string*/    'type'        => 'email',
            /*string*/    'name'        => 'pc_email_institucional',
            /*string*/    'id'          => 'pc_email_institucional',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o e-mail institucional para contato',
            /*string*/    'value'       => $rsRegistroPessoaCont['email_institucional'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'E-mail Pessoal',
            /*string*/    'type'        => 'email',
            /*string*/    'name'        => 'pc_email_pessoal',
            /*string*/    'id'          => 'pc_email_pessoal',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o e-mail pessoal para contato',
            /*string*/    'value'       => $rsRegistroPessoaCont['email_pessoal'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'E-mail Alternativo',
            /*string*/    'type'        => 'email',
            /*string*/    'name'        => 'pc_email_alternativo',
            /*string*/    'id'          => 'pc_email_alternativo',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o e-mail alternativo para contato',
            /*string*/    'value'       => $rsRegistroPessoaCont['email_alternativo'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Site',
            /*string*/    'type'        => 'url',
            /*string*/    'name'        => 'pc_site',
            /*string*/    'id'          => 'pc_site',
            /*string*/    'class'       => 'form-control site',
            /*int*/       'minlength'   => 5,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o site para contato',
            /*string*/    'value'       => $rsRegistroPessoaCont['site'],
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
        <h5><?= $tituloFormulario4;?></h5>
        <small><?= $descricaoFormulario4;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 8,
            /*string*/    'label'       => 'Nome do Contato de Emergência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_emergencia_nome',
            /*string*/    'id'          => 'pc_emergencia_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do contato de emergência',
            /*string*/    'value'       => $rsRegistroPessoaCont['emergencia_nome'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Telefone/Celular do contato de emergência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_emergencia_tel',
            /*string*/    'id'          => 'pc_emergencia_tel',
            /*string*/    'class'       => 'form-control mask-tel-geral',
            /*int*/       'minlength'   => 13,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o telefone do contato de emergência',
            /*string*/    'value'       => $rsRegistroPessoaCont['emergencia_tel'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Endereço do Contato de Emergência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_emergencia_end',
            /*string*/    'id'          => 'pc_emergencia_end',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o endereço do contato de emergência',
            /*string*/    'value'       => $rsRegistroPessoaCont['emergencia_end'],
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