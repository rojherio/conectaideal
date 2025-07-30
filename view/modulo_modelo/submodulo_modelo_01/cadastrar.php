<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.status,
  p.dt_cadastro,
  p.tipo,
  p.nome,
  p.nome_social,
  p.cpf,
  p.ie,
  p.dt_nascimento,
  p.dt_criacao,
  p.sexo,
  p.natural_bsc_pais_id,
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
  p.pai_profissao,
  p.mae_nome,
  p.mae_natural_bsc_pais_id,
  p.mae_profissao,
  p.foto,
  p.sangue_tipo,
  p.raca,
  p.enfermedade_portador,
  p.enfermedade_codigo_internacional
  FROM bsc_pessoa AS p
  LEFT JOIN bsc_municipio AS m ON m.id = p.natural_bsc_municipio_id 
  LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id 
  WHERE p.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsPessoa = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsPessoa)) {
  $rsPessoa['id'] = 0;
  $rsPessoa['tipo'] = '';
  $rsPessoa['nome'] = '';
  $rsPessoa['nome_social'] = '';
  $rsPessoa['cpf'] = '';
  $rsPessoa['ie'] = '';
  $rsPessoa['dt_nascimento'] = '';
  $rsPessoa['dt_criacao'] = '';
  $rsPessoa['sexo'] = '';
  $rsPessoa['natural_bsc_pais_id'] = '';
  $rsPessoa['natural_bsc_municipio_id'] = '';
  $rsPessoa['natural_municipio_nome'] = '';
  $rsPessoa['natural_estado_id'] = '';
  $rsPessoa['natural_estado_sigla'] = '';
  $rsPessoa['natural_estrangeiro_dt_ingresso'] = '';
  $rsPessoa['natural_estrangeiro_cidade'] = '';
  $rsPessoa['natural_estrangeiro_estado'] = '';
  $rsPessoa['natural_estrangeiro_condicao_trabalho'] = '';
  $rsPessoa['pai_nome'] = '';
  $rsPessoa['pai_natural_bsc_pais_id'] = '';
  $rsPessoa['pai_profissao'] = '';
  $rsPessoa['mae_nome'] = '';
  $rsPessoa['mae_natural_bsc_pais_id'] = '';
  $rsPessoa['mae_profissao'] = '';
  $rsPessoa['foto'] = '';
  $rsPessoa['sangue_tipo'] = '';
  $rsPessoa['raca'] = '';
  $rsPessoa['enfermidade_portador'] = '';
  $rsPessoa['enfermidade_codigo_internacional'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("
  SELECT 
    p.id,
    p.status,
    p.dt_cadastro,
    p.nome,
    p.nacionalidade,
    p.masculino,
    p.feminino
  FROM bsc_pais AS p
  WHERE p.status = 1 
  ORDER BY p.id ASC;");
$stmt->execute();
$rsPaises = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare("
  SELECT 
    e.id,
    e.status,
    e.dt_cadastro,
    e.nome,
    e.sigla,
    e.bsc_pais_id
  FROM bsc_estado AS e;
  WHERE e.status = 1 
  ORDER BY e.id ASC;");
$stmt->execute();
$rsEstados = $stmt->fetchAll(PDO::FETCH_ASSOC);
// $stmt = $db->prepare("
//   SELECT 
//     p.id,
//     p.status,
//     p.dt_cadastro,
//     p.nome,
//     p.nacionalidade,
//     p.masculino,
//     p.feminino
//   FROM bsc_pais AS p
//   WHERE p.status = 1 
//   ORDER BY p.id ASC;");
// $stmt->execute();
// $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina           = "Pessoa";
$DescricaoPagina        = "Informações de pessoa física ou jurídica";
$tituloFormulario       = "Cadastro de Pessoa";
$DescricaoFormulario    = "Cadastro de dados referente a uma pessoa física ou jurídica"
//Parámetros de títutlos - NED
?>
<!-- main section -->
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
                <i class="ph-duotone  ph-cardholder f-s-16"></i>  Estrutura Organizacional
              </span>
            </a>
          </li>
          <li class="active">
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Tipo de isntituição</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- div de cadastro - BEGIN -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5><?= $tituloFormulario;?></h5>
            <small><?= $DescricaoFormulario;?></small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- formulário de cadastro - BEGIN -->
            <form class="app-form" id="form_unidade_organizacional_tipo" name="form_unidade_organizacional_tipo" method="post" action="">
              <!-- div row input - BEGIN -->
              <div class="row">
                <!-- createInput($col, $label, $type, $name, $id, $class, $minlength, $maxlength, $placeholder, $title, $value, $required, $prop) -->
                <?= createInput("12", "Nome", "text", "p_nome", "p_nome", "form-control", "3", "254", "Digite o nome da pessoa", "", $rsUOTipo['nome'], true, "") ;?>
              </div>
              <!-- div row input - END -->
              <!-- div row select - BEGIN -->
              <div class="row">
                <!-- createSelect($col, $label, $name, $id, $class, $ariaLabel, $required, $prop, $options) { -->
                <?= createSelect("12", "Secretaria", "p_secretaria", "p_secretaria", "select_modelo form-control form-select select-basic", "Selecione uma secretaria", true, "", $rsUOs) ;?>
              </div>
              <!-- div row select - END -->
              <!-- div row checkbox - BEGIN -->
              <div class="row">
                <!-- createCheckbox($col, $label, $type, $name, $id, $class, $checked, $value, $prop) -->
                <?= createCheckbox("12", "Ativo", "checkbox", "p_status", "p_status", "toggle", "false", "1", "")?>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="check-container form-control delfos-radio mb-3">
                    <label for="radio-group" class="delfos-radio">Full Name</label>
                    <label class="check-box">
                      <input name="radio-group" type="radio">
                      <span class="radiomark  check-info ms-2"></span>
                      <span class="text-info">info</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- createRadio($col, $label, $type, $name, $id, $class, $value, $required, $prop, $options) -->
                <?= createRadio("12", "Sexo", "radio", "p_sexo", array("p_sexo_F", "p_sexo_M"), "radiomark  check-info ms-2", $rsPessoa['sexo'], true, "", array("Feminino", "Masculino")) ?>
              </div>
              <!-- div row checkbox - END -->
              <!-- div row buttons - BEGIN -->
              <div class="row">
                <div class="box-footer text-center">
                  <button type="reset" class="btn btn-danger waves-effect waves-light b-r-22" id="btn_cancelar">
                    <i class="ti ti-eraser"></i> Cancelar
                  </button>
                  <button type="submit" class="btn btn-success waves-effect waves-light b-r-22">
                    <i class="ti ti-writing"></i> Cadastrar
                  </button>
                </div>
                <input type="hidden" id="id" name="id" value="">
              </div>
              <!-- div row buttons - END -->
            </form>
            <!-- formulário de cadastro - END -->
          </div>
        </div>
      </div>
    </div>
    <!-- div de cadastro - END -->
  </div>
</main>
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/modulo_modelo/submodulo_modelo_01/dashboard_modelo.js"></script>