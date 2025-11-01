<?php
$db                                       = Conexao::getInstance();
$status                                   = 1;
$id                                       = strip_tags(@$_POST['ue_id']?: '');
$dt_cadastro                              = date("Y-m-d H:i:s");
$parceria_see                             = @$_POST['ue_parceria_see']?: 0;
$parceria_sme                             = @$_POST['ue_parceria_sme']?: 0;
//POST Tables Terciarias
$ue_ue_inst_parc_conv_id                  = @$_POST['ue_ue_inst_parc_conv_id'];
$ue_bsc_uo_publica_id_vinc                = @$_POST['ue_bsc_uo_publica_id_vinc'];
$tableName      = 'ue_ue';
$error          = false;
$result         = array();
$msg            = "";
// $result['status'] = 'error';
// $result['tipo'] = 'id';
// $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois o código Id não foi recebido corretamente.";
// echo json_encode($result);
// exit();
try {
  $db->beginTransaction();
  // UPDATE ue_ue - BEGIN
  if (is_numeric($id) && $id != 0) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        dt_cadastro = ?,
        parceria_see = ?,
        parceria_sme = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $dt_cadastro?: NULL);
    $stmt->bindValue(2, $parceria_see);
    $stmt->bindValue(3, $parceria_sme);
    $stmt->bindValue(4, $id);
    $stmt->execute();
    // DELETE UPDATE INSERT ue_ue_inst_parc_conv - BEGIN
    // Busca antigos
    $stmt = $db->prepare('
      SELECT 
      tb.id
      FROM ue_ue_inst_parc_conv AS tb 
      WHERE tb.ue_ue_id = ?;');
    $stmt->bindValue(1, $id);
    $stmt->execute();
    $rsRegistroOlds = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($rsRegistroOlds) {
      foreach ($rsRegistroOlds as $keyOld => $objOld) {
        $idx        = array_search($objOld['id'], $ue_ue_inst_parc_conv_id);
        $idxValido  = (($idx >= 0 && is_numeric($idx)) ? (is_numeric($ue_bsc_uo_publica_id_vinc[$idx]) ? ($ue_bsc_uo_publica_id_vinc[$idx] > 0 ? true : false) : false) : false);
        if(!in_array($objOld['id'], $ue_ue_inst_parc_conv_id) || !$idxValido) {
          // Registro removido na página - DELETE CASCADE
          $stmt = $db->prepare('
            SELECT 
            tb.id
            FROM ue_ue_isnt_parc_conv_forma AS tb 
            WHERE tb.ue_ue_inst_parc_conv_id = ?;');
          $stmt->bindValue(1, $objOld['id']);
          $stmt->execute();
          $rsRegistroOldSubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($rsRegistroOldSubs as $keyOldSub => $objOldSub) {
            $stmt = $db->prepare('
              DELETE 
                FROM ue_ue_inst_parc_conv_ens_atend_tipo
                WHERE ue_ue_isnt_parc_conv_forma_id = ?');
            $stmt->bindValue(1, $objOldSub['id']);
            $stmt->execute();
            $stmt = $db->prepare('
              DELETE 
                FROM ue_ue_inst_parc_conv_ens_modalidade_etapa
                WHERE ue_ue_isnt_parc_conv_forma_id = ?');
            $stmt->bindValue(1, $objOldSub['id']);
            $stmt->execute();
            $stmt = $db->prepare('
              DELETE 
                FROM ue_ue_inst_parc_conv_ens_profis_forma
                WHERE ue_ue_isnt_parc_conv_forma_id = ?');
            $stmt->bindValue(1, $objOldSub['id']);
            $stmt->execute();
          }
          $stmt = $db->prepare('
            DELETE 
              FROM ue_ue_isnt_parc_conv_forma
              WHERE ue_ue_inst_parc_conv_id = ?');
          $stmt->bindValue(1, $objOld['id']);
          $stmt->execute();
          $stmt = $db->prepare('
            DELETE 
              FROM ue_ue_inst_parc_conv
              WHERE id = ?');
          $stmt->bindValue(1, $objOld['id']);
          $stmt->execute();
        }
      }
    }
    // Verifica id == 0
    $stmt = $db->prepare("SELECT 
      eat.id
      FROM ue_ens_atend_tipo AS eat
      WHERE 1 = 1;");
    $stmt->execute();
    $rsUeeat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $db->prepare("SELECT 
      eme.id
      FROM ue_ens_modalidade_etapa AS eme
      WHERE 1 = 1;");
    $stmt->execute();
    $rsUeeme = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt = $db->prepare("SELECT 
      epf.id
      FROM ue_ens_profis_forma AS epf
      WHERE 1 = 1;");
    $stmt->execute();
    $rsUeepf = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($ue_ue_inst_parc_conv_id as $ueueipcKey => $ueueipcId) {
      $ue_ue_isnt_parc_conv_forma_id  = @$_POST['ue_ue_isnt_parc_conv_forma_id_'.$ueueipcKey];
      $ue_ue_parc_conv_forma_id       = @$_POST['ue_ue_parc_conv_forma_id_'.$ueueipcKey];
      if (is_numeric($ueueipcId) && $ueueipcId > 0 && is_numeric($ue_bsc_uo_publica_id_vinc[$ueueipcKey]) && $ue_bsc_uo_publica_id_vinc[$ueueipcKey] > 0) {
        $stmt = $db->prepare('
          UPDATE ue_ue_inst_parc_conv 
            SET
            status = ?,
            dt_cadastro = ?,
            descricao = ?,
            ue_ue_id = ?,
            bsc_uo_publica_id = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, 1);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, '');
        $stmt->bindValue(4, $id);
        $stmt->bindValue(5, $ue_bsc_uo_publica_id_vinc[$ueueipcKey]);
        $stmt->bindValue(6, $ueueipcId);
        $stmt->execute();
        // DELETE UPDATE INSERT ue_ue_inst_parc_conv - BEGIN
        // Busca antigos
        $stmt = $db->prepare('
          SELECT 
          tb.id
          FROM ue_ue_isnt_parc_conv_forma AS tb 
          WHERE tb.ue_ue_inst_parc_conv_id = ?;');
        $stmt->bindValue(1, $ueueipcId);
        $stmt->execute();
        $rsRegistroOlds = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($rsRegistroOlds) {
          foreach ($rsRegistroOlds as $keyOld => $objOld) {
            $idx        = array_search($objOld['id'], $ue_ue_isnt_parc_conv_forma_id);
            $idxValido  = (($idx >= 0 && is_numeric($idx)) ? (is_numeric($ue_ue_parc_conv_forma_id[$idx]) ? ($ue_ue_parc_conv_forma_id[$idx] > 0 ? true : false) : false) : false);
            if(!in_array($objOld['id'], $ue_ue_isnt_parc_conv_forma_id) || !$idxValido) {
              // Registro removido na página - DELETE CASCADE
              $stmt = $db->prepare('
                DELETE 
                  FROM ue_ue_inst_parc_conv_ens_atend_tipo
                  WHERE ue_ue_isnt_parc_conv_forma_id = ?');
              $stmt->bindValue(1, $objOld['id']);
              $stmt->execute();
              $stmt = $db->prepare('
                DELETE 
                  FROM ue_ue_inst_parc_conv_ens_modalidade_etapa
                  WHERE ue_ue_isnt_parc_conv_forma_id = ?');
              $stmt->bindValue(1, $objOld['id']);
              $stmt->execute();
              $stmt = $db->prepare('
                DELETE 
                  FROM ue_ue_inst_parc_conv_ens_profis_forma
                  WHERE ue_ue_isnt_parc_conv_forma_id = ?');
              $stmt->bindValue(1, $objOld['id']);
              $stmt->execute();
              $stmt = $db->prepare('
                DELETE 
                  FROM ue_ue_isnt_parc_conv_forma
                  WHERE id = ?');
              $stmt->bindValue(1, $objOld['id']);
              $stmt->execute();
            }
          }
        }
        foreach ($ue_ue_isnt_parc_conv_forma_id as $ueueipcfKey => $ueueipcfId) {
          if (is_numeric($ueueipcfId) && $ueueipcfId > 0 && is_numeric($ue_ue_parc_conv_forma_id[$ueueipcfKey]) && $ue_ue_parc_conv_forma_id[$ueueipcfKey] > 0) {
            // UPDATE ue_ue_isnt_parc_conv_forma
            $stmt = $db->prepare('
              UPDATE ue_ue_isnt_parc_conv_forma 
                SET
                status = ?,
                dt_cadastro = ?,
                descricao = ?,
                ue_parc_conv_forma_id = ?,
                ue_ue_inst_parc_conv_id = ?
                WHERE id = ?
                ');
            $stmt->bindValue(1, 1);
            $stmt->bindValue(2, $dt_cadastro?: NULL);
            $stmt->bindValue(3, '');
            $stmt->bindValue(4, $ue_ue_parc_conv_forma_id[$ueueipcfKey]);
            $stmt->bindValue(5, $ueueipcId);
            $stmt->bindValue(6, $ueueipcfId);
            $stmt->execute();
            $stmt = $db->prepare('
              DELETE 
                FROM ue_ue_inst_parc_conv_ens_atend_tipo
                WHERE ue_ue_isnt_parc_conv_forma_id = ?');
            $stmt->bindValue(1, $ueueipcfId);
            $stmt->execute();
            $stmt = $db->prepare('
              DELETE 
                FROM ue_ue_inst_parc_conv_ens_modalidade_etapa
                WHERE ue_ue_isnt_parc_conv_forma_id = ?');
            $stmt->bindValue(1, $ueueipcfId);
            $stmt->execute();
            $stmt = $db->prepare('
              DELETE 
                FROM ue_ue_inst_parc_conv_ens_profis_forma
                WHERE ue_ue_isnt_parc_conv_forma_id = ?');
            $stmt->bindValue(1, $ueueipcfId);
            $stmt->execute();
            foreach ($rsUeeat as $ueeatKey => $ueeatObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_atend_tipo
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_atend_tipo_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_eat_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueeatObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueeatObj['id']);
              $stmt->bindValue(6, $ueueipcfId);
              $stmt->execute();
            }
            foreach ($rsUeeme as $ueemeKey => $ueemeObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_modalidade_etapa
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_modalidade_etapa_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_eme_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueemeObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueemeObj['id']);
              $stmt->bindValue(6, $ueueipcfId);
              $stmt->execute();
            }
            foreach ($rsUeepf as $ueepfKey => $ueepfObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_profis_forma
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_profis_forma_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_epf_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueepfObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueepfObj['id']);
              $stmt->bindValue(6, $ueueipcfId);
              $stmt->execute();
            }
          } else if (is_numeric($ue_ue_parc_conv_forma_id[$ueueipcfKey]) && $ue_ue_parc_conv_forma_id[$ueueipcfKey] > 0) {
            // INSERT ue_ue_isnt_parc_conv_forma
            $stmt = $db->prepare('
              INSERT INTO ue_ue_isnt_parc_conv_forma
              (
                status,
                dt_cadastro,
                descricao,
                ue_parc_conv_forma_id,
                ue_ue_inst_parc_conv_id
                )
              VALUES
              (
                ?,
                ?,
                ?,
                ?,
                ?
              );');
            $stmt->bindValue(1, 1);
            $stmt->bindValue(2, $dt_cadastro?: NULL);
            $stmt->bindValue(3, '');
            $stmt->bindValue(4, $ue_ue_parc_conv_forma_id[$ueueipcfKey]);
            $stmt->bindValue(5, $ueueipcId);
            $stmt->execute();
            $idLast = $db->lastInsertId();
            foreach ($rsUeeat as $ueeatKey => $ueeatObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_atend_tipo
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_atend_tipo_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_eat_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueeatObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueeatObj['id']);
              $stmt->bindValue(6, $idLast);
              $stmt->execute();
            }
            foreach ($rsUeeme as $ueemeKey => $ueemeObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_modalidade_etapa
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_modalidade_etapa_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_eme_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueemeObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueemeObj['id']);
              $stmt->bindValue(6, $idLast);
              $stmt->execute();
            }
            foreach ($rsUeepf as $ueepfKey => $ueepfObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_profis_forma
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_profis_forma_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_epf_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueepfObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueepfObj['id']);
              $stmt->bindValue(6, $idLast);
              $stmt->execute();
            }
          }
        }
      } else if (is_numeric($ue_bsc_uo_publica_id_vinc[$ueueipcKey]) && $ue_bsc_uo_publica_id_vinc[$ueueipcKey] > 0) {
        // INSERT ue_ue_inst_parc_conv
        $stmt = $db->prepare('
          INSERT INTO ue_ue_inst_parc_conv
          (
            status,
            dt_cadastro,
            descricao,
            ue_ue_id,
            bsc_uo_publica_id
            )
          VALUES
          (
            ?,
            ?,
            ?,
            ?,
            ?
          );');
        $stmt->bindValue(1, 1);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, '');
        $stmt->bindValue(4, $id);
        $stmt->bindValue(5, $ue_bsc_uo_publica_id_vinc[$ueueipcKey]);
        $stmt->execute();
        $idLastUeipc = $db->lastInsertId();
        foreach ($ue_ue_isnt_parc_conv_forma_id as $ueueipcfKey => $ueueipcfId) {
          if (is_numeric($ue_ue_parc_conv_forma_id[$ueueipcfKey]) && $ue_ue_parc_conv_forma_id[$ueueipcfKey] > 0) {
            // INSERT ue_ue_isnt_parc_conv_forma
            $stmt = $db->prepare('
              INSERT INTO ue_ue_isnt_parc_conv_forma
              (
                status,
                dt_cadastro,
                descricao,
                ue_parc_conv_forma_id,
                ue_ue_inst_parc_conv_id
                )
              VALUES
              (
                ?,
                ?,
                ?,
                ?,
                ?
              );');
            $stmt->bindValue(1, 1);
            $stmt->bindValue(2, $dt_cadastro?: NULL);
            $stmt->bindValue(3, '');
            $stmt->bindValue(4, $ue_ue_parc_conv_forma_id[$ueueipcfKey]);
            $stmt->bindValue(5, $idLastUeipc);
            $stmt->execute();
            $idLastUeipcf = $db->lastInsertId();
            foreach ($rsUeeat as $ueeatKey => $ueeatObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_atend_tipo
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_atend_tipo_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_eat_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueeatObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueeatObj['id']);
              $stmt->bindValue(6, $idLastUeipcf);
              $stmt->execute();
            }
            foreach ($rsUeeme as $ueemeKey => $ueemeObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_modalidade_etapa
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_modalidade_etapa_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_eme_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueemeObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueemeObj['id']);
              $stmt->bindValue(6, $idLastUeipcf);
              $stmt->execute();
            }
            foreach ($rsUeepf as $ueepfKey => $ueepfObj) {
              $stmt = $db->prepare(' INSERT INTO ue_ue_inst_parc_conv_ens_profis_forma
                ( status, dt_cadastro, matricula_qtd, descricao, ue_ens_profis_forma_id, ue_ue_isnt_parc_conv_forma_id )
                VALUES ( ?, ?, ?, ?, ?, ? );');
              $stmt->bindValue(1, 1);
              $stmt->bindValue(2, $dt_cadastro?: NULL);
              $stmt->bindValue(3, @$_POST['ue_ue_pcf_epf_matricula_qtd_'.$ueueipcKey.'_'.$ueueipcfKey.'_'.$ueepfObj['id']]?: NULL);
              $stmt->bindValue(4, '');
              $stmt->bindValue(5, $ueepfObj['id']);
              $stmt->bindValue(6, $idLastUeipcf);
              $stmt->execute();
            }
          }
        }
      }
    }
    $db->commit();
    //MENSAGEM DE SUCESSO
    $result['id'] = $id;
    $result['status'] = 'success';
    $result['msg'] = 'As novas informações foram registradas com sucesso.';
    echo json_encode($result);
    exit();
  } else {
    $result['status'] = 'error';
    $result['tipo'] = 'id';
    $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois o código Id não foi recebido corretamente.";
    echo json_encode($result);
    exit();
  }
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>