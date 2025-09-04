<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['i_id']?: '');
$status                                   = strip_tags(@$_POST['i_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['i_nome']?: ''))));
$ue_infraestrutura_tipo_id                = strip_tags(@$_POST['i_ue_infraestrutura_tipo_id']?: 0);
$tableName      = 'ue_infraestrutura';
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
        nome = ?,
        ue_infraestrutura_tipo_id = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $nome);
    $stmt->bindValue(4, $ue_infraestrutura_tipo_id);
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
      SELECT tb.nome, tb2.nome
      FROM '.$tableName.' AS tb 
      LEFT JOIN ue_infraestrutura_tipo AS tb2 ON tb2.id = tb.ue_infraestrutura_tipo_id
      WHERE tb.nome LIKE ? AND tb.ue_infraestrutura_tipo_id = ?');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $ue_infraestrutura_tipo_id);
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
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um banco registrado com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO '.$tableName.'
        (
          status,
          dt_cadastro,
          nome,
          ue_infraestrutura_tipo_id
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
      $stmt->bindValue(3, $nome);
      $stmt->bindValue(4, $ue_infraestrutura_tipo_id);
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