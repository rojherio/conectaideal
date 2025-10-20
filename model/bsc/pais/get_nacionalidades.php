<?php
$db = Conexao::getInstance();
$nome = strip_tags(@$_POST['nome']);
$msg = array();
$mensagem = "";
try {
  $msg['itens'] = array();
  $stmt = $db->prepare("
    SELECT 
    p.id, 
    CONCAT(p.nome, ' - ', p.nacionalidade) AS nome
    FROM  bsc_pais AS p 
    WHERE 
      CONCAT(p.nome, ' - ', p.nacionalidade) LIKE ? 
      OR p.nome LIKE ? 
      OR p.nacionalidade LIKE ?
    ORDER BY id;");
  $stmt->bindValue(1, ($nome.'%'));
  $stmt->bindValue(2, ($nome.'%'));
  $stmt->bindValue(3, ($nome.'%'));
  $stmt->execute();
  $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($rsMunicipios) > 0 ) {
    foreach ($rsMunicipios as $kObj => $vObj) {
      array_push($msg['itens'], array('id'=> $vObj['id'], 'text'=> $vObj['nome']));
    }
  } else {
    array_push($msg['itens'], array('id'=> 0, 'text'=> 'Nenhum País/Nacionalidade encontrado para a busca efetuada'));
  }
  $msg['msg'] = 'success';
  echo json_encode($msg);
  exit();
} catch (PDOException $e) {
  $msg['msg'] = 'error';
  $msg['retorno'] = "Erro ao tentar buscar os Países/Nacionalidades: " . $e->getMessage();
  echo json_encode($msg);
  exit();
}
?>