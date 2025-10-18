<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['pa_id']?: '');
$status                                   = strip_tags(@$_POST['pa_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['pa_nome']?: ''))));
$descricao                                = trim(strip_tags(@$_POST['pa_descricao']?: ''));
$pasta                                    = trim(strip_tags(@$_POST['pa_pasta']?: ''));
$caminho                                  = trim(strip_tags(@$_POST['pa_caminho']?: ''));
$seg_pasta_id                             = strip_tags(@$_POST['pa_seg_pasta_id']?: '');
$tableName      = 'seg_pagina';
$error          = false;
$result         = array();
$msg            = "";
// echo json_encode(array('status' => 'success', 'msg' => 'As novas informações foram registradas com sucesso.'));
// exit();
try {
  $db->beginTransaction();
  $stmt = $db->prepare('
    SELECT tb.nome, tb2.nome
    FROM '.$tableName.' AS tb 
    LEFT JOIN seg_pasta AS tb2 ON tb2.id = tb.seg_pasta_id
    WHERE tb.id <> ? AND (tb.nome LIKE ? AND tb.seg_pasta_id = ?);');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $nome);
  $stmt->bindValue(3, $seg_pasta_id);
  $stmt->execute();
  $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
  if (is_array($rsExistente)) {
    $db->rollback();
    $existentes = '';
    $virgula = '';
    foreach ($rsExistente as $kObj => $vObj) {
      $existentes .= $virgula.'<br/>'.htmlentities(ucwords($kObj)).': '.$vObj;
      $virgula = ', ';
    }
    $result['status'] = 'error';
    $result['tipo'] = 'existente';
    $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um registro com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
    echo json_encode($result);
    exit();
  } else {
    if (is_numeric($id) && $id != 0) {
      $stmt = $db->prepare('
        UPDATE '.$tableName.'
          SET
          status = ?,
          dt_cadastro = ?,
          nome = ?,
          descricao = ?,
          pasta = ?,
          caminho = ?,
          seg_pasta_id = ?
          WHERE id = ?
          ');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $nome);
      $stmt->bindValue(4, $descricao);
      $stmt->bindValue(5, $pasta);
      $stmt->bindValue(6, $caminho);
      $stmt->bindValue(7, $seg_pasta_id? : NULL);
      $stmt->bindValue(8, $id);
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
          nome,
          descricao,
          pasta,
          caminho,
          seg_pasta_id
          ) 
        VALUES
        (
          ?, 
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
      $stmt->bindValue(4, $descricao);
      $stmt->bindValue(5, $pasta);
      $stmt->bindValue(6, $caminho);
      $stmt->bindValue(7, $seg_pasta_id? : NULL);
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