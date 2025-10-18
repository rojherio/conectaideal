<?php
$db                                       = Conexao::getInstance();
$id                                       = @$_POST['ss_sme_serv_saude_id']?: '';
$status                                   = @$_POST['ss_status']?: 0;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['ss_sme_servidor_id']?: '');
$dt_ocorrido                              = @$_POST['ss_dt_ocorrido']?: '';
$descricao                                = @$_POST['ss_descricao']?: '';
$dt_inicio                                = @$_POST['ss_dt_inicio']?: '';
$dt_fim                                   = @$_POST['ss_dt_fim']?: '';
$tableName      = 'sme_serv_saude';
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
            descricao = ?,
            dt_inicio = ?,
            dt_fim = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, $dt_ocorrido?: NULL);
        $stmt->bindValue(5, $descricao);
        $stmt->bindValue(6, $dt_inicio?: NULL);
        $stmt->bindValue(7, $dt_fim?: NULL);
        $stmt->bindValue(8, $vId);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO '.$tableName.' 
          (
            status,
            dt_cadastro,
            sme_servidor_id,
            dt_ocorrido,
            descricao,
            dt_inicio,
            dt_fim
            ) 
          VALUES
          (
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
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, $dt_ocorrido[$kId]?: NULL);
        $stmt->bindValue(5, trim(strip_tags($descricao[$kId])));
        $stmt->bindValue(6, $dt_inicio[$kId]?: NULL);
        $stmt->bindValue(7, $dt_fim[$kId]?: NULL);
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