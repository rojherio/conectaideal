<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = !(isset($_POST['id'])) ? 0 : $_POST['id'];
$db = Conexao::getInstance();
//Consulta para Edição - BEGIN
$stmt = $db->prepare("SELECT 
  uot.id AS id, 
  uot.nome AS nome, 
  uot.status AS status 
  FROM bsc_unidade_organizacional_tipo AS uot 
  WHERE uot.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsUOTipo = $stmt->fetch(PDO::FETCH_ASSOC);
//Consulta para Edição - END
//Consulta para DataTable - BEGIN
$stmt = $db->prepare("
  SELECT 
  uot.id AS id,  
  uot.nome AS nome, 
  uot.status AS status, 
  COUNT(uo.id) AS qtd_uo_id 
  FROM bsc_unidade_organizacional_tipo AS uot 
  LEFT JOIN bsc_unidade_organizacional AS uo ON uot.id = uo.bsc_unidade_organizacional_tipo_id 
  GROUP BY uot.id, uot.nome, uot.status 
  ORDER BY uot.nome ASC;");
$stmt->execute();
$rsUOTipos = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para DataTable - END
?>
<!-- main section -->
<main>
  <div class="container-fluid">
    <!-- div Título página e links de navegação - BEGIN -->
    <div class="row m-1">
      <div class="col-12 ">
        <h4 class="main-title">Tipo de Unidade Organizacional</h4>
        <ul class="app-line-breadcrumbs mb-3">
          <li class="">
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">
              <span>
                <i class="ph-duotone  ph-cardholder f-s-16"></i> Cadastros Básicos
              </span>
            </a>
          </li>
          <li class="active">
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Tipo de Unidade Organizacional</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- div de cadastro - BEGIN -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <!-- Título da div de cadastro - BEGIN -->
            <h5>CADASTRO DE TIPO DE UNIDADE ORGANIZACIONAL</h5>
            <small>Explicação da página</small>
            <!-- Título da div de cadastro - END -->
          </div>
          <div class="card-body">
            <!-- formulário de cadastro - BEGIN -->
            <form class="app-form" id="form_uo_tipo" name="form_uo_tipo" method="post" action="">
              <!-- div row input - BEGIN -->
              <div class="row">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" minlength="3" maxlength="100" id="nome_uot" name="nome_uot" placeholder="Digite o nome do tipo de unidade organizacional" value="<?= $rsUOTipo['nome']; ?>" required>
                    <label for="nome_uot">Nome</label>
                  </div>
                </div>
              </div>
              <!-- div row input - END -->
              <!-- div row checkbox - BEGIN -->
              <div class="row">
                <div class="col-2">
                  <div class="card-body main-switch main-switch-color switch-unchecked switch_border">
                    <div class="switch-info switch-unchecked-danger switch-border-info my-3 swich-size">
                      <input type="checkbox" class="toggle" id="status_uot1" name="status_uot1" <?= $rsUOTipo['status'] == NULL || $rsUOTipo['status'] == 1 ? "checked" : "checked" ;?>>
                      <label for="status_uot1"> Ativo</label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- div row checkbox - END -->
              <!-- div row buttons - BEGIN -->
              <div class="row">
                <div class="box-footer text-center">
                  <button type="reset" class="btn btn-danger waves-effect waves-light b-r-22" id="btn_cancelar">
                    <i class="ti ti-eraser"></i> Cancelar
                  </button>
                  <button type="submit" class="btn btn-success waves-effect waves-light b-r-22">
                    <i class="ti ti-writing"></i> Cadastrar
                  </button>
                </div>
                <input type="hidden" id="id" name="id" value="<?= $rsUOTipo['id'] ;?>">
              </div>
              <!-- div row buttons - END -->
            </form>
            <!-- formulário de cadastro - END -->
          </div>
        </div>
      </div>
    </div>
    <!-- div de cadastro - END -->
    <!-- div de listagem/dataTable - BEGIN -->
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h5><span id="titulo_form" class="icon-name"> LISTA DE TIPOS DE UNIDADES ORGANIZACIONAIS</span></h5>
            <small>Explicação da página</small>
            <input type="hidden" id="titulo_relatorio" value="Relatório de tipos de unidades organizacionais cadastradas no sistema">
          </div>
          <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
              <h6 class="card-header">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
              <!-- <table id="table_modelo_01" class="display app-data-table default-data-table"> -->
              <table id="table_modelo_01" class="table table-striped display app-data-table">
                <thead class="bg-inverse">
                  <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Status</th>
                    <th class="no-print" width="160px !important"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($rsUOTipos as $kObj => $vObj) {
                    $excluirDisable = $vObj['qtd_uo_id'] > 0 ? 'negado="true" data-toggle="tooltip" title="Este registro não pode ser exlcuido pois está vinculado a uma unidade organizacional!" onclick="return null;"' : 'onclick="btnExcluir(this)"';
                    ?>
                    <tr>
                      <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                      <td id="td_count"><?= $kObj+1; ?></td>
                      <td id="td_nome"><?= $vObj['nome']; ?></td>
                      <td id="td_status" value="<?= $vObj['status'];?>"><span class="badge <?= $vObj['status'] == 1 ? 'text-light-primary' : 'text-light-warning'; ?> "><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></span></td>
                      <td class="text-center">
                        <button type="button" id="btn_editar_registro" class="btn_editar_registro btn btn-light-warning icon-btn b-r-4" onclick="btnEditar(this);">
                          <i class="ti ti-edit"></i>
                        </button>
                        <button type="button" id="btn_excluir_registro" class="btn_excluir_registro btn btn-light-danger icon-btn b-r-4" <?= $excluirDisable; ?>>
                          <i class="ti ti-trash"></i>
                        </button>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  <!-- <td><span class="badge text-light-primary">System Architect</span></td>
                  <td><span class="badge text-light-success">Accountant</span></td>
                  <td><span class="badge text-light-secondary">Junior Technical Author</span></td>
                  <td><span class="badge text-light-info">Senior Javascript Developer</span></td>
                  <td><span class="badge text-light-danger"> Integration Specialist</span></td>
                  <td><span class="badge text-light-dark">Sales Assistant</span></td>
                  <td><span class="badge text-light-light">Integration Specialist</span></td>
                  <td><span class="badge text-light-warning">Marketing Designer</span></td> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- div de listagem/dataTable - END -->
  </div>
</main>
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/bsc/unidade_organizacional_tipo/dashboard.js"></script>