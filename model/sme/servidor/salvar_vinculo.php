<?php
$db                                       = Conexao::getInstance();
$id                                       = @$_POST['sv_sme_serv_vinculo_id']?: '';
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['sv_sme_servidor_id']?: '');
$local                                    = @$_POST['sv_local']?: '';
$bsc_esfera_administrativa_id             = @$_POST['sv_bsc_esfera_administrativa_id']?: '';
$cargo                                    = @$_POST['sv_cargo']?: '';
$carga_horaria                            = @$_POST['sv_carga_horaria']?: '';
$cursando                                 = array();
$tableName      = 'sme_serv_vinculo';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  //consulta registros existente para comparar com $_POST
  $stmt = $db->prepare('
    SELECT 
    tb.id
    FROM '.$tableName.' AS tb 
    WHERE tb.sme_servidor_id = ?;');
  $stmt->bindValue(1, $sme_servidor_id);
  $stmt->execute();
  $rsRegistroOlds = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //deleta registros DB removidos na página
  if ($rsRegistroOlds) {
    foreach ($rsRegistroOlds as $keyOld => $objOld) {
      if(!in_array($objOld['id'], $id)) {
        $stmt = $db->prepare('
          DELETE 
            FROM '.$tableName.'
            WHERE id = ?');
        $stmt->bindValue(1, $objOld['id']);
        $stmt->execute();
      }
    }
  }
  //atualiza ou insere registros vindos da página
  foreach ($id as $kId => $vId) {
    if ($local[$kId] == ''){
      $stmt = $db->prepare('
        DELETE 
          FROM '.$tableName.'
          WHERE id = ?');
      $stmt->bindValue(1, $vId);
      $stmt->execute();
    } else {
      if (is_numeric($vId) && $vId != 0 ) {
        $stmt = $db->prepare('
          UPDATE '.$tableName.' 
            SET
            status = ?,
            dt_cadastro = ?,
            sme_servidor_id = ?,
            local = ?,
            bsc_esfera_administrativa_id = ?,
            cargo = ?,
            carga_horaria = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, trim(strip_tags($local[$kId]?: '')));
        $stmt->bindValue(5, $bsc_esfera_administrativa_id[$kId]?: NULL);
        $stmt->bindValue(6, trim(strip_tags($cargo[$kId]?: '')));
        $stmt->bindValue(7, trim(strip_tags($carga_horaria[$kId]?: '')));
        $stmt->bindValue(8, $vId);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO '.$tableName.' 
          (
            status,
            dt_cadastro,
            sme_servidor_id,
            local,
            bsc_esfera_administrativa_id,
            cargo,
            carga_horaria
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
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, trim(strip_tags($local[$kId]?: '')));
        $stmt->bindValue(5, $bsc_esfera_administrativa_id[$kId]?: NULL);
        $stmt->bindValue(6, trim(strip_tags($cargo[$kId]?: '')));
        $stmt->bindValue(7, trim(strip_tags($carga_horaria[$kId]?: '')));
        $stmt->execute();
      }
    }
  }
  $db->commit();
  //MENSAGEM DE SUCESSO
  // $result['id'] = $id;
  $result['status'] = 'success';
  $result['msg'] = 'As novas informações foram registradas com sucesso.';
  echo json_encode($result);
  exit();
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>