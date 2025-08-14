<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['p_id']);
$status                                   = strip_tags(@$_POST['p_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$tipo                                     = 2; //1 = pessoa física, 2 = pessoa jurídica
$nome                                     = ucwords(strip_tags(@$_POST['p_nome']?: ''));
$nome_social                               = ucwords(strip_tags(@$_POST['p_nome_social']?: ''));
$cpf                                      = strip_tags(@$_POST['p_cpf']?: '');
$ie                                       = strip_tags(@$_POST['p_ie']?: '');
$dt_criacao                               = strip_tags(@$_POST['p_dt_criacao']?: '');
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
      UPDATE bsc_pessoa 
        SET
        status = ?,
        dt_cadastro = ?,
        tipo = ?,
        nome = ?,
        nome_social = ?,
        cpf = ?,
        ie = ?,
        dt_criacao = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $tipo);
    $stmt->bindValue(4, $nome);
    $stmt->bindValue(5, $nome_social);
    $stmt->bindValue(6, $cpf);
    $stmt->bindValue(7, $ie);
    $stmt->bindValue(8, $dt_criacao?: NULL);
    $stmt->bindValue(9, $id);
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
      SELECT p.id, p.cpf
      FROM bsc_pessoa AS p 
      WHERE p.cpf LIKE ?;');
    $stmt->bindValue(1, $cpf);
    $stmt->execute();
    $rsPessoa = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsPessoa)) {
      $db->rollback();
      $result['status'] = 'error';
      $result['tipo'] = 'cnpj';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe uma pessoa jurídica registrada com o cnpj: ".$cpf.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_pessoa 
        (
          status,
          dt_cadastro,
          tipo,
          nome,
          nome_social,
          cpf,
          ie,
          dt_criacao
          ) 
        VALUES
        (
          ?, 
          ?, 
          ?, 
          ?, 
          ?, 
          ?, 
          ?, 
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro?: NULL);
      $stmt->bindValue(3, $tipo);
      $stmt->bindValue(4, $nome);
      $stmt->bindValue(5, $nome_social);
      $stmt->bindValue(6, $cpf);
      $stmt->bindValue(7, $ie);
      $stmt->bindValue(8, $dt_criacao?: NULL);
      $stmt->execute();
      $bscPessoaIdNew = $db->lastInsertId();
      // $senhaNome = strtolower(removeAcentos($nome));
      // $subSenhaNome = explode(' ',$senhaNome);
      // $subSenhaNome = array_values(array_diff($subSenhaNome, array('')));
      // $senhaNome = array_shift($subSenhaNome).'.'.array_pop($subSenhaNome);
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