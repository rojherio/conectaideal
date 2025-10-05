<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = ($parametromodulo) ? : 0;
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  sm.id
  FROM seg_submodulo AS sm
  WHERE sm.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistro)) {
  $rsRegistro = array();
  $rsRegistro['id'] = 0;
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  m.id,
  m.nome
  FROM seg_modulo AS  m
  ORDER BY m.nome");
$stmt->execute();
$rsSegModulo = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de SubModulo";
$descricaoPagina          = "Informações do SubModulo";
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">SubModulo</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <form class="app-form" id="form_seg_submodulo" name="form_seg_submodulo" method="post" urltosend="eo/seg_submodulo/salvar_identificacao" action="">
      <?php 
      include_once ('view/eo/seg_submodulo/content_identificacao.php'); 
      ?>
    </form>
    <!-- formulário de cadastro - END -->
    <!-- div de cadastro - END -->
  </div>
</main>
<!-- Main Section - END-->
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/eo/seg_submodulo/cadastrar.js"></script>