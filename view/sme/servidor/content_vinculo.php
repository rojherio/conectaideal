<?php
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $bsc_pessoa_id : $idUE;
//Consulta para Edição - BEGIN
//Consulta para Edição - END
//Consulta para Select - BEGIN
//Parceria/Convenio Forma - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome,
  descricao 
  FROM ue_parc_conv_forma
  WHERE 1 = 1;");
$stmt->execute();
$rsParcConvFormas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Parceria/Convenio Forma - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$uevTituloFormulario1       = "Poder Público Responsável pela Parceria ou Convênio";
$uevDescricaoFormulario1    = "Selecione a(s) sercretaría(s) pareceira(s) ou conveniada(s)";
$uevTituloFormulario2       = "Órgãos/Instituições em Parceria/Convênio";
$uevDescricaoFormulario2    = "Dados das parcerias/convênios com órgãos/instituições";
$uevTituloFormulario3        = "";
$uevDescricaoFormulario3     = "";
$uevTituloFormulario4        = "";
$uevDescricaoFormulario4     = "";
$uevTituloFormulario5        = "Situação";
$uevDescricaoFormulario5     = "Defina se esse cadastro da unidade educativa está ativo ou inativo";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $ueiTituloFormulario2;?></h5>
        <small><?= $ueiDescricaoFormulario2;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Matrícula',
            /*string*/    'type'        => 'number',
            /*string*/    'name'        => 's_matricula',
            /*string*/    'id'          => 's_matricula',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 11,
            /*string*/    'placeholder' => 'Digite a matrícula',
            /*string*/    'value'       => $rsRegistroSIdent['matricula'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Tipo de Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_tipo_id',
            /*string*/    'id'          => 's_sme_serv_tipo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_tipo_id'],
            /*array()*/   'options'     => $rsServidorTipos,
            /*string*/    'ariaLabel'   => 'Selecione um tipo de servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cargo',
            /*string*/    'name'        => 's_eo_cargo_id',
            /*string*/    'id'          => 's_eo_cargo_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['eo_cargo_id'],
            /*array()*/   'options'     => $rsServidorCargos,
            /*string*/    'ariaLabel'   => 'Selecione um cargo',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Situação do Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_situacao_id',
            /*string*/    'id'          => 's_sme_serv_situacao_id',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_situacao_id'],
            /*array()*/   'options'     => $rsServidorSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione uma situação do servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Decreto',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_decreto',
            /*string*/    'id'          => 's_situacao_trabalho_decreto',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o decreto da situação de trabalho',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_decreto'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'DOE(Diario Oficial do Estado)',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_doe',
            /*string*/    'id'          => 's_situacao_trabalho_doe',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o DOE(diario oficial do estado)',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_doe'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data de Inicio',
            /*string*/    'name'        => 's_situacao_trabalho_dt_inicio',
            /*string*/    'id'          => 's_situacao_trabalho_dt_inicio',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de inicio',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_inicio'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data de Finalização',
            /*string*/    'name'        => 's_situacao_trabalho_dt_fim',
            /*string*/    'id'          => 's_situacao_trabalho_dt_fim',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de finalização',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_fim'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Observação',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_obs',
            /*string*/    'id'          => 's_situacao_trabalho_obs',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o DOE(diario oficial do estado)',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_obs'],
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
        <h5><?= $ueiTituloFormulario3;?></h5>
        <small><?= $ueiDescricaoFormulario3;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <!-- div row input - BEGIN -->
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Matrícula',
            /*string*/    'type'        => 'number',
            /*string*/    'name'        => 's_matricula_2',
            /*string*/    'id'          => 's_matricula_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 11,
            /*string*/    'placeholder' => 'Digite a matrícula',
            /*string*/    'value'       => $rsRegistroSIdent['matricula_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Tipo de Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_tipo_id_2',
            /*string*/    'id'          => 's_sme_serv_tipo_id_2',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_tipo_id_2'],
            /*array()*/   'options'     => $rsServidorTipos,
            /*string*/    'ariaLabel'   => 'Selecione um tipo de servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Cargo',
            /*string*/    'name'        => 's_eo_cargo_id_2',
            /*string*/    'id'          => 's_eo_cargo_id_2',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['eo_cargo_id_2'],
            /*array()*/   'options'     => $rsServidorCargos,
            /*string*/    'ariaLabel'   => 'Selecione um cargo',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Situação do Servidor(a)',
            /*string*/    'name'        => 's_sme_serv_situacao_id_2',
            /*string*/    'id'          => 's_sme_serv_situacao_id_2',
            /*string*/    'class'       => 'select2 form-control form-select select-basic',
            /*string*/    'value'       => $rsRegistroSIdent['sme_serv_situacao_id_2'],
            /*array()*/   'options'     => $rsServidorSituacoes,
            /*string*/    'ariaLabel'   => 'Selecione uma situação do servidor(a)',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Decreto',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_decreto_2',
            /*string*/    'id'          => 's_situacao_trabalho_decreto_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o decreto da situação de trabalho',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_decreto_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'DOE(Diario Oficial do Estado)',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_doe_2',
            /*string*/    'id'          => 's_situacao_trabalho_doe_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 15,
            /*string*/    'placeholder' => 'Digite o DOE(diario oficial do estado)',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_doe_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data de Inicio',
            /*string*/    'name'        => 's_situacao_trabalho_dt_inicio_2',
            /*string*/    'id'          => 's_situacao_trabalho_dt_inicio_2',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de inicio',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_inicio_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createInputDate(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Data de Finalização',
            /*string*/    'name'        => 's_situacao_trabalho_dt_fim_2',
            /*string*/    'id'          => 's_situacao_trabalho_dt_fim_2',
            /*string*/    'class'       => 'form-control mask-data',
            /*int*/       'min'         => '1900-01-01',
            /*int*/       'maxToday'    => true,
            /*string*/    'placeholder' => 'Digite a data de finalização',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_dt_fim_2'],
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createInput(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Observação',
            /*string*/    'type'        => 'text',
            /*string*/    'name'        => 's_situacao_trabalho_obs_2',
            /*string*/    'id'          => 's_situacao_trabalho_obs_2',
            /*string*/    'class'       => 'form-control',
            /*int*/       'minlength'   => 3,
            /*int*/       'maxlength'   => 100,
            /*string*/    'placeholder' => 'Digite o DOE(diario oficial do estado)',
            /*string*/    'value'       => $rsRegistroSIdent['situacao_trabalho_obs_2'],
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