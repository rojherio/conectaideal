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
//Pessoas Física - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM bsc_pessoa AS p
  WHERE p.tipo = 1;");
$stmt->execute();
$rsPJs = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Pessoas Física - END
//Consultas para Select - BEGIN
//Tipos de Servidor - BEGIN
$stmt = $db->prepare("SELECT 
  id,
  nome
  FROM sme_serv_tipo  
  WHERE 1 = 1;");
$stmt->execute();
$rsServidorTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Tipos de Servidor - END
// //Municipio - BEGIN
// $stmt = $db->prepare("
//   SELECT 
//   m.id, 
//   CONCAT(m.nome, ' - ', e.sigla) AS nome
//   FROM bsc_municipio AS m 
//   LEFT JOIN bsc_estado AS e ON e.id = m.bsc_estado_id
//   ORDER BY e.nome ASC, m.nome;");
// $stmt->execute();
// $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
// //Município - END
// //Grau Parentesco - BEGIN
// $stmt = $db->prepare("
//   SELECT 
//   p.id, 
//   CONCAT(p.nome, ' - ', p.grau) AS nome 
//   FROM bsc_parentesco_grau AS p ;");
// $stmt->execute();
// $rsGrausParentesco = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Grau Parentesco - END
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
//   ORDER BY p.id ASC;");
// $stmt->execute();
// $rsMunicipios = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Servidor(a)";
$descricaoPagina          = "Informações do(a) servidor(a)";
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
        <!-- <div class="card"> -->
          <div class="">
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
                    <button aria-controls="tab-pane-3" data-bs-target="#tab-pane-3" id="tab-3" aria-selected="false" class="nav-link <?= $tabPane == 2 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                      <i class="ti ti-star pe-1 ps-1"></i>Contatos
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button aria-controls="tab-pane-2" data-bs-target="#tab-pane-2" id="tab-2" aria-selected="false" class="nav-link <?= $tabPane == 3 ? 'active' : '' ;?>" data-bs-toggle="tab" role="tab" type="button">
                      <i class="ti ti-history pe-1 ps-1"></i>Vínculos
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
                <div aria-labelledby="tab-pane-3" id="tab-pane-3" class="tab-pane fade <?= $tabPane == 2 ? 'show active' : '' ;?>" role="tabpanel" tabindex="2">
                  <form class="app-form" id="form_ue_contato" name="form_ue_contato" method="post" urlToSend="sme/servidor/salvar_contato" action="">
                    <?php 
                    include_once ('view/sme/servidor/content_contato.php'); 
                    ?>
                  </form>.
                </div>
                <div aria-labelledby="tab-pane-2" id="tab-pane-2" class="tab-pane fade <?= $tabPane == 3 ? 'show active' : '' ;?>" role="tabpanel" tabindex="end">
                  <form class="app-form" id="form_ue_privada" name="form_ue_privada" method="post" urlToSend="ue/unidade_educativa/salvar_vinculo" action="">
                    <?php 
                    include_once ('view/ue/unidade_educativa/content_vinculo.php'); 
                    ?>
                  </form>
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/ue/unidade_educativa/cadastrar.js"></script>