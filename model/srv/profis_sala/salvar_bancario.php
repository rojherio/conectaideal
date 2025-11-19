<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['sb_id']);
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['sb_sme_servidor_id']?: '');
$bsc_banco_conta_tipo_id                  = strip_tags(@$_POST['sb_bsc_banco_conta_tipo_id']?: '');
$bsc_banco_id                             = strip_tags(@$_POST['sb_bsc_banco_id']?: '');
$agencia                                  = trim(strip_tags(@$_POST['sb_agencia']?: ''));
$conta                                    = trim(strip_tags(@$_POST['sb_conta']?: ''));
$op                                       = trim(strip_tags(@$_POST['sb_op']?: ''));
$tableName      = 'sme_serv_bancario';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != 0 ) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        status = ?,
        dt_cadastro = ?,
        sme_servidor_id = ?,
        bsc_banco_conta_tipo_id = ?,
        bsc_banco_id = ?,
        agencia = ?,
        conta = ?,
        op = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $sme_servidor_id?: NULL);
    $stmt->bindValue(4, $bsc_banco_conta_tipo_id?: NULL);
    $stmt->bindValue(5, $bsc_banco_id?: NULL);
    $stmt->bindValue(6, $agencia);
    $stmt->bindValue(7, $conta);
    $stmt->bindValue(8, $op);
    $stmt->bindValue(9, $id);
    $stmt->execute();
    $db->commit();
      //MENSAGEM DE SUCESSO
    $result['id'] = $id;
    $result['status'] = 'success';
    $result['msg'] = 'As novas informações foram registradas com sucesso.';
    echo json_encode($result);
    exit();
  } else {
    $stmt = $db->prepare('INSERT INTO '.$tableName.' 
      (
        status,
        dt_cadastro,
        sme_servidor_id,
        bsc_banco_conta_tipo_id,
        bsc_banco_id,
        agencia,
        conta,
        op
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
        ?
      )');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $sme_servidor_id?: NULL);
    $stmt->bindValue(4, $bsc_banco_conta_tipo_id?: NULL);
    $stmt->bindValue(5, $bsc_banco_id?: NULL);
    $stmt->bindValue(6, $agencia);
    $stmt->bindValue(7, $conta);
    $stmt->bindValue(8, $op);
    $stmt->execute();
    $idNew = $db->lastInsertId();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $result['id'] = $idNew;
    $result['status'] = 'success';
    $result['msg'] = 'As novas informações foram registradas com sucesso.';
    echo json_encode($result);
    exit();
  // }
  }
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>