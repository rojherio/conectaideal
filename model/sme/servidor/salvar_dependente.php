<?php
$id                                       = @$_POST['sd_sme_serv_dependente_id']?: '';
$status                                   = 1;
$dt_cadastro                              = date("Y-m-d H:i:s");
$sme_servidor_id                          = strip_tags(@$_POST['sd_sme_servidor_id']?: '');
$codigo                                   = @$_POST['sd_codigo']?: '';
$nome                                     = @$_POST['sd_nome']?: '';
$bsc_parentesco_grau_id                   = @$_POST['sd_bsc_parentesco_grau_id']?: '';
$parentesco_grau_outro                    = @$_POST['sd_parentesco_grau_outro']?: '';
$dt_nascimento                            = @$_POST['sd_dt_nascimento']?: '';
$dt_casamento                             = @$_POST['sd_dt_casamento']?: '';
$cpf                                      = @$_POST['sd_cpf']?: '';
$benef_rg_numero                          = @$_POST['sd_benef_rg_numero']?: '';
$benef_rg_dt_emissao                      = @$_POST['sd_benef_rg_dt_emissao']?: '';
$benef_rg_orgao_expedidor                 = @$_POST['sd_benef_rg_orgao_expedidor']?: '';
$benef_tel_residencial                    = @$_POST['sd_benef_tel_residencial']?: '';
$benef_tel_celular                        = @$_POST['sd_benef_tel_celular']?: '';
$benef_end_cep                            = @$_POST['sd_benef_end_cep']?: '';
$benef_end_logradouro                     = @$_POST['sd_benef_end_logradouro']?: '';
$benef_end_numero                         = @$_POST['sd_benef_end_numero']?: '';
$benef_end_complemento                    = @$_POST['sd_benef_end_complemento']?: '';
$benef_end_bairro                         = @$_POST['sd_benef_end_bairro']?: '';
$benef_bsc_municipio_id                   = @$_POST['sd_benef_bsc_municipio_id']?: '';
$benef_autos_numero                       = @$_POST['sd_benef_autos_numero']?: '';
$benef_bsc_banco_conta_tipo_id            = @$_POST['sd_benef_bsc_banco_conta_tipo_id']?: '';
$benef_bsc_banco_id                       = @$_POST['sd_benef_bsc_banco_id']?: '';
$benef_agencia                            = @$_POST['sd_benef_agencia']?: '';
$benef_conta                              = @$_POST['sd_benef_conta']?: '';
$benef_op                                 = @$_POST['sd_benef_op']?: '';
$benef_repres_nome                        = @$_POST['sd_benef_repres_nome']?: '';
$benef_repres_cpf                         = @$_POST['sd_benef_repres_cpf']?: '';
$benef_repres_rg_numero                   = @$_POST['sd_benef_repres_rg_numero']?: '';
$benef_repres_rg_dt_emissao               = @$_POST['sd_benef_repres_rg_dt_emissao']?: '';
$benef_repres_rg_orgao_expedidor          = @$_POST['sd_benef_repres_rg_orgao_expedidor']?: '';
$benef_repres_end_cep                     = @$_POST['sd_benef_repres_end_cep']?: '';
$benef_repres_end_logradouro              = @$_POST['sd_benef_repres_end_logradouro']?: '';
$benef_repres_end_numero                  = @$_POST['sd_benef_repres_end_numero']?: '';
$benef_repres_end_complemento             = @$_POST['sd_benef_repres_end_complemento']?: '';
$benef_repres_end_bairro                  = @$_POST['sd_benef_repres_end_bairro']?: '';
$benef_repres_bsc_municipio_id            = @$_POST['sd_benef_repres_bsc_municipio_id']?: '';
$benef_repres_tel_residencial             = @$_POST['sd_benef_repres_tel_residencial']?: '';
$benef_repres_tel_celular                 = @$_POST['sd_benef_repres_tel_celular']?: '';
$tableName      = 'sme_serv_dependente';
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
    if (!is_numeric($bsc_parentesco_grau_id[$kId])) {
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
            codigo = ?,
            nome = ?,
            bsc_parentesco_grau_id = ?,
            parentesco_grau_outro = ?,
            dt_nascimento = ?,
            dt_casamento = ?,
            cpf = ?,
            benef_rg_numero = ?,
            benef_rg_dt_emissao = ?,
            benef_rg_orgao_expedidor = ?,
            benef_tel_residencial = ?,
            benef_tel_celular = ?,
            benef_end_cep = ?,
            benef_end_logradouro = ?,
            benef_end_numero = ?,
            benef_end_complemento = ?,
            benef_end_bairro = ?,
            benef_bsc_municipio_id = ?,
            benef_autos_numero = ?,
            benef_bsc_banco_conta_tipo_id = ?,
            benef_bsc_banco_id = ?,
            benef_agencia = ?,
            benef_conta = ?,
            benef_op = ?,
            benef_repres_nome = ?,
            benef_repres_cpf = ?,
            benef_repres_rg_numero = ?,
            benef_repres_rg_dt_emissao = ?,
            benef_repres_rg_orgao_expedidor = ?,
            benef_repres_end_cep = ?,
            benef_repres_end_logradouro = ?,
            benef_repres_end_numero = ?,
            benef_repres_end_complemento = ?,
            benef_repres_end_bairro = ?,
            benef_repres_bsc_municipio_id = ?,
            benef_repres_tel_residencial = ?,
            benef_repres_tel_celular = ?
            WHERE id = ?
            ');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, trim(strip_tags($codigo[$kId])));
        $stmt->bindValue(5, trim(strip_tags($nome[$kId])));
        $stmt->bindValue(6, $bsc_parentesco_grau_id[$kId]?: NULL);
        $stmt->bindValue(7, trim(strip_tags($parentesco_grau_outro[$kId])));
        $stmt->bindValue(8, $dt_nascimento[$kId]?: NULL);
        $stmt->bindValue(9, $dt_casamento[$kId]?: NULL);
        $stmt->bindValue(10, trim(strip_tags($cpf[$kId])));
        $stmt->bindValue(11, trim(strip_tags($benef_rg_numero[$kId])));
        $stmt->bindValue(12, $benef_rg_dt_emissao[$kId]?: NULL);
        $stmt->bindValue(13, trim(strip_tags($benef_rg_orgao_expedidor[$kId])));
        $stmt->bindValue(14, trim(strip_tags($benef_tel_residencial[$kId])));
        $stmt->bindValue(15, trim(strip_tags($benef_tel_celular[$kId])));
        $stmt->bindValue(16, trim(strip_tags($benef_end_cep[$kId])));
        $stmt->bindValue(17, trim(strip_tags($benef_end_logradouro[$kId])));
        $stmt->bindValue(18, trim(strip_tags($benef_end_numero[$kId])));
        $stmt->bindValue(19, trim(strip_tags($benef_end_complemento[$kId])));
        $stmt->bindValue(20, trim(strip_tags($benef_end_bairro[$kId])));
        $stmt->bindValue(21, $benef_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(22, trim(strip_tags($benef_autos_numero[$kId])));
        $stmt->bindValue(23, $benef_bsc_banco_conta_tipo_id[$kId]?: NULL);
        $stmt->bindValue(24, $benef_bsc_banco_id[$kId]?: NULL);
        $stmt->bindValue(25, trim(strip_tags($benef_agencia[$kId])));
        $stmt->bindValue(26, trim(strip_tags($benef_conta[$kId])));
        $stmt->bindValue(27, trim(strip_tags($benef_op[$kId])));
        $stmt->bindValue(28, trim(strip_tags($benef_repres_nome[$kId])));
        $stmt->bindValue(29, trim(strip_tags($benef_repres_cpf[$kId])));
        $stmt->bindValue(30, trim(strip_tags($benef_repres_rg_numero[$kId])));
        $stmt->bindValue(31, $benef_repres_rg_dt_emissao[$kId]?: NULL);
        $stmt->bindValue(32, trim(strip_tags($benef_repres_rg_orgao_expedidor[$kId])));
        $stmt->bindValue(33, trim(strip_tags($benef_repres_end_cep[$kId])));
        $stmt->bindValue(34, trim(strip_tags($benef_repres_end_logradouro[$kId])));
        $stmt->bindValue(35, trim(strip_tags($benef_repres_end_numero[$kId])));
        $stmt->bindValue(36, trim(strip_tags($benef_repres_end_complemento[$kId])));
        $stmt->bindValue(37, trim(strip_tags($benef_repres_end_bairro[$kId])));
        $stmt->bindValue(38, $benef_repres_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(39, trim(strip_tags($benef_repres_tel_residencial[$kId])));
        $stmt->bindValue(40, trim(strip_tags($benef_repres_tel_celular[$kId])));
        $stmt->bindValue(41, $vId);
        $stmt->execute();
      } else {
        $stmt = $db->prepare('INSERT INTO '.$tableName.' 
          (
            status,
            dt_cadastro,
            sme_servidor_id,
            codigo,
            nome,
            bsc_parentesco_grau_id,
            parentesco_grau_outro,
            dt_nascimento,
            dt_casamento,
            cpf,
            benef_rg_numero,
            benef_rg_dt_emissao,
            benef_rg_orgao_expedidor,
            benef_tel_residencial,
            benef_tel_celular,
            benef_end_cep,
            benef_end_logradouro,
            benef_end_numero,
            benef_end_complemento,
            benef_end_bairro,
            benef_bsc_municipio_id,
            benef_autos_numero,
            benef_bsc_banco_conta_tipo_id,
            benef_bsc_banco_id,
            benef_agencia,
            benef_conta,
            benef_op,
            benef_repres_nome,
            benef_repres_cpf,
            benef_repres_rg_numero,
            benef_repres_rg_dt_emissao,
            benef_repres_rg_orgao_expedidor,
            benef_repres_end_cep,
            benef_repres_end_logradouro,
            benef_repres_end_numero,
            benef_repres_end_complemento,
            benef_repres_end_bairro,
            benef_repres_bsc_municipio_id,
            benef_repres_tel_residencial,
            benef_repres_tel_celular
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
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, trim(strip_tags($codigo[$kId])));
        $stmt->bindValue(5, trim(strip_tags($nome[$kId])));
        $stmt->bindValue(6, $bsc_parentesco_grau_id[$kId]?: NULL);
        $stmt->bindValue(7, trim(strip_tags($parentesco_grau_outro[$kId])));
        $stmt->bindValue(8, $dt_nascimento[$kId]?: NULL);
        $stmt->bindValue(9, $dt_casamento[$kId]?: NULL);
        $stmt->bindValue(10, trim(strip_tags($cpf[$kId])));
        $stmt->bindValue(11, trim(strip_tags($benef_rg_numero[$kId])));
        $stmt->bindValue(12, $benef_rg_dt_emissao[$kId]?: NULL);
        $stmt->bindValue(13, trim(strip_tags($benef_rg_orgao_expedidor[$kId])));
        $stmt->bindValue(14, trim(strip_tags($benef_tel_residencial[$kId])));
        $stmt->bindValue(15, trim(strip_tags($benef_tel_celular[$kId])));
        $stmt->bindValue(16, trim(strip_tags($benef_end_cep[$kId])));
        $stmt->bindValue(17, trim(strip_tags($benef_end_logradouro[$kId])));
        $stmt->bindValue(18, trim(strip_tags($benef_end_numero[$kId])));
        $stmt->bindValue(19, trim(strip_tags($benef_end_complemento[$kId])));
        $stmt->bindValue(20, trim(strip_tags($benef_end_bairro[$kId])));
        $stmt->bindValue(21, $benef_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(22, trim(strip_tags($benef_autos_numero[$kId])));
        $stmt->bindValue(23, $benef_bsc_banco_conta_tipo_id[$kId]?: NULL);
        $stmt->bindValue(24, $benef_bsc_banco_id[$kId]?: NULL);
        $stmt->bindValue(25, trim(strip_tags($benef_agencia[$kId])));
        $stmt->bindValue(26, trim(strip_tags($benef_conta[$kId])));
        $stmt->bindValue(27, trim(strip_tags($benef_op[$kId])));
        $stmt->bindValue(28, trim(strip_tags($benef_repres_nome[$kId])));
        $stmt->bindValue(29, trim(strip_tags($benef_repres_cpf[$kId])));
        $stmt->bindValue(30, trim(strip_tags($benef_repres_rg_numero[$kId])));
        $stmt->bindValue(31, $benef_repres_rg_dt_emissao[$kId]?: NULL);
        $stmt->bindValue(32, trim(strip_tags($benef_repres_rg_orgao_expedidor[$kId])));
        $stmt->bindValue(33, trim(strip_tags($benef_repres_end_cep[$kId])));
        $stmt->bindValue(34, trim(strip_tags($benef_repres_end_logradouro[$kId])));
        $stmt->bindValue(35, trim(strip_tags($benef_repres_end_numero[$kId])));
        $stmt->bindValue(36, trim(strip_tags($benef_repres_end_complemento[$kId])));
        $stmt->bindValue(37, trim(strip_tags($benef_repres_end_bairro[$kId])));
        $stmt->bindValue(38, $benef_repres_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(39, trim(strip_tags($benef_repres_tel_residencial[$kId])));
        $stmt->bindValue(40, trim(strip_tags($benef_repres_tel_celular[$kId])));
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