<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  up.id,
  up.status,
  up.dt_cadastro,
  up.bsc_setor_publico_id,
  up.bsc_pessoa_id
  FROM bsc_uo_publica AS up
  WHERE up.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistro)) {
  $rsRegistro = array();
  $rsRegistro['id'] = 0;
  $rsRegistro['status'] = 1;
  $rsRegistro['dt_cadastro'] = '';
  $rsRegistro['bsc_setor_publico_id'] = '';
  $rsRegistro['bsc_pessoa_id'] = '';
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
$tituloFormulario1        = "Dados da Unidade Organizacional/Órgão Público(a)";
$descricaoFormulario1     = "Dados da identificação da unidade organizacional/órgão público(a)";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de unidade organizacional/orgão público(a) está ativo ou inativo";
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Unidade Organizacional/Órgão Público(a)</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <form class="app-form" id="form_uo_publica" name="form_uo_publica" method="post" action="">
      <input type="hidden" name="up_id" id="up_id" value="<?= $rsRegistro['id'] ;?>">
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
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Setor Publico',
                  /*string*/    'name'        => 'up_bsc_setor_publico_id',
                  /*string*/    'id'          => 'up_bsc_setor_publico_id',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*string*/    'value'       => $rsRegistro['bsc_setor_publico_id'],
                  /*array()*/   'options'     => $rsRegistro2,
                  /*string*/    'ariaLabel'   => 'Selecione uma Setor Publico',
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <div class="row">
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Pessoa',
                  /*string*/    'name'        => 'up_bsc_pessoa_id',
                  /*string*/    'id'          => 'up_bsc_pessoa_id',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*string*/    'value'       => $rsRegistro['bsc_pessoa_id'],
                  /*array()*/   'options'     => $rsRegistro3,
                  /*string*/    'ariaLabel'   => 'Selecione uma Pessoa',
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => '',
                  /*string*/    'display'     => true
                )); ?>
              </div>
              <!-- div row input - END -->
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <!-- Título da div de cadastro - BEGIN -->
              <h5><?= $tituloFormulario5;?></h5>
              <small><?= $descricaoFormulario5;?></small>
              <!-- Título da div de cadastro - END -->
            </div>
            <div class="card-body">
              <!-- div row input - BEGIN -->
              <div class="row">
                <?= createCheckbox(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Ativo',
                  /*string*/    'type'        => 'checkbox',
                  /*string*/    'name'        => 'up_status',
                  /*string*/    'id'          => 'up_status',
                  /*string*/    'class'       => 'toggle',
                  /*string*/    'value'       => 1,
                  /*string*/    'checked'     => $rsRegistro['status'],
                  /*string*/    'prop'        => ''
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
              </div>
              <!-- div row buttons - END -->
            </div>
          </div>
        </div>
      </div>
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