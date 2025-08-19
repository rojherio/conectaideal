<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  b.id,
  b.status,
  b.dt_cadastro,
  b.codigo,
  b.nome,
  b.sigla,
  b.ispb
  FROM bsc_banco AS b
  WHERE b.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistro)) {
  $rsRegistro = array();
  $rsRegistro['id'] = 0;
  $rsRegistro['status'] = 1;
  $rsRegistro['dt_cadastro'] = '';
  $rsRegistro['codigo'] = '';
  $rsRegistro['nome'] = '';
  $rsRegistro['sigla'] = '';
  $rsRegistro['ispb'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Banco (Instituição Financeira)";
$descricaoPagina          = "Informações do banco (Instituição Financeira)";
$tituloFormulario1        = "Dados do Banco";
$descricaoFormulario1     = "Dados de identificação do banco";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de banco está ativo ou inativo";
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Banco</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <form class="app-form" id="form_banco" name="form_banco" method="post" action="">
      <input type="hidden" name="b_id" id="b_id" value="<?= $rsRegistro['id'] ;?>">
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
                  /*int 1-12*/  'col'         => 6,
                  /*string*/    'label'       => 'Nome do Banco',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'b_nome',
                  /*string*/    'id'          => 'b_nome',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 254,
                  /*string*/    'placeholder' => 'Digite o nome do banco',
                  /*string*/    'value'       => $rsRegistro['nome'],
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => ''
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 6,
                  /*string*/    'label'       => 'Sigla',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'b_sigla',
                  /*string*/    'id'          => 'b_sigla',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 80,
                  /*string*/    'placeholder' => 'Digite o nome curto do banco',
                  /*string*/    'value'       => $rsRegistro['sigla'],
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => ''
                )) ;?>
              </div>
              <div class="row">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 6,
                  /*string*/    'label'       => 'Código',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'b_codigo',
                  /*string*/    'id'          => 'b_codigo',
                  /*string*/    'class'       => 'form-control mask-numeros',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 3,
                  /*string*/    'placeholder' => 'Digite o código do banco',
                  /*string*/    'value'       => $rsRegistro['codigo'],
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => ''
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 6,
                  /*string*/    'label'       => 'ISPB',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'b_ispb',
                  /*string*/    'id'          => 'b_ispb',
                  /*string*/    'class'       => 'form-control mask-numeros',
                  /*int*/       'minlength'   => 1,
                  /*int*/       'maxlength'   => 8,
                  /*string*/    'placeholder' => 'Digite o código ISPB do banco',
                  /*string*/    'value'       => $rsRegistro['ispb'],
                  /*bool*/      'required'    => true,
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
                  /*string*/    'name'        => 'b_status',
                  /*string*/    'id'          => 'b_status',
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/banco/cadastrar.js"></script>