<?php
//Consulta para Edição - BEGIN
$idS = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idS = isset($sme_servidor_id) ? $sme_servidor_id : $idS;
//Identificação - BEGIN
$stmt = $db->prepare("SELECT 
  sv.id,
  sv.status,
  sv.dt_cadastro,
  sv.sme_servidor_id,
  sv.local,
  sv.bsc_esfera_administrativa_id,
  sv.cargo,
  sv.carga_horaria
  FROM sme_serv_vinculo AS sv
  WHERE sv.sme_servidor_id = ? ;");
$stmt->bindValue(1, $idS);
$stmt->execute();
$rsRegistrosSVinculo = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (!$rsRegistrosSVinculo) {
  $rsRegistrosSVinculo = array();
  $rsRegistrosSVinculo[0]['id'] = 0;
  $rsRegistrosSVinculo[0]['status'] = 1;
  $rsRegistrosSVinculo[0]['dt_cadastro'] = '';
  $rsRegistrosSVinculo[0]['sme_servidor_id'] = $idS;
  $rsRegistrosSVinculo[0]['local'] = '';
  $rsRegistrosSVinculo[0]['bsc_esfera_administrativa_id'] = '';
  $rsRegistrosSVinculo[0]['cargo'] = '';
  $rsRegistrosSVinculo[0]['carga_horaria'] = '';
}
//Consulta para Edição - END
//Esfera Administrativa - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM bsc_esfera_administrativa  
  WHERE 1 = 1;");
$stmt->execute();
$rsEsfAdm = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Esfera Administrativa - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$siTituloFormulario1       = "Outros Vínculos do Servidor";
$siDescricaoFormulario1    = "Informações de outros vínculos do servidor(a)";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="sv_sme_servidor_id" id="sv_sme_servidor_id" value="<?= $idS ;?>">
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
        foreach ($rsRegistrosSVinculo as $keySV => $objSV) {
          ?>
          <div divcount="<?=$keySV+1;?>" class="div_clonar row border border-outline-info rounded  pt-3 pb-3 ps-1 pe-0 mt-3 mb-1 ms-0 me-0">
            <h6>Outro vínculo - <span class="span_contador"><?=$keySV+1;?></span></h6>
            <!-- div row input - BEGIN -->
            <input type="hidden" name="sv_sme_serv_vinculo_id[]" id="sv_sme_serv_vinculo_id<?=$keySV+1;?>" idbase="sv_sme_serv_vinculo_id_" value="<?=$objSV['id'];?>"/>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '7 pe-1',
                /*string*/    'label'       => 'Local',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sv_local[]',
                /*string*/    'id'          => 'sv_local_'.$keySV,
                /*string*/    'class'       => 'form-control mask-ano max-today',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 50,
                /*string*/    'placeholder' => 'Digite o local de vínculo',
                /*string*/    'value'       => $objSV['local'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sv_local_"'
              )) ;?>
              <?= createSelect(array(
                /*int 1-12*/  'col'         => '5 pe-1',
                /*string*/    'label'       => 'Esfera Administrativa',
                /*string*/    'name'        => 'sv_bsc_esfera_administrativa_id[]',
                /*string*/    'id'          => 'sv_bsc_esfera_administrativa_id_'.$keySV,
                /*string*/    'class'       => 'select2 form-control form-select select-basic',
                /*string*/    'value'       => $objSV['bsc_esfera_administrativa_id'],
                /*array()*/   'options'     => $rsEsfAdm,
                /*string*/    'ariaLabel'   => 'Selecione a esfera administrativa de vínculo',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sv_bsc_esfera_administrativa_id_"'
              )); ?>
            </div>
            <div class="row pe-0">
              <?= createInput(array(
                /*int 1-12*/  'col'         => '7 pe-1',
                /*string*/    'label'       => 'Cargo',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sv_cargo[]',
                /*string*/    'id'          => 'sv_cargo_'.$keySV,
                /*string*/    'class'       => 'form-control mask-ano max-today',
                /*int*/       'minlength'   => 3,
                /*int*/       'maxlength'   => 50,
                /*string*/    'placeholder' => 'Digite o cargo do vínculo',
                /*string*/    'value'       => $objSV['cargo'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sv_cargo_"'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => '5 pe-1',
                /*string*/    'label'       => 'Carga-Horária',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => 'sv_carga_horaria[]',
                /*string*/    'id'          => 'sv_carga_horaria_'.$keySV,
                /*string*/    'class'       => 'form-control mask-ano max-today',
                /*int*/       'minlength'   => 1,
                /*int*/       'maxlength'   => 20,
                /*string*/    'placeholder' => 'Digite a carga-horária do vínculo',
                /*string*/    'value'       => $objSV['carga_horaria'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'idbase="sv_carga_horaria_"'
              )) ;?>
            </div>
            <div class="div_clonar_btns row">
              <div class="box-footer text-center">
                <button type="button" class="btn_div_remove btn btn-outline-warning b-r-22">
                  <i class="ti ti-eraser"></i> Remover este vínculo
                </button>
                <button type="button" class="btn_div_add btn btn-outline-info b-r-22">
                  <i class="ti ti-plus"></i> Adicionar outro vínculo
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