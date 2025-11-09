<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['p_id']?: '');
$status                                   = strip_tags(@$_POST['p_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$tipo                                     = 1; //1 = pessoa física, 2 = pessoa jurídica
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['p_nome']?: ''))));
$nome_social                              = ucwords(strtolower(trim(strip_tags(@$_POST['p_nome_social']?: ''))));
$cpf                                      = strip_tags(@$_POST['p_cpf']?: '');
$dt_nascimento                            = strip_tags(@$_POST['p_dt_nascimento']?: '');
$sexo                                     = strip_tags(@$_POST['p_sexo']?: '');
$bsc_estado_civil_id                      = strip_tags(@$_POST['p_bsc_estado_civil_id']?: '');
$natural_bsc_pais_id                      = strip_tags(@$_POST['p_natural_bsc_pais_id']?: '');
$natural_bsc_municipio_id                 = strip_tags(@$_POST['p_natural_bsc_municipio_id']?: '');
$natural_estrangeiro_dt_ingresso          = strip_tags(@$_POST['p_natural_estrangeiro_dt_ingresso']?: '');
$natural_estrangeiro_cidade               = ucwords(strtolower(trim(strip_tags(@$_POST['p_natural_estrangeiro_cidade']?: ''))));
$natural_estrangeiro_estado               = ucwords(strtolower(trim(strip_tags(@$_POST['p_natural_estrangeiro_estado']?: ''))));
$natural_estrangeiro_condicao_trabalho    = ucwords(strtolower(trim(strip_tags(@$_POST['p_natural_estrangeiro_condicao_trabalho']?: ''))));
$natural_estrangeiro_naturalizado         = strip_tags(@$_POST['p_natural_estrangeiro_naturalizado']?: 0);
$pai_nome                                 = ucwords(strtolower(trim(strip_tags(@$_POST['p_pai_nome']?: ''))));
$pai_natural_bsc_pais_id                  = strip_tags(@$_POST['p_pai_natural_bsc_pais_id']?: '');
$pai_profissao                            = ucwords(strtolower(trim(strip_tags(@$_POST['p_pai_profissao']?: ''))));
$mae_nome                                 = ucwords(strtolower(trim(strip_tags(@$_POST['p_mae_nome']?: ''))));
$mae_natural_bsc_pais_id                  = strip_tags(@$_POST['p_mae_natural_bsc_pais_id']?: '');
$mae_profissao                            = ucwords(strtolower(trim(strip_tags(@$_POST['p_mae_profissao']?: ''))));
$foto                                     = "";
$sangue_tipo                              = strip_tags(@$_POST['p_sangue_tipo']?: '');
$bsc_cor_raca_id                          = strip_tags(@$_POST['p_bsc_cor_raca_id']?: '');
$enfermidade_portador                     = ucwords(strtolower(trim(strip_tags(@$_POST['p_enfermidade_portador']?: ''))));
$enfermidade_codigo_internacional         = trim(strip_tags(@$_POST['p_enfermidade_codigo_internacional']?: ''));
$tableName      = 'bsc_pessoa';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  $stmt = $db->prepare('
    SELECT tb.cpf
    FROM '.$tableName.' AS tb 
    WHERE tb.id <> ? AND tb.cpf LIKE ?;');
  $stmt->bindValue(1, $id);
  $stmt->bindValue(2, $cpf);
  $stmt->execute();
  $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($rsExistente) {
    $db->rollback();
    $existentes = '';
    $virgula = '';
    foreach ($rsExistente as $kObj => $vObj) {
      $existentes .= $virgula.'<br/>'.htmlentities(ucwords($kObj)).': '.$vObj;
      $virgula = ', ';
    }
    $result['status'] = 'error';
    $result['tipo'] = 'existente';
    $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um registro com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
    echo json_encode($result);
    exit();
  } else {
    if (is_numeric($id) && $id != 0) {
      $stmt = $db->prepare('
        UPDATE '.$tableName.' 
          SET
          status = ?,
          dt_cadastro = ?,
          tipo = ?,
          nome = ?,
          nome_social = ?,
          cpf = ?,
          dt_nascimento = ?,
          sexo = ?,
          bsc_estado_civil_id = ?,
          natural_bsc_pais_id = ?,
          natural_bsc_municipio_id = ?,
          natural_estrangeiro_dt_ingresso = ?,
          natural_estrangeiro_cidade = ?,
          natural_estrangeiro_estado = ?,
          natural_estrangeiro_condicao_trabalho = ?,
          natural_estrangeiro_naturalizado = ?,
          pai_nome = ?,
          pai_natural_bsc_pais_id = ?,
          pai_profissao = ?,
          mae_nome = ?,
          mae_natural_bsc_pais_id = ?,
          mae_profissao = ?,
          foto = ?,
          sangue_tipo = ?,
          bsc_cor_raca_id = ?,
          enfermidade_portador = ?,
          enfermidade_codigo_internacional = ?
          WHERE id = ?
          ');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $tipo);
      $stmt->bindValue(4, $nome);
      $stmt->bindValue(5, $nome_social);
      $stmt->bindValue(6, $cpf);
      $stmt->bindValue(7, $dt_nascimento?: NULL);
      $stmt->bindValue(8, $sexo);
      $stmt->bindValue(9, $bsc_estado_civil_id?: NULL);
      $stmt->bindValue(10, $natural_bsc_pais_id?: NULL);
      $stmt->bindValue(11, $natural_bsc_municipio_id?: NULL);
      $stmt->bindValue(12, $natural_estrangeiro_dt_ingresso?: NULL);
      $stmt->bindValue(13, $natural_estrangeiro_cidade);
      $stmt->bindValue(14, $natural_estrangeiro_estado);
      $stmt->bindValue(15, $natural_estrangeiro_condicao_trabalho);
      $stmt->bindValue(16, $natural_estrangeiro_naturalizado);
      $stmt->bindValue(17, $pai_nome);
      $stmt->bindValue(18, $pai_natural_bsc_pais_id?: NULL);
      $stmt->bindValue(19, $pai_profissao);
      $stmt->bindValue(20, $mae_nome);
      $stmt->bindValue(21, $mae_natural_bsc_pais_id?: NULL);
      $stmt->bindValue(22, $mae_profissao);
      $stmt->bindValue(23, $foto);
      $stmt->bindValue(24, $sangue_tipo);
      $stmt->bindValue(25, $bsc_cor_raca_id?: NULL);
      $stmt->bindValue(26, $enfermidade_portador);
      $stmt->bindValue(27, $enfermidade_codigo_internacional);
      $stmt->bindValue(28, $id);
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
          tipo,
          nome,
          nome_social,
          cpf,
          dt_nascimento,
          sexo,
          bsc_estado_civil_id,
          natural_bsc_pais_id,
          natural_bsc_municipio_id,
          natural_estrangeiro_dt_ingresso,
          natural_estrangeiro_cidade,
          natural_estrangeiro_estado,
          natural_estrangeiro_condicao_trabalho,
          natural_estrangeiro_naturalizado,
          pai_nome,
          pai_natural_bsc_pais_id,
          pai_profissao,
          mae_nome,
          mae_natural_bsc_pais_id,
          mae_profissao,
          foto,
          sangue_tipo,
          bsc_cor_raca_id,
          enfermidade_portador,
          enfermidade_codigo_internacional
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
          ?, 
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $tipo);
      $stmt->bindValue(4, $nome);
      $stmt->bindValue(5, $nome_social);
      $stmt->bindValue(6, $cpf);
      $stmt->bindValue(7, $dt_nascimento?: NULL);
      $stmt->bindValue(8, $sexo);
      $stmt->bindValue(9, $bsc_estado_civil_id?: NULL);
      $stmt->bindValue(10, $natural_bsc_pais_id?: NULL);
      $stmt->bindValue(11, $natural_bsc_municipio_id?: NULL);
      $stmt->bindValue(12, $natural_estrangeiro_dt_ingresso?: NULL);
      $stmt->bindValue(13, $natural_estrangeiro_cidade);
      $stmt->bindValue(14, $natural_estrangeiro_estado);
      $stmt->bindValue(15, $natural_estrangeiro_condicao_trabalho);
      $stmt->bindValue(16, $natural_estrangeiro_naturalizado);
      $stmt->bindValue(17, $pai_nome);
      $stmt->bindValue(18, $pai_natural_bsc_pais_id?: NULL);
      $stmt->bindValue(19, $pai_profissao);
      $stmt->bindValue(20, $mae_nome);
      $stmt->bindValue(21, $mae_natural_bsc_pais_id?: NULL);
      $stmt->bindValue(22, $mae_profissao);
      $stmt->bindValue(23, $foto);
      $stmt->bindValue(24, $sangue_tipo);
      $stmt->bindValue(25, $bsc_cor_raca_id?: NULL);
      $stmt->bindValue(26, $enfermidade_portador);
      $stmt->bindValue(27, $enfermidade_codigo_internacional);
      $stmt->execute();
      $idNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $result['id'] = $idNew;
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