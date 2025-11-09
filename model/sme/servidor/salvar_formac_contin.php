<?php
$db                                       = Conexao::getInstance();
$id                                       = @$_POST['si_sme_serv_instrucao_id']?: '';
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['si_sme_servidor_id']?: '');
$bsc_escolaridade_id                      = @$_POST['si_bsc_escolaridade_id']?: '';
$formacao                                 = @$_POST['si_formacao']?: '';
$conclusao_ano                            = @$_POST['si_conclusao_ano']?: '';
$c_h                                      = @$_POST['si_c_h']?: '';
$cursando                                 = array();
//tratamento especial para checkbox
foreach ($id as $k => $v) {
  $cursando[$k] = @$_POST['si_cursando_'.($k+1)]?: 0;
}
$tableName      = 'sme_serv_instrucao';
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
    if (!is_numeric($bsc_escolaridade_id[$kId])) {
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
            bsc_escolaridade_id = ?,
            formacao = ?,
            conclusao_ano = ?,
            cursando = ?,
            c_h = ?,
            inst_sup_cod_inep = ?,
            bsc_ens_med_tipo_id = ?,
            bsc_ens_sup_tipo_id = ?,
            bsc_inst_tipo_id = ?,
            ue_compon_curricular_id = ?,
            sme_ens_sup_curso_id = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, $bsc_escolaridade_id[$kId]?: NULL);
        $stmt->bindValue(5, trim(strip_tags($formacao[$kId]?: '')));
        $stmt->bindValue(6, trim(strip_tags($conclusao_ano[$kId]?: '')));
        $stmt->bindValue(7, trim($cursando[$kId]?: 0));
        $stmt->bindValue(8, trim(strip_tags($c_h[$kId]?: NULL)));
        $stmt->bindValue(9, @$_POST['si_inst_sup_cod_inep_'.$kId]?: NULL);
        $stmt->bindValue(10, @$_POST['si_bsc_ens_med_tipo_id_'.$kId]?: NULL);
        $stmt->bindValue(11, @$_POST['si_bsc_ens_sup_tipo_id_'.$kId]?: NULL);
        $stmt->bindValue(12, @$_POST['si_bsc_inst_tipo_id_'.$kId]?: NULL);
        $stmt->bindValue(13, @$_POST['si_ue_compon_curricular_id_'.$kId]?: NULL);
        $stmt->bindValue(14, @$_POST['si_sme_ens_sup_curso_id_'.$kId]?: NULL);
        $stmt->bindValue(15, $vId);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO '.$tableName.' 
          (
            status,
            dt_cadastro,
            sme_servidor_id,
            bsc_escolaridade_id,
            formacao,
            conclusao_ano,
            cursando,
            c_h,
            inst_sup_cod_inep,
            bsc_ens_med_tipo_id,
            bsc_ens_sup_tipo_id,
            bsc_inst_tipo_id,
            ue_compon_curricular_id,
            sme_ens_sup_curso_id
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
        $stmt->bindValue(4, $bsc_escolaridade_id[$kId]?: NULL);
        $stmt->bindValue(5, trim(strip_tags($formacao[$kId]?: '')));
        $stmt->bindValue(6, trim(strip_tags($conclusao_ano[$kId]?: '')));
        $stmt->bindValue(7, trim($cursando[$kId]?: 0));
        $stmt->bindValue(8, trim(strip_tags($c_h[$kId]?: NULL)));
        $stmt->bindValue(9, @$_POST['si_inst_sup_cod_inep_'.$kId]?: NULL);
        $stmt->bindValue(10, @$_POST['si_bsc_ens_med_tipo_id_'.$kId]?: NULL);
        $stmt->bindValue(11, @$_POST['si_bsc_ens_sup_tipo_id_'.$kId]?: NULL);
        $stmt->bindValue(12, @$_POST['si_bsc_inst_tipo_id_'.$kId]?: NULL);
        $stmt->bindValue(13, @$_POST['si_ue_compon_curricular_id_'.$kId]?: NULL);
        $stmt->bindValue(14, @$_POST['si_sme_ens_sup_curso_id_'.$kId]?: NULL);
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