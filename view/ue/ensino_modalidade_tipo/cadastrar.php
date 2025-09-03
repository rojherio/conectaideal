<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  emt.id,
  emt.status,
  emt.dt_cadastro,
  emt.nome,
  emt.descricao
  FROM ue_ens_modalidade_tipo AS emt
  WHERE emt.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistro)) {
  $rsRegistro = array();
  $rsRegistro['id'] = 0;
  $rsRegistro['status'] = 1;
  $rsRegistro['dt_cadastro'] = '';
  $rsRegistro['nome'] = '';
  $rsRegistro['descricao'] = '';
}
//Consulta para Edição - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Modalidade de Ensino";
$descricaoPagina          = "Informações da modalidade de ensino";
$tituloFormulario1        = "Dados da Modalidade de Ensino";
$descricaoFormulario1     = "Dados da identificação da modalidade de ensino";
$tituloFormulario2        = "";
$descricaoFormulario2     = "";
$tituloFormulario3        = "";
$descricaoFormulario3     = "";
$tituloFormulario4        = "";
$descricaoFormulario4     = "";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de modalidade de ensino está ativo ou inativo";
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Modalidade de Ensino</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <form class="app-form" id="form_ensino_modalidade_tipo" name="form_ensino_modalidade_tipo" method="post" action="">
      <input type="hidden" name="emt_id" id="emt_id" value="<?= $rsRegistro['id'] ;?>">
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
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Nome da Modalidade de Ensino',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'emt_nome',
                  /*string*/    'id'          => 'emt_nome',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 254,
                  /*string*/    'placeholder' => 'Digite o nome da Modalidade de Ensino',
                  /*string*/    'value'       => $rsRegistro['nome'],
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => ''
                )) ;?>
              </div>
              <div class="row">
                <?= createTextArea(array(
                  /*int 1-12*/  'col'         => 12,
                  /*string*/    'label'       => 'Descrição',
                  /*string*/    'name'        => 'emt_descricao',
                  /*string*/    'id'          => 'emt_descricao',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 254,
                  /*string*/    'placeholder' => 'Descreva a Modalidade de Ensino',
                  /*string*/    'value'       => $rsRegistro['descricao'],
                  /*bool*/      'required'    => false,
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
                  /*string*/    'name'        => 'emt_status',
                  /*string*/    'id'          => 'emt_status',
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/ensino_modalidade_tipo/cadastrar.js"></script>