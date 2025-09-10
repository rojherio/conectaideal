<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['ect_id']?: '');
$status                                   = strip_tags(@$_POST['ect_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['ect_nome']?: ''))));
$descricao                                = trim(strip_tags(@$_POST['ect_descricao']?: ''));
$tableName      = 'ue_equip_comput_tipo';
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
        descricao = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $nome);
    $stmt->bindValue(4, $descricao);
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
      SELECT tb.nome
      FROM '.$tableName.' AS tb 
      WHERE tb.nome LIKE ?');
    $stmt->bindValue(1, $nome);
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
          descricao
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
      $stmt->bindValue(4, $descricao);
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