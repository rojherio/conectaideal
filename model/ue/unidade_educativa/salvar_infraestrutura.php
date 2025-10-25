<?php
$db                                       = Conexao::getInstance();
$status                                   = 1;
$id                                       = strip_tags(@$_POST['ue_id']?: '');
$dt_cadastro                              = date("Y-m-d H:i:s");
$ue_infra_local_ocupacao_forma_id         = strip_tags(@$_POST['uei_ue_infra_local_ocupacao_forma_id']?: '');
$fornece_agua_potavel                     = strip_tags(@$_POST['uei_fornece_agua_potavel']?: 0);
$sala_aula_qtd                            = trim(strip_tags(@$_POST['uei_sala_aula_qtd']?: ''));
$sala_aula_climatizada_qtd                = trim(strip_tags(@$_POST['uei_sala_aula_climatizada_qtd']?: ''));
$sala_aula_acessibilidade_qtd             = trim(strip_tags(@$_POST['uei_sala_aula_acessibilidade_qtd']?: ''));
$alimentacao_pnae_fnde_oferece            = strip_tags(@$_POST['uei_alimentacao_pnae_fnde_oferece']?: 0);
//POST Tables Terciarias
$ue_infra_local_funcionam_id              = @$_POST['uei_infra_local_funcionam_id'];
$ue_infra_ue_compartilha_id               = @$_POST['uei_ue_infra_ue_compartilha_id'];
$ue_infra_agua_abast_tipo_id              = @$_POST['uei_ue_infra_agua_abast_tipo_id'];
$ue_infra_eletrica_fonte_id               = @$_POST['uei_ue_infra_eletrica_fonte_id'];
$ue_infra_esgot_tipo_id                   = @$_POST['uei_ue_infra_esgot_tipo_id'];
$ue_infra_lixo_dest_tipo_id               = @$_POST['uei_ue_infra_lixo_dest_tipo_id'];
$ue_infra_lixo_resid_trat_tipo_id         = @$_POST['uei_ue_infra_lixo_resid_trat_tipo_id'];
$ue_infra_espaco_fisico_id                = @$_POST['uei_ue_infra_espaco_fisico_id'];
$ue_infra_acessib_recurso_id              = @$_POST['uei_ue_infra_acessib_recurso_id'];
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
        ue_infra_local_ocupacao_forma_id = ?,
        fornece_agua_potavel = ?,
        sala_aula_qtd = ?,
        sala_aula_climatizada_qtd = ?,
        sala_aula_acessibilidade_qtd = ?,
        alimentacao_pnae_fnde_oferece = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $dt_cadastro?: NULL);
    $stmt->bindValue(2, $ue_infra_local_ocupacao_forma_id?: NULL);
    $stmt->bindValue(3, $fornece_agua_potavel);
    $stmt->bindValue(4, $sala_aula_qtd?: NULL);
    $stmt->bindValue(5, $sala_aula_climatizada_qtd?: NULL);
    $stmt->bindValue(6, $sala_aula_acessibilidade_qtd?: NULL);
    $stmt->bindValue(7, $alimentacao_pnae_fnde_oferece);
    $stmt->bindValue(8, $id);
    $stmt->execute();
    //DELETE ue_ue_infra_local_funcionam
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_local_funcionam
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_local_funcionam
    if($ue_infra_local_funcionam_id){
      foreach ($ue_infra_local_funcionam_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_local_funcionam
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_local_funcionam_id
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
    //DELETE ue_ue_infra_ue_compartilha
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_ue_compartilha
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_ue_compartilha
    if($ue_infra_ue_compartilha_id){
      foreach ($ue_infra_ue_compartilha_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_ue_compartilha
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_ue_id_compartilha
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
    //DELETE ue_ue_infra_agua_abast_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_agua_abast_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_agua_abast_tipo
    if($ue_infra_agua_abast_tipo_id){
      foreach ($ue_infra_agua_abast_tipo_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_agua_abast_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_agua_abast_tipo_id
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
    //DELETE ue_ue_infra_eletrica_fonte
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_eletrica_fonte
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_eletrica_fonte
    if($ue_infra_eletrica_fonte_id){
      foreach ($ue_infra_eletrica_fonte_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_eletrica_fonte
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_eletrica_fonte_id
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
    //DELETE ue_ue_infra_esgot_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_esgot_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_esgot_tipo
    if($ue_infra_esgot_tipo_id){
      foreach ($ue_infra_esgot_tipo_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_esgot_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_esgot_tipo_id
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
    //DELETE ue_ue_infra_lixo_dest_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_lixo_dest_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_lixo_dest_tipo
    if($ue_infra_lixo_dest_tipo_id){
      foreach ($ue_infra_lixo_dest_tipo_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_lixo_dest_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_lixo_dest_tipo_id
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
    //DELETE ue_ue_infra_lixo_resid_trat_tipo
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_lixo_resid_trat_tipo
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_lixo_resid_trat_tipo
    if($ue_infra_lixo_resid_trat_tipo_id){
      foreach ($ue_infra_lixo_resid_trat_tipo_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_lixo_resid_trat_tipo
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_lixo_resid_trat_tipo_id
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
    //DELETE ue_ue_infra_espaco_fisico
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_espaco_fisico
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_espaco_fisico
    if($ue_infra_espaco_fisico_id){
      foreach ($ue_infra_espaco_fisico_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_espaco_fisico
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_espaco_fisico_id
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
    //DELETE ue_ue_infra_acessib_recurso
    $stmt = $db->prepare('
      DELETE 
        FROM ue_ue_infra_acessib_recurso
        WHERE ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //INSERT ue_ue_infra_acessib_recurso
    if($ue_infra_acessib_recurso_id){
      foreach ($ue_infra_acessib_recurso_id as $k => $v) {
        $stmt = $db->prepare('
          INSERT INTO ue_ue_infra_acessib_recurso
          (
            status,
            dt_cadastro,
            ue_ue_id,
            ue_infra_acessib_recurso_id
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