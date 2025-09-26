<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['ue_id']?: '');
$status                                   = strip_tags(@$_POST['ue_status']?: 0);
$dt_cadastro                              = date("Y-m-d H:i:s");
$bsc_pessoa_id                            = strip_tags(@$_POST['ue_bsc_pessoa_id']?: '');
$inep_cod                                 = trim(strip_tags(@$_POST['ue_inep_cod']?: ''));
$ue_funcionam_situacao_id                 = strip_tags(@$_POST['ue_ue_funcionam_situacao_id']?: '');
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
$fornece_agua_potavel                     = trim(strip_tags(@$_POST['ue_fornece_agua_potavel']?: ''));
$sala_aula_qtd                            = trim(strip_tags(@$_POST['ue_sala_aula_qtd']?: ''));
$sala_aula_climatizada_qtd                = trim(strip_tags(@$_POST['ue_sala_aula_climatizada_qtd']?: ''));
$sala_aula_acessibilidade_qtd             = trim(strip_tags(@$_POST['ue_sala_aula_acessibilidade_qtd']?: ''));
$internet_banda_larga_velocidade          = trim(strip_tags(@$_POST['ue_internet_banda_larga_velocidade']?: ''));
$alimentacao_pnae_fnde_oferece            = trim(strip_tags(@$_POST['alimentacao_pnae_fnde_oferece']?: ''));
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
echo json_encode(array('status' => 'success', 'msg' => 'As novas informações foram registradas com sucesso.'));
exit();
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
        ie = ?,
        dt_criacao = ?
        WHERE id = ?
        ');
    $stmt->bindValue(1, $status);
    $stmt->bindValue(2, $dt_cadastro?: NULL);
    $stmt->bindValue(3, $tipo);
    $stmt->bindValue(4, $nome);
    $stmt->bindValue(5, $nome_social);
    $stmt->bindValue(6, $cpf);
    $stmt->bindValue(7, $ie);
    $stmt->bindValue(8, $dt_criacao?: NULL);
    $stmt->bindValue(9, $id);
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
        $existentes .= $virgula.'<br/>'.(ucwords($kObj!='cpf'? : 'CNPJ')).': '.$vObj;
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
          ie,
          dt_criacao
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
          ?
        )');
      $stmt->bindValue(1, $status);
      $stmt->bindValue(2, $dt_cadastro?: NULL);
      $stmt->bindValue(3, $tipo);
      $stmt->bindValue(4, $nome);
      $stmt->bindValue(5, $nome_social);
      $stmt->bindValue(6, $cpf);
      $stmt->bindValue(7, $ie);
      $stmt->bindValue(8, $dt_criacao?: NULL);
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