<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['g_id']?: '');
$status                                   = strip_tags(@$_POST['g_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(trim(strip_tags(@$_POST['g_nome']?: '')));
$error = false;
$result = array();
$msg = "";
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
      UPDATE bsc_grandeza
        SET
        status = ?,
        dt_cadastro = ?,
        nome = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $nome);
    $stmt->bindValue(4, $id);
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
      SELECT g.id, g.nome
      FROM bsc_grandeza AS g 
      WHERE g.nome LIKE ?');
    $stmt->bindValue(1, $nome);
    $stmt->execute();
    $rsGrandeza = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsGrandeza)) {
      $db->rollback();
      $result['status'] = 'error';
      $existentes = '';
      if ($rsGrandeza['nome'] == $nome) {
        $existentes .= ('nome: '.$nome);
      }
      $result['tipo'] = 'grandeza';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe grandeza registrada com dados de ".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_grandeza
        (
          status,
          dt_cadastro,
          nome
          ) 
        VALUES
        (
          ?, 
          ?, 
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $nome);
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