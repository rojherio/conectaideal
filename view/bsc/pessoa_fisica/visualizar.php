<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = empty($parametromodulo) ? 0 : $parametromodulo;
if (empty($id)) {
  header('Location: '.PORTAL_URL.'view/bsc/pessoa_fisica/listar');
}
$db = Conexao::getInstance();
//Consulta para Visualizar - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.status,
  p.dt_cadastro,
  p.tipo,
  p.nome,
  p.nome_social,
  p.cpf,
  p.dt_nascimento,
  p.sexo,
  p.natural_bsc_pais_id,
  pa.nome AS natural_pais_nome,
  p.natural_bsc_municipio_id,
  m.nome AS natural_municipio_nome, 
  e.id AS natural_estado_id, 
  e.sigla AS natural_estado_sigla, 
  p.natural_estrangeiro_dt_ingresso,
  p.natural_estrangeiro_cidade,
  p.natural_estrangeiro_estado,
  p.natural_estrangeiro_condicao_trabalho,
  p.pai_nome,
  p.pai_natural_bsc_pais_id,
  pa1.nome AS pai_natural_pais_nome,
  p.pai_profissao,
  p.mae_nome,
  pa2.nome AS mae_natural_pais_nome,
  p.mae_natural_bsc_pais_id,
  p.mae_profissao,
  p.foto,
  p.sangue_tipo,
  p.raca,
  p.enfermidade_portador,
  p.enfermidade_codigo_internacional
  FROM bsc_pessoa AS p
  LEFT JOIN bsc_municipio AS m ON m.id = p.natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  LEFT JOIN bsc_pais AS pa ON pa.id = p.natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS pa1 ON pa1.id = p.pai_natural_bsc_pais_id 
  LEFT JOIN bsc_pais AS pa2 ON pa2.id = p.mae_natural_bsc_pais_id
  WHERE p.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsPessoa = $stmt->fetch(PDO::FETCH_ASSOC);
//Consulta para Visualizar - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Pessoa Física";
$descricaoPagina          = "Informações de pessoa física";
$tituloFormulario1        = "Dados Pessoais";
$descricaoFormulario1     = "Dados de identificação da pessoa";
$tituloFormulario2        = "Filiação";
$descricaoFormulario2     = "Dados de filiação da pessoa";
$tituloFormulario3        = "Natualidade";
$descricaoFormulario3     = "Dados de naturalidade da pessoa";
$tituloFormulario4        = "Saúde";
$descricaoFormulario4     = "Dados de saúde da pessoa";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de pessoa está ativo ou inativo";
//Parámetros de títutlos - NED
?>
<!-- Main Section - BEGIN-->
<main>
  <div class="container-fluid">
    <!-- div Título página e links de navegação - BEGIN -->
    <div class="row m-1">
      <div class="col-12 ">
        <h4 class="main-title"><?= $tituloPagina;?></h4>
        <ul class="app-line-breadcrumbs mb-3">
          <li class="">
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">
              <span>
                <i class="ph-duotone  ph-cardholder f-s-16"></i>  Módulo Base
              </span>
            </a>
          </li>
          <li class="active">
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Pessoa Física</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <input type="hidden" name="p_id" id="p_id" value="<?= $rsPessoa['id'] ;?>">
    <!-- div de cadastro - BEGIN -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5><?= $tituloFormulario1;?></h5>
            <small><?= $descricaoFormulario1;?></small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- div row input - BEGIN -->
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 5,
                /*string*/    'label'       => 'Nome',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_nome',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['nome'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 4,
                /*string*/    'label'       => 'Nome Social',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_nome_social',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['nome_social'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 3,
                /*string*/    'label'       => 'CPF',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_cpf',
                /*string*/    'class'       => 'form-control-plaintext mask-cpf',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['cpf'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
            </div>
            <div class="row">
              <?= createInputDate(array(
                /*int 1-12*/  'col'         => 3,
                /*string*/    'label'       => 'Data de Nascimento',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_dt_nascimento',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'min'         => '',
                /*int*/       'maxToday'    => false,
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['dt_nascimento'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 3,
                /*string*/    'label'       => 'Sexo',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_sexo',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['sexo'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 3,
                /*string*/    'label'       => 'Tipo Sanaguíneo',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_sangue_tipo',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['sangue_tipo'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 3,
                /*string*/    'label'       => 'Raça',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_raca',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['raca'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
            </div>
            <!-- div row input - END -->
          </div>
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5><?= $tituloFormulario3;?></h5>
            <small><?= $descricaoFormulario3;?></small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- div row input - BEGIN -->
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 6,
                /*string*/    'label'       => 'Nacionalidade',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_natural_bsc_pais_id',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['natural_pais_nome'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?php
                //Parámetros de exibir/ocultar div - BEGIN
              $displayNaturalidadeNacional      = $rsPessoa['natural_bsc_pais_id'] != 1 ? 'style="display: none;"' : '';
              $displayNaturalidadeExtranjeiro   = $rsPessoa['natural_bsc_pais_id'] <= 1 ? 'style="display: none;"' : '';
                //Parámetros de exibir/ocultar div - NED
              ?>
              <div class="col-6" id="div_naturalidade_nacional" <?= $displayNaturalidadeNacional ;?>>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Naturalidade',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => '',
                  /*string*/    'id'          => 'p_natural_bsc_municipio_id',
                  /*string*/    'class'       => 'form-control-plaintext',
                  /*int*/       'minlength'   => '',
                  /*int*/       'maxlength'   => '',
                  /*string*/    'placeholder' => '',
                  /*string*/    'value'       => $rsPessoa['natural_municipio_nome'].' - '.$rsPessoa['natural_estado_sigla'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'readonly'
                )) ;?>
              </div>
            </div>
            <div id="div_naturalidade_extrangeiro" <?= $displayNaturalidadeExtranjeiro ;?>>
              <div class="row">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 3,
                  /*string*/    'label'       => 'Nome da Cidade',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => '',
                  /*string*/    'id'          => 'p_natural_estrangeiro_cidade',
                  /*string*/    'class'       => 'form-control-plaintext',
                  /*int*/       'minlength'   => '',
                  /*int*/       'maxlength'   => '',
                  /*string*/    'placeholder' => '',
                  /*string*/    'value'       => $rsPessoa['natural_estrangeiro_cidade'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'readonly'
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 3,
                  /*string*/    'label'       => 'Nome do Estado',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => '',
                  /*string*/    'id'          => 'p_natural_estrangeiro_estado',
                  /*string*/    'class'       => 'form-control-plaintext',
                  /*int*/       'minlength'   => '',
                  /*int*/       'maxlength'   => '',
                  /*string*/    'placeholder' => '',
                  /*string*/    'value'       => $rsPessoa['natural_estrangeiro_estado'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'readonly'
                )) ;?>
                <?= createInputDate(array(
                  /*int 1-12*/  'col'         => 3,
                  /*string*/    'label'       => 'Data de Ingreso ao Brasil',
                  /*string*/    'name'        => '',
                  /*string*/    'id'          => 'p_natural_estrangeiro_dt_ingresso',
                  /*string*/    'class'       => 'form-control-plaintext mask-data',
                  /*int*/       'min'         => '',
                  /*int*/       'maxToday'    => false,
                  /*string*/    'placeholder' => '',
                  /*string*/    'value'       => $rsPessoa['natural_estrangeiro_dt_ingresso'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'readonly'
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 3,
                  /*string*/    'label'       => 'Condição de Trabalho',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => '',
                  /*string*/    'id'          => 'p_natural_estrangeiro_condicao_trabalho',
                  /*string*/    'class'       => 'form-control-plaintext',
                  /*int*/       'minlength'   => '',
                  /*int*/       'maxlength'   => '',
                  /*string*/    'placeholder' => '',
                  /*string*/    'value'       => $rsPessoa['natural_estrangeiro_condicao_trabalho'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => 'readonly'
                )) ;?>
              </div>
            </div>
            <!-- div row input - END -->
          </div>
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5><?= $tituloFormulario2;?></h5>
            <small><?= $descricaoFormulario2;?></small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- div row input - BEGIN -->
            <div class="row">
              <div class="col-md-6">
                <!-- div row input - BEGIN -->
                <div class="row">
                  <?= createInput(array(
                    /*int 1-12*/  'col'         => 7,
                    /*string*/    'label'       => 'Nome do Pai',
                    /*string*/    'type'        => 'text',
                    /*string*/    'name'        => '',
                    /*string*/    'id'          => 'p_pai_nome',
                    /*string*/    'class'       => 'form-control-plaintext',
                    /*int*/       'minlength'   => '',
                    /*int*/       'maxlength'   => '',
                    /*string*/    'placeholder' => '',
                    /*string*/    'value'       => $rsPessoa['pai_nome'],
                    /*bool*/      'required'    => false,
                    /*string*/    'prop'        => 'readonly'
                  )) ;?>
                  <?= createInput(array(
                    /*int 1-12*/  'col'         => 5,
                    /*string*/    'label'       => 'Nacionalidade do Pai',
                    /*string*/    'type'        => 'text',
                    /*string*/    'name'        => '',
                    /*string*/    'id'          => 'p_pai_nome',
                    /*string*/    'class'       => 'form-control-plaintext',
                    /*int*/       'minlength'   => '',
                    /*int*/       'maxlength'   => '',
                    /*string*/    'placeholder' => '',
                    /*string*/    'value'       => $rsPessoa['pai_natural_pais_nome'],
                    /*bool*/      'required'    => false,
                    /*string*/    'prop'        => 'readonly'
                  )) ;?>
                </div>
                <div class="row">
                  <?= createInput(array(
                    /*int 1-12*/  'col'         => 12,
                    /*string*/    'label'       => 'Profissão do Pai',
                    /*string*/    'type'        => 'text',
                    /*string*/    'name'        => '',
                    /*string*/    'id'          => 'p_pai_profissao',
                    /*string*/    'class'       => 'form-control-plaintext',
                    /*int*/       'minlength'   => '',
                    /*int*/       'maxlength'   => '',
                    /*string*/    'placeholder' => '',
                    /*string*/    'value'       => $rsPessoa['pai_profissao'],
                    /*bool*/      'required'    => false,
                    /*string*/    'prop'        => 'readonly'
                  )) ;?>
                </div>
                <!-- div row input - END -->
              </div>
              <div class="col-md-6">
                <div class="row">
                  <!-- div row input - BEGIN -->
                  <?= createInput(array(
                    /*int 1-12*/  'col'         => 7,
                    /*string*/    'label'       => 'Nome da Mãe',
                    /*string*/    'type'        => 'text',
                    /*string*/    'name'        => '',
                    /*string*/    'id'          => 'p_mae_nome',
                    /*string*/    'class'       => 'form-control-plaintext',
                    /*int*/       'minlength'   => '',
                    /*int*/       'maxlength'   => '',
                    /*string*/    'placeholder' => '',
                    /*string*/    'value'       => $rsPessoa['mae_nome'],
                    /*bool*/      'required'    => false,
                    /*string*/    'prop'        => 'readonly'
                  )) ;?>
                  <?= createInput(array(
                    /*int 1-12*/  'col'         => 5,
                    /*string*/    'label'       => 'Nacionalidade da Mãe',
                    /*string*/    'type'        => 'text',
                    /*string*/    'name'        => '',
                    /*string*/    'id'          => 'p_mae_natural_bsc_pais_id',
                    /*string*/    'class'       => 'form-control-plaintext',
                    /*int*/       'minlength'   => '',
                    /*int*/       'maxlength'   => '',
                    /*string*/    'placeholder' => '',
                    /*string*/    'value'       => $rsPessoa['mae_natural_pais_nome'],
                    /*bool*/      'required'    => false,
                    /*string*/    'prop'        => 'readonly'
                  )) ;?>
                </div>
                <div class="row">
                  <?= createInput(array(
                    /*int 1-12*/  'col'         => 12,
                    /*string*/    'label'       => 'Profissão da Mãe',
                    /*string*/    'type'        => 'text',
                    /*string*/    'name'        => '',
                    /*string*/    'id'          => 'p_mae_profissao',
                    /*string*/    'class'       => 'form-control-plaintext',
                    /*int*/       'minlength'   => '',
                    /*int*/       'maxlength'   => '',
                    /*string*/    'placeholder' => '',
                    /*string*/    'value'       => $rsPessoa['mae_profissao'],
                    /*bool*/      'required'    => false,
                    /*string*/    'prop'        => 'readonly'
                  )) ;?>
                </div>
                <!-- div row input - END -->
              </div>
            </div>
            <!-- div row input - END -->
          </div>
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5><?= $tituloFormulario4;?></h5>
            <small><?= $descricaoFormulario4;?></small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- div row input - BEGIN -->
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 6,
                /*string*/    'label'       => 'Enfermidade Portada',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_enfermidade_portador',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['enfermidade_portador'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
              <?= createInput(array(
                /*int 1-12*/  'col'         => 6,
                /*string*/    'label'       => 'Código Internacional da Enfermidade',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_enfermidade_codigo_internacional',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['enfermidade_codigo_internacional'],
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
            </div>
            <!-- div row input - END -->
          </div>
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5><?= $tituloFormulario5;?></h5>
            <small><?= $descricaoFormulario5;?></small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- div row input - BEGIN -->
            <div class="row">
              <?= createInput(array(
                /*int 1-12*/  'col'         => 12,
                /*string*/    'label'       => '',
                /*string*/    'type'        => 'text',
                /*string*/    'name'        => '',
                /*string*/    'id'          => 'p_status',
                /*string*/    'class'       => 'form-control-plaintext',
                /*int*/       'minlength'   => '',
                /*int*/       'maxlength'   => '',
                /*string*/    'placeholder' => '',
                /*string*/    'value'       => $rsPessoa['status'] > 0 ? 'Ativo' : 'Inativo',
                /*bool*/      'required'    => false,
                /*string*/    'prop'        => 'readonly'
              )) ;?>
            </div>
            <!-- div row input - END -->
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <!-- div row buttons - BEGIN -->
            <div class="row">
              <div class="box-footer text-center">
                <button type="reset" class="btn btn-outline-danger b-r-22" id="btn_cancelar">
                  <i class="ti ti-eraser"></i> Cancelar
                </button>
                <button type="button" id="submit" class="btn btn-outline-success waves-light b-r-22">
                  <i class="ti ti-writing"></i> Cadastrar
                </button>
              </div>
              <input type="hidden" id="id" name="id" value="">
            </div>
            <!-- div row buttons - END -->
          </div>
        </div>
      </div>
    </div>
    <!-- formulário de cadastro - END -->
    <!-- div de cadastro - END -->
  </div>
</main>
<!-- Main Section - END-->
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/pessoa_fisica/cadastrar.js"></script>