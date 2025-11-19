<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  sfct.id,
  sfct.status,
  sfct.dt_cadastro,
  sfct.c_h,
  sfct.sme_servidor_id,
  sfct.sme_formac_contin_curso_id
  FROM sme_serv_formac_contin AS sfct 
  WHERE sfct.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSFContin = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSFContin) {
  $rsRegistrosSFContin = array();
  $rsRegistrosSFContin[0]['id'] = 0;
  $rsRegistrosSFContin[0]['status'] = 1;
  $rsRegistrosSFContin[0]['dt_cadastro'] = '';
  $rsRegistrosSFContin[0]['c_h'] = '';
  $rsRegistrosSFContin[0]['sme_servidor_id'] = '';
  $rsRegistrosSFContin[0]['sme_formac_contin_curso_id'] = '';
}
//Consulta para Edição - END
//Consultas para Select - BEGIN
//Formação Continuada Cursos - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM sme_formac_contin_curso  
  WHERE 1 = 1;");
$stmt->execute();
$rsFormacContinCursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Formação Continuada Cursos - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Formação Continuada do Servidor(a)";
$siDescricaoFormulario1    = "Informações de formações continuada do servidor(a)";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="sfct_sme_servidor_id" id="sfct_sme_servidor_id" value="<?= $idS ;?>">
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
        foreach ($rsRegistrosSFContin as $keySFC => $objSFC) {
          ?>
          <div divcount="<?=$keySFC+1;?>" class="div_clonar row border border-outline-info rounded pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Formação Continuada - <span class="span_contador"><?=$keySFC+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="sfct_sme_formac_contin_id[]" id="sfct_sme_formac_contin_id_<?=$keySFC+1;?>" idbase="sfct_sme_formac_contin_id_" value="<?=$objSFC['id'];?>"/>
            <div class="row pe-0">
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '8 pe-1',
                /*string*/    'label'       => 'Curso',
                /*string*/    'name'        => 'sfct_sme_formac_contin_curso_id[]',
                /*string*/    'id'          => 'sfct_sme_formac_contin_curso_id_'.$keySFC,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSFC['sme_formac_contin_curso_id'],
                /*array()*/   'options'     => $rsFormacContinCursos
              ,
                /*string*/    'ariaLabel'   => 'Selecione o curso',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sfct_sme_formac_contin_curso_id_"'
              )); ?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '4 pe-1',
                /*string*/    'label'       => 'Carga-Horária',
                /*string*/    'type'        => 'number',
                /*string*/    'name'        => 'sfct_c_h[]',
                /*string*/    'id'          => 'sfct_c_h_'.$keySFC,
                /*string*/    'class'       => 'form-control',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 5,
                /*string*/    'placeholder' => 'Digite a carga-horária',
                /*string*/    'value'       => $objSFC['c_h'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sfct_c_h_"'
              )) ;?>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover esta formação
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar outra formação
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