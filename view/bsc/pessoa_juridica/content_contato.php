<?php
//Consulta para Edição - BEGIN
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
  m.nome AS end_municipio_nome, 
  e.sigla AS end_estado_sigla, 
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
  pc.emergencia_tel
  FROM bsc_pessoa_contato AS pc 
  LEFT JOIN bsc_municipio AS m ON m.id = pc.bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_parentesco_grau AS pg ON pg.id = pc.bsc_parentesco_grau_id 
  WHERE pc.bsc_pessoa_id = ?;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro3 = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistro3)) {
  $rsRegistro3 = array();
  $rsRegistro3['id'] = 0;
  $rsRegistro3['status'] = 1;
  $rsRegistro3['bsc_pessoa_id'] = $id;
  $rsRegistro3['end_cep'] = '';
  $rsRegistro3['end_logradouro'] = '';
  $rsRegistro3['end_numero'] = '';
  $rsRegistro3['end_complemento'] = '';
  $rsRegistro3['end_bairro'] = '';
  $rsRegistro3['bsc_municipio_id'] = '';
  $rsRegistro3['end_municipio_nome'] = '';
  $rsRegistro3['end_estado_sigla'] = '';
  $rsRegistro3['tel_residencial'] = '';
  $rsRegistro3['tel_celular'] = '';
  $rsRegistro3['tel_recado'] = '';
  $rsRegistro3['tel_recado_nome'] = '';
  $rsRegistro3['bsc_parentesco_grau_id'] = '';
  $rsRegistro3['email_institucional'] = '';
  $rsRegistro3['email_pessoal'] = '';
  $rsRegistro3['email_alternativo'] = '';
  $rsRegistro3['site'] = '';
  $rsRegistro3['emergencia_nome'] = '';
  $rsRegistro3['emergencia_end'] = '';
  $rsRegistro3['emergencia_tel'] = '';
}
//Contato - END
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Endereço";
$descricaoFormulario1     = "Dados de endereçõ da pessoa";
$tituloFormulario2        = "Contato Telefônico";
$descricaoFormulario2     = "Dados do contato telefônico da pessoa";
$tituloFormulario3        = "Contato Eletrônico";
$descricaoFormulario3     = "Dados do contato eletrônico da pessoa";
$tituloFormulario4        = "Contato de Emergência";
$descricaoFormulario4     = "Dados do contato de emergência da pessoa";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<input type="hidden" name="pc_id" id="pc_id" value="<?= $rsRegistro3['id'] ;?>">
<input type="hidden" name="pc_bsc_pessoa_id" id="pc_bsc_pessoa_id" value="<?= $rsRegistro3['bsc_pessoa_id'] ;?>">
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
            /*string*/    'label'       => 'CEP',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_cep',
            /*string*/    'id'          => 'pc_end_cep',
            /*string*/    'class'       => 'form-control mask-cep',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 10,
            /*string*/    'placeholder' => 'Digite o cep do endereço',
            /*string*/    'value'       => $rsRegistro3['end_cep'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Logradouro',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_logradouro',
            /*string*/    'id'          => 'pc_end_logradouro',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o logradouro do endereço',
            /*string*/    'value'       => $rsRegistro3['end_logradouro'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Número',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_numero',
            /*string*/    'id'          => 'pc_end_numero',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 1,
            /*int*/       'maxlength'   => 10,
            /*string*/    'placeholder' => 'Digite o número do endereço',
            /*string*/    'value'       => $rsRegistro3['end_numero'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Complemento',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_complemento',
            /*string*/    'id'          => 'pc_end_complemento',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 0,
            /*int*/       'maxlength'   => 150,
            /*string*/    'placeholder' => 'Digite o complemento do endereço',
            /*string*/    'value'       => $rsRegistro3['end_complemento'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Bairro',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_end_bairro',
            /*string*/    'id'          => 'pc_end_bairro',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 0,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o bairro do endereço',
            /*string*/    'value'       => $rsRegistro3['end_bairro'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cidade',
            /*string*/    'name'        => 'pc_bsc_municipio_id',
            /*string*/    'id'          => 'pc_bsc_municipio_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistro3['bsc_municipio_id'],
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
        <h5><?= $tituloFormulario2;?></h5>
        <small><?= $descricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Telfone Residencial',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_residencial',
            /*string*/    'id'          => 'pc_tel_residencial',
            /*string*/    'class'       => 'form-control mask-tel-resid',
            /*int*/       'minlength'   => 13,
            /*int*/       'maxlength'   => 13,
            /*string*/    'placeholder' => 'Digite o número telefônico residencial',
            /*string*/    'value'       => $rsRegistro3['tel_residencial'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Telfone Celular',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_celular',
            /*string*/    'id'          => 'pc_tel_celular',
            /*string*/    'class'       => 'form-control mask-tel-cel',
            /*int*/       'minlength'   => 15,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número telefônico celular',
            /*string*/    'value'       => $rsRegistro3['tel_celular'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Telfone para Recado',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_recado',
            /*string*/    'id'          => 'pc_tel_recado',
            /*string*/    'class'       => 'form-control mask-tel-geral',
            /*int*/       'minlength'   => 13,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o número telefônico para recado',
            /*string*/    'value'       => $rsRegistro3['tel_recado'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Nome do Contato para Recado',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_tel_recado_nome',
            /*string*/    'id'          => 'pc_tel_recado_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 50,
            /*string*/    'placeholder' => 'Digite o nome do contato para recado',
            /*string*/    'value'       => $rsRegistro3['tel_recado_nome'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 4,
            /*string*/    'label'       => 'Grau de Parentesco do Contato para Recado',
            /*string*/    'name'        => 'pc_bsc_parentesco_grau_id',
            /*string*/    'id'          => 'pc_bsc_parentesco_grau_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistro3['bsc_parentesco_grau_id'],
            /*array()*/   'options'     => $rsGrausParentesco,
            /*string*/    'ariaLabel'   => 'Selecione um grau de parentesco',
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
        <h5><?= $tituloFormulario3;?></h5>
        <small><?= $descricaoFormulario3;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'E-mail Institucional',
            /*string*/    'type'        => 'email',
            /*string*/    'name'        => 'pc_email_institucional',
            /*string*/    'id'          => 'pc_email_institucional',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o e-mail institucional para contato',
            /*string*/    'value'       => $rsRegistro3['email_institucional'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'E-mail Pessoal',
            /*string*/    'type'        => 'email',
            /*string*/    'name'        => 'pc_email_pessoal',
            /*string*/    'id'          => 'pc_email_pessoal',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o e-mail pessoal para contato',
            /*string*/    'value'       => $rsRegistro3['email_pessoal'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'E-mail Alternativo',
            /*string*/    'type'        => 'email',
            /*string*/    'name'        => 'pc_email_alternativo',
            /*string*/    'id'          => 'pc_email_alternativo',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 10,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o e-mail alternativo para contato',
            /*string*/    'value'       => $rsRegistro3['email_alternativo'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Site',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_site',
            /*string*/    'id'          => 'pc_site',
            /*string*/    'class'       => 'form-control site',
            /*int*/       'minlength'   => 5,
            /*int*/       'maxlength'   => 254,
            /*string*/    'placeholder' => 'Digite o site para contato',
            /*string*/    'value'       => $rsRegistro3['site'],
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
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Nome do Contato de Emergência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_emergencia_nome',
            /*string*/    'id'          => 'pc_emergencia_nome',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o nome do contato de emergência',
            /*string*/    'value'       => $rsRegistro3['emergencia_nome'],
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
            /*string*/    'value'       => $rsRegistro3['emergencia_end'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Telefone/Celular do contato de emergência',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 'pc_emergencia_tel',
            /*string*/    'id'          => 'pc_emergencia_tel',
            /*string*/    'class'       => 'form-control mask-tel-geral',
            /*int*/       'minlength'   => 13,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o telefone do contato de emergência',
            /*string*/    'value'       => $rsRegistro3['emergencia_tel'],
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