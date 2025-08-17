<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['pg_id']?: '');
$status                                   = strip_tags(@$_POST['pg_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(trim(strip_tags(@$_POST['pg_nome']?: '')));
$grau                                     = trim(strip_tags(@$_POST['pg_grau']?: ''));
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
      UPDATE bsc_parentesco_grau
        SET
        status = ?,
        dt_cadastro = ?,
        nome = ?,
        grau = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $nome);
    $stmt->bindValue(4, $grau);
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
      SELECT pg.id, pg.nome
      FROM bsc_parentesco_grau AS pg 
      WHERE pg.nome LIKE ?');
    $stmt->bindValue(1, $nome);
    $stmt->execute();
    $rsParentescoGrau = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsParentescoGrau)) {
      $db->rollback();
      $result['status'] = 'error';
      $existentes = '';
      if ($rsParentescoGrau['nome'] == $nome) {
        $existentes .= ('nome: '.$nome);
      }
      $result['tipo'] = 'grau de parentesco';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um grau de parentesco registrado com dados de ".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_parentesco_grau
        (
          status,
          dt_cadastro,
          nome,
          grau
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
      $stmt->bindValue(4, $grau);
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