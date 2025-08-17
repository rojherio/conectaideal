<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['ec_id']?: '');
$status                                   = strip_tags(@$_POST['ec_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['ec_nome']?: ''))));
$exige_registro                           = strip_tags(@$_POST['ec_exige_registro']?: 0);
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
      UPDATE bsc_estado_civil
        SET
        status = ?,
        dt_cadastro = ?,
        nome = ?,
        exige_registro = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $nome);
    $stmt->bindValue(4, $exige_registro);
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
      SELECT ec.id, ec.nome
      FROM bsc_estado_civil AS ec 
      WHERE ec.nome LIKE ?');
    $stmt->bindValue(1, $nome);
    $stmt->execute();
    $rsEstadoCivil = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsEstadoCivil)) {
      $db->rollback();
      $result['status'] = 'error';
      $existentes = '';
      if ($rsEstadoCivil['nome'] == $nome) {
        $existentes .= ('nome: '.$nome);
      }
      $result['tipo'] = 'estado civil';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um estado civil registrado com dados de ".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_estado_civil
        (
          status,
          dt_cadastro,
          nome,
          exige_registro
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
      $stmt->bindValue(4, $exige_registro);
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