<?php
$db                                       = Conexao::getInstance();
$id                                       = strip_tags(@$_POST['p_id']);
$tipo                                     = 1; //1 = pessoa física, 2 = pessoa jurídica
$status                                   = strip_tags(@$_POST['p_status']);
$nome                                     = strip_tags(@$_POST['p_nome']);
$nomeSocial                               = strip_tags(@$_POST['p_nome_social']);
$cpf                                      = strip_tags(@$_POST['p_cpf']);
$dt_nascimento                            = strip_tags(@$_POST['p_dt_nascimento']);
$sexo                                     = strip_tags(@$_POST['p_sexo']);
$natural_bsc_pais_id                      = strip_tags(@$_POST['p_natural_bsc_pais_id']);
$natural_bsc_municipio_id                 = strip_tags(@$_POST['p_natural_bsc_municipio_id']);
$natural_estrangeiro_dt_ingresso          = strip_tags(@$_POST['p_natural_estrangeiro_dt_ingresso']);
$natural_estrangeiro_cidade               = strip_tags(@$_POST['p_natural_estrangeiro_cidade']);
$natural_estrangeiro_estado               = strip_tags(@$_POST['p_natural_estrangeiro_estado']);
$natural_estrangeiro_condicao_trabalho    = strip_tags(@$_POST['p_natural_estrangeiro_condicao_trabalho']);
$pai_nome                                 = strip_tags(@$_POST['p_pai_nome']);
$pai_natural_bsc_pais_id                  = strip_tags(@$_POST['p_pai_natural_bsc_pais_id']);
$pai_profissao                            = strip_tags(@$_POST['p_pai_profissao']);
$mae_nome                                 = strip_tags(@$_POST['p_mae_nome']);
$mae_natural_bsc_pais_id                  = strip_tags(@$_POST['p_mae_natural_bsc_pais_id']);
$mae_profissao                            = strip_tags(@$_POST['p_mae_profissao']);
$foto                                     = "";
$sangue_tipo                              = strip_tags(@$_POST['p_sangue_tipo']);
$raca                                     = strip_tags(@$_POST['p_raca']);
$enfermedade_portador                     = strip_tags(@$_POST['p_enfermedade_portador']);
$enfermidade_codigo_internacional         = strip_tags(@$_POST['p_enfermidade_codigo_internacional']);
$error = false;
$retorno = array();
$mensagem = "";

echo json_encode('entrou');
exit();
try {
  $db->beginTransaction();
  if (is_numeric($id) && $id != "" && $id != 0 ) {
    $stmt = $db->prepare('
      UPDATE seg_servidor 
      SET
      nome = ?, 
      cpf = ?, 
      matricula = ?, 
      matricula_2 = ?, 
      mae_nome = ?, 
      dt_cadastro = NOW(), 
      seg_usuario_id = ?
      WHERE id = (SELECT seg_servidor_id FROM rh_servidor WHERE id = ?) ;');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $cpf);
    $stmt->bindValue(3, $matricula);
    $stmt->bindValue(4, $matricula2 != '' ? $matricula2 : NULL);
    $stmt->bindValue(5, $maeNome);
    $stmt->bindValue(6, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
    $stmt->bindValue(7, $id);
    $stmt->execute();
    $stmt = $db->prepare('
      UPDATE rh_servidor 
      SET
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
      matricula = ?, 
      eo_empregador_id = ?, 
      eo_setor_unidade_organizacional_id = ?, 
      rh_situacao_trabalho_id = ?, 
      situacao_trabalho_decreto = ?, 
      situacao_trabalho_doe = ?, 
      situacao_trabalho_dt_inicio = ?, 
      situacao_trabalho_dt_fim = ?, 
      situacao_trabalho_obs = ?, 
      matricula_2 = ?, 
      eo_empregador_id_2 = ?, 
      eo_setor_unidade_organizacional_id_2 = ?, 
      rh_situacao_trabalho_id_2 = ?, 
      situacao_trabalho_decreto_2 = ?, 
      situacao_trabalho_doe_2 = ?, 
      situacao_trabalho_dt_inicio_2 = ?, 
      situacao_trabalho_dt_fim_2 = ?, 
      situacao_trabalho_obs_2 = ?, 
      foto = ?, 
      sangue_tipo = ?, 
      raca = ?, 
      covid_vacina_nome = ?, 
      covid_vacina_dose = ?, 
      covid_vacina_lote = ?, 
      covid_vacina_data = ?, 
      covid_vacina_endereco = ?, 
      enfermidade_portador = ?, 
      enfermidade_codigo_internacional = ?, 
      rh_servidor_tipo_id = ?, 
      eo_cargo_id = ?, 
      rh_servidor_tipo_id_2 = ?, 
      eo_cargo_id_2 = ?, 
      status = ?, 
      dt_cadastro = NOW(), 
      seg_usuario_id = ?
      WHERE id = ? ;');
    $stmt->bindValue(1, $nome);
    $stmt->bindValue(2, $nomeSocial);
    $stmt->bindValue(3, $cpf);
    $stmt->bindValue(4, formata_data($dtNasc));
    $stmt->bindValue(5, $sexo);
    $stmt->bindValue(6, $nacionalidade != '' ? $nacionalidade : NULL);
    $stmt->bindValue(7, $naturalidade != '' ? $naturalidade : NULL);
    $stmt->bindValue(8, formata_data($estDtIngresso));
    $stmt->bindValue(9, $estCidade);
    $stmt->bindValue(10, $estEstado);
    $stmt->bindValue(11, $estCondTrabalho);
    $stmt->bindValue(12, $paiNome);
    $stmt->bindValue(13, $paiNacionalidade != '' ? $paiNacionalidade : NULL);
    $stmt->bindValue(14, $paiProfissao);
    $stmt->bindValue(15, $maeNome);
    $stmt->bindValue(16, $maeNacionalidade != '' ? $maeNacionalidade : NULL);
    $stmt->bindValue(17, $maeProfissao);
    $stmt->bindValue(18, $matricula);
    $stmt->bindValue(19, $empregador != '' ? $empregador : NULL);
    $stmt->bindValue(20, $setorId != '' ? $setorId : NULL);
    $stmt->bindValue(21, $sitTrabId != '' ? $sitTrabId : NULL);
    $stmt->bindValue(22, $sitTrabDecreto);
    $stmt->bindValue(23, $sitTrabDoe);
    $stmt->bindValue(24, formata_data($sitTrabDtInicio));
    $stmt->bindValue(25, formata_data($sitTrabDtFim));
    $stmt->bindValue(26, $sitTrabObs);
    $stmt->bindValue(27, $matricula2 != '' ? $matricula2 : NULL);
    $stmt->bindValue(28, $empregador2 != '' ? $empregador2 : NULL);
    $stmt->bindValue(29, $setorId2 != '' ? $setorId2 : NULL);
    $stmt->bindValue(30, $sitTrabId2 != '' ? $sitTrabId2 : NULL);
    $stmt->bindValue(31, $sitTrabDecreto2);
    $stmt->bindValue(32, $sitTrabDoe2);
    $stmt->bindValue(33, formata_data($sitTrabDtInicio2));
    $stmt->bindValue(34, formata_data($sitTrabDtFim2));
    $stmt->bindValue(35, $sitTrabObs2);
    $stmt->bindValue(36, NULL);
    $stmt->bindValue(37, $sangueTipo);
    $stmt->bindValue(38, $raca);
    $stmt->bindValue(39, $covidVacinaNome);
    $stmt->bindValue(40, $covidVacinaDose);
    $stmt->bindValue(41, $covidVacinaLote);
    $stmt->bindValue(42, formata_data($covidVacinaData));
    $stmt->bindValue(43, $covidVacinaEnd);
    $stmt->bindValue(44, $enfermidadePortada);
    $stmt->bindValue(45, $enfermidadeCodInt);
    $stmt->bindValue(46, $servTipoId != '' ? $servTipoId : NULL);
    $stmt->bindValue(47, $cargoId != '' ? $cargoId : NULL);
    $stmt->bindValue(48, $servTipoId2 != '' ? $servTipoId2 : NULL);
    $stmt->bindValue(49, $cargoId2 != '' ? $cargoId2 : NULL);
    $stmt->bindValue(50, $status);
    $stmt->bindValue(51, $_SESSION['zatu_id']); //ID DO USUÁRIO LOGADO NO SISTEMA
    $stmt->bindValue(52, $id);
    $stmt->execute();
    $db->commit();
      //MENSAGEM DE SUCESSO
    $retorno['id'] = $id;
    $retorno['msg'] = 'success';
    $retorno['retorno'] = 'Dados pessoais do servidor atualizados com sucesso.';
    echo json_encode($retorno);
    exit();
  } else {
    $stmt = $db->prepare('
      SELECT s.id, s.cpf
      FROM rh_servidor AS s 
      WHERE 
      s.cpf LIKE ?;');
    $stmt->bindValue(1, $cpf);
    $stmt->execute();
    $rsServidorExiste = $stmt->fetchALL(PDO::FETCH_ASSOC);
    if (sizeof($rsServidorExiste) > 0) {
      $db->rollback();
      $retorno['msg'] = 'error';
      $retorno['tipo'] = 'cpf';
      $retorno['retorno'] = "Falha ao tentar salvar novo servidor, poir o CPF informado já está vincualado a um servidor!";
      echo json_encode($retorno);
      exit();
    } else {
      $stmt = $db->prepare('INSERT INTO seg_servidor 
        (nome, 
          cpf, 
          matricula, 
          matricula_2, 
          mae_nome, 
          status, 
          dt_cadastro, 
          seg_usuario_id) 
        VALUES
        (?, ?, ?, ?, ?, ?, NOW(), ?)');
      $stmt->bindValue(1, $nome);
      $stmt->bindValue(2, $cpf);
      $stmt->bindValue(3, $matricula);
      $stmt->bindValue(4, $matricula2 != '' ? $matricula2 : NULL);
      $stmt->bindValue(5, $maeNome);
      $stmt->bindValue(6, 0);
      $stmt->bindValue(7, $_SESSION['zatu_id']);
      $stmt->execute();
      $segServidorIdNew = $db->lastInsertId();
      $senhaNome = strtolower(removeAcentos($nome));
      $subSenhaNome = explode(' ',$senhaNome);
      $subSenhaNome = array_values(array_diff($subSenhaNome, array('')));
      $senhaNome = array_shift($subSenhaNome).'.'.array_pop($subSenhaNome);
      $stmt = $db->prepare('INSERT INTO rh_servidor 
        (nome, 
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
          matricula, 
          eo_empregador_id, 
          eo_setor_unidade_organizacional_id, 
          rh_situacao_trabalho_id, 
          situacao_trabalho_decreto, 
          situacao_trabalho_doe, 
          situacao_trabalho_dt_inicio, 
          situacao_trabalho_dt_fim, 
          situacao_trabalho_obs, 
          matricula_2, 
          eo_empregador_id_2, 
          eo_setor_unidade_organizacional_id_2, 
          rh_situacao_trabalho_id_2, 
          situacao_trabalho_decreto_2, 
          situacao_trabalho_doe_2, 
          situacao_trabalho_dt_inicio_2, 
          situacao_trabalho_dt_fim_2, 
          situacao_trabalho_obs_2, 
          foto, 
          sangue_tipo, 
          raca, 
          covid_vacina_nome, 
          covid_vacina_dose, 
          covid_vacina_lote, 
          covid_vacina_data, 
          covid_vacina_endereco, 
          enfermidade_portador, 
          enfermidade_codigo_internacional, 
          rh_servidor_tipo_id, 
          eo_cargo_id, 
          rh_servidor_tipo_id_2, 
          eo_cargo_id_2, 
          status, 
          dt_cadastro, 
          seg_usuario_id, 
          senha_nome, 
          seg_servidor_id) 
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?)');
      $stmt->bindValue(1, $nome);
      $stmt->bindValue(2, $nomeSocial);
      $stmt->bindValue(3, $cpf);
      $stmt->bindValue(4, formata_data($dtNasc));
      $stmt->bindValue(5, $sexo);
      $stmt->bindValue(6, $nacionalidade != '' ? $nacionalidade : NULL);
      $stmt->bindValue(7, $naturalidade != '' ? $naturalidade : NULL);
      $stmt->bindValue(8, formata_data($estDtIngresso));
      $stmt->bindValue(9, $estCidade);
      $stmt->bindValue(10, $estEstado);
      $stmt->bindValue(11, $estCondTrabalho);
      $stmt->bindValue(12, $paiNome);
      $stmt->bindValue(13, $paiNacionalidade != '' ? $paiNacionalidade : NULL);
      $stmt->bindValue(14, $paiProfissao);
      $stmt->bindValue(15, $maeNome);
      $stmt->bindValue(16, $maeNacionalidade != '' ? $maeNacionalidade : NULL);
      $stmt->bindValue(17, $maeProfissao);
      $stmt->bindValue(18, $matricula);
      $stmt->bindValue(19, $empregador != '' ? $empregador : NULL);
      $stmt->bindValue(20, $setorId != '' ? $setorId : NULL);
      $stmt->bindValue(21, $sitTrabId != '' ? $sitTrabId : NULL);
      $stmt->bindValue(22, $sitTrabDecreto);
      $stmt->bindValue(23, $sitTrabDoe);
      $stmt->bindValue(24, formata_data($sitTrabDtInicio));
      $stmt->bindValue(25, formata_data($sitTrabDtFim));
      $stmt->bindValue(26, $sitTrabObs);
      $stmt->bindValue(27, $matricula2 != '' ? $matricula2 : NULL);
      $stmt->bindValue(28, $empregador2 != '' ? $empregador2 : NULL);
      $stmt->bindValue(29, $setorId2 != '' ? $setorId2 : NULL);
      $stmt->bindValue(30, $sitTrabId2 != '' ? $sitTrabId2 : NULL);
      $stmt->bindValue(31, $sitTrabDecreto2);
      $stmt->bindValue(32, $sitTrabDoe2);
      $stmt->bindValue(33, formata_data($sitTrabDtInicio2));
      $stmt->bindValue(34, formata_data($sitTrabDtFim2));
      $stmt->bindValue(35, $sitTrabObs2);
      $stmt->bindValue(36, $foto);
      $stmt->bindValue(37, $sangueTipo);
      $stmt->bindValue(38, $raca);
      $stmt->bindValue(39, $covidVacinaNome);
      $stmt->bindValue(40, $covidVacinaDose);
      $stmt->bindValue(41, $covidVacinaLote);
      $stmt->bindValue(42, formata_data($covidVacinaData));
      $stmt->bindValue(43, $covidVacinaEnd);
      $stmt->bindValue(44, $enfermidadePortada);
      $stmt->bindValue(45, $enfermidadeCodInt);
      $stmt->bindValue(46, $servTipoId != '' ? $servTipoId : NULL);
      $stmt->bindValue(47, $cargoId != '' ? $cargoId : NULL);
      $stmt->bindValue(48, $servTipoId2 != '' ? $servTipoId2 : NULL);
      $stmt->bindValue(49, $cargoId2 != '' ? $cargoId2 : NULL);
      $stmt->bindValue(50, $status);
      $stmt->bindValue(51, $_SESSION['zatu_id']);
      $stmt->bindValue(52, $senhaNome);
      $stmt->bindValue(53, $segServidorIdNew);
      $stmt->execute();
      $servidorIdNew = $db->lastInsertId();
      $db->commit();
      //MENSAGEM DE SUCESSO
      $retorno['id'] = $servidorIdNew;
      $retorno['msg'] = 'success';
      $retorno['retorno'] = 'Dados pessoais do servidor cadastrados com sucesso.';
      echo json_encode($retorno);
      exit();
    }
  }
} catch (PDOException $e) {
  $db->rollback();
  $retorno['msg'] = 'error';
  $retorno['retorno'] = "Erro ao tentar salvar os dados pessoais do servidor: " . $e->getMessage();
  echo json_encode($retorno);
  exit();
}
?>