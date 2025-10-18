<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['pf_id']);
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['sf_sme_servidor_id']?: '');
$bsc_estado_civil_id                      = strip_tags(@$_POST['sf_bsc_estado_civil_id']?: '');
$conjuge_dt_casamento                     = strip_tags(@$_POST['sf_conjuge_dt_casamento']?: '');
$conjuge_nome                             = ucwords(strtolower(trim(strip_tags(@$_POST['sf_conjuge_nome']?: ''))));
$conjuge_cpf                              = trim(strip_tags(@$_POST['sf_conjuge_cpf']?: ''));
$conjuge_dt_nascimento                    = strip_tags(@$_POST['sf_conjuge_dt_nascimento']?: '');
$bsc_pais_id_conjuge                      = strip_tags(@$_POST['sf_bsc_pais_id_conjuge']?: '');
$bsc_municipio_id_conjuge                 = strip_tags(@$_POST['sf_bsc_municipio_id_conjuge']?: '');
$conjuge_natural_estrangeiro_cidade       = ucwords(strtolower(trim(strip_tags(@$_POST['sf_conjuge_natural_estrangeiro_cidade']?: ''))));
$conjuge_natural_estrangeiro_estado       = ucwords(strtolower(trim(strip_tags(@$_POST['sf_conjuge_natural_estrangeiro_estado']?: ''))));
$conjuge_local_trabalho                   = ucwords(strtolower(trim(strip_tags(@$_POST['sf_conjuge_local_trabalho']?: ''))));
$reg_civil_modelo                         = ucwords(strtolower(trim(strip_tags(@$_POST['sf_reg_civil_modelo']?: ''))));
$reg_civil_numero                         = ucwords(strtolower(trim(strip_tags(@$_POST['sf_reg_civil_numero']?: ''))));
$reg_civil_livro                          = ucwords(strtolower(trim(strip_tags(@$_POST['sf_reg_civil_livro']?: ''))));
$reg_civil_folha                          = ucwords(strtolower(trim(strip_tags(@$_POST['sf_reg_civil_folha']?: ''))));
$reg_civil_cartorio                       = ucwords(strtolower(trim(strip_tags(@$_POST['sf_reg_civil_cartorio']?: ''))));
$reg_civil_dt_emissao                     = strip_tags(@$_POST['sf_reg_civil_dt_emissao']?: '');
$bsc_municipio_id_reg_civil               = strip_tags(@$_POST['sf_bsc_municipio_id_reg_civil']?: '');
$averbacao_tipo                           = ucwords(strtolower(trim(strip_tags(@$_POST['sf_averbacao_tipo']?: ''))));
$averbacao_numero                         = ucwords(strtolower(trim(strip_tags(@$_POST['sf_averbacao_numero']?: ''))));
$averbacao_dt_emissao                     = strip_tags(@$_POST['sf_averbacao_dt_emissao']?: '');
$averbacao_cartorio                       = ucwords(strtolower(trim(strip_tags(@$_POST['sf_averbacao_cartorio']?: ''))));
$bsc_municipio_id_averbacao               = strip_tags(@$_POST['sf_bsc_municipio_id_averbacao']?: '');
$tableName      = 'sme_serv_familiar';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != 0 ) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        status = ?,
        dt_cadastro = ?,
        sme_servidor_id = ?,
        bsc_estado_civil_id = ?,
        conjuge_dt_casamento = ?,
        conjuge_nome = ?,
        conjuge_cpf = ?,
        conjuge_dt_nascimento = ?,
        bsc_pais_id_conjuge = ?,
        bsc_municipio_id_conjuge = ?,
        conjuge_natural_estrangeiro_cidade = ?,
        conjuge_natural_estrangeiro_estado = ?,
        conjuge_local_trabalho = ?,
        reg_civil_modelo = ?,
        reg_civil_numero = ?,
        reg_civil_livro = ?,
        reg_civil_folha = ?,
        reg_civil_cartorio = ?,
        reg_civil_dt_emissao = ?,
        bsc_municipio_id_reg_civil = ?,
        averbacao_tipo = ?,
        averbacao_numero = ?,
        averbacao_dt_emissao = ?,
        averbacao_cartorio = ?,
        bsc_municipio_id_averbacao = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $sme_servidor_id?: NULL);
    $stmt->bindValue(4, $bsc_estado_civil_id?: NULL);
    $stmt->bindValue(5, $conjuge_dt_casamento?: NULL);
    $stmt->bindValue(6, $conjuge_nome);
    $stmt->bindValue(7, $conjuge_cpf);
    $stmt->bindValue(8, $conjuge_dt_nascimento?: NULL);
    $stmt->bindValue(9, $bsc_pais_id_conjuge?: NULL);
    $stmt->bindValue(10, $bsc_municipio_id_conjuge?: NULL);
    $stmt->bindValue(11, $conjuge_natural_estrangeiro_cidade);
    $stmt->bindValue(12, $conjuge_natural_estrangeiro_estado);
    $stmt->bindValue(13, $conjuge_local_trabalho);
    $stmt->bindValue(14, $reg_civil_modelo);
    $stmt->bindValue(15, $reg_civil_numero);
    $stmt->bindValue(16, $reg_civil_livro);
    $stmt->bindValue(17, $reg_civil_folha);
    $stmt->bindValue(18, $reg_civil_cartorio);
    $stmt->bindValue(19, $reg_civil_dt_emissao?: NULL);
    $stmt->bindValue(20, $bsc_municipio_id_reg_civil?: NULL);
    $stmt->bindValue(21, $averbacao_tipo);
    $stmt->bindValue(22, $averbacao_numero);
    $stmt->bindValue(23, $averbacao_dt_emissao?: NULL);
    $stmt->bindValue(24, $averbacao_cartorio);
    $stmt->bindValue(25, $bsc_municipio_id_averbacao?: NULL);
    $stmt->bindValue(26, $id);
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
        sme_servidor_id,
        bsc_estado_civil_id,
        conjuge_dt_casamento,
        conjuge_nome,
        conjuge_cpf,
        conjuge_dt_nascimento,
        bsc_pais_id_conjuge,
        bsc_municipio_id_conjuge,
        conjuge_natural_estrangeiro_cidade,
        conjuge_natural_estrangeiro_estado,
        conjuge_local_trabalho,
        reg_civil_modelo,
        reg_civil_numero,
        reg_civil_livro,
        reg_civil_folha,
        reg_civil_cartorio,
        reg_civil_dt_emissao,
        bsc_municipio_id_reg_civil,
        averbacao_tipo,
        averbacao_numero,
        averbacao_dt_emissao,
        averbacao_cartorio,
        bsc_municipio_id_averbacao
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
        ?
      )');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $sme_servidor_id?: NULL);
    $stmt->bindValue(4, $bsc_estado_civil_id?: NULL);
    $stmt->bindValue(5, $conjuge_dt_casamento?: NULL);
    $stmt->bindValue(6, $conjuge_nome);
    $stmt->bindValue(7, $conjuge_cpf);
    $stmt->bindValue(8, $conjuge_dt_nascimento?: NULL);
    $stmt->bindValue(9, $bsc_pais_id_conjuge?: NULL);
    $stmt->bindValue(10, $bsc_municipio_id_conjuge?: NULL);
    $stmt->bindValue(11, $conjuge_natural_estrangeiro_cidade);
    $stmt->bindValue(12, $conjuge_natural_estrangeiro_estado);
    $stmt->bindValue(13, $conjuge_local_trabalho);
    $stmt->bindValue(14, $reg_civil_modelo);
    $stmt->bindValue(15, $reg_civil_numero);
    $stmt->bindValue(16, $reg_civil_livro);
    $stmt->bindValue(17, $reg_civil_folha);
    $stmt->bindValue(18, $reg_civil_cartorio);
    $stmt->bindValue(19, $reg_civil_dt_emissao?: NULL);
    $stmt->bindValue(20, $bsc_municipio_id_reg_civil?: NULL);
    $stmt->bindValue(21, $averbacao_tipo);
    $stmt->bindValue(22, $averbacao_numero);
    $stmt->bindValue(23, $averbacao_dt_emissao?: NULL);
    $stmt->bindValue(24, $averbacao_cartorio);
    $stmt->bindValue(25, $bsc_municipio_id_averbacao?: NULL);
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