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
  si.cursando
  FROM sme_serv_instrucao AS si
  WHERE si.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSInstrucao = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSInstrucao) {
  $rsRegistrosSInstrucao = array();
  $rsRegistrosSInstrucao[0]['id'] = 0;
  $rsRegistrosSInstrucao[0]['status'] = 1;
  $rsRegistrosSInstrucao[0]['dt_cadastro'] = '';
  $rsRegistrosSInstrucao[0]['sme_servidor_id'] = '';
  $rsRegistrosSInstrucao[0]['bsc_escolaridade_id'] = '';
  $rsRegistrosSInstrucao[0]['formacao'] = '';
  $rsRegistrosSInstrucao[0]['conclusao_ano'] = '';
  $rsRegistrosSInstrucao[0]['cursando'] = '';
  $rsRegistrosSInstrucao[1]['id'] = 0;
  $rsRegistrosSInstrucao[1]['status'] = 1;
  $rsRegistrosSInstrucao[1]['dt_cadastro'] = '';
  $rsRegistrosSInstrucao[1]['sme_servidor_id'] = '';
  $rsRegistrosSInstrucao[1]['bsc_escolaridade_id'] = '';
  $rsRegistrosSInstrucao[1]['formacao'] = '';
  $rsRegistrosSInstrucao[1]['conclusao_ano'] = '';
  $rsRegistrosSInstrucao[1]['cursando'] = '';
}
//Secretaria Municipal de Educação - BEGIN
$stmt = $db->prepare("SELECT 
  s.id,
  p.nome
  FROM sme_sme AS s 
  LEFT JOIN bsc_pessoa AS p ON p.id = s.bsc_pessoa_id
  WHERE 1 = 1;");
$stmt->execute();
$rsSMEs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Secretaria Municipal de Educação - END
//Pessoas Física - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM bsc_pessoa AS p
  WHERE p.tipo = 1;");
$stmt->execute();
$rsPFs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Pessoas Física - END
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Escolariade - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_escolaridade  
  WHERE 1 = 1;");
$stmt->execute();
$rsEscolaridades = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Escolaridade - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Escolaridade/Grau de Instrução do Servidor";
$siDescricaoFormulario1    = "Informações de estudo e formação do servidor ";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="si_sme_servidor_id" id="si_sme_servidor_id" value="<?= $rsRegistroSIdent['id'] ;?>">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <!-- Título da div de cadastro - BEGIN -->
        <h5><?= $siTituloFormulario1;?></h5>
        <small><?= $siDescricaoFormulario1;?></small>
        <!-- Título da div de cadastro - END -->
      </div>
      <div class="card-body">
        <?php
        foreach ($rsRegistrosSInstrucao as $keySI => $objSI) {
          ?>
          <div id="div_escolaridade" div-count="<?=$keySI;?>" class="row border border-outline-primary rounded pt-3 ps-3 ms-0 me-0 mb-3">
            <h6>Grau de Instrução - <?=$keySI+1;?></h6>
            <!-- div row input - BEGIN -->
            <div class="row">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Escolaridade',
                /*string*/    'name'        => 'si_bsc_escolaridade_id[]',
                /*string*/    'id'          => 'si_bsc_escolaridade_id_'.$keySI,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSI['bsc_escolaridade_id'],
                /*array()*/   'options'     => $rsEscolaridades,
                /*string*/    'ariaLabel'   => 'Selecione uma escolaridade',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )); ?>
            </div>
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Formação',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'si_formacao[]',
                /*string*/    'id'          => 'si_formacao_'.$keySI,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 150,
                /*string*/    'placeholder' => 'Digite a formação',
                /*string*/    'value'       => $objSI['formacao'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )) ;?>
            </div>
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Ano de Conclusão',
                /*string*/    'type'        => 'number',
                /*string*/    'name'        => 'si_conclusao_ano[]',
                /*string*/    'id'          => 'si_conclusao_ano_'.$keySI,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 4,
                /*int*/       'maxlength'   => 4,
                /*string*/    'placeholder' => 'Digite o ano de conclusao',
                /*string*/    'value'       => $objSI['conclusao_ano'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => ''
              )) ;?>
            </div>
            <div class="row">
              <?= createCheckbox(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => 'Cursando',
                /*string*/    'type'        => 'checkbox',
                /*string*/    'name'        => 'si_cursando[]',
                /*string*/    'id'          => 'si_cursando_'.$keySI,
                /*string*/    'class'       => 'toggle',
                /*string*/    'value'       => 1,
                /*string*/    'checked'     => $objSI['cursando'],
                /*string*/    'prop'        => ''
              )) ;?>
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