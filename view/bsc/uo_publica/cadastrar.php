<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  up.id
  FROM bsc_uo_publica AS up
  WHERE up.id = ? ;");
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
  sp.id,
  sp.nome
  FROM bsc_setor_publico AS sp
  ORDER BY sp.nome");
$stmt->execute();
$rsRegistro2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  p.id,
  p.nome
  FROM bsc_pessoa AS p 
  WHERE p.tipo = 2 
  ORDER BY p.nome");
$stmt->execute();
$rsRegistro3 = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro da Unidade Organizacional/Órgão Público(a)";
$descricaoPagina          = "Informações da unidade organizacional/órgão público(a)";
//Parámetros de títutlos - END
//Parámetros de Exibição de campos - BEGIN
$exibeSituação            = true;
$exibeButões              = true;
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Unidade Organizacional/Órgão Público(a)</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <form class="app-form" id="form_uo_publica" name="form_uo_publica" method="post" urltosend="bsc/uo_publica/salvar_identificacao" action="">
      <?php 
      include_once ('view/bsc/uo_publica/content_identificacao.php'); 
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/uo_publica/cadastrar.js"></script>