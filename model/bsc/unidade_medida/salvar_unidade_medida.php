<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['um_id']?: '');
$status                                   = strip_tags(@$_POST['um_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['um_nome']?: ''))));
$simbolo                                  = trim(strip_tags(@$_POST['um_simbolo']?: ''));
$equivalencia                             = trim(strip_tags(@$_POST['um_equivalencia']?: ''));
$bsc_grandeza_id                          = strip_tags(@$_POST['um_bsc_grandeza_id']?: '');
$tableName      = 'bsc_unidade_medida';
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
        simbolo = ?,
        equivalencia = ?,
        bsc_grandeza_id = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $nome);
    $stmt->bindValue(4, $simbolo);
    $stmt->bindValue(5, $equivalencia);
    $stmt->bindValue(6, $bsc_grandeza_id);
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
      SELECT tb.nome, tb2.nome
      FROM '.$tableName.' AS tb 
      LEFT JOIN bsc_grandeza AS tb2 ON tb2.id = tb.bsc_grandeza_id
      WHERE tb.nome LIKE ? AND tb.bsc_grandeza_id = ?');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $bsc_grandeza_id);
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
          simbolo,
          equivalencia,
          bsc_grandeza_id
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
      $stmt->bindValue(3, $nome);
      $stmt->bindValue(4, $simbolo);
      $stmt->bindValue(5, $equivalencia);
      $stmt->bindValue(6, $bsc_grandeza_id);
      $stmt->execute();
      $idNew = $db->lastInsertId();
      // $senhaNome = strtolower(removeAcentos($nome));
      // $subSenhaNome = explode(' ',$senhaNome);
      // $subSenhaNome = array_values(array_diff($subSenhaNome, array('')));
      // $senhaNome = array_shift($subSenhaNome).'.'.array_pop($subSenhaNome);
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