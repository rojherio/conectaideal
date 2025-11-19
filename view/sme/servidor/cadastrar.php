<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
//Parámetros de títutlos - BEGIN
$id = ($parametromodulo) ? : 0;
$tabPane = !(isset($_POST['tabPane'])) ? 0 : $_POST['tabPane'];
//Consulta Base - BEGIN
$stmt = $db->prepare("SELECT 
  s.id
  FROM sme_servidor AS s
  WHERE s.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistroS = $stmt->fetch(PDO::FETCH_ASSOC);
if (!($rsRegistroS)) {
  $rsRegistroS = array();
  $rsRegistroS['id'] = 0;
}
//Consulta Base - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Servidor(a)";
$descricaoPagina          = "Informações do(a) servidor(a)";
//Parámetros de títutlos - END
//Parámetros de Exibição de campos - BEGIN
$exibeSituacaoN1          = true;
$exibeButoesN1            = true;
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
                <i class="ph-duotone  ph-cardholder f-s-16"></i>  Módulo SEME
              </span>
            </a>
          </li>
          <li class="active">
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Servidor(a)</a>
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
            if ($rsRegistroS['id']) {
              ?>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-2" data-bs-target="#tab-pane-2" id="tab-2" aria-selected="false" class="nav-link <?= $tabPane == 2 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-star pe-1 ps-1"></i>Contatos
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-3" data-bs-target="#tab-pane-3" id="tab-3" aria-selected="false" class="nav-link <?= $tabPane == 3 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Documentos
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-4" data-bs-target="#tab-pane-4" id="tab-4" aria-selected="false" class="nav-link <?= $tabPane == 4 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Grau de Instrução
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-5" data-bs-target="#tab-pane-5" id="tab-5" aria-selected="false" class="nav-link <?= $tabPane == 5 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Formação Complementar
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-6" data-bs-target="#tab-pane-6" id="tab-6" aria-selected="false" class="nav-link <?= $tabPane == 6 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Formação Continuada
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-7" data-bs-target="#tab-pane-7" id="tab-7" aria-selected="false" class="nav-link <?= $tabPane == 7 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Familiar
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-8" data-bs-target="#tab-pane-8" id="tab-8" aria-selected="false" class="nav-link <?= $tabPane == 8 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Dependentes
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-9" data-bs-target="#tab-pane-9" id="tab-9" aria-selected="false" class="nav-link <?= $tabPane == 9 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Bancário
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-10" data-bs-target="#tab-pane-10" id="tab-10" aria-selected="false" class="nav-link <?= $tabPane == 10 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Contratos
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-11" data-bs-target="#tab-pane-11" id="tab-11" aria-selected="false" class="nav-link <?= $tabPane == 11 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Outros Vínculos
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-12" data-bs-target="#tab-pane-12" id="tab-12" aria-selected="false" class="nav-link <?= $tabPane == 12 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>OBS/Ocorrências
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-13" data-bs-target="#tab-pane-13" id="tab-13" aria-selected="false" class="nav-link <?= $tabPane == 13 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-history pe-1 ps-1"></i>Saúde
                </button>
              </li>
              <?php
            }
            ?>
          </ul>
          <div class="tab-content" id="v-bgContent">
            <div aria-labelledby="tab-pane-1" id="tab-pane-1" class="tab-pane fade <?= $tabPane <= 1 ? 'show active' : '' ;?>" role="tabpanel" tabindex="1">
              <form class="app-form" id="form_ue_identificacao" name="form_ue_identificacao" method="post" urlToSend="sme/servidor/salvar_identificacao" action="">
                <?php 
                include_once ('view/sme/servidor/content_identificacao.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-2" id="tab-pane-2" class="tab-pane fade <?= $tabPane == 2 ? 'show active' : '' ;?>" role="tabpanel" tabindex="2">
              <form class="app-form" id="form_ue_contato" name="form_ue_contato" method="post" urlToSend="bsc/pessoa_fisica/salvar_contato" action="">
                <?php 
                include_once ('view/sme/servidor/content_contato.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-3" id="tab-pane-3" class="tab-pane fade <?= $tabPane == 3 ? 'show active' : '' ;?>" role="tabpanel" tabindex="3">
              <form class="app-form" id="form_ue_documento" name="form_ue_documento" method="post" urlToSend="bsc/pessoa_fisica/salvar_documento" action="">
                <?php 
                include_once ('view/sme/servidor/content_documento.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-4" id="tab-pane-4" class="tab-pane fade <?= $tabPane == 4 ? 'show active' : '' ;?>" role="tabpanel" tabindex="4">
              <form class="app-form" id="form_ue_instrucao" name="form_ue_instrucao" method="post" urlToSend="sme/servidor/salvar_instrucao" action="">
                <?php 
                include_once ('view/sme/servidor/content_instrucao.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-4" id="tab-pane-5" class="tab-pane fade <?= $tabPane == 5 ? 'show active' : '' ;?>" role="tabpanel" tabindex="5">
              <form class="app-form" id="form_ue_formac_complemen" name="form_ue_formac_complemen" method="post" urlToSend="sme/servidor/salvar_formac_complemen" action="">
                <?php 
                include_once ('view/sme/servidor/content_formac_complemen.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-4" id="tab-pane-6" class="tab-pane fade <?= $tabPane == 6 ? 'show active' : '' ;?>" role="tabpanel" tabindex="6">
              <form class="app-form" id="form_ue_formac_contin" name="form_ue_formac_contin" method="post" urlToSend="sme/servidor/salvar_formac_contin" action="">
                <?php 
                include_once ('view/sme/servidor/content_formac_contin.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-5" id="tab-pane-7" class="tab-pane fade <?= $tabPane == 7 ? 'show active' : '' ;?>" role="tabpanel" tabindex="7">
              <form class="app-form" id="form_ue_familiar" name="form_ue_familiar" method="post" urlToSend="sme/servidor/salvar_familiar" action="">
                <?php 
                include_once ('view/sme/servidor/content_familiar.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-6" id="tab-pane-8" class="tab-pane fade <?= $tabPane == 8 ? 'show active' : '' ;?>" role="tabpanel" tabindex="8">
              <form class="app-form" id="form_ue_dependente" name="form_ue_dependente" method="post" urlToSend="sme/servidor/salvar_dependente" action="">
                <?php 
                include_once ('view/sme/servidor/content_dependente.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-7" id="tab-pane-9" class="tab-pane fade <?= $tabPane == 9 ? 'show active' : '' ;?>" role="tabpanel" tabindex="9">
              <form class="app-form" id="form_ue_bancario" name="form_ue_bancario" method="post" urlToSend="sme/servidor/salvar_bancario" action="">
                <?php 
                include_once ('view/sme/servidor/content_bancario.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-8" id="tab-pane-10" class="tab-pane fade <?= $tabPane == 10 ? 'show active' : '' ;?>" role="tabpanel" tabindex="10">
              <form class="app-form" id="form_ue_contrato" name="form_ue_contrato" method="post" urlToSend="sme/servidor/salvar_contrato" action="">
                <?php 
                include_once ('view/sme/servidor/content_contrato.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-9" id="tab-pane-11" class="tab-pane fade <?= $tabPane == 11 ? 'show active' : '' ;?>" role="tabpanel" tabindex="11">
              <form class="app-form" id="form_ue_vinculo" name="form_ue_vinculo" method="post" urlToSend="sme/servidor/salvar_vinculo" action="">
                <?php 
                include_once ('view/sme/servidor/content_vinculo.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-10" id="tab-pane-12" class="tab-pane fade <?= $tabPane == 12 ? 'show active' : '' ;?>" role="tabpanel" tabindex="12">
              <form class="app-form" id="form_ue_obs" name="form_ue_obs" method="post" urlToSend="sme/servidor/salvar_obs" action="">
                <?php 
                include_once ('view/sme/servidor/content_obs.php'); 
                ?>
              </form>
            </div>
            <div aria-labelledby="tab-pane-11" id="tab-pane-13" class="tab-pane fade <?= $tabPane == 13 ? 'show active' : '' ;?>" role="tabpanel" tabindex="end">
              <form class="app-form" id="form_ue_saude" name="form_ue_saude" method="post" urlToSend="sme/servidor/salvar_saude" action="">
                <?php 
                include_once ('view/sme/servidor/content_saude.php'); 
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/sme/servidor/cadastrar.js"></script>