<?php
//Consulta para Edição - BEGIN
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $ue_ue_id : $idUE;
//Infraestrutura - BEGIN
$stmt = $db->prepare("SELECT 
  ue.id,
  ue.status,
  ue.dt_cadastro,
  ue.bsc_pessoa_id, 
  ue.ue_infra_local_ocupacao_forma_id,
  ue.ue_ue_id_vinculada,
  ue.fornece_agua_potavel,
  ue.sala_aula_qtd,
  ue.sala_aula_climatizada_qtd,
  ue.sala_aula_acessibilidade_qtd, 
  ue.alimentacao_pnae_fnde_oferece 
  FROM ue_ue AS ue
  WHERE ue.id = ? ;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistroUEInfra = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroUEInfra)) {
  $idUE = 0;
  $rsRegistroUEInfra = array();
  $rsRegistroUEInfra['id'] = 0;
  $rsRegistroUEInfra['status'] = 1;
  $rsRegistroUEInfra['dt_cadastro'] = '';
  $rsRegistroUEInfra['bsc_pessoa_id'] = '';
  $rsRegistroUEInfra['ue_infra_local_ocupacao_forma_id'] = '';
  $rsRegistroUEInfra['ue_ue_id_vinculada'] = '';
  $rsRegistroUEInfra['fornece_agua_potavel'] = 0;
  $rsRegistroUEInfra['sala_aula_qtd'] = '';
  $rsRegistroUEInfra['sala_aula_climatizada_qtd'] = '';
  $rsRegistroUEInfra['sala_aula_acessibilidade_qtd'] = '';
  $rsRegistroUEInfra['alimentacao_pnae_fnde_oferece'] = '';
}
//Infraestrutura - END
//Locais de Funcionamento - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_local_funcionam_id AS tb_ref_id
  FROM ue_ue_infra_local_funcionam
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosInfraLocalFuncionamId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Locais de Funcionamento - END
//UE compartilha - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_ue_id_compartilha AS tb_ref_id
  FROM ue_ue_infra_ue_compartilha
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUECompartilhaId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//UE compartilha - END
//Agua Abastecimento Tipo - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_agua_abast_tipo_id AS tb_ref_id
  FROM ue_ue_infra_agua_abast_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEAguaAbastTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Agua Abastecimento Tipo - END
//Eletrica Fonte - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_eletrica_fonte_id AS tb_ref_id
  FROM ue_ue_infra_eletrica_fonte
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEletricaFonteId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Eletrica Fonte - END
//Esgotamento Sanitário - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_esgot_tipo_id AS tb_ref_id
  FROM ue_ue_infra_esgot_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEsgotTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Esgotamento Sanitário - END
//Destinação do Lixo - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_lixo_dest_tipo_id AS tb_ref_id
  FROM ue_ue_infra_lixo_dest_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUELixoDestTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Destinação do Lixo - END
//Tratamento do Lixo/Resíduo - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_lixo_resid_trat_tipo_id AS tb_ref_id
  FROM ue_ue_infra_lixo_resid_trat_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUELixoResidTratTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Tratamento do Lixo/Resíduo - END
//Espaço Físicos - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_espaco_fisico_id AS tb_ref_id
  FROM ue_ue_infra_espaco_fisico
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEspacoFisicoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Espaço Físicos - END
//Recurso Acessibilidade - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_infra_acessib_recurso_id AS tb_ref_id
  FROM ue_ue_infra_acessib_recurso
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEAcessibRecursoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Recurso Acessibilidade - END
//Consulta para Edição - END
//Consulta para Select - BEGIN
//Local de Funcionamento - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_local_funcionam
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraLocalFuncionamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Local de Funcionamento - END
//Local Ocupação Forma - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_local_ocupacao_forma
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraLocalOcupacaoFormas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Local Ocupação Forma - END
//UE Compartilha - BEGIN
$stmt = $db->prepare("SELECT 
  ue.id,
  CONCAT(p.nome, ' - ', p.cpf) AS nome
  FROM ue_ue AS ue 
  LEFT JOIN bsc_pessoa AS p ON p.id = ue.bsc_pessoa_id
  WHERE ue.id <> ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsUECompartilhas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//UE Compartilha - END
//Agua Abastecimento Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_agua_abast_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraAguaAbastTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Agua Abastecimento Tipo - END
//Eletrica Fonte - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_eletrica_fonte 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraEletricaFontes = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Esgotamento Sanitário - END
//Destinação do Lixo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_esgot_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraEsgotTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Esgotamento Sanitário - END
//Destinação do Lixo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_lixo_dest_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraLixoDestTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Destinação do Lixo - END
//Tratamento do Lixo/Resíduo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_lixo_resid_trat_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraLixoResidTratTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Tratamento do Lixo/Resíduo - END
//Espaço Físico - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_espaco_fisico 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraEspacoFisicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Espaço Físico - END
//Recurso Acessibilidade - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_infra_acessib_recurso 
  WHERE 1 = 1;");
$stmt->execute();
$rsInfraAcessibRecursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Recurso Acessibilidade - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Dados da Alimentação Escolar";
$descricaoFormulario1     = "Dados de alimentação escolar da unidade educativa";
$tituloFormulario2        = "Dados da Infraestrutura";
$descricaoFormulario2     = "Dados de infraestrutura da unidade educativa";
//Parámetros de títutlos - END
?>
<!-- formulário de cadastro - BEGIN -->
<div class="row">
  <input type="hidden" name="ue_id" id="ue_id" value="<?= $idUE ;?>">
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
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => '6 mt-3 mb-3',
            /*string*/    'label'       => 'Oferece Alimentação Escolar com Recursos Pnae/FNDE?',
            /*string*/    'name'        => 'uei_alimentacao_pnae_fnde_oferece',
            /*string*/    'id'          => 'uei_alimentacao_pnae_fnde_oferece',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroUEInfra['alimentacao_pnae_fnde_oferece'],
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <!-- div row input - END -->
      </div>
    </div>
  </div>
</div>
<div class="row">
  <input type="hidden" name="ue_id" id="ue_id" value="<?= $idUE ;?>">
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
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Locais de Funcionamento',
            /*string*/    'name'        => 'uei_infra_local_funcionam_id[]',
            /*string*/    'id'          => 'uei_infra_local_funcionam_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosInfraLocalFuncionamId,
            /*array()*/   'options'     => $rsInfraLocalFuncionamentos,
            /*string*/    'ariaLabel'   => 'Selecione os locais de funcionamento',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => 'controller="uei_predio_escolar" controller-values="1"'
          )); ?>
          <?= createSelect(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Forma de Ocupação do Local de Funcionamento',
            /*string*/    'name'        => 'uei_ue_infra_local_ocupacao_forma_id',
            /*string*/    'id'          => 'uei_ue_infra_local_ocupacao_forma_id',
            /*string*/    'class'       => 'select2 form-control form-select',
            /*array()*/   'value'       => $rsRegistroUEInfra['ue_infra_local_ocupacao_forma_id'],
            /*array()*/   'options'     => $rsInfraLocalOcupacaoFormas,
            /*string*/    'ariaLabel'   => 'Selecione a forma de ocupação do local de funcionamento',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <?php
        //Parámetros de exibir/ocultar div - BEGIN
        $displayUEIPredioEscolar   = (!in_array(1, $rsRegistrosInfraLocalFuncionamId)) ? 'style="display: none;"' : '';
        //Parámetros de exibir/ocultar div - NED
        ?>
        <div controlled="uei_predio_escolar" control-value="1" <?= $displayUEIPredioEscolar ;?>>
          <div class="row">
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Número de Salas de Aula (dentro e fora do prédio)',
              /*string*/    'type'        => 'number',
              /*string*/    'name'        => 'uei_sala_aula_qtd',
              /*string*/    'id'          => 'uei_sala_aula_qtd',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 1,
              /*int*/       'maxlength'   => 10,
              /*string*/    'placeholder' => 'Digite o número de salas de aula',
              /*string*/    'value'       => $rsRegistroUEInfra['sala_aula_qtd'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="uei_predio_escolar" control-value="1"'
            )) ;?>
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Número de Salas de Aula Climatizadas (dentro e fora do prédio)',
              /*string*/    'type'        => 'number',
              /*string*/    'name'        => 'uei_sala_aula_climatizada_qtd',
              /*string*/    'id'          => 'uei_sala_aula_climatizada_qtd',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 1,
              /*int*/       'maxlength'   => 10,
              /*string*/    'placeholder' => 'Digite o número de salas de aula climatizadas',
              /*string*/    'value'       => $rsRegistroUEInfra['sala_aula_climatizada_qtd'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="uei_predio_escolar" control-value="1"'
            )) ;?>
          </div>
          <div class="row">
            <?= createInput(array(
              /*int 1-12*/  'col'         => 6,
              /*string*/    'label'       => 'Número de Salas de Aula com Acessibilidade (dentro e fora do prédio)',
              /*string*/    'type'        => 'number',
              /*string*/    'name'        => 'uei_sala_aula_acessibilidade_qtd',
              /*string*/    'id'          => 'uei_sala_aula_acessibilidade_qtd',
              /*string*/    'class'       => 'form-control',
              /*int*/       'minlength'   => 1,
              /*int*/       'maxlength'   => 10,
              /*string*/    'placeholder' => 'Digite o número de salas de aula com acessibilidade',
              /*string*/    'value'       => $rsRegistroUEInfra['sala_aula_acessibilidade_qtd'],
              /*bool*/      'required'    => false,
              /*string*/    'prop'        => 'controlled="uei_predio_escolar" control-value="1"'
            )) ;?>
          </div>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Unidades Educativas que Compartilham o Local Desta Unidade Educativa',
            /*string*/    'name'        => 'uei_ue_infra_ue_compartilha_id[]',
            /*string*/    'id'          => 'uei_ue_infra_ue_compartilha_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUECompartilhaId,
            /*array()*/   'options'     => $rsUECompartilhas,
            /*string*/    'ariaLabel'   => 'Selecione as unidades educativas que compartilham o local desta unidade educativa',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Abastecimento de Água',
            /*string*/    'name'        => 'uei_ue_infra_agua_abast_tipo_id[]',
            /*string*/    'id'          => 'uei_ue_infra_agua_abast_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEAguaAbastTipoId,
            /*array()*/   'options'     => $rsInfraAguaAbastTipos,
            /*string*/    'ariaLabel'   => 'Selecione a(s) fonte(s) de abastecimento de água',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createCheckbox(array(
            /*int 1-12*/  'col'         => '6 mt-3',
            /*string*/    'label'       => 'Fornece Água Potável?',
            /*string*/    'name'        => 'uei_fornece_agua_potavel',
            /*string*/    'id'          => 'uei_fornece_agua_potavel',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistroUEInfra['fornece_agua_potavel'],
            /*string*/    'prop'        => ''
          )) ;?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Fonte de Energia Elétrica',
            /*string*/    'name'        => 'uei_ue_infra_eletrica_fonte_id[]',
            /*string*/    'id'          => 'uei_ue_infra_eletrica_fonte_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEEletricaFonteId,
            /*array()*/   'options'     => $rsInfraEletricaFontes,
            /*string*/    'ariaLabel'   => 'Selecione a(s) fonte(s) de energia elétrica',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Esgotamento Sanitário',
            /*string*/    'name'        => 'uei_ue_infra_esgot_tipo_id[]',
            /*string*/    'id'          => 'uei_ue_infra_esgot_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEEsgotTipoId,
            /*array()*/   'options'     => $rsInfraEsgotTipos,
            /*string*/    'ariaLabel'   => 'Selecione o(s) destino(s) de esgotamento sanitário',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Destinação do Lixo',
            /*string*/    'name'        => 'uei_ue_infra_lixo_dest_tipo_id[]',
            /*string*/    'id'          => 'uei_ue_infra_lixo_dest_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUELixoDestTipoId,
            /*array()*/   'options'     => $rsInfraLixoDestTipos,
            /*string*/    'ariaLabel'   => 'Selecione o(s) destino(s) do lixo',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Tratamento do Lixo/Resíduos',
            /*string*/    'name'        => 'uei_ue_infra_lixo_resid_trat_tipo_id[]',
            /*string*/    'id'          => 'uei_ue_infra_lixo_resid_trat_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUELixoResidTratTipoId,
            /*array()*/   'options'     => $rsInfraLixoResidTratTipos,
            /*string*/    'ariaLabel'   => 'Selecione o(s) tratamento(s) do lixo/resíduos',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Dependência Física Existente na Unidade Educativa',
            /*string*/    'name'        => 'uei_ue_infra_espaco_fisico_id[]',
            /*string*/    'id'          => 'uei_ue_infra_espaco_fisico_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEEspacoFisicoId,
            /*array()*/   'options'     => $rsInfraEspacoFisicos,
            /*string*/    'ariaLabel'   => 'Selecione a(s) dependência(s) física(s) existente(s) na unidade educativa',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Recurso de Acessibilidade',
            /*string*/    'name'        => 'uei_ue_infra_acessib_recurso_id[]',
            /*string*/    'id'          => 'uei_ue_infra_acessib_recurso_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEAcessibRecursoId,
            /*array()*/   'options'     => $rsInfraAcessibRecursos,
            /*string*/    'ariaLabel'   => 'Selecione o(s) recurso(s) de acessibilidade existente(s) na unidade educativa',
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