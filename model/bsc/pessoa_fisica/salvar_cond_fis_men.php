<?php
$db                                       = Conexao::getInstance();
$status                                   = 1;
$id                                       = strip_tags(@$_POST['pcfm_id']);
$bsc_pessoa_id                            = strip_tags(@$_POST['pcfm_bsc_pessoa_id']);
$dt_cadastro                              = date("Y-m-d H:i:s");
$bsc_cond_tea_tipo_id                     = strip_tags(@$_POST['pcfm_bsc_cond_tea_tipo_id']?: '');
//POST Tables Terciarias
$bsc_cond_deficiencia_id                  = @$_POST['pcfm_bsc_cond_deficiencia_id'];
$bsc_cond_superdotacao_id                 = @$_POST['pcfm_bsc_cond_superdotacao_id'];
$bsc_cond_recurso_uso_id                  = @$_POST['pcfm_bsc_cond_recurso_uso_id'];
$idNew          = $id;
$tableName      = 'bsc_pessoa_cond_fis_men';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != 0) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        status = ?,
        dt_cadastro = ?,
        bsc_pessoa_id = ?,
        bsc_cond_tea_tipo_id = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
    $stmt->bindValue(4, $bsc_cond_tea_tipo_id?: NULL);
    $stmt->bindValue(5, $id);
    $stmt->execute();
    //DELETE bsc_pessoa_cond_deficiencia
    $stmt = $db->prepare('
      DELETE 
        FROM bsc_pessoa_cond_deficiencia
        WHERE bsc_pessoa_cond_fis_men_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //DELETE bsc_pessoa_cond_superdotacao
    $stmt = $db->prepare('
      DELETE 
        FROM bsc_pessoa_cond_superdotacao
        WHERE bsc_pessoa_cond_fis_men_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    //DELETE bsc_pessoa_cond_recurso_uso
    $stmt = $db->prepare('
      DELETE 
        FROM bsc_pessoa_cond_recurso_uso
        WHERE bsc_pessoa_cond_fis_men_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
  } else {
    $stmt = $db->prepare('INSERT INTO '.$tableName.' 
      (
        status,
        dt_cadastro,
        bsc_pessoa_id,
        bsc_cond_tea_tipo_id
        ) 
      VALUES
      (
        ?, 
        ?, 
        ?, 
        ? 
      )');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
    $stmt->bindValue(4, $bsc_cond_tea_tipo_id?: NULL);
    $stmt->execute();
    $idNew = $db->lastInsertId();
  }
  //INSERT bsc_pessoa_cond_deficiencia
  if($bsc_cond_deficiencia_id){
    foreach ($bsc_cond_deficiencia_id as $k => $v) {
      $stmt = $db->prepare('
        INSERT INTO bsc_pessoa_cond_deficiencia
        (
          status,
          dt_cadastro,
          bsc_pessoa_cond_fis_men_id,
          bsc_cond_deficiencia_id
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
      $stmt->bindValue(3, $idNew);
      $stmt->bindValue(4, $v[0]);
      $stmt->execute();
    }
  }
  //INSERT bsc_pessoa_cond_superdotacao
  if($bsc_cond_superdotacao_id){
    foreach ($bsc_cond_superdotacao_id as $k => $v) {
      $stmt = $db->prepare('
        INSERT INTO bsc_pessoa_cond_superdotacao
        (
          status,
          dt_cadastro,
          bsc_pessoa_cond_fis_men_id,
          bsc_cond_superdotacao_id
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
      $stmt->bindValue(3, $idNew);
      $stmt->bindValue(4, $v[0]);
      $stmt->execute();
    }
  }
  //INSERT bsc_pessoa_cond_recurso_uso
  if($bsc_cond_recurso_uso_id){
    foreach ($bsc_cond_recurso_uso_id as $k => $v) {
      $stmt = $db->prepare('
        INSERT INTO bsc_pessoa_cond_recurso_uso
        (
          status,
          dt_cadastro,
          bsc_pessoa_cond_fis_men_id,
          bsc_cond_recurso_uso_id
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
      $stmt->bindValue(3, $idNew);
      $stmt->bindValue(4, $v[0]);
      $stmt->execute();
    }
  }
  $db->commit();
      //MENSAGEM DE SUCESSO
  $result['id'] = $idNew;
  $result['status'] = 'success';
  $result['msg'] = 'As novas informações foram registradas com sucesso.';
  echo json_encode($result);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>