<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['up_id']?: '');
$status                                   = strip_tags(@$_POST['up_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$bsc_setor_publico_id                     = strip_tags(@$_POST['up_bsc_setor_publico_id']?: '');
$bsc_pessoa_id                            = strip_tags(@$_POST['up_bsc_pessoa_id']?: '');
$tableName      = 'bsc_uo_publica';
$error          = false;
$result         = array();
$msg            = "";
// sleep(10);
// $result = array(
//   'id'      => '',
//   'tipo'    => '',
//   'status' => 'succes',
//   'msg' => 'Dados pessoais do servidor atualizados com sucesso.'
// );
// echo json_encode(array('status' => 'success', 'msg' => 'As novas informações foram registradas com sucesso.'));
// exit();
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != "" && $id != 0 ) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.'
        SET
        status = ?,
        dt_cadastro = ?,
        bsc_setor_publico_id = ?,
        bsc_pessoa_id = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $bsc_setor_publico_id);
    $stmt->bindValue(4, $bsc_pessoa_id);
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
    $stmt = $db->prepare('
      SELECT 
      p.nome AS nome_pessoa, 
      sp.nome AS nome_setor_publico
      FROM '.$tableName.' AS tb 
      LEFT JOIN bsc_pessoa AS p ON p.id = tb.bsc_pessoa_id 
      LEFT JOIN bsc_setor_publico AS sp ON sp.id = tb.bsc_setor_publico_id 
      WHERE tb.bsc_pessoa_id = ? AND bsc_setor_publico_id = ?');
    $stmt->bindValue(1, $bsc_pessoa_id);
    $stmt->bindValue(2, $bsc_setor_publico_id);
    $stmt->execute();
    $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsExistente)) {
      $db->rollback();
      $existentes = '';
      $virgula = '';
      foreach ($rsExistente as $kObj => $vObj) {
        $existentes .= $virgula.'<br/>'.(ucwords($kObj)).': '.$vObj;
        $virgula = ', ';
      }
      $result['status'] = 'error';
      $result['tipo'] = 'existente';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um registro com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO '.$tableName.'
        (
          status,
          dt_cadastro,
          bsc_setor_publico_id,
          bsc_pessoa_id
          ) 
        VALUES
        (
          ?, 
          ?,
          ?,
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $bsc_setor_publico_id);
      $stmt->bindValue(4, $bsc_pessoa_id);
      $stmt->execute();
      $idNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $result['id'] = $idNew;
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