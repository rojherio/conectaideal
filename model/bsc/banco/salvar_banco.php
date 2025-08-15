<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['b_id']?: '');
$status                                   = strip_tags(@$_POST['b_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$codigo                                   = trim(strip_tags(@$_POST['b_codigo']?: ''));
$nome                                     = ucwords(trim(strip_tags(@$_POST['b_nome']?: '')));
$nome_curto                               = ucwords(trim(strip_tags(@$_POST['b_nome_curto']?: '')));
$ispb                                     = trim(strip_tags(@$_POST['b_ispb']?: ''));
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
      UPDATE bsc_banco 
        SET
        status = ?,
        dt_cadastro = ?,
        codigo = ?,
        nome = ?,
        nome_curto = ?,
        ispb = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $codigo);
    $stmt->bindValue(4, $nome);
    $stmt->bindValue(5, $nome_curto);
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
      SELECT b.id, b.nome, b.nome_curto, b.codigo, b.ispb
      FROM bsc_banco AS b 
      WHERE b.nome LIKE ? OR b.nome_curto LIKE ? OR b.codigo LIKE ? OR b.ispb LIKE ?;');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $nome_curto);
    $stmt->bindValue(3, $codigo);
    $stmt->bindValue(4, $ispb);
    $stmt->execute();
    $rsBanco = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsBanco)) {
      $db->rollback();
      $result['status'] = 'error';
      $existentes = '';
      if ($rsBanco['nome'] == $nome) {
        $existentes .= ('nome: '.$nome);
      }
      if ($rsBanco['nome_curto'] == $nome_curto) {
        $existentes .= $existentes.(', nome curto: '.$nome_curto);
      }
      if ($rsBanco['codigo'] == $codigo) {
        $existentes .= $existentes.(', codigo: '.$codigo);
      }
      if ($rsBanco['ispb'] == $ispb) {
        $existentes .= $existentes.(', ispb: '.$ispb);
      }
      $result['tipo'] = 'banco';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um banco registrado com dados de ".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_banco 
        (
          status,
          dt_cadastro,
          codigo,
          nome,
          nome_curto,
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
      $stmt->bindValue(5, $nome_curto);
      $stmt->bindValue(6, $ispb);
      $stmt->execute();
      $bscPessoaIdNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $result['id'] = $bscPessoaIdNew;
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