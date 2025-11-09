<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  si.id,
  si.status,
  si.dt_cadastro,
  si.sme_servidor_id,
  si.bsc_escolaridade_id,
  si.formacao,
  si.conclusao_ano,
  si.cursando,
  si.c_h, 
  si.inst_sup_cod_inep,
  si.bsc_ens_med_tipo_id,
  si.bsc_ens_sup_tipo_id,
  si.bsc_inst_tipo_id,
  si.ue_compon_curricular_id,
  si.sme_ens_sup_curso_id
  FROM sme_serv_instrucao AS si 
  LEFT JOIN bsc_escolaridade AS e ON e.id = si.bsc_escolaridade_id 
  WHERE si.sme_servidor_id = ? 
  ORDER BY e.nivel_controle;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSInstrucao = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSInstrucao) {
  $rsRegistrosSInstrucao = array();
  $rsRegistrosSInstrucao[0]['id'] = 0;
  $rsRegistrosSInstrucao[0]['status'] = 1;
  $rsRegistrosSInstrucao[0]['dt_cadastro'] = '';
  $rsRegistrosSInstrucao[0]['sme_servidor_id'] = $idS;
  $rsRegistrosSInstrucao[0]['bsc_escolaridade_id'] = '';
  $rsRegistrosSInstrucao[0]['formacao'] = '';
  $rsRegistrosSInstrucao[0]['conclusao_ano'] = '';
  $rsRegistrosSInstrucao[0]['cursando'] = '';
  $rsRegistrosSInstrucao[0]['c_h'] = '';
  $rsRegistrosSInstrucao[0]['inst_sup_cod_inep'] = '';
  $rsRegistrosSInstrucao[0]['bsc_ens_med_tipo_id'] = '';
  $rsRegistrosSInstrucao[0]['bsc_ens_sup_tipo_id'] = '';
  $rsRegistrosSInstrucao[0]['bsc_inst_tipo_id'] = '';
  $rsRegistrosSInstrucao[0]['ue_compon_curricular_id'] = '';
  $rsRegistrosSInstrucao[0]['sme_ens_sup_curso_id'] = '';
}
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Escolaridade - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_escolaridade  
  WHERE 1 = 1;");
$stmt->execute();
$rsEscolaridades = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Escolaridade - END
//Tipo Ensino Médio - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_ens_med_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsEnsMedTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Tipo Ensino Médio - END
//Tipo de Ensino Superior - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_ens_sup_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsEnsSupTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Tipo de Ensino Superior - END
//Tipo de Instituição - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_inst_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsInstTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Tipo de Instituição - END
//Componente Curricular - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_compon_curricular  
  WHERE 1 = 1;");
$stmt->execute();
$rsComponCurriculars = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Componente Curricular - END
//Curso de Ensino Superior - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM sme_ens_sup_curso  
  WHERE 1 = 1;");
$stmt->execute();
$rsEnsSupCursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Curso de Ensino Superior - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Escolaridade/Grau de Instrução do Servidor(a)";
$siDescricaoFormulario1    = "Informações de estudo e formação do servidor(a)";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="si_sme_servidor_id" id="si_sme_servidor_id" value="<?= $idS ;?>">
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
        foreach ($rsRegistrosSInstrucao as $keySI => $objSI) {
          ?>
          <div divcount="<?=$keySI+1;?>" class="div_clonar row border border-outline-info rounded pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Escolaridade / Grau de Instrução - <span class="span_contador"><?=$keySI+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="si_sme_serv_instrucao_id[]" id="si_sme_serv_instrucao_id_<?=$keySI+1;?>" idbase="si_sme_serv_instrucao_id_" value="<?=$objSI['id'];?>"/>
            <div class="row pe-0">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Escolaridade',
                /*string*/    'name'        => 'si_bsc_escolaridade_id[]',
                /*string*/    'id'          => 'si_bsc_escolaridade_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['bsc_escolaridade_id'],
                /*array()*/   'options'     => $rsEscolaridades,
                /*string*/    'ariaLabel'   => 'Selecione uma escolaridade',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_bsc_escolaridade_id_" controllerbase="escolaridade_" controller="escolaridade_'.$keySI.'" controller-values="5|6|7|8|9|10|11|12|13|14|15|16"'
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Ano de Conclusão',
                /*string*/    'type'        => 'number',
                /*string*/    'name'        => 'si_conclusao_ano[]',
                /*string*/    'id'          => 'si_conclusao_ano_'.$keySI,
                /*string*/    'class'       => 'form-control mask-ano max-today',
                /*int*/       'minlength'   => 4,
                /*int*/       'maxlength'   => 4,
                /*string*/    'placeholder' => 'Digite o ano de conclusao',
                /*string*/    'value'       => $objSI['conclusao_ano'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_conclusao_ano_"'
              )) ;?>
              <?= createCheckbox(array(
                /*int 1-12*/  'col'         => '4 pe-1 pt-3',
                /*string*/    'label'       => 'Cursando?',
                /*string*/    'name'        => 'si_cursando_'.$keySI,
                /*string*/    'id'          => 'si_cursando_'.$keySI,
                /*string*/    'class'       => 'toggle',
                /*string*/    'value'       => 1,
                /*string*/    'checked'     => $objSI['cursando'],
                /*string*/    'prop'        => 'idbase="si_cursando_"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Carga-Horária',
                /*string*/    'type'        => 'number',
                /*string*/    'name'        => 'si_c_h[]',
                /*string*/    'id'          => 'si_c_h_'.$keySI,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 5,
                /*string*/    'placeholder' => 'Digite a carga-horária',
                /*string*/    'value'       => $objSI['c_h'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_c_h_"'
              )) ;?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Tipo de Instituição de Educação',
                /*string*/    'name'        => 'si_bsc_inst_tipo_id[]',
                /*string*/    'id'          => 'si_bsc_inst_tipo_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['bsc_inst_tipo_id'],
                /*array()*/   'options'     => $rsInstTipos,
                /*string*/    'ariaLabel'   => 'Selecione o tipo de instituição de educação',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_bsc_inst_tipo_id_"'
              )); ?>
              <?php
              //Parámetros de exibir/ocultar div - BEGIN
              $displayEnsMedio      = !in_array($objSI['bsc_escolaridade_id'], array(5, 6, 7, 8)) ? 'style="display: none;"' : '';
              $displayEnsSup        = !in_array($objSI['bsc_escolaridade_id'], array(9,10)) ? 'style="display: none;"' : '';
              $displayEnsSupMaior   = !in_array($objSI['bsc_escolaridade_id'], array(9,10,11,12,13,14,15,16)) ? 'style="display: none;"' : '';
              //Parámetros de exibir/ocultar div - NED
              ?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1 " '.$displayEnsMedio.' controlled="escolaridade_'.$keySI.'" control-values="5|6|7|8"',
                /*string*/    'label'       => 'Tipo de Ensino Médio Cursado',
                /*string*/    'name'        => 'si_bsc_ens_med_tipo_id_'.$keySI,
                /*string*/    'id'          => 'si_bsc_ens_med_tipo_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['bsc_ens_med_tipo_id'],
                /*array()*/   'options'     => $rsEnsMedTipos,
                /*string*/    'ariaLabel'   => 'Selecione o tipo de ensino médio cursado',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_bsc_ens_med_tipo_id_" namebasesingle="si_bsc_ens_med_tipo_id_" controlled="escolaridade_'.$keySI.'" control-values="5|6|7|8"'
              )); ?>
            </div>
            <div class="row pe-0" controlled="escolaridade_<?=$keySI;?>" control-values="9|10" <?= $displayEnsSup ;?>>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '8 pe-1',
                /*string*/    'label'       => 'Curso Superior/Pos Cursado',
                /*string*/    'name'        => 'si_sme_ens_sup_curso_id_'.$keySI,
                /*string*/    'id'          => 'si_sme_ens_sup_curso_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['sme_ens_sup_curso_id'],
                /*array()*/   'options'     => $rsEnsSupCursos,
                /*string*/    'ariaLabel'   => 'Selecione o curso superior/pos cursado',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_sme_ens_sup_curso_id_" namebasesingle="si_sme_ens_sup_curso_id_" controlled="escolaridade_'.$keySI.'" control-values="9|10"'
              )); ?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Tipo de Ensino Superior Cursado',
                /*string*/    'name'        => 'si_bsc_ens_sup_tipo_id_'.$keySI,
                /*string*/    'id'          => 'si_bsc_ens_sup_tipo_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['bsc_ens_sup_tipo_id'],
                /*array()*/   'options'     => $rsEnsSupTipos,
                /*string*/    'ariaLabel'   => 'Selecione o tipo de ensino superior cursado',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_bsc_ens_sup_tipo_id_" namebasesingle="si_bsc_ens_sup_tipo_id_" controlled="escolaridade_'.$keySI.'" control-values="9|10"'
              )); ?>
            </div>
            <div class="row pe-0">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '8 pe-1 " '.$displayEnsSupMaior.' controlled="escolaridade_'.$keySI.'" control-values="9|10|11|12|13|14|15|16"',
                /*string*/    'label'       => 'Componente Curricular Cursado',
                /*string*/    'name'        => 'si_ue_compon_curricular_id_'.$keySI,
                /*string*/    'id'          => 'si_ue_compon_curricular_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['ue_compon_curricular_id'],
                /*array()*/   'options'     => $rsComponCurriculars,
                /*string*/    'ariaLabel'   => 'Selecione o componente curricular cursado',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_ue_compon_curricular_id_" namebasesingle="si_ue_compon_curricular_id_" controlled="escolaridade_'.$keySI.'" control-values="9|10|11|12|13|14|15|16""'
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1 " '.$displayEnsSup.' controlled="escolaridade_'.$keySI.'" control-values="9|10"',
                /*string*/    'label'       => 'Código INEP da Instituição de Educação Superior',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'si_inst_sup_cod_inep_'.$keySI,
                /*string*/    'id'          => 'si_inst_sup_cod_inep_'.$keySI,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 12,
                /*string*/    'placeholder' => 'Digite o código INEP da instituição de educação superior',
                /*string*/    'value'       => $objSI['inst_sup_cod_inep'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_inst_sup_cod_inep_" namebasesingle="si_inst_sup_cod_inep_" controlled="escolaridade_'.$keySI.'" control-values="9|10"'
              )) ;?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '12 pe-1',
                /*string*/    'label'       => 'Formação',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'si_formacao[]',
                /*string*/    'id'          => 'si_formacao_'.$keySI,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 255,
                /*string*/    'placeholder' => 'Digite a formação',
                /*string*/    'value'       => $objSI['formacao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="si_formacao_"'
              )) ;?>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover esta escolaridade
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar outra escolaridade
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