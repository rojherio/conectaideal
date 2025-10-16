<?php
$id                                       = ucwords(strtolower(trim(strip_tags(@$_POST['sd_id']?: ''))));
$status                                   = strip_tags(@$_POST['sd_status']?: 0);
$dt_cadastro                              = strip_tags(@$_POST['sd_dt_cadastro']?: '');
$sme_servidor_id                          = strip_tags(@$_POST['sd_sme_servidor_id']?: '');
$codigo                                   = ucwords(strtolower(trim(strip_tags(@$_POST['sd_codigo']?: ''))));
$nome                                     = ucwords(strtolower(trim(strip_tags(@$_POST['sd_nome']?: ''))));
$bsc_parentesco_grau_id                   = strip_tags(@$_POST['sd_bsc_parentesco_grau_id']?: '');
$parentesco_grau_outro                    = ucwords(strtolower(trim(strip_tags(@$_POST['sd_parentesco_grau_outro']?: ''))));
$dt_nascimento                            = strip_tags(@$_POST['sd_dt_nascimento']?: '');
$dt_casamento                             = strip_tags(@$_POST['sd_dt_casamento']?: '');
$cpf                                      = ucwords(strtolower(trim(strip_tags(@$_POST['sd_cpf']?: ''))));
$beneficiario                             = array();
$benef_rg_numero                          = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_rg_numero']?: ''))));
$benef_rg_dt_emissao                      = strip_tags(@$_POST['sd_benef_rg_dt_emissao']?: '');
$benef_rg_orgao_expedidor                 = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_rg_orgao_expedidor']?: ''))));
$benef_tel_residencial                    = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_tel_residencial']?: ''))));
$benef_tel_celular                        = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_tel_celular']?: ''))));
$benef_end_cep                            = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_end_cep']?: ''))));
$benef_end_logradouro                     = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_end_logradouro']?: ''))));
$benef_end_numero                         = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_end_numero']?: ''))));
$benef_end_complemento                    = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_end_complemento']?: ''))));
$benef_end_bairro                         = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_end_bairro']?: ''))));
$benef_bsc_municipio_id                   = strip_tags(@$_POST['sd_benef_bsc_municipio_id']?: '');
$benef_autos_numero                       = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_autos_numero']?: ''))));
$benef_bsc_banco_conta_tipo_id            = strip_tags(@$_POST['sd_benef_bsc_banco_conta_tipo_id']?: '');
$benef_bsc_banco_id                       = strip_tags(@$_POST['sd_benef_bsc_banco_id']?: '');
$benef_agencia                            = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_agencia']?: ''))));
$benef_conta                              = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_conta']?: ''))));
$benef_op                                 = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_op']?: ''))));
$benef_repres_nome                        = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_nome']?: ''))));
$benef_repres_cpf                         = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_cpf']?: ''))));
$benef_repres_rg_numero                   = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_rg_numero']?: ''))));
$benef_repres_rg_dt_emissao               = strip_tags(@$_POST['sd_benef_repres_rg_dt_emissao']?: '');
$benef_repres_rg_orgao_expedidor          = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_rg_orgao_expedidor']?: ''))));
$benef_repres_end_cep                     = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_end_cep']?: ''))));
$benef_repres_end_logradouro              = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_end_logradouro']?: ''))));
$benef_repres_end_numero                  = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_end_numero']?: ''))));
$benef_repres_end_complemento             = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_end_complemento']?: ''))));
$benef_repres_end_bairro                  = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_end_bairro']?: ''))));
$benef_repres_bsc_municipio_id            = strip_tags(@$_POST['sd_benef_repres_bsc_municipio_id']?: '');
$benef_repres_tel_residencial             = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_tel_residencial']?: ''))));
$benef_repres_tel_celular                 = ucwords(strtolower(trim(strip_tags(@$_POST['sd_benef_repres_tel_celular']?: ''))));
//tratamento especial para checkbox
foreach ($id as $k => $v) {
  $beneficiario[$k] = @$_POST['si_beneficiario_'.($k+1)]?: 0;
}
$tableName      = 'sme_serv_dependente';
$error          = false;
$result         = array();
$msg            = "";
try {
  $db->beginTransaction();
  //consulta registros existente para comparar com $_POST
  $stmt = $db->prepare('
    SELECT 
    tb.id,
    tb.sme_servidor_id,
    tb.codigo,
    tb.nome,
    tb.bsc_parentesco_grau_id,
    tb.parentesco_grau_outro,
    tb.dt_nascimento,
    tb.dt_casamento,
    tb.cpf,
    tb.beneficiario,
    tb.benef_rg_numero,
    tb.benef_rg_dt_emissao,
    tb.benef_rg_orgao_expedidor,
    tb.benef_tel_residencial,
    tb.benef_tel_celular,
    tb.benef_end_cep,
    tb.benef_end_logradouro,
    tb.benef_end_numero,
    tb.benef_end_complemento,
    tb.benef_end_bairro,
    tb.benef_bsc_municipio_id,
    tb.benef_autos_numero,
    tb.benef_bsc_banco_conta_tipo_id,
    tb.benef_bsc_banco_id,
    tb.benef_agencia,
    tb.benef_conta,
    tb.benef_op,
    tb.benef_repres_nome,
    tb.benef_repres_cpf,
    tb.benef_repres_rg_numero,
    tb.benef_repres_rg_dt_emissao,
    tb.benef_repres_rg_orgao_expedidor,
    tb.benef_repres_end_cep,
    tb.benef_repres_end_logradouro,
    tb.benef_repres_end_numero,
    tb.benef_repres_end_complemento,
    tb.benef_repres_end_bairro,
    tb.benef_repres_bsc_municipio_id,
    tb.benef_repres_tel_residencial,
    tb.benef_repres_tel_celular
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
    if (is_numeric($bsc_escolaridade_id[$kId])) {
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
            beneficiario = ?,
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
        $stmt->bindValue(4, trim(strip_tags($codigo)));
        $stmt->bindValue(5, trim(strip_tags($nome)));
        $stmt->bindValue(6, $bsc_parentesco_grau_id[$kId]?: NULL);
        $stmt->bindValue(7, trim(strip_tags($parentesco_grau_outro)));
        $stmt->bindValue(8, $dt_nascimento?: NULL);
        $stmt->bindValue(9, $dt_casamento?: NULL);
        $stmt->bindValue(10, trim(strip_tags($cpf)));
        $stmt->bindValue(11, $beneficiario);
        $stmt->bindValue(12, trim(strip_tags(trim(strip_tags($benef_rg_numero)));
        $stmt->bindValue(13, trim(strip_tags($benef_rg_dt_emissao?: NULL)));
        $stmt->bindValue(14, trim(strip_tags($benef_rg_orgao_expedidor)));
        $stmt->bindValue(15, trim(strip_tags($benef_tel_residencial)));
        $stmt->bindValue(16, trim(strip_tags($benef_tel_celular)));
        $stmt->bindValue(17, trim(strip_tags($benef_end_cep)));
        $stmt->bindValue(18, trim(strip_tags($benef_end_logradouro)));
        $stmt->bindValue(19, trim(strip_tags($benef_end_numero)));
        $stmt->bindValue(20, trim(strip_tags($benef_end_complemento)));
        $stmt->bindValue(21, trim(strip_tags($benef_end_bairro)));
        $stmt->bindValue(22, $benef_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(23, trim(strip_tags($benef_autos_numero)));
        $stmt->bindValue(24, $benef_bsc_banco_conta_tipo_id[$kId]?: NULL);
        $stmt->bindValue(25, $benef_bsc_banco_id[$kId]?: NULL);
        $stmt->bindValue(26, trim(strip_tags($benef_agencia)));
        $stmt->bindValue(27, trim(strip_tags($benef_conta)));
        $stmt->bindValue(28, trim(strip_tags($benef_op)));
        $stmt->bindValue(29, trim(strip_tags($benef_repres_nome)));
        $stmt->bindValue(30, trim(strip_tags($benef_repres_cpf)));
        $stmt->bindValue(31, trim(strip_tags($benef_repres_rg_numero)));
        $stmt->bindValue(32, $benef_repres_rg_dt_emissao?: NULL);
        $stmt->bindValue(33, trim(strip_tags($benef_repres_rg_orgao_expedidor)));
        $stmt->bindValue(34, trim(strip_tags($benef_repres_end_cep)));
        $stmt->bindValue(35, trim(strip_tags($benef_repres_end_logradouro)));
        $stmt->bindValue(36, trim(strip_tags($benef_repres_end_numero)));
        $stmt->bindValue(37, trim(strip_tags($benef_repres_end_complemento)));
        $stmt->bindValue(38, trim(strip_tags($benef_repres_end_bairro)));
        $stmt->bindValue(39, $benef_repres_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(40, trim(strip_tags($benef_repres_tel_residencial)));
        $stmt->bindValue(41, trim(strip_tags($benef_repres_tel_celular)));
        $stmt->bindValue(42, $vId);
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
            beneficiario,
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
            benef_repres_tel_celular,
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
            ?
          );');
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $dt_cadastro?: NULL);
        $stmt->bindValue(3, $sme_servidor_id?: NULL);
        $stmt->bindValue(4, trim(strip_tags($codigo)));
        $stmt->bindValue(5, trim(strip_tags($nome)));
        $stmt->bindValue(6, $bsc_parentesco_grau_id[$kId]?: NULL);
        $stmt->bindValue(7, trim(strip_tags($parentesco_grau_outro)));
        $stmt->bindValue(8, $dt_nascimento?: NULL);
        $stmt->bindValue(9, $dt_casamento?: NULL);
        $stmt->bindValue(10, trim(strip_tags($cpf)));
        $stmt->bindValue(11, $beneficiario);
        $stmt->bindValue(12, trim(strip_tags(trim(strip_tags($benef_rg_numero)));
        $stmt->bindValue(13, trim(strip_tags($benef_rg_dt_emissao?: NULL)));
        $stmt->bindValue(14, trim(strip_tags($benef_rg_orgao_expedidor)));
        $stmt->bindValue(15, trim(strip_tags($benef_tel_residencial)));
        $stmt->bindValue(16, trim(strip_tags($benef_tel_celular)));
        $stmt->bindValue(17, trim(strip_tags($benef_end_cep)));
        $stmt->bindValue(18, trim(strip_tags($benef_end_logradouro)));
        $stmt->bindValue(19, trim(strip_tags($benef_end_numero)));
        $stmt->bindValue(20, trim(strip_tags($benef_end_complemento)));
        $stmt->bindValue(21, trim(strip_tags($benef_end_bairro)));
        $stmt->bindValue(22, $benef_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(23, trim(strip_tags($benef_autos_numero)));
        $stmt->bindValue(24, $benef_bsc_banco_conta_tipo_id[$kId]?: NULL);
        $stmt->bindValue(25, $benef_bsc_banco_id[$kId]?: NULL);
        $stmt->bindValue(26, trim(strip_tags($benef_agencia)));
        $stmt->bindValue(27, trim(strip_tags($benef_conta)));
        $stmt->bindValue(28, trim(strip_tags($benef_op)));
        $stmt->bindValue(29, trim(strip_tags($benef_repres_nome)));
        $stmt->bindValue(30, trim(strip_tags($benef_repres_cpf)));
        $stmt->bindValue(31, trim(strip_tags($benef_repres_rg_numero)));
        $stmt->bindValue(32, $benef_repres_rg_dt_emissao?: NULL);
        $stmt->bindValue(33, trim(strip_tags($benef_repres_rg_orgao_expedidor)));
        $stmt->bindValue(34, trim(strip_tags($benef_repres_end_cep)));
        $stmt->bindValue(35, trim(strip_tags($benef_repres_end_logradouro)));
        $stmt->bindValue(36, trim(strip_tags($benef_repres_end_numero)));
        $stmt->bindValue(37, trim(strip_tags($benef_repres_end_complemento)));
        $stmt->bindValue(38, trim(strip_tags($benef_repres_end_bairro)));
        $stmt->bindValue(39, $benef_repres_bsc_municipio_id[$kId]?: NULL);
        $stmt->bindValue(40, trim(strip_tags($benef_repres_tel_residencial)));
        $stmt->bindValue(41, trim(strip_tags($benef_repres_tel_celular)));
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