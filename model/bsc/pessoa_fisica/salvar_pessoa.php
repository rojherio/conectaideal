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
$natural_bsc_pais_id                      = strip_tags(@$_POST['p_natural_bsc_pais_id']?: '');
$natural_bsc_municipio_id                 = strip_tags(@$_POST['p_natural_bsc_municipio_id']?: '');
$natural_estrangeiro_dt_ingresso          = strip_tags(@$_POST['p_natural_estrangeiro_dt_ingresso']?: '');
$natural_estrangeiro_cidade               = ucwords(strtolower(trim(strip_tags(@$_POST['p_natural_estrangeiro_cidade']?: ''))));
$natural_estrangeiro_estado               = ucwords(strtolower(trim(strip_tags(@$_POST['p_natural_estrangeiro_estado']?: ''))));
$natural_estrangeiro_condicao_trabalho    = ucwords(strtolower(trim(strip_tags(@$_POST['p_natural_estrangeiro_condicao_trabalho']?: ''))));
$pai_nome                                 = ucwords(strtolower(trim(strip_tags(@$_POST['p_pai_nome']?: ''))));
$pai_natural_bsc_pais_id                  = strip_tags(@$_POST['p_pai_natural_bsc_pais_id']?: '');
$pai_profissao                            = ucwords(strtolower(trim(strip_tags(@$_POST['p_pai_profissao']?: ''))));
$mae_nome                                 = ucwords(strtolower(trim(strip_tags(@$_POST['p_mae_nome']?: ''))));
$mae_natural_bsc_pais_id                  = strip_tags(@$_POST['p_mae_natural_bsc_pais_id']?: '');
$mae_profissao                            = ucwords(strtolower(trim(strip_tags(@$_POST['p_mae_profissao']?: ''))));
$foto                                     = "";
$sangue_tipo                              = strip_tags(@$_POST['p_sangue_tipo']?: '');
$raca                                     = ucwords(strtolower(trim(strip_tags(@$_POST['p_raca']?: ''))));
$enfermidade_portador                     = ucwords(strtolower(trim(strip_tags(@$_POST['p_enfermidade_portador']?: ''))));
$enfermidade_codigo_internacional         = trim(strip_tags(@$_POST['p_enfermidade_codigo_internacional']?: ''));
$tableName      = 'bsc_pessoa';
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
  if (is_numeric($id) && $id != "" && $id != 0 ) {
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
        natural_bsc_pais_id = ?,
        natural_bsc_municipio_id = ?,
        natural_estrangeiro_dt_ingresso = ?,
        natural_estrangeiro_cidade = ?,
        natural_estrangeiro_estado = ?,
        natural_estrangeiro_condicao_trabalho = ?,
        pai_nome = ?,
        pai_natural_bsc_pais_id = ?,
        pai_profissao = ?,
        mae_nome = ?,
        mae_natural_bsc_pais_id = ?,
        mae_profissao = ?,
        foto = ?,
        sangue_tipo = ?,
        raca = ?,
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
    $stmt->bindValue(7, $dt_nascimento);
    $stmt->bindValue(8, $sexo);
    $stmt->bindValue(9, $natural_bsc_pais_id);
    $stmt->bindValue(10, $natural_bsc_municipio_id?: '');
    $stmt->bindValue(11, $natural_estrangeiro_dt_ingresso?: NULL);
    $stmt->bindValue(12, $natural_estrangeiro_cidade);
    $stmt->bindValue(13, $natural_estrangeiro_estado);
    $stmt->bindValue(14, $natural_estrangeiro_condicao_trabalho);
    $stmt->bindValue(15, $pai_nome);
    $stmt->bindValue(16, $pai_natural_bsc_pais_id?: NULL);
    $stmt->bindValue(17, $pai_profissao);
    $stmt->bindValue(18, $mae_nome);
    $stmt->bindValue(19, $mae_natural_bsc_pais_id?: NULL);
    $stmt->bindValue(20, $mae_profissao);
    $stmt->bindValue(21, $foto);
    $stmt->bindValue(22, $sangue_tipo);
    $stmt->bindValue(23, $raca);
    $stmt->bindValue(24, $enfermidade_portador);
    $stmt->bindValue(25, $enfermidade_codigo_internacional);
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
    $stmt = $db->prepare('
      SELECT tb.cpf
      FROM '.$tableName.' AS tb 
      WHERE tb.cpf LIKE ?;');
    $stmt->bindValue(1, $cpf);
    $stmt->execute();
    $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsExistente)) {
      $db->rollback();
      $existentes = '';
      $virgula = '';
      foreach ($rsExistente as $kObj => $vObj) {
        $existentes .= $virgula.'<br/>'.(ucwords($kObj)).': '.$vObj;
        $virgula = ', ';
      }
      $result['status'] = 'error';
      $result['tipo'] = 'existente';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um banco registrado com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
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
          natural_bsc_pais_id,
          natural_bsc_municipio_id,
          natural_estrangeiro_dt_ingresso,
          natural_estrangeiro_cidade,
          natural_estrangeiro_estado,
          natural_estrangeiro_condicao_trabalho,
          pai_nome,
          pai_natural_bsc_pais_id,
          pai_profissao,
          mae_nome,
          mae_natural_bsc_pais_id,
          mae_profissao,
          foto,
          sangue_tipo,
          raca,
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
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro);
      $stmt->bindValue(3, $tipo);
      $stmt->bindValue(4, $nome);
      $stmt->bindValue(5, $nome_social);
      $stmt->bindValue(6, $cpf);
      $stmt->bindValue(7, $dt_nascimento);
      $stmt->bindValue(8, $sexo);
      $stmt->bindValue(9, $natural_bsc_pais_id);
      $stmt->bindValue(10, $natural_bsc_municipio_id?: NULL);
      $stmt->bindValue(11, $natural_estrangeiro_dt_ingresso?: NULL);
      $stmt->bindValue(12, $natural_estrangeiro_cidade);
      $stmt->bindValue(13, $natural_estrangeiro_estado);
      $stmt->bindValue(14, $natural_estrangeiro_condicao_trabalho);
      $stmt->bindValue(15, $pai_nome);
      $stmt->bindValue(16, $pai_natural_bsc_pais_id?: NULL);
      $stmt->bindValue(17, $pai_profissao);
      $stmt->bindValue(18, $mae_nome);
      $stmt->bindValue(19, $mae_natural_bsc_pais_id?: NULL);
      $stmt->bindValue(20, $mae_profissao);
      $stmt->bindValue(21, $foto);
      $stmt->bindValue(22, $sangue_tipo);
      $stmt->bindValue(23, $raca);
      $stmt->bindValue(24, $enfermidade_portador);
      $stmt->bindValue(25, $enfermidade_codigo_internacional);
      $stmt->execute();
      $idNew = $db->lastInsertId();
      // $senhaNome = strtolower(removeAcentos($nome));
      // $subSenhaNome = explode(' ',$senhaNome);
      // $subSenhaNome = array_values(array_diff($subSenhaNome, array('')));
      // $senhaNome = array_shift($subSenhaNome).'.'.array_pop($subSenhaNome);
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