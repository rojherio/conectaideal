<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
//Parámetros de títutlos - BEGIN
$id = ($parametromodulo) ? : 0;
$tabPane = !(isset($_POST['tabPane'])) ? 0 : $_POST['tabPane'];
echo $tabPane;
$stmt = $db->prepare("SELECT 
  p.id,
  p.status,
  p.dt_cadastro,
  p.tipo,
  p.nome,
  p.nome_social,
  p.cpf,
  p.ie,
  p.dt_criacao
  FROM bsc_pessoa AS p
  WHERE p.tipo = 2 AND p.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (is_array($rsRegistro)) {
  $id = 0;
}
$tituloPagina             = "Cadastro de Pessoa Jurídica";
$descricaoPagina          = "Informações de pessoa jurídica";
//Parámetros de títutlos - END
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
        <div class="card">
          <div class="card-body equal-card">
            <ul class="nav nav-tabs tab-primary bg-primary p-2" id="bg" role="tablist">
              <li class="nav-item" role="presentation">
                <button aria-controls="tab-pane-p-identificacao" data-bs-target="#tab-pane-p-identificacao" id="tab-p-identificacao" aria-selected="true" class="nav-link <?= $tabPane <=1 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                  <i class="ti ti-disc pe-1 ps-1"></i>Identificação
                </button>
              </li>
              <?php
              if (is_array($rsRegistro)) {
                ?>
                <li class="nav-item" role="presentation">
                  <button aria-controls="tab-pane-p-documentos" data-bs-target="#tab-pane-p-documentos" id="tab-p-documentos" aria-selected="false" class="nav-link <?= $tabPane == 2 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                    <i class="ti ti-history pe-1 ps-1"></i>Documentos
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button aria-controls="tab-pane-p-contatos" data-bs-target="#tab-pane-p-contatos" id="tab-p-contatos" aria-selected="false" class="nav-link <?= $tabPane == 3 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                    <i class="ti ti-star pe-1 ps-1"></i>Contatos
                  </button>
                </li>
                <?php
              }
              ?>
            </ul>
            <div class="tab-content" id="v-bgContent">
              <div aria-labelledby="tab-pane-p-identificacao" id="tab-pane-p-identificacao" class="tab-pane fade <?= $tabPane <= 1 ? 'show active' : '' ;?>" role="tabpanel" tabindex="1">
                <?php 
                include_once ('view/bsc/pessoa_juridica/content_identificacao.php'); 
                ?>
              </div>
              <div aria-labelledby="tab-pane-p-documentos" id="tab-pane-p-documentos" class="tab-pane fade <?= $tabPane == 2 ? 'show active' : '' ;?>" role="tabpanel" tabindex="2">
                <?php 
                include_once ('view/bsc/pessoa_juridica/content_documento.php'); 
                ?>
              </div>
              <div aria-labelledby="tab-pane-p-contatos" id="tab-pane-p-contatos" class="tab-pane fade <?= $tabPane == 3 ? 'show active' : '' ;?>" role="tabpanel" tabindex="end">
                <?php 
                include_once ('view/bsc/pessoa_juridica/content_contato.php'); 
                ?>
              </div>
            </div>
          </div>
          <div id="teste">
            
          </div>
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/pessoa_juridica/cadastrar.js"></script>