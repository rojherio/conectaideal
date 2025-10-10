<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['ue_id']?: '');
$status                                   = strip_tags(@$_POST['ue_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$bsc_pessoa_id                            = strip_tags(@$_POST['ue_bsc_pessoa_id']?: '');
$inep_cod                                 = trim(strip_tags(@$_POST['ue_inep_cod']?: ''));
$ue_funcionam_situacao_id                 = strip_tags(@$_POST['ue_ue_funcionam_situacao_id']?: '');
$ano_letivo_dt_inicio                     = strip_tags(@$_POST['ue_ano_letivo_dt_inicio']?: '');
$ano_letivo_dt_fim                        = strip_tags(@$_POST['ue_ano_letivo_dt_fim']?: '');
$bsc_zona_id                              = strip_tags(@$_POST['ue_bsc_zona_id']?: '');
$ue_localizacao_diferenciada_id           = strip_tags(@$_POST['ue_ue_localizacao_diferenciada_id']?: '');
$bsc_esfera_administrativa_id_dependencia = strip_tags(@$_POST['ue_bsc_esfera_administrativa_id_dependencia']?: '');
$ue_cat_esc_priv_id                       = strip_tags(@$_POST['ue_ue_cat_esc_priv_id']?: '');
$bsc_esfera_administrativa_id_regulam     = strip_tags(@$_POST['ue_bsc_esfera_administrativa_id_regulam']?: '');
$ue_regulam_situacao_id                   = strip_tags(@$_POST['ue_ue_regulam_situacao_id']?: '');
$ue_ue_vinculada_tipo_id                  = strip_tags(@$_POST['ue_ue_ue_vinculada_tipo_id']?: '');
$ue_ue_id_vinculada                       = strip_tags(@$_POST['ue_ue_ue_id_vinculada']?: '');
$regional_cod                             = trim(strip_tags(@$_POST['ue_regional_cod']?: ''));
$entidade_superior_acesso                 = trim(strip_tags(@$_POST['ue_entidade_superior_acesso']?: ''));
$ue_infra_local_ocupacao_forma_id         = strip_tags(@$_POST['ue_ue_infra_local_ocupacao_forma_id']?: '');
$fornece_agua_potavel                     = trim(strip_tags(@$_POST['ue_fornece_agua_potavel']?: 0));
$sala_aula_qtd                            = trim(strip_tags(@$_POST['ue_sala_aula_qtd']?: 0));
$sala_aula_climatizada_qtd                = trim(strip_tags(@$_POST['ue_sala_aula_climatizada_qtd']?: 0));
$sala_aula_acessibilidade_qtd             = trim(strip_tags(@$_POST['ue_sala_aula_acessibilidade_qtd']?: 0));
$internet_banda_larga_velocidade          = trim(strip_tags(@$_POST['ue_internet_banda_larga_velocidade']?: ''));
$alimentacao_pnae_fnde_oferece            = trim(strip_tags(@$_POST['alimentacao_pnae_fnde_oferece']?: 0));
//POST Tables Terciarias
$bsc_uo_publica_id                        = @$_POST['bsc_uo_publica_id'];
$ue_ens_atend_tipo_id                     = @$_POST['ue_ens_atend_tipo_id'];
$ue_ens_modalidade_etapa_id               = @$_POST['ue_ens_modalidade_etapa_id'];
$ue_ens_profis_forma_id                   = @$_POST['ue_ens_profis_forma_id'];
$ue_infra_local_funcionam_id              = @$_POST['ue_infra_local_funcionam_id'];
$tableName      = 'ue_ue';
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
  $stmt = $db->prepare('
    SELECT p.nome AS "Nome da Unidade Educativa" 
    FROM '.$tableName.' AS tb 
    LEFT JOIN bsc_pessoa AS p ON p.id = tb.bsc_pessoa_id
    WHERE tb.id <> ? AND tb.bsc_pessoa_id = ?;');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $bsc_pessoa_id);
  $stmt->execute();
  $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt = $db->prepare('
    SELECT tb.inep_cod AS "Código Inep" 
    FROM '.$tableName.' AS tb 
    WHERE tb.id <> ? AND tb.inep_cod = ?;');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $inep_cod);
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
          status = ?,
          dt_cadastro = ?,
          bsc_pessoa_id = ?,
          inep_cod = ?,
          ue_funcionam_situacao_id = ?,
          ano_letivo_dt_inicio = ?,
          ano_letivo_dt_fim = ?,
          bsc_zona_id = ?,
          ue_localizacao_diferenciada_id = ?,
          bsc_esfera_administrativa_id_dependencia = ?,
          ue_cat_esc_priv_id = ?,
          bsc_esfera_administrativa_id_regulam = ?,
          ue_regulam_situacao_id = ?,
          ue_ue_vinculada_tipo_id = ?,
          ue_ue_id_vinculada = ?,
          regional_cod = ?,
          entidade_superior_acesso = ?,
          ue_infra_local_ocupacao_forma_id = ?,
          fornece_agua_potavel = ?,
          sala_aula_qtd = ?,
          sala_aula_climatizada_qtd = ?,
          sala_aula_acessibilidade_qtd = ?,
          internet_banda_larga_velocidade = ?,
          alimentacao_pnae_fnde_oferece = ?
          WHERE id = ?
          ');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro?: NULL);
      $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
      $stmt->bindValue(4, $inep_cod);
      $stmt->bindValue(5, $ue_funcionam_situacao_id?: NULL);
      $stmt->bindValue(6, $ano_letivo_dt_inicio?: NULL);
      $stmt->bindValue(7, $ano_letivo_dt_fim?: NULL);
      $stmt->bindValue(8, $bsc_zona_id?: NULL);
      $stmt->bindValue(9, $ue_localizacao_diferenciada_id?: NULL);
      $stmt->bindValue(10, $bsc_esfera_administrativa_id_dependencia?: NULL);
      $stmt->bindValue(11, $ue_cat_esc_priv_id?: NULL);
      $stmt->bindValue(12, $bsc_esfera_administrativa_id_regulam?: NULL);
      $stmt->bindValue(13, $ue_regulam_situacao_id?: NULL);
      $stmt->bindValue(14, $ue_ue_vinculada_tipo_id?: NULL);
      $stmt->bindValue(15, $ue_ue_id_vinculada?: NULL);
      $stmt->bindValue(16, $regional_cod);
      $stmt->bindValue(17, $entidade_superior_acesso);
      $stmt->bindValue(18, $ue_infra_local_ocupacao_forma_id?: NULL);
      $stmt->bindValue(19, $fornece_agua_potavel);
      $stmt->bindValue(20, $sala_aula_qtd);
      $stmt->bindValue(21, $sala_aula_climatizada_qtd);
      $stmt->bindValue(22, $sala_aula_acessibilidade_qtd);
      $stmt->bindValue(23, $internet_banda_larga_velocidade);
      $stmt->bindValue(24, $alimentacao_pnae_fnde_oferece);
      $stmt->bindValue(25, $id);
      $stmt->execute();
    //DELETE ue_ue_uo_publica_vinc
      $stmt = $db->prepare('
        DELETE 
          FROM ue_ue_uo_publica_vinc
          WHERE ue_ue_id = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
    //INSERT ue_ue_uo_publica_vinc
      if($bsc_uo_publica_id){
        foreach ($bsc_uo_publica_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_uo_publica_vinc
            (
              status,
              dt_cadastro,
              ue_ue_id,
              bsc_uo_publica_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //DELETE ue_ue_ens_atend_tipo
      $stmt = $db->prepare('
        DELETE 
          FROM ue_ue_ens_atend_tipo
          WHERE ue_ue_id = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
    //INSERT ue_ue_ens_atend_tipo
      if($ue_ens_atend_tipo_id){
        foreach ($ue_ens_atend_tipo_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_ens_atend_tipo
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_ens_atend_tipo_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //DELETE ue_ue_ens_modalidade_etapa
      $stmt = $db->prepare('
        DELETE 
          FROM ue_ue_ens_modalidade_etapa
          WHERE ue_ue_id = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
    //INSERT ue_ue_ens_modalidade_etapa
      if($ue_ens_modalidade_etapa_id){
        foreach ($ue_ens_modalidade_etapa_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_ens_modalidade_etapa
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_ens_modalidade_etapa_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //DELETE ue_ue_ens_profis_forma
      $stmt = $db->prepare('
        DELETE 
          FROM ue_ue_ens_profis_forma
          WHERE ue_ue_id = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
    //INSERT ue_ue_ens_profis_forma
      if($ue_ens_profis_forma_id){
        foreach ($ue_ens_profis_forma_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_ens_profis_forma
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_ens_profis_forma_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //DELETE ue_ue_infra_local_funcionam
      $stmt = $db->prepare('
        DELETE 
          FROM ue_ue_infra_local_funcionam
          WHERE ue_ue_id = ?;');
      $stmt->bindValue(1, $id);
      $stmt->execute();
    //INSERT ue_ue_infra_local_funcionam
      if($ue_infra_local_funcionam_id){
        foreach ($ue_infra_local_funcionam_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_infra_local_funcionam
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_infra_local_funcionam_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
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
      $stmt = $db->prepare('INSERT INTO '.$tableName.' 
        (
          status,
          dt_cadastro,
          bsc_pessoa_id,
          inep_cod,
          ue_funcionam_situacao_id,
          ano_letivo_dt_inicio,
          ano_letivo_dt_fim,
          bsc_zona_id,
          ue_localizacao_diferenciada_id,
          bsc_esfera_administrativa_id_dependencia,
          ue_cat_esc_priv_id,
          bsc_esfera_administrativa_id_regulam,
          ue_regulam_situacao_id,
          ue_ue_vinculada_tipo_id,
          ue_ue_id_vinculada,
          regional_cod,
          entidade_superior_acesso,
          ue_infra_local_ocupacao_forma_id,
          fornece_agua_potavel,
          sala_aula_qtd,
          sala_aula_climatizada_qtd,
          sala_aula_acessibilidade_qtd,
          internet_banda_larga_velocidade,
          alimentacao_pnae_fnde_oferece
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
      $stmt->bindValue(4, $inep_cod);
      $stmt->bindValue(5, $ue_funcionam_situacao_id?: NULL);
      $stmt->bindValue(6, $ano_letivo_dt_inicio?: NULL);
      $stmt->bindValue(7, $ano_letivo_dt_fim?: NULL);
      $stmt->bindValue(8, $bsc_zona_id?: NULL);
      $stmt->bindValue(9, $ue_localizacao_diferenciada_id?: NULL);
      $stmt->bindValue(10, $bsc_esfera_administrativa_id_dependencia?: NULL);
      $stmt->bindValue(11, $ue_cat_esc_priv_id?: NULL);
      $stmt->bindValue(12, $bsc_esfera_administrativa_id_regulam?: NULL);
      $stmt->bindValue(13, $ue_regulam_situacao_id?: NULL);
      $stmt->bindValue(14, $ue_ue_vinculada_tipo_id?: NULL);
      $stmt->bindValue(15, $ue_ue_id_vinculada?: NULL);
      $stmt->bindValue(16, $regional_cod);
      $stmt->bindValue(17, $entidade_superior_acesso);
      $stmt->bindValue(18, $ue_infra_local_ocupacao_forma_id?: NULL);
      $stmt->bindValue(19, $fornece_agua_potavel);
      $stmt->bindValue(20, $sala_aula_qtd);
      $stmt->bindValue(21, $sala_aula_climatizada_qtd);
      $stmt->bindValue(22, $sala_aula_acessibilidade_qtd);
      $stmt->bindValue(23, $internet_banda_larga_velocidade);
      $stmt->bindValue(24, $alimentacao_pnae_fnde_oferece);
      $stmt->execute();
      $id = $db->lastInsertId();
      if($bsc_uo_publica_id){
        foreach ($bsc_uo_publica_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_uo_publica_vinc
            (
              status,
              dt_cadastro,
              ue_ue_id,
              bsc_uo_publica_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //INSERT ue_ue_ens_atend_tipo
      if($ue_ens_atend_tipo_id){
        foreach ($ue_ens_atend_tipo_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_ens_atend_tipo
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_ens_atend_tipo_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //INSERT ue_ue_ens_modalidade_etapa
      if($ue_ens_modalidade_etapa_id){
        foreach ($ue_ens_modalidade_etapa_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_ens_modalidade_etapa
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_ens_modalidade_etapa_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
    //INSERT ue_ue_ens_profis_forma
      if($ue_ens_profis_forma_id){
        foreach ($ue_ens_profis_forma_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_ens_profis_forma
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_ens_profis_forma_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
      //INSERT ue_ue_infra_local_funcionam
      if($ue_infra_local_funcionam_id){
        foreach ($ue_infra_local_funcionam_id as $k => $v) {
          $stmt = $db->prepare('
            INSERT INTO ue_ue_infra_local_funcionam
            (
              status,
              dt_cadastro,
              ue_ue_id,
              ue_infra_local_funcionam_id
              )
            VALUES
            (
              ?,
              ?,
              ?,
              ?
            );');
          $stmt->bindValue(1, $status);
          $stmt->bindValue(2, $dt_cadastro?: NULL);
          $stmt->bindValue(3, $id);
          $stmt->bindValue(4, $v[0]);
          $stmt->execute();
        }
      }
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