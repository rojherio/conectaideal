<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['pc_id']);
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$bsc_pessoa_id                            = strip_tags(@$_POST['pc_bsc_pessoa_id']?: '');
$end_cep                                  = ucwords(strtolower(trim(strip_tags(@$_POST['pc_end_cep']?: ''))));
$end_logradouro                           = ucwords(strtolower(trim(strip_tags(@$_POST['pc_end_logradouro']?: ''))));
$end_numero                               = ucwords(strtolower(trim(strip_tags(@$_POST['pc_end_numero']?: ''))));
$end_complemento                          = ucwords(strtolower(trim(strip_tags(@$_POST['pc_end_complemento']?: ''))));
$end_bairro                               = ucwords(strtolower(trim(strip_tags(@$_POST['pc_end_bairro']?: ''))));
$bsc_municipio_id                         = strip_tags(@$_POST['pc_bsc_municipio_id']?: '');
$tel_residencial                          = ucwords(strtolower(trim(strip_tags(@$_POST['pc_tel_residencial']?: ''))));
$tel_celular                              = ucwords(strtolower(trim(strip_tags(@$_POST['pc_tel_celular']?: ''))));
$tel_recado                               = ucwords(strtolower(trim(strip_tags(@$_POST['pc_tel_recado']?: ''))));
$tel_recado_nome                          = ucwords(strtolower(trim(strip_tags(@$_POST['pc_tel_recado_nome']?: ''))));
$bsc_parentesco_grau_id                   = strip_tags(@$_POST['pc_bsc_parentesco_grau_id']?: '');
$email_institucional                      = ucwords(strtolower(trim(strip_tags(@$_POST['pc_email_institucional']?: ''))));
$email_pessoal                            = ucwords(strtolower(trim(strip_tags(@$_POST['pc_email_pessoal']?: ''))));
$email_alternativo                        = ucwords(strtolower(trim(strip_tags(@$_POST['pc_email_alternativo']?: ''))));
$site                                     = ucwords(strtolower(trim(strip_tags(@$_POST['pc_site']?: ''))));
$emergencia_nome                          = ucwords(strtolower(trim(strip_tags(@$_POST['pc_emergencia_nome']?: ''))));
$emergencia_end                           = ucwords(strtolower(trim(strip_tags(@$_POST['pc_emergencia_end']?: ''))));
$emergencia_tel                           = ucwords(strtolower(trim(strip_tags(@$_POST['pc_emergencia_tel']?: ''))));
$bsc_pais_id_residencia                   = strip_tags(@$_POST['pc_bsc_pais_id_residencia']?: '');
$bsc_zona_id                              = strip_tags(@$_POST['pc_bsc_zona_id']?: '');
$ue_localizacao_diferenciada_id           = strip_tags(@$_POST['pc_ue_localizacao_diferenciada_id']?: '');
$end_latitude                             = trim(strip_tags(@$_POST['pc_end_latitude']?: ''));
$end_longitude                            = trim(strip_tags(@$_POST['pc_end_longitude']?: ''));
$tableName      = 'bsc_pessoa_contato';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != 0) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        status = ?,
        dt_cadastro = ?,
        bsc_pessoa_id = ?,
        end_cep = ?,
        end_logradouro = ?,
        end_numero = ?,
        end_complemento = ?,
        end_bairro = ?,
        bsc_municipio_id = ?,
        tel_residencial = ?,
        tel_celular = ?,
        tel_recado = ?,
        tel_recado_nome = ?,
        bsc_parentesco_grau_id = ?,
        email_institucional = ?,
        email_pessoal = ?,
        email_alternativo = ?,
        site = ?,
        emergencia_nome = ?,
        emergencia_end = ?,
        emergencia_tel = ?,
        bsc_pais_id_residencia = ?,
        bsc_zona_id = ?,
        ue_localizacao_diferenciada_id = ?,
        end_latitude = ?,
        end_longitude = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
    $stmt->bindValue(4, $end_cep);
    $stmt->bindValue(5, $end_logradouro);
    $stmt->bindValue(6, $end_numero);
    $stmt->bindValue(7, $end_complemento);
    $stmt->bindValue(8, $end_bairro);
    $stmt->bindValue(9, $bsc_municipio_id?: NULL);
    $stmt->bindValue(10, $tel_residencial);
    $stmt->bindValue(11, $tel_celular);
    $stmt->bindValue(12, $tel_recado);
    $stmt->bindValue(13, $tel_recado_nome);
    $stmt->bindValue(14, $bsc_parentesco_grau_id?: NULL);
    $stmt->bindValue(15, $email_institucional);
    $stmt->bindValue(16, $email_pessoal);
    $stmt->bindValue(17, $email_alternativo);
    $stmt->bindValue(18, $site);
    $stmt->bindValue(19, $emergencia_nome);
    $stmt->bindValue(20, $emergencia_end);
    $stmt->bindValue(21, $emergencia_tel);
    $stmt->bindValue(22, $bsc_pais_id_residencia?: NULL);
    $stmt->bindValue(23, $bsc_zona_id?: NULL);
    $stmt->bindValue(24, $ue_localizacao_diferenciada_id?: NULL);
    $stmt->bindValue(25, $end_latitude);
    $stmt->bindValue(26, $end_longitude);
    $stmt->bindValue(27, $id);
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
        end_cep,
        end_logradouro,
        end_numero,
        end_complemento,
        end_bairro,
        bsc_municipio_id,
        tel_residencial,
        tel_celular,
        tel_recado,
        tel_recado_nome,
        bsc_parentesco_grau_id,
        email_institucional,
        email_pessoal,
        email_alternativo,
        site,
        emergencia_nome,
        emergencia_end,
        emergencia_tel,
        bsc_pais_id_residencia,
        bsc_zona_id,
        ue_localizacao_diferenciada_id,
        end_latitude,
        end_longitude
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
        ?, 
        ?, 
        ?
      )');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
    $stmt->bindValue(4, $end_cep);
    $stmt->bindValue(5, $end_logradouro);
    $stmt->bindValue(6, $end_numero);
    $stmt->bindValue(7, $end_complemento);
    $stmt->bindValue(8, $end_bairro);
    $stmt->bindValue(9, $bsc_municipio_id?: NULL);
    $stmt->bindValue(10, $tel_residencial);
    $stmt->bindValue(11, $tel_celular);
    $stmt->bindValue(12, $tel_recado);
    $stmt->bindValue(13, $tel_recado_nome);
    $stmt->bindValue(14, $bsc_parentesco_grau_id?: NULL);
    $stmt->bindValue(15, $email_institucional);
    $stmt->bindValue(16, $email_pessoal);
    $stmt->bindValue(17, $email_alternativo);
    $stmt->bindValue(18, $site);
    $stmt->bindValue(19, $emergencia_nome);
    $stmt->bindValue(20, $emergencia_end);
    $stmt->bindValue(21, $emergencia_tel);
    $stmt->bindValue(22, $bsc_pais_id_residencia?: NULL);
    $stmt->bindValue(23, $bsc_zona_id?: NULL);
    $stmt->bindValue(24, $ue_localizacao_diferenciada_id?: NULL);
    $stmt->bindValue(25, $end_latitude);
    $stmt->bindValue(26, $end_longitude);
    $stmt->execute();
    $idNew = $db->lastInsertId();
    $db->commit();
    //MENSAGEM DE SUCESSO
    $result['id'] = $idNew;
    $result['status'] = 'success';
    $result['msg'] = 'As novas informações foram registradas com sucesso.';
    echo json_encode($result);
    exit();
  // }
  }
} catch (PDOException $e) {
  $db->rollback();
  $result['status'] = 'error';
  $result['msg'] = "Erro: " . $e->getMessage();
  echo json_encode($result);
  exit();
}
?>