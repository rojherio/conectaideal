<?php
$db                                       = Conexao::getInstance();
$id                                       = @$_POST['so_sme_servidor_obs_id']?: '';
$status                                   = @$_POST['so_status']?: 0;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['so_sme_servidor_id']?: '');
$dt_ocorrido                              = @$_POST['so_dt_ocorrido']?: '';
$descricao                                = @$_POST['so_descricao']?: '';
$tableName      = 'sme_serv_obs';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  //consulta registros existente para comparar com $_POST
  $stmt = $db->prepare('
    SELECT 
    tb.id
    FROM '.$tableName.' AS tb 
    WHERE tb.sme_servidor_id = ?;');
  $stmt->bindValue(1, $sme_servidor_id);
  $stmt->execute();
  $rsRegistroOlds = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //deleta registros DB removidos na página
  if ($rsRegistroOlds) {
    foreach ($rsRegistroOlds as $keyOld => $objOld) {
      if(!in_array($objOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE 
            FROM '.$tableName.'
            WHERE id = ?');
        $stmt->bindValue(1, $objOld['id']);
        $stmt->execute();
      }
    }
  }
  //atualiza ou insere registros vindos da página
  foreach ($id as $kId => $vId) {
    If ($descricao[$kId] == ''){
      $stmt = $db->prepare('
        DELETE 
          FROM '.$tableName.'
          WHERE id = ?');
      $stmt->bindValue(1, $vId);
      $stmt->execute();
    } else {
      if (is_numeric($vId) && $vId != 0 ) {
        $stmt = $db->prepare('
          UPDATE '.$tableName.' 
            SET
            status = ?,
            dt_cadastro = ?,
            sme_servidor_id = ?,
            dt_ocorrido = ?,
            descricao = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, $dt_ocorrido[$kId]?: NULL);
        $stmt->bindValue(5, trim(strip_tags($descricao[$kId])));
        $stmt->bindValue(6, $vId);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO '.$tableName.' 
          (
            status,
            dt_cadastro,
            sme_servidor_id,
            dt_ocorrido,
            descricao
            ) 
          VALUES
          (
            ?, 
            ?, 
            ?, 
            ?, 
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, $dt_ocorrido[$kId]?: NULL);
        $stmt->bindValue(5, trim(strip_tags($descricao[$kId])));
        $stmt->execute();
      }
    }
  }
  $db->commit();
  //MENSAGEM DE SUCESSO
  // $result['id'] = $id;
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