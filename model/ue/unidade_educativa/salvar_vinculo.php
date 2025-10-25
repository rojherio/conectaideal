<?php
$result['status'] = 'error';
$result['tipo'] = 'id';
$result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois o código Id não foi recebido corretamente.";
echo json_encode($result);
exit();
$db                                       = Conexao::getInstance();
$status                                   = 1;
$id                                       = strip_tags(@$_POST['ue_id']?: '');
$dt_cadastro                              = date("Y-m-d H:i:s");
$internet_banda_larga_velocidade          = strip_tags(@$_POST['uee_internet_banda_larga_velocidade']?: 0);
//POST Tables Terciarias
$ue_internet_pub_tipo_id                  = @$_POST['uee_ue_internet_pub_tipo_id'];
$ue_equip_rede_local_tipo_id              = @$_POST['uee_ue_equip_rede_local_tipo_id'];
$ue_equip_acesso_internet_aluno_id        = @$_POST['uee_ue_equip_acesso_internet_aluno_id'];
$ue_ta_id                                 = @$_POST['uee_ta_id'];
$ue_ta_qtd_apta_uso                       = @$_POST['uee_ta_qtd_apta_uso'];
$ue_ta_qtd_desligado                      = @$_POST['uee_ta_qtd_desligado'];
$ue_ta_qtd_sem_utilizacao                 = @$_POST['uee_ta_qtd_sem_utilizacao'];
$ue_ta_qtd_aguardando_instalacao          = @$_POST['uee_ta_qtd_aguardando_instalacao'];
$ue_ta_qtd_em_conserto                    = @$_POST['uee_ta_qtd_em_conserto'];
$ue_ta_qtd_encaixotado                    = @$_POST['uee_ta_qtd_encaixotado'];
$ue_ta_qtd_alugado                        = @$_POST['uee_ta_qtd_alugado'];
$ue_ea_id                                 = @$_POST['uee_ea_id'];
$ue_ea_qtd_apta_uso                       = @$_POST['uee_ea_qtd_apta_uso'];
$ue_ea_qtd_desligado                      = @$_POST['uee_ea_qtd_desligado'];
$ue_ea_qtd_sem_utilizacao                 = @$_POST['uee_ea_qtd_sem_utilizacao'];
$ue_ea_qtd_aguardando_instalacao          = @$_POST['uee_ea_qtd_aguardando_instalacao'];
$ue_ea_qtd_em_conserto                    = @$_POST['uee_ea_qtd_em_conserto'];
$ue_ea_qtd_encaixotado                    = @$_POST['uee_ea_qtd_encaixotado'];
$ue_ea_qtd_alugado                        = @$_POST['uee_ea_qtd_alugado'];
$ue_ct_id                                 = @$_POST['uee_ct_id'];
$ue_ct_qtd_apta_uso                       = @$_POST['uee_ct_qtd_apta_uso'];
$ue_ct_qtd_desligado                      = @$_POST['uee_ct_qtd_desligado'];
$ue_ct_qtd_sem_utilizacao                 = @$_POST['uee_ct_qtd_sem_utilizacao'];
$ue_ct_qtd_aguardando_instalacao          = @$_POST['uee_ct_qtd_aguardando_instalacao'];
$ue_ct_qtd_em_conserto                    = @$_POST['uee_ct_qtd_em_conserto'];
$ue_ct_qtd_encaixotado                    = @$_POST['uee_ct_qtd_encaixotado'];
$ue_ct_qtd_alugado                        = @$_POST['uee_ct_qtd_alugado'];
$tableName      = 'ue_ue';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != 0) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        dt_cadastro = ?,
        internet_banda_larga_velocidade = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $dt_cadastro?: NULL);
    $stmt->bindValue(2, $internet_banda_larga_velocidade);
    $stmt->bindValue(3, $id);
    $stmt->execute();
    //DELETE ue_ue_internet_pub_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_internet_pub_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_internet_pub_tipo
    if($ue_internet_pub_tipo_id){
      foreach ($ue_internet_pub_tipo_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_internet_pub_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_internet_pub_tipo_id
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $v[0]);
        $stmt->execute();
      }
    }
    //DELETE ue_ue_equip_rede_local_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_equip_rede_local_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_equip_rede_local_tipo
    if($ue_equip_rede_local_tipo_id){
      foreach ($ue_equip_rede_local_tipo_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_equip_rede_local_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_equip_rede_local_tipo_id
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $v[0]);
        $stmt->execute();
      }
    }
    //DELETE ue_ue_equip_acesso_internet_aluno
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_equip_acesso_internet_aluno
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_equip_acesso_internet_aluno
    if($ue_equip_acesso_internet_aluno_id){
      foreach ($ue_equip_acesso_internet_aluno_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_equip_acesso_internet_aluno
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_equip_acesso_internet_aluno_id
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $v[0]);
        $stmt->execute();
      }
    }
    //DELETE ue_ue_equip_tecn_administrativo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_equip_tecn_administrativo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_equip_tecn_administrativo
    if($ue_ta_id){
      foreach ($ue_ta_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_equip_tecn_administrativo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_equip_tecn_administrativo_id,
            qtd_apta_uso,
            qtd_desligado,
            qtd_sem_utilizacao,
            qtd_aguard_instalacao,
            qtd_em_conserto,
            qtd_encaixotado,
            qtd_alugado
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $v[0]);
        $stmt->bindValue(5, $ue_ta_qtd_apta_uso[$k]?:NULL);
        $stmt->bindValue(6, $ue_ta_qtd_desligado[$k]?:NULL);
        $stmt->bindValue(7, $ue_ta_qtd_sem_utilizacao[$k]?:NULL);
        $stmt->bindValue(8, $ue_ta_qtd_aguardando_instalacao[$k]?:NULL);
        $stmt->bindValue(9, $ue_ta_qtd_em_conserto[$k]?:NULL);
        $stmt->bindValue(10, $ue_ta_qtd_encaixotado[$k]?:NULL);
        $stmt->bindValue(11, $ue_ta_qtd_alugado[$k]?:NULL);
        $stmt->execute();
      }
    }
    //DELETE ue_ue_equip_ens_aprendiz_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_equip_ens_aprendiz_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_equip_ens_aprendiz_tipo
    if($ue_ea_id){
      foreach ($ue_ea_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_equip_ens_aprendiz_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_equip_ens_aprendiz_tipo_id,
            qtd_apta_uso,
            qtd_desligado,
            qtd_sem_utilizacao,
            qtd_aguard_instalacao,
            qtd_em_conserto,
            qtd_encaixotado,
            qtd_alugado
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $v[0]);
        $stmt->bindValue(5, $ue_ea_qtd_apta_uso[$k]?:NULL);
        $stmt->bindValue(6, $ue_ea_qtd_desligado[$k]?:NULL);
        $stmt->bindValue(7, $ue_ea_qtd_sem_utilizacao[$k]?:NULL);
        $stmt->bindValue(8, $ue_ea_qtd_aguardando_instalacao[$k]?:NULL);
        $stmt->bindValue(9, $ue_ea_qtd_em_conserto[$k]?:NULL);
        $stmt->bindValue(10, $ue_ea_qtd_encaixotado[$k]?:NULL);
        $stmt->bindValue(11, $ue_ea_qtd_alugado[$k]?:NULL);
        $stmt->execute();
      }
    }
    //DELETE ue_ue_aluno_comput_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_aluno_comput_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_aluno_comput_tipo
    if($ue_ct_id){
      foreach ($ue_ct_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_aluno_comput_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_equip_comput_tipo_id,
            qtd_apta_uso,
            qtd_desligado,
            qtd_sem_utilizacao,
            qtd_aguard_instalacao,
            qtd_em_conserto,
            qtd_encaixotado,
            qtd_alugado
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $id);
        $stmt->bindValue(4, $v[0]);
        $stmt->bindValue(5, $ue_ct_qtd_apta_uso[$k]?:NULL);
        $stmt->bindValue(6, $ue_ct_qtd_desligado[$k]?:NULL);
        $stmt->bindValue(7, $ue_ct_qtd_sem_utilizacao[$k]?:NULL);
        $stmt->bindValue(8, $ue_ct_qtd_aguardando_instalacao[$k]?:NULL);
        $stmt->bindValue(9, $ue_ct_qtd_em_conserto[$k]?:NULL);
        $stmt->bindValue(10, $ue_ct_qtd_encaixotado[$k]?:NULL);
        $stmt->bindValue(11, $ue_ct_qtd_alugado[$k]?:NULL);
        $stmt->execute();
      }
    }
    $db->commit();
    //MENSAGEM DE SUCESSO
    $result['id'] = $id;
    $result['status'] = 'success';
    $result['msg'] = 'As novas informações foram registradas com sucesso.';
    echo json_encode($result);
    exit();
  } else {
    $result['status'] = 'error';
    $result['tipo'] = 'id';
    $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois o código Id não foi recebido corretamente.";
    echo json_encode($result);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>