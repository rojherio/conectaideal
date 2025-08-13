<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['p_id']);
$status                                   = strip_tags(@$_POST['p_status']);
$dt_cadastro                              = date("Y-m-d H:i:s");
$tipo                                     = 1; //1 = pessoa física, 2 = pessoa jurídica
$nome                                     = strip_tags(@$_POST['p_nome']);
$nomeSocial                               = strip_tags(@$_POST['p_nome_social']);
$cpf                                      = strip_tags(@$_POST['p_cpf']);
$dt_nascimento                            = strip_tags(@$_POST['p_dt_nascimento']);
$sexo                                     = strip_tags(@$_POST['p_sexo']);
$natural_bsc_pais_id                      = strip_tags(@$_POST['p_natural_bsc_pais_id']);
$natural_bsc_municipio_id                 = strip_tags(@$_POST['p_natural_bsc_municipio_id']?: '');
$natural_estrangeiro_dt_ingresso          = strip_tags(@$_POST['p_natural_estrangeiro_dt_ingresso']?: '');
$natural_estrangeiro_cidade               = strip_tags(@$_POST['p_natural_estrangeiro_cidade']?: '');
$natural_estrangeiro_estado               = strip_tags(@$_POST['p_natural_estrangeiro_estado']?: '');
$natural_estrangeiro_condicao_trabalho    = strip_tags(@$_POST['p_natural_estrangeiro_condicao_trabalho']?: '');
$pai_nome                                 = strip_tags(@$_POST['p_pai_nome']);
$pai_natural_bsc_pais_id                  = strip_tags(@$_POST['p_pai_natural_bsc_pais_id']?: '');
$pai_profissao                            = strip_tags(@$_POST['p_pai_profissao']);
$mae_nome                                 = strip_tags(@$_POST['p_mae_nome']);
$mae_natural_bsc_pais_id                  = strip_tags(@$_POST['p_mae_natural_bsc_pais_id']?: '');
$mae_profissao                            = strip_tags(@$_POST['p_mae_profissao']);
$foto                                     = "";
$sangue_tipo                              = strip_tags(@$_POST['p_sangue_tipo']);
$raca                                     = strip_tags(@$_POST['p_raca']);
$enfermedade_portador                     = strip_tags(@$_POST['p_enfermedade_portador']);
$enfermidade_codigo_internacional         = strip_tags(@$_POST['p_enfermidade_codigo_internacional']);
$error = false;
$result = array();
$msg = "";
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
      UPDATE bsc_pessoa 
        SET
        p.status = ?,
        p.dt_cadastro = ?,
        p.tipo = ?,
        p.nome = ?,
        p.nome_social = ?,
        p.cpf = ?,
        p.dt_nascimento = ?,
        p.sexo = ?,
        p.natural_bsc_pais_id = ?,
        p.natural_bsc_municipio_id = ?,
        p.natural_estrangeiro_dt_ingresso = ?,
        p.natural_estrangeiro_cidade = ?,
        p.natural_estrangeiro_estado = ?,
        p.natural_estrangeiro_condicao_trabalho = ?,
        p.pai_nome = ?,
        p.pai_natural_bsc_pais_id = ?,
        p.pai_profissao = ?,
        p.mae_nome = ?,
        p.mae_natural_bsc_pais_id = ?,
        p.mae_profissao = ?,
        p.foto = ?,
        p.sangue_tipo = ?,
        p.raca = ?,
        p.enfermedade_portador = ?,
        p.enfermedade_codigo_internacional = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro);
    $stmt->bindValue(3, $tipo);
    $stmt->bindValue(4, $nome);
    $stmt->bindValue(5, $nomeSocial);
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
    $stmt->bindValue(24, $enfermedade_portador);
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
      SELECT p.id, p.cpf
      FROM bsc_pessoa AS p 
      WHERE p.cpf LIKE ?;');
    $stmt->bindValue(1, $cpf);
    $stmt->execute();
    $rsPessoa = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsPessoa)) {
      $db->rollback();
      $result['status'] = 'error';
      $result['tipo'] = 'cpf';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe uma pessoa física registrada com o cpf: ".$cpf.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO bsc_pessoa 
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
          enfermedade_portador,
          enfermedade_codigo_internacional
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
      $stmt->bindValue(5, $nomeSocial);
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
      $stmt->bindValue(24, $enfermedade_portador);
      $stmt->bindValue(25, $enfermidade_codigo_internacional);
      $stmt->execute();
      $bscPessoaIdNew = $db->lastInsertId();
      // $senhaNome = strtolower(removeAcentos($nome));
      // $subSenhaNome = explode(' ',$senhaNome);
      // $subSenhaNome = array_values(array_diff($subSenhaNome, array('')));
      // $senhaNome = array_shift($subSenhaNome).'.'.array_pop($subSenhaNome);
      $db->commit();
      //MENSAGEM DE SUCESSO
      $result['id'] = $bscPessoaIdNew;
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