<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['ps_id']);
$status                                   = strip_tags(@$_POST['ps_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$cod_inep                                 = trim(strip_tags(@$_POST['ps_cod_inep']?: ''));
$sme_servidor_id                          = strip_tags(@$_POST['ps_sme_servidor_id']?: '');
$tableName      = 'srv_profis_sala';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  $stmt = $db->prepare('
    SELECT p.nome AS "Nome do servidor"
    FROM '.$tableName.' AS tb 
    LEFT JOIN sme_servidor AS s ON s.id = tb.sme_servidor_id
    LEFT JOIN bsc_pessoa AS p ON p.id = s.bsc_pessoa_id
    WHERE tb.id <> ? AND (tb.sme_servidor_id = ?);');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $sme_servidor_id);
  $stmt->execute();
  $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($rsExistente) {
    $db->rollback();
    $existentes = '';
    $virgula = '';
    foreach ($rsExistente as $kObj => $vObj) {
      $existentes .= $virgula.'<br/>'.htmlentities($kObj).': '.$vObj;
      $virgula = ', ';
    }
    $result['status'] = 'error';
    $result['tipo'] = 'existente';
    $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe registrado com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
    echo json_encode($result);
    exit();
  } else {
    if (is_numeric($id) && $id != 0) {
      $stmt = $db->prepare('
        UPDATE '.$tableName.' 
          SET
          status = ?,
          dt_cadastro = ?,
          cod_inep = ?,
          sme_servidor_id = ?
          WHERE id = ?
          ');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro?: NULL);
      $stmt->bindValue(3, $cod_inep);
      $stmt->bindValue(4, $sme_servidor_id?: NULL);
      $stmt->bindValue(5, $id);
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
          cod_inep,
          sme_servidor_id
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
      $stmt->bindValue(3, $cod_inep);
      $stmt->bindValue(4, $sme_servidor_id?: NULL);
      $stmt->execute();
      $id = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $result['id'] = $id;
      $result['status'] = 'success';
      $result['msg'] = 'As novas informações foram registradas com sucesso.';
      echo json_encode($result);
      exit();
    }
  }
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>