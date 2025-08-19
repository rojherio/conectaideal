<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  um.id,
  um.status,
  um.dt_cadastro,
  um.nome,
  um.simbolo,
  um.equivalencia,
  um.bsc_grandeza_id
  FROM bsc_unidade_medida AS um
  WHERE um.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($rsRegistro)) {
  $rsRegistro = array();
  $rsRegistro['id'] = 0;
  $rsRegistro['status'] = 1;
  $rsRegistro['nome'] = '';
  $rsRegistro['simbolo'] = '';
  $rsRegistro['equivalencia'] = '';
  $rsRegistro['bsc_grandeza_id'] = '';
}
//Consulta para Edição - END
//Consulta para Select - BEGIN
$stmt = $db->prepare("SELECT 
  g.id,
  g.nome
  FROM bsc_grandeza AS g
  ORDER BY g.nome");
$stmt->execute();
$rsGrandezas = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para Select - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Cadastro de Unidade de Medida";
$descricaoPagina          = "Informações de unidade de medida";
$tituloFormulario1        = "Dados de Unidade de Medida";
$descricaoFormulario1     = "Dados de identificação da unidade de medida";
$tituloFormulario5        = "Situação";
$descricaoFormulario5     = "Defina se esse cadastro de unidade de medida está ativo ou inativo";
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Unidade de Medida</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- formulário de cadastro - BEGIN -->
    <form class="app-form" id="form_unidade_medida" name="form_unidade_medida" method="post" action="">
      <input type="hidden" name="um_id" id="um_id" value="<?= $rsRegistro['id'] ;?>">
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
                  /*int 1-12*/  'col'         => 8,
                  /*string*/    'label'       => 'Nome',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'um_nome',
                  /*string*/    'id'          => 'um_nome',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 3,
                  /*int*/       'maxlength'   => 45,
                  /*string*/    'placeholder' => 'Digite o nome da unidade de medida',
                  /*string*/    'value'       => $rsRegistro['nome'],
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => ''
                )) ;?>
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 4,
                  /*string*/    'label'       => 'Símbolo',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'um_simbolo',
                  /*string*/    'id'          => 'um_simbolo',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 1,
                  /*int*/       'maxlength'   => 10,
                  /*string*/    'placeholder' => 'Digite o símbolo',
                  /*string*/    'value'       => $rsRegistro['simbolo'],
                  /*bool*/      'required'    => true,
                  /*string*/    'prop'        => ''
                )) ;?>
              </div>
              <div class="row">
                <?= createInput(array(
                  /*int 1-12*/  'col'         => 4,
                  /*string*/    'label'       => 'Equivalência',
                  /*string*/    'type'        => 'text',
                  /*string*/    'name'        => 'um_equivalencia',
                  /*string*/    'id'          => 'um_equivalencia',
                  /*string*/    'class'       => 'form-control',
                  /*int*/       'minlength'   => 2,
                  /*int*/       'maxlength'   => 20,
                  /*string*/    'placeholder' => 'Digite a Equivalência',
                  /*string*/    'value'       => $rsRegistro['equivalencia'],
                  /*bool*/      'required'    => false,
                  /*string*/    'prop'        => ''
                )) ;?>
                <?= createSelect(array(
                  /*int 1-12*/  'col'         => 4,
                  /*string*/    'label'       => 'Grandeza',
                  /*string*/    'name'        => 'um_bsc_grandeza_id',
                  /*string*/    'id'          => 'um_bsc_grandeza_id',
                  /*string*/    'class'       => 'select2 form-control form-select select-basic',
                  /*string*/    'value'       => $rsRegistro['bsc_grandeza_id'],
                  /*array()*/   'options'     => $rsGrandezas,
                  /*string*/    'ariaLabel'   => 'Selecione uma grandeza',
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
                  /*string*/    'name'        => 'um_status',
                  /*string*/    'id'          => 'um_status',
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/unidade_medida/cadastrar.js"></script>