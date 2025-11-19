<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = ($parametromodulo) ? : 0;
$tabPane = !(isset($_POST['tabPane'])) ? 0 : $_POST['tabPane'];
//Consulta para Edição - BEGIN
//Identiicação - BEGIN
$stmt = $db->prepare("SELECT 
  p.id
  FROM bsc_pessoa AS p
  WHERE p.tipo = 1 AND p.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$rsRegistro) {
  $rsRegistro = array();
  $rsRegistro['id'] = 0;
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Pessoa Física";
$descricaoPagina          = "Informações de pessoa física";
$tituloFormulario1        = "Dados Pessoais";
$descricaoFormulario1     = "Dados de identificação da pessoa";
$tituloFormulario2        = "Filiação";
$descricaoFormulario2     = "Dados de filiação da pessoa";
$tituloFormulario3        = "Naturalidade";
$descricaoFormulario3     = "Dados de naturalidade da pessoa";
$tituloFormulario4        = "Saúde";
$descricaoFormulario4     = "Dados de saúde da pessoa";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de pessoa está ativo ou inativo";
//Parámetros de títutlos - END
//Parámetros de Exibição de campos - BEGIN
$exibeSituacao            = true;
$exibeButoes              = true;
//Parámetros de Exibição de campos - END
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Pessoa Jurídica</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- div de cadastro - BEGIN -->
    <!-- TABS - BEGIN -->
    <div class="row app-tabs-section">
      <div class="col-md-12">
        <div class="card-body equal-card">
          <ul class="nav nav-tabs tab-primary bg-primary p-2" id="bg" role="tablist">
            <li class="nav-item" role="presentation">
              <button aria-controls="tab-pane-1" data-bs-target="#tab-pane-1" id="tab-1" aria-selected="true" class="nav-link <?= $tabPane <=1 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                <i class="ti ti-disc pe-1 ps-1"></i>Identificação
              </button>
            </li>
            <?php
            if ($rsRegistro['id']) {
              ?>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-2" data-bs-target="#tab-pane-2" id="tab-2" aria-selected="false" class="nav-link <?= $tabPane == 2 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Documentos
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-3" data-bs-target="#tab-pane-3" id="tab-3" aria-selected="false" class="nav-link <?= $tabPane == 3 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-star pe-1 ps-1"></i>Contatos
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-4" data-bs-target="#tab-pane-4" id="tab-3" aria-selected="false" class="nav-link <?= $tabPane == 4 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-star pe-1 ps-1"></i>Condição Física/Mental
                </button>
              </li>
              <?php
            }
            ?>
          </ul>
          <div class="tab-content" id="v-bgContent">
            <div aria-labelledby="tab-pane-1" id="tab-pane-1" class="tab-pane fade <?= $tabPane <= 1 ? 'show active' : '' ;?>" role="tabpanel" tabindex="1">
              <form class="app-form" id="form_pessoa" name="form_pessoa" method="post" urltosend="bsc/pessoa_fisica/salvar_identificacao" action="">
                <?php 
                include_once ('view/bsc/pessoa_fisica/content_identificacao.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-2" id="tab-pane-2" class="tab-pane fade <?= $tabPane == 2 ? 'show active' : '' ;?>" role="tabpanel" tabindex="2">
              <form class="app-form" id="form_pessoa_documento" name="form_pessoa_documento" method="post" urltosend="bsc/pessoa_fisica/salvar_documento" action="">
                <?php 
                include_once ('view/bsc/pessoa_fisica/content_documento.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-3" id="tab-pane-3" class="tab-pane fade <?= $tabPane == 3 ? 'show active' : '' ;?>" role="tabpanel" tabindex="3">
              <form class="app-form" id="form_pessoa_contato" name="form_pessoa_contato" method="post" urltosend="bsc/pessoa_fisica/salvar_contato" action="">
                <?php 
                include_once ('view/bsc/pessoa_fisica/content_contato.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-3" id="tab-pane-4" class="tab-pane fade <?= $tabPane == 4 ? 'show active' : '' ;?>" role="tabpanel" tabindex="end">
              <form class="app-form" id="form_pessoa_cond_fis_men" name="form_pessoa_cond_fis_men" method="post" urltosend="bsc/pessoa_fisica/salvar_cond_fis_men" action="">
                <?php 
                include_once ('view/bsc/pessoa_fisica/content_cond_fis_men.php'); 
                ?>
              </form>
            </div>
          </div>
        </div>
        <div id="teste">

        </div>
      </div>
    </div>
    <!-- TABS - END -->
    <!-- div de cadastro - END -->
  </div>
</main>
<!-- Main Section - END-->
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/pessoa_fisica/cadastrar.js"></script>