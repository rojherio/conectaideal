<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['bct_id']?: '');
$status                                   = strip_tags(@$_POST['bct_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(trim(strip_tags(@$_POST['bct_nome']?: '')));
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
      UPDATE bsc_banco_conta_tipo
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
      SELECT bct.id, bct.nome
      FROM bsc_banco_conta_tipo AS bct 
      WHERE bct.nome LIKE ?');
    $stmt->bindValue(1, $nome);
    $stmt->execute();
    $rsBancoContaTipo = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsBancoContaTipo)) {
      $db->rollback();
      $result['status'] = 'error';
      $existentes = '';
      if ($rsBancoContaTipo['nome'] == $nome) {
        $existentes .= ('nome: '.$nome);
      }
      $result['tipo'] = 'banco';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um banco registrado com dados de ".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_banco_conta_tipo
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