<?php
$db                                       = Conexao::getInstance();
$id                                       = @$_POST['sfct_sme_formac_contin_id']?: '';
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['sfct_sme_servidor_id']?: '');
$sme_formac_contin_curso_id               = @$_POST['sfct_sme_formac_contin_curso_id']?: '';
$c_h                                      = @$_POST['sfct_c_h']?: '';
$tableName      = 'sme_serv_formac_contin';
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
    if (!is_numeric($sme_formac_contin_curso_id[$kId])) {
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
            c_h = ?,
            sme_servidor_id = ?,
            sme_formac_contin_curso_id = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, trim(strip_tags($c_h[$kId]?: '')));
        $stmt->bindValue(4, $sme_servidor_id?: NULL);
        $stmt->bindValue(5, $sme_formac_contin_curso_id[$kId]?: NULL);
        $stmt->bindValue(6, $vId);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO '.$tableName.' 
          (
            status,
            dt_cadastro,
            c_h,
            sme_servidor_id,
            sme_formac_contin_curso_id
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
        $stmt->bindValue(3, trim(strip_tags($c_h[$kId]?: '')));
        $stmt->bindValue(4, $sme_servidor_id?: NULL);
        $stmt->bindValue(5, $sme_formac_contin_curso_id[$kId]?: NULL);
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