<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['pd_id']);
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$bsc_pessoa_id                            = strip_tags(@$_POST['pd_bsc_pessoa_id']?: '');
$rg_numero                                = trim(strip_tags(@$_POST['pd_rg_numero']?: ''));
$rg_dt_emissao                            = strip_tags(@$_POST['pd_rg_dt_emissao']?: '');
$rg_orgao_expedidor                       = trim(strip_tags(@$_POST['pd_rg_orgao_expedidor']?: ''));
$pis_numero                               = trim(strip_tags(@$_POST['pd_pis_numero']?: ''));
$pis_dt_cadastro                          = strip_tags(@$_POST['pd_pis_dt_cadastro']?: '');
$pis_domicilio_bancario                   = trim(strip_tags(@$_POST['pd_pis_domicilio_bancario']?: ''));
$pis_banco_numero                         = trim(strip_tags(@$_POST['pd_pis_banco_numero']?: ''));
$pis_banco_agencia                        = trim(strip_tags(@$_POST['pd_pis_banco_agencia']?: ''));
$pis_banco_end                            = trim(strip_tags(@$_POST['pd_pis_banco_end']?: ''));
$eleitor_numero                           = trim(strip_tags(@$_POST['pd_eleitor_numero']?: ''));
$eleitor_zona                             = trim(strip_tags(@$_POST['pd_eleitor_zona']?: ''));
$eleitor_secao                            = trim(strip_tags(@$_POST['pd_eleitor_secao']?: ''));
$eleitor_bsc_municipio_id                 = strip_tags(@$_POST['pd_eleitor_bsc_municipio_id']?: '');
$eleitor_insc_orgao_classe                = trim(strip_tags(@$_POST['pd_eleitor_insc_orgao_classe']?: ''));
$ctps_numero                              = trim(strip_tags(@$_POST['pd_ctps_numero']?: ''));
$ctps_serie                               = trim(strip_tags(@$_POST['pd_ctps_serie']?: ''));
$ctps_dt_emissao                          = strip_tags(@$_POST['pd_ctps_dt_emissao']?: '');
$ctps_orgao_expedidor                     = trim(strip_tags(@$_POST['pd_ctps_orgao_expedidor']?: ''));
$ctps_primeiro_emprego_ano                = trim(strip_tags(@$_POST['pd_ctps_primeiro_emprego_ano']?: ''));
$cnh_numero                               = trim(strip_tags(@$_POST['pd_cnh_numero']?: ''));
$cnh_categoria                            = trim(strip_tags(@$_POST['pd_cnh_categoria']?: ''));
$cnh_dt_emissao                           = strip_tags(@$_POST['pd_cnh_dt_emissao']?: '');
$cnh_orgao_expedidor                      = trim(strip_tags(@$_POST['pd_cnh_orgao_expedidor']?: ''));
$cnh_validade                             = trim(strip_tags(@$_POST['pd_cnh_validade']?: ''));
$cnh_dt_primeira_habilitacao              = strip_tags(@$_POST['pd_cnh_dt_primeira_habilitacao']?: '');
$rm_numero                                = trim(strip_tags(@$_POST['pd_rm_numero']?: ''));
$rm_categoria                             = trim(strip_tags(@$_POST['pd_rm_categoria']?: ''));
$rm_emissao_ano                           = trim(strip_tags(@$_POST['pd_rm_emissao_ano']?: ''));
$rm_orgao_expedidor                       = trim(strip_tags(@$_POST['pd_rm_orgao_expedidor']?: ''));
$rm_especie                               = trim(strip_tags(@$_POST['pd_rm_especie']?: ''));
$rp_numero                                = trim(strip_tags(@$_POST['pd_rp_numero']?: ''));
$rp_dt_emissao                            = strip_tags(@$_POST['pd_rp_dt_emissao']?: '');
$rp_orgao_expedidor                       = trim(strip_tags(@$_POST['pd_rp_orgao_expedidor']?: ''));
$rp_dt_validade                           = strip_tags(@$_POST['pd_rp_dt_validade']?: '');
$rne_numero                               = trim(strip_tags(@$_POST['pd_rne_numero']?: ''));
$rne_dt_emissao                           = strip_tags(@$_POST['pd_rne_dt_emissao']?: '');
$rne_orgao_expedidor                      = trim(strip_tags(@$_POST['pd_rne_orgao_expedidor']?: ''));
$fgts_numero                              = trim(strip_tags(@$_POST['pd_fgts_numero']?: ''));
$fgts_opcao                               = trim(strip_tags(@$_POST['pd_fgts_opcao']?: ''));
$fgts_conta_vinculaa_banco                = trim(strip_tags(@$_POST['pd_fgts_conta_vinculaa_banco']?: ''));
$fgts_dt_retificacao                      = strip_tags(@$_POST['pd_fgts_dt_retificacao']?: '');
$estrangeiro_casado_brasileiro            = trim(strip_tags(@$_POST['pd_estrangeiro_casado_brasileiro']?: ''));
$estrangeiro_filho_brasileiro             = trim(strip_tags(@$_POST['pd_estrangeiro_filho_brasileiro']?: ''));
$tableName      = 'bsc_pessoa_documento';
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
  if (is_numeric($id) && $id != 0) {
    $stmt = $db->prepare('
      UPDATE '.$tableName.' 
        SET
        status = ?,
        dt_cadastro = ?,
        bsc_pessoa_id = ?,
        rg_numero = ?,
        rg_dt_emissao = ?,
        rg_orgao_expedidor = ?,
        pis_numero = ?,
        pis_dt_cadastro = ?,
        pis_domicilio_bancario = ?,
        pis_banco_numero = ?,
        pis_banco_agencia = ?,
        pis_banco_end = ?,
        eleitor_numero = ?,
        eleitor_zona = ?,
        eleitor_secao = ?,
        eleitor_bsc_municipio_id = ?,
        eleitor_insc_orgao_classe = ?,
        ctps_numero = ?,
        ctps_serie = ?,
        ctps_dt_emissao = ?,
        ctps_orgao_expedidor = ?,
        ctps_primeiro_emprego_ano = ?,
        cnh_numero = ?,
        cnh_categoria = ?,
        cnh_dt_emissao = ?,
        cnh_orgao_expedidor = ?,
        cnh_validade = ?,
        cnh_dt_primeira_habilitacao = ?,
        rm_numero = ?,
        rm_categoria = ?,
        rm_emissao_ano = ?,
        rm_orgao_expedidor = ?,
        rm_especie = ?,
        rp_numero = ?,
        rp_dt_emissao = ?,
        rp_orgao_expedidor = ?,
        rp_dt_validade = ?,
        rne_numero = ?,
        rne_dt_emissao = ?,
        rne_orgao_expedidor = ?,
        fgts_numero = ?,
        fgts_opcao = ?,
        fgts_conta_vinculaa_banco = ?,
        fgts_dt_retificacao = ?,
        estrangeiro_casado_brasileiro = ?,
        estrangeiro_filho_brasileiro = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $bsc_pessoa_id?: NULL);
    $stmt->bindValue(4, $rg_numero);
    $stmt->bindValue(5, $rg_dt_emissao?: NULL);
    $stmt->bindValue(6, $rg_orgao_expedidor);
    $stmt->bindValue(7, $pis_numero);
    $stmt->bindValue(8, $pis_dt_cadastro?: NULL);
    $stmt->bindValue(9, $pis_domicilio_bancario);
    $stmt->bindValue(10, $pis_banco_numero);
    $stmt->bindValue(11, $pis_banco_agencia);
    $stmt->bindValue(12, $pis_banco_end);
    $stmt->bindValue(13, $eleitor_numero);
    $stmt->bindValue(14, $eleitor_zona);
    $stmt->bindValue(15, $eleitor_secao);
    $stmt->bindValue(16, $eleitor_bsc_municipio_id?: NULL);
    $stmt->bindValue(17, $eleitor_insc_orgao_classe);
    $stmt->bindValue(18, $ctps_numero);
    $stmt->bindValue(19, $ctps_serie);
    $stmt->bindValue(20, $ctps_dt_emissao?: NULL);
    $stmt->bindValue(21, $ctps_orgao_expedidor);
    $stmt->bindValue(22, $ctps_primeiro_emprego_ano?: NULL);
    $stmt->bindValue(23, $cnh_numero);
    $stmt->bindValue(24, $cnh_categoria);
    $stmt->bindValue(25, $cnh_dt_emissao?: NULL);
    $stmt->bindValue(26, $cnh_orgao_expedidor);
    $stmt->bindValue(27, $cnh_validade?: NULL);
    $stmt->bindValue(28, $cnh_dt_primeira_habilitacao?: NULL);
    $stmt->bindValue(29, $rm_numero);
    $stmt->bindValue(30, $rm_categoria);
    $stmt->bindValue(31, $rm_emissao_ano?: NULL);
    $stmt->bindValue(32, $rm_orgao_expedidor);
    $stmt->bindValue(33, $rm_especie);
    $stmt->bindValue(34, $rp_numero);
    $stmt->bindValue(35, $rp_dt_emissao?: NULL);
    $stmt->bindValue(36, $rp_orgao_expedidor);
    $stmt->bindValue(37, $rp_dt_validade?: NULL);
    $stmt->bindValue(38, $rne_numero);
    $stmt->bindValue(39, $rne_dt_emissao?: NULL);
    $stmt->bindValue(40, $rne_orgao_expedidor);
    $stmt->bindValue(41, $fgts_numero);
    $stmt->bindValue(42, $fgts_opcao);
    $stmt->bindValue(43, $fgts_conta_vinculaa_banco);
    $stmt->bindValue(44, $fgts_dt_retificacao?: NULL);
    $stmt->bindValue(45, $estrangeiro_casado_brasileiro);
    $stmt->bindValue(46, $estrangeiro_filho_brasileiro);
    $stmt->bindValue(47, $id);
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
      SELECT tb.rg_numero AS Número_RG 
      FROM '.$tableName.' AS tb 
      WHERE tb.rg_numero LIKE ?;');
    $stmt->bindValue(1, $rg_numero);
    $stmt->execute();
    $rsExistente = $stmt->fetch(PDO::FETCH_ASSOC);
    if (is_array($rsExistente)) {
      $db->rollback();
      $existentes = '';
      $virgula = '';
      foreach ($rsExistente as $kObj => $vObj) {
        $existentes .= $virgula.'<br/>'.$kObj.': '.$vObj;
        $virgula = ', ';
      }
      $result['status'] = 'error';
      $result['tipo'] = 'existente';
      $result['msg'] = "Houve um erro ao tentar registrar as novas informações, pois no sistema já existe um registro com o(s) seguinte(s) dado(s):<br/>".$existentes.".";
      echo json_encode($result);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO '.$tableName.' 
        (
          status,
          dt_cadastro,
          bsc_pessoa_id,
          rg_numero,
          rg_dt_emissao,
          rg_orgao_expedidor,
          pis_numero,
          pis_dt_cadastro,
          pis_domicilio_bancario,
          pis_banco_numero,
          pis_banco_agencia,
          pis_banco_end,
          eleitor_numero,
          eleitor_zona,
          eleitor_secao,
          eleitor_bsc_municipio_id,
          eleitor_insc_orgao_classe,
          ctps_numero,
          ctps_serie,
          ctps_dt_emissao,
          ctps_orgao_expedidor,
          ctps_primeiro_emprego_ano,
          cnh_numero,
          cnh_categoria,
          cnh_dt_emissao,
          cnh_orgao_expedidor,
          cnh_validade,
          cnh_dt_primeira_habilitacao,
          rm_numero,
          rm_categoria,
          rm_emissao_ano,
          rm_orgao_expedidor,
          rm_especie,
          rp_numero,
          rp_dt_emissao,
          rp_orgao_expedidor,
          rp_dt_validade,
          rne_numero,
          rne_dt_emissao,
          rne_orgao_expedidor,
          fgts_numero,
          fgts_opcao,
          fgts_conta_vinculaa_banco,
          fgts_dt_retificacao,
          estrangeiro_casado_brasileiro,
          estrangeiro_filho_brasileiro
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
      $stmt->bindValue(4, $rg_numero);
      $stmt->bindValue(5, $rg_dt_emissao?: NULL);
      $stmt->bindValue(6, $rg_orgao_expedidor);
      $stmt->bindValue(7, $pis_numero);
      $stmt->bindValue(8, $pis_dt_cadastro?: NULL);
      $stmt->bindValue(9, $pis_domicilio_bancario);
      $stmt->bindValue(10, $pis_banco_numero);
      $stmt->bindValue(11, $pis_banco_agencia);
      $stmt->bindValue(12, $pis_banco_end);
      $stmt->bindValue(13, $eleitor_numero);
      $stmt->bindValue(14, $eleitor_zona);
      $stmt->bindValue(15, $eleitor_secao);
      $stmt->bindValue(16, $eleitor_bsc_municipio_id?: NULL);
      $stmt->bindValue(17, $eleitor_insc_orgao_classe);
      $stmt->bindValue(18, $ctps_numero);
      $stmt->bindValue(19, $ctps_serie);
      $stmt->bindValue(20, $ctps_dt_emissao?: NULL);
      $stmt->bindValue(21, $ctps_orgao_expedidor);
      $stmt->bindValue(22, $ctps_primeiro_emprego_ano?: NULL);
      $stmt->bindValue(23, $cnh_numero);
      $stmt->bindValue(24, $cnh_categoria);
      $stmt->bindValue(25, $cnh_dt_emissao?: NULL);
      $stmt->bindValue(26, $cnh_orgao_expedidor);
      $stmt->bindValue(27, $cnh_validade?: NULL);
      $stmt->bindValue(28, $cnh_dt_primeira_habilitacao?: NULL);
      $stmt->bindValue(29, $rm_numero);
      $stmt->bindValue(30, $rm_categoria);
      $stmt->bindValue(31, $rm_emissao_ano?: NULL);
      $stmt->bindValue(32, $rm_orgao_expedidor);
      $stmt->bindValue(33, $rm_especie);
      $stmt->bindValue(34, $rp_numero);
      $stmt->bindValue(35, $rp_dt_emissao?: NULL);
      $stmt->bindValue(36, $rp_orgao_expedidor);
      $stmt->bindValue(37, $rp_dt_validade?: NULL);
      $stmt->bindValue(38, $rne_numero);
      $stmt->bindValue(39, $rne_dt_emissao?: NULL);
      $stmt->bindValue(40, $rne_orgao_expedidor);
      $stmt->bindValue(41, $fgts_numero);
      $stmt->bindValue(42, $fgts_opcao);
      $stmt->bindValue(43, $fgts_conta_vinculaa_banco);
      $stmt->bindValue(44, $fgts_dt_retificacao?: NULL);
      $stmt->bindValue(45, $estrangeiro_casado_brasileiro);
      $stmt->bindValue(46, $estrangeiro_filho_brasileiro);
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