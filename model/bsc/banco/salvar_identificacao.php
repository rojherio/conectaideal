<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['b_id']?: '');
$status                                   = strip_tags(@$_POST['b_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$codigo                                   = trim(strip_tags(@$_POST['b_codigo']?: ''));
$nome                                     = ucwords(trim(strip_tags(@$_POST['b_nome']?: '')));
$sigla                                    = ucwords(trim(strip_tags(@$_POST['b_sigla']?: '')));
$ispb                                     = trim(strip_tags(@$_POST['b_ispb']?: ''));
$tableName      = 'bsc_banco';
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
        codigo = ?,
        nome = ?,
        sigla = ?,
        ispb = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $codigo);
    $stmt->bindValue(4, $nome);
    $stmt->bindValue(5, $sigla);
    $stmt->bindValue(6, $ispb);
    $stmt->bindValue(7, $id);
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
      SELECT tb.nome, tb.sigla, tb.codigo, tb.ispb
      FROM '.$tableName.' AS tb 
      WHERE tb.nome LIKE ? OR tb.sigla LIKE ? OR tb.codigo LIKE ? OR tb.ispb LIKE ?;');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $sigla);
    $stmt->bindValue(3, $codigo);
    $stmt->bindValue(4, $ispb);
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
          codigo,
          nome,
          sigla,
          ispb
          ) 
        VALUES
        (
          ?, 
          ?, 
          ?, 
          ?, 
          ?,
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $codigo);
      $stmt->bindValue(4, $nome);
      $stmt->bindValue(5, $sigla);
      $stmt->bindValue(6, $ispb);
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