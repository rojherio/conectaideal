<?php
//Consulta para Edição - BEGIN
$idUE = isset($id) ? $id : (isset($parametromodulo) ? $parametromodulo : 0);
$idUE = isset($ue_ue_id) ? $ue_ue_id : $idUE;
//Equipamento - BEGIN
$stmt = $db->prepare("SELECT 
  uee.id,
  uee.status,
  uee.dt_cadastro,
  uee.internet_banda_larga_velocidade
  FROM ue_ue AS uee
  WHERE uee.id = ? ;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEquipam = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistrosUEEquipam)) {
  $idUE = 0;
  $rsRegistrosUEEquipam = array();
  $rsRegistrosUEEquipam['id'] = 0;
  $rsRegistrosUEEquipam['status'] = 1;
  $rsRegistrosUEEquipam['dt_cadastro'] = '';
  $rsRegistrosUEEquipam['internet_banda_larga_velocidade'] = '';
}
//Equipamento - END
//Equipamento Acesso Internet Aluno - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_equip_acesso_internet_aluno_id AS tb_ref_id
  FROM ue_ue_equip_acesso_internet_aluno
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEquipAcessoInternetAlunoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Equipamento Acesso Internet Aluno - END
//Equipamento Rede Local Tipo - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_equip_rede_local_tipo_id AS tb_ref_id
  FROM ue_ue_equip_rede_local_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEquipRedeLocalTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Equipamento Rede Local Tipo - END
//Internet Publico Tipo - BEGIN
$stmt = $db->prepare("SELECT
  id,
  ue_ue_id AS tb_base_id,
  ue_internet_pub_tipo_id AS tb_ref_id
  FROM ue_ue_internet_pub_tipo
  WHERE ue_ue_id = ?;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEInternetPubTipoId = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'tb_ref_id');
//Internet Publico Tipo - END
//Equipamento Tecnico Administrativo
$stmt = $db->prepare("SELECT 
  eta.id,
  eta.nome, 
  ueeta.descricao,
  ueeta.ue_ue_id,
  ueeta.ue_equip_tecn_administrativo_id,
  ueeta.qtd_apta_uso,
  ueeta.qtd_desligado,
  ueeta.qtd_sem_utilizacao,
  ueeta.qtd_aguard_instalacao,
  ueeta.qtd_em_conserto,
  ueeta.qtd_encaixotado,
  ueeta.qtd_alugado
  FROM ue_equip_tecn_administrativo AS eta
  LEFT JOIN ( 
    SELECT 
    ueueeta.id, 
    ueueeta.descricao,
    ueueeta.ue_ue_id,
    ueueeta.ue_equip_tecn_administrativo_id,
    ueueeta.qtd_apta_uso,
    ueueeta.qtd_desligado,
    ueueeta.qtd_sem_utilizacao,
    ueueeta.qtd_aguard_instalacao,
    ueueeta.qtd_em_conserto,
    ueueeta.qtd_encaixotado,
    ueueeta.qtd_alugado
    FROM ue_ue_equip_tecn_administrativo AS ueueeta
    WHERE ueueeta.ue_ue_id = ?
    ) AS ueeta ON ueeta.ue_equip_tecn_administrativo_id = eta.id
  WHERE 1 = 1;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEETA = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Equipamento Tecnico Administrativo
//Equipamento Ensino Aprendizagem Tipo
$stmt = $db->prepare("SELECT 
  eeat.id,
  eeat.nome, 
  ueeeat.descricao,
  ueeeat.ue_ue_id,
  ueeeat.ue_equip_ens_aprendiz_tipo_id,
  ueeeat.qtd_apta_uso,
  ueeeat.qtd_desligado,
  ueeeat.qtd_sem_utilizacao,
  ueeeat.qtd_aguard_instalacao,
  ueeeat.qtd_em_conserto,
  ueeeat.qtd_encaixotado,
  ueeeat.qtd_alugado
  FROM ue_equip_ens_aprendiz_tipo AS eeat
  LEFT JOIN ( 
    SELECT 
    ueueeet.id, 
    ueueeet.descricao,
    ueueeet.ue_ue_id,
    ueueeet.ue_equip_ens_aprendiz_tipo_id,
    ueueeet.qtd_apta_uso,
    ueueeet.qtd_desligado,
    ueueeet.qtd_sem_utilizacao,
    ueueeet.qtd_aguard_instalacao,
    ueueeet.qtd_em_conserto,
    ueueeet.qtd_encaixotado,
    ueueeet.qtd_alugado
    FROM ue_ue_equip_ens_aprendiz_tipo AS ueueeet
    WHERE ueueeet.ue_ue_id = ?
    ) AS ueeeat ON ueeeat.ue_equip_ens_aprendiz_tipo_id = eeat.id
  WHERE 1 = 1;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEEEAT = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Equipamento Ensino Aprendizagem Tipo
//Equipamento Aluno Computador Tipo
$stmt = $db->prepare("SELECT 
  ect.id,
  ect.nome, 
  ueact.descricao,
  ueact.ue_ue_id,
  ueact.ue_equip_comput_tipo_id,
  ueact.qtd_apta_uso,
  ueact.qtd_desligado,
  ueact.qtd_sem_utilizacao,
  ueact.qtd_aguard_instalacao,
  ueact.qtd_em_conserto,
  ueact.qtd_encaixotado,
  ueact.qtd_alugado
  FROM ue_equip_comput_tipo AS ect
  LEFT JOIN ( 
    SELECT 
    ueueact.id, 
    ueueact.descricao,
    ueueact.ue_ue_id,
    ueueact.ue_equip_comput_tipo_id,
    ueueact.qtd_apta_uso,
    ueueact.qtd_desligado,
    ueueact.qtd_sem_utilizacao,
    ueueact.qtd_aguard_instalacao,
    ueueact.qtd_em_conserto,
    ueueact.qtd_encaixotado,
    ueueact.qtd_alugado
    FROM ue_ue_aluno_comput_tipo AS ueueact
    WHERE ueueact.ue_ue_id = ?
    ) AS ueact ON ueact.ue_equip_comput_tipo_id = ect.id
  WHERE 1 = 1;");
$stmt->bindValue(1, $idUE);
$stmt->execute();
$rsRegistrosUEACT = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Equipamento Aluno Computador Tipo
//Consulta para Edição - END
//Consulta para Select - BEGIN
//Equipamento Acesso Internet Aluno - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_equip_acesso_internet_aluno 
  WHERE 1 = 1;");
$stmt->execute();
$rsEquipAcessoInternetAlunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Equipamento Acesso Internet Aluno - END
//Equipamento Rede Local Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_equip_rede_local_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsEquipRedeLocalTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Equipamento Rede Local Tipo - END
//Internet Publico Tipo - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM ue_internet_pub_tipo 
  WHERE 1 = 1;");
$stmt->execute();
$rsInternetPubTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Internet Publico Tipo - END
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloFormulario1        = "Dados dos Equipamentos";
$descricaoFormulario1     = "Dados dos equipamentos da unidade educativa";
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
            /*string*/    'label'       => 'Possui Acesso à Internet via Banda Larga (maior a 100Kbps)?',
            /*string*/    'name'        => 'uee_internet_banda_larga_velocidade',
            /*string*/    'id'          => 'uee_internet_banda_larga_velocidade',
            /*string*/    'class'       => 'toggle',
            /*string*/    'value'       => 1,
            /*string*/    'checked'     => $rsRegistrosUEEquipam['internet_banda_larga_velocidade'],
            /*string*/    'prop'        => ''
          )) ;?>
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 6,
            /*string*/    'label'       => 'Equipamento de Rede Local',
            /*string*/    'name'        => 'uee_ue_equip_rede_local_tipo_id[]',
            /*string*/    'id'          => 'uee_ue_equip_rede_local_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEEquipRedeLocalTipoId,
            /*array()*/   'options'     => $rsEquipRedeLocalTipos,
            /*string*/    'ariaLabel'   => 'Selecione os equipamentos de rede local',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Público com Acesso à Interent da Unidade Educativa',
            /*string*/    'name'        => 'uee_ue_internet_pub_tipo_id[]',
            /*string*/    'id'          => 'uee_ue_internet_pub_tipo_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEInternetPubTipoId,
            /*array()*/   'options'     => $rsInternetPubTipos,
            /*string*/    'ariaLabel'   => 'Selecione os equipamentos de acessoa a internet',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <div class="row">
          <?= createSelectMultiple(array(
            /*int 1-12*/  'col'         => 12,
            /*string*/    'label'       => 'Equipamento de Acesso à Internet para Aluno',
            /*string*/    'name'        => 'uee_ue_equip_acesso_internet_aluno_id[]',
            /*string*/    'id'          => 'uee_ue_equip_acesso_internet_aluno_id',
            /*string*/    'class'       => 'select2-multiple form-control form-select',
            /*array()*/   'value'       => $rsRegistrosUEEquipAcessoInternetAlunoId,
            /*array()*/   'options'     => $rsEquipAcessoInternetAlunos,
            /*string*/    'ariaLabel'   => 'Selecione os equipamentos de acessoa a internet',
            /*bool*/      'required'    => false,
            /*string*/    'prop'        => ''
          )); ?>
        </div>
        <h6>Equipamentos Existentes na Escola para Uso Técnico e Administrativo</h6>
        <div class="row mt-0 mb-3">
          <!-- Small Table start -->
          <div class="col-xl-12">
            <div class="table-responsive">
              <table class="table table-dark table-bottom-border table-sm table-hover table-striped align-middle mb-0">
                <thead>
                  <tr>
                    <th scope="col">Equipamento</th>
                    <th scope="col">Apta ao Uso</th>
                    <th scope="col">Desligado</th>
                    <th scope="col">Sem Uso</th>
                    <th scope="col">À Instalar</th>
                    <th scope="col">Conserto</th>
                    <th scope="col">Encaixotado</th>
                    <th scope="col">Alugado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($rsRegistrosUEETA as $key1 => $obj1) {
                    ?>
                    <tr>
                      <input type="hidden" id="uee_ta_id_<?=$obj1['id'];?>" name="uee_ta_id[]" value="<?=$obj1['id'];?>">
                      <td><label for=""><?= $obj1['nome'];?></label></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_apta_uso_<?=$obj1['id'];?>" name="uee_ta_qtd_apta_uso[]" value="<?=$obj1['qtd_apta_uso'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_desligado_<?=$obj1['id'];?>" name="uee_ta_qtd_desligado[]" value="<?=$obj1['qtd_desligado'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_sem_utilizacao_<?=$obj1['id'];?>" name="uee_ta_qtd_sem_utilizacao[]" value="<?=$obj1['qtd_sem_utilizacao'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_aguardando_instalacao_<?=$obj1['id'];?>" name="uee_ta_qtd_aguardando_instalacao[]" value="<?=$obj1['qtd_aguard_instalacao'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_em_conserto_<?=$obj1['id'];?>" name="uee_ta_qtd_em_conserto[]" value="<?=$obj1['qtd_em_conserto'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_encaixotado_<?=$obj1['id'];?>" name="uee_ta_qtd_encaixotado[]" value="<?=$obj1['qtd_encaixotado'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ta_qtd_alugado_<?=$obj1['id'];?>" name="uee_ta_qtd_alugado[]" value="<?=$obj1['qtd_alugado'];?>"></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- Small Table end -->
          </div>
        </div>
        <h6>Quantidade de Equipamentos para o Processo de Ensino e Aprendizagem</h6>
        <div class="row mt-0 mb-3">
          <!-- Small Table start -->
          <div class="col-xl-12">
            <div class="table-responsive">
              <table class="table table-dark table-bottom-border table-sm table-hover table-striped align-middle mb-0">
                <thead>
                  <tr>
                    <th scope="col">Equipamento</th>
                    <th scope="col">Apta ao Uso</th>
                    <th scope="col">Desligado</th>
                    <th scope="col">Sem Uso</th>
                    <th scope="col">À Instalar</th>
                    <th scope="col">Conserto</th>
                    <th scope="col">Encaixotado</th>
                    <th scope="col">Alugado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($rsRegistrosUEEEAT as $key1 => $obj1) {
                    ?>
                    <tr>
                      <input type="hidden" id="uee_ea_id_<?=$obj1['id'];?>" name="uee_ea_id[]" value="<?=$obj1['id'];?>">
                      <td><label for=""><?= $obj1['nome'];?></label></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_apta_uso_<?=$obj1['id'];?>" name="uee_ea_qtd_apta_uso[]" value="<?=$obj1['qtd_apta_uso'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_desligado_<?=$obj1['id'];?>" name="uee_ea_qtd_desligado[]" value="<?=$obj1['qtd_desligado'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_sem_utilizacao_<?=$obj1['id'];?>" name="uee_ea_qtd_sem_utilizacao[]" value="<?=$obj1['qtd_sem_utilizacao'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_aguardando_instalacao_<?=$obj1['id'];?>" name="uee_ea_qtd_aguardando_instalacao[]" value="<?=$obj1['qtd_aguard_instalacao'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_em_conserto_<?=$obj1['id'];?>" name="uee_ea_qtd_em_conserto[]" value="<?=$obj1['qtd_em_conserto'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_encaixotado_<?=$obj1['id'];?>" name="uee_ea_qtd_encaixotado[]" value="<?=$obj1['qtd_encaixotado'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ea_qtd_alugado_<?=$obj1['id'];?>" name="uee_ea_qtd_alugado[]" value="<?=$obj1['qtd_alugado'];?>"></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- Small Table end -->
          </div>
        </div>
        <h6>Quantidade de Computadores em Uso pelos Alunos</h6>
        <div class="row mt-0 mb-3">
          <!-- Small Table start -->
          <div class="col-xl-12">
            <div class="table-responsive">
              <table class="table table-dark table-bottom-border table-sm table-hover table-striped align-middle mb-0">
                <thead>
                  <tr>
                    <th scope="col">Equipamento</th>
                    <th scope="col">Apta ao Uso</th>
                    <th scope="col">Desligado</th>
                    <th scope="col">Sem Uso</th>
                    <th scope="col">À Instalar</th>
                    <th scope="col">Conserto</th>
                    <th scope="col">Encaixotado</th>
                    <th scope="col">Alugado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($rsRegistrosUEACT as $key1 => $obj1) {
                    ?>
                    <tr>
                      <input type="hidden" id="uee_ct_id_<?=$obj1['id'];?>" name="uee_ct_id[]" value="<?=$obj1['id'];?>">
                      <td><label for=""><?= $obj1['nome'];?></label></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_apta_uso_<?=$obj1['id'];?>" name="uee_ct_qtd_apta_uso[]" value="<?=$obj1['qtd_apta_uso'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_desligado_<?=$obj1['id'];?>" name="uee_ct_qtd_desligado[]" value="<?=$obj1['qtd_desligado'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_sem_utilizacao_<?=$obj1['id'];?>" name="uee_ct_qtd_sem_utilizacao[]" value="<?=$obj1['qtd_sem_utilizacao'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_aguardando_instalacao_<?=$obj1['id'];?>" name="uee_ct_qtd_aguardando_instalacao[]" value="<?=$obj1['qtd_aguard_instalacao'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_em_conserto_<?=$obj1['id'];?>" name="uee_ct_qtd_em_conserto[]" value="<?=$obj1['qtd_em_conserto'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_encaixotado_<?=$obj1['id'];?>" name="uee_ct_qtd_encaixotado[]" value="<?=$obj1['qtd_encaixotado'];?>"></td>
                      <td><input type="number" min="1" minlength="1" maxlength="7" id="uee_ct_qtd_alugado_<?=$obj1['id'];?>" name="uee_ct_qtd_alugado[]" value="<?=$obj1['qtd_alugado'];?>"></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- Small Table end -->
          </div>
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