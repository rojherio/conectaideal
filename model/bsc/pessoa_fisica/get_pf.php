<?php
$db = Conexao::getInstance();
$nome = strip_tags(@$_POST['nome']);
$msg = array();
$mensagem = "";
try {
  $msg['itens'] = array();
  // if ($id != '' && $id != null) {
  $stmt = $db->prepare('SELECT 
    p.id, 
    CONCAT (p.nome, " (CPF.: ", p.cpf, ")") AS nome
    FROM bsc_pessoa AS p 
    WHERE p.tipo = 1 AND (p.nome LIKE ? OR p.cpf LIKE ?)
    ORDER BY p.nome;');
  $stmt->bindValue(1, ('%'.$nome.'%'));
  $stmt->bindValue(2, ('%'.$nome.'%'));
  $stmt->execute();
  $rsPesquisa = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($rsPesquisa) > 0 ) {
    foreach ($rsPesquisa as $kObj => $vObj) {
      array_push($msg['itens'], array('id'=> $vObj['id'], 'text'=> $vObj['nome']));
    }
  } else {
    array_push($msg['itens'], array('id'=> 0, 'text'=> 'Nenhum resultado encontrado'));
  }
  $msg['msg'] = 'success';
  echo json_encode($msg);
  exit();
} catch (PDOException $e) {
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao realizar a busca: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>