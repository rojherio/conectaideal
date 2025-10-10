<?php
$id                                       = ucwords(strtolower(trim(strip_tags(@$_POST['s_id']?: ''))));
$status                                   = strip_tags(@$_POST['s_status']?: 0);
$dt_cadastro                              = strip_tags(@$_POST['s_dt_cadastro']?: '');
$bsc_pessoa_id                            = strip_tags(@$_POST['s_bsc_pessoa_id']?: '');
$matricula                                = ucwords(strtolower(trim(strip_tags(@$_POST['s_matricula']?: ''))));
$sme_serv_tipo_id                         = strip_tags(@$_POST['s_sme_serv_tipo_id']?: '');
$eo_cargo_id                              = strip_tags(@$_POST['s_eo_cargo_id']?: '');
$sme_serv_situacao_id                     = strip_tags(@$_POST['s_sme_serv_situacao_id']?: '');
$situacao_trabalho_decreto                = ucwords(strtolower(trim(strip_tags(@$_POST['s_situacao_trabalho_decreto']?: ''))));
$situacao_trabalho_doe                    = ucwords(strtolower(trim(strip_tags(@$_POST['s_situacao_trabalho_doe']?: ''))));
$situacao_trabalho_dt_inicio              = strip_tags(@$_POST['s_situacao_trabalho_dt_inicio']?: '');
$situacao_trabalho_dt_fim                 = strip_tags(@$_POST['s_situacao_trabalho_dt_fim']?: '');
$situacao_trabalho_obs                    = ucwords(strtolower(trim(strip_tags(@$_POST['s_situacao_trabalho_obs']?: ''))));
$matricula_2                              = ucwords(strtolower(trim(strip_tags(@$_POST['s_matricula_2']?: ''))));
$sme_serv_tipo_id_2                       = strip_tags(@$_POST['s_sme_serv_tipo_id_2']?: '');
$eo_cargo_id_2                            = strip_tags(@$_POST['s_eo_cargo_id_2']?: '');
$sme_serv_situacao_id_2                   = strip_tags(@$_POST['s_sme_serv_situacao_id_2']?: '');
$situacao_trabalho_decreto_2              = ucwords(strtolower(trim(strip_tags(@$_POST['s_situacao_trabalho_decreto_2']?: ''))));
$situacao_trabalho_doe_2                  = ucwords(strtolower(trim(strip_tags(@$_POST['s_situacao_trabalho_doe_2']?: ''))));
$situacao_trabalho_dt_inicio_2            = strip_tags(@$_POST['s_situacao_trabalho_dt_inicio_2']?: '');
$situacao_trabalho_dt_fim_2               = strip_tags(@$_POST['s_situacao_trabalho_dt_fim_2']?: '');
$situacao_trabalho_obs_2                  = ucwords(strtolower(trim(strip_tags(@$_POST['s_situacao_trabalho_obs_2']?: ''))));
$foto                                     = ucwords(strtolower(trim(strip_tags(@$_POST['s_foto']?: ''))));
$senha_nome                               = ucwords(strtolower(trim(strip_tags(@$_POST['s_senha_nome']?: ''))));
$sme_sme_id                               = strip_tags(@$_POST['s_sme_sme_id']?: '');
$tableName      = 'sme_servidor';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  $stmt = $db->prepare('
    SELECT p.nome AS "Nome do servidor"
    FROM '.$tableName.' AS tb 
    LEFT JOIN bsc_pessoa AS p ON p.id = tb.bsc_pessoa_id
    WHERE tb.id <> ? AND (tb.bsc_pessoa_id = ?);');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $bsc_pessoa_id);
  $stmt->execute();
  $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt = $db->prepare('
    SELECT tb.matricula AS "Matricula", 
    tb.matricula_2 AS "Matricula-2" 
    FROM '.$tableName.' AS tb 
    WHERE tb.id <> ? AND (tb.matricula = ? OR tb.matricula_2 = ?);');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $matricula);
  $stmt->bindValue(3, $matricula_2);
  $stmt->execute();
  $rsExistente = array_merge($rsExistente ? : array(), $stmt->fetch(PDO::FETCH_ASSOC) ? : array());
  if ($rsExistente) {
    $db->rollback();
    $existentes = '';
    $virgula = '';
    foreach ($rsExistente as $kObj => $vObj) {
      $existentes .= $virgula.'<br/>'.htmlentities($kObj).': '.$vObj;
      $virgula = ', ';
    }
    $result['status'] = 'error';
    $result['tipo'] = 'existente';
    $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe registrado com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
    echo json_encode($result);
    exit();
  } else {
    if (is_numeric($id) && $id != "" && $id != 0 ) {
      $stmt = $db->prepare('
        UPDATE '.$tableName.' 
          SET
          id = ?,
          status = ?,
          dt_cadastro = ?,
          bsc_pessoa_id = ?,
          matricula = ?,
          sme_serv_tipo_id = ?,
          eo_cargo_id = ?,
          sme_serv_situacao_id = ?,
          situacao_trabalho_decreto = ?,
          situacao_trabalho_doe = ?,
          situacao_trabalho_dt_inicio = ?,
          situacao_trabalho_dt_fim = ?,
          situacao_trabalho_obs = ?,
          matricula_2 = ?,
          sme_serv_tipo_id_2 = ?,
          eo_cargo_id_2 = ?,
          sme_serv_situacao_id_2 = ?,
          situacao_trabalho_decreto_2 = ?,
          situacao_trabalho_doe_2 = ?,
          situacao_trabalho_dt_inicio_2 = ?,
          situacao_trabalho_dt_fim_2 = ?,
          situacao_trabalho_obs_2 = ?,
          foto = ?,
          senha_nome = ?,
          sme_sme_id = ?
          WHERE id = ?
          ');
      $stmt->bindValue(1, $id);
      $stmt->bindValue(2, $status);
      $stmt->bindValue(3, $dt_cadastro?: NULL);
      $stmt->bindValue(4, $bsc_pessoa_id?: NULL);
      $stmt->bindValue(5, $matricula?: NULL);
      $stmt->bindValue(6, $sme_serv_tipo_id?: NULL);
      $stmt->bindValue(7, $eo_cargo_id?: NULL);
      $stmt->bindValue(8, $sme_serv_situacao_id?: NULL);
      $stmt->bindValue(9, $situacao_trabalho_decreto);
      $stmt->bindValue(10, $situacao_trabalho_doe);
      $stmt->bindValue(11, $situacao_trabalho_dt_inicio?: NULL);
      $stmt->bindValue(12, $situacao_trabalho_dt_fim?: NULL);
      $stmt->bindValue(13, $situacao_trabalho_obs);
      $stmt->bindValue(14, $matricula_2?: NULL);
      $stmt->bindValue(15, $sme_serv_tipo_id_2?: NULL);
      $stmt->bindValue(16, $eo_cargo_id_2?: NULL);
      $stmt->bindValue(17, $sme_serv_situacao_id_2?: NULL);
      $stmt->bindValue(18, $situacao_trabalho_decreto_2);
      $stmt->bindValue(19, $situacao_trabalho_doe_2);
      $stmt->bindValue(20, $situacao_trabalho_dt_inicio_2?: NULL);
      $stmt->bindValue(21, $situacao_trabalho_dt_fim_2?: NULL);
      $stmt->bindValue(22, $situacao_trabalho_obs_2);
      $stmt->bindValue(23, $foto);
      $stmt->bindValue(24, $senha_nome);
      $stmt->bindValue(25, $sme_sme_id?: NULL);
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
          bsc_pessoa_id,
          matricula,
          sme_serv_tipo_id,
          eo_cargo_id,
          sme_serv_situacao_id,
          situacao_trabalho_decreto,
          situacao_trabalho_doe,
          situacao_trabalho_dt_inicio,
          situacao_trabalho_dt_fim,
          situacao_trabalho_obs,
          matricula_2,
          sme_serv_tipo_id_2,
          eo_cargo_id_2,
          sme_serv_situacao_id_2,
          situacao_trabalho_decreto_2,
          situacao_trabalho_doe_2,
          situacao_trabalho_dt_inicio_2,
          situacao_trabalho_dt_fim_2,
          situacao_trabalho_obs_2,
          foto,
          senha_nome,
          sme_sme_id
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
      $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
      $stmt->bindValue(4, $matricula?: NULL);
      $stmt->bindValue(5, $sme_serv_tipo_id?: NULL);
      $stmt->bindValue(6, $eo_cargo_id?: NULL);
      $stmt->bindValue(7, $sme_serv_situacao_id?: NULL);
      $stmt->bindValue(8, $situacao_trabalho_decreto);
      $stmt->bindValue(9, $situacao_trabalho_doe);
      $stmt->bindValue(10, $situacao_trabalho_dt_inicio?: NULL);
      $stmt->bindValue(11, $situacao_trabalho_dt_fim?: NULL);
      $stmt->bindValue(12, $situacao_trabalho_obs);
      $stmt->bindValue(13, $matricula_2?: NULL);
      $stmt->bindValue(14, $sme_serv_tipo_id_2?: NULL);
      $stmt->bindValue(15, $eo_cargo_id_2?: NULL);
      $stmt->bindValue(16, $sme_serv_situacao_id_2?: NULL);
      $stmt->bindValue(17, $situacao_trabalho_decreto_2);
      $stmt->bindValue(18, $situacao_trabalho_doe_2);
      $stmt->bindValue(19, $situacao_trabalho_dt_inicio_2?: NULL);
      $stmt->bindValue(20, $situacao_trabalho_dt_fim_2?: NULL);
      $stmt->bindValue(21, $situacao_trabalho_obs_2);
      $stmt->bindValue(22, $foto);
      $stmt->bindValue(23, $senha_nome);
      $stmt->bindValue(24, $sme_sme_id?: NULL);
      $stmt->execute();
      $id = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $result['id'] = $id;
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