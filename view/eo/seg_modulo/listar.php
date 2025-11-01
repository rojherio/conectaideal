<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$db = Conexao::getInstance();
//Consulta para DataTable - BEGIN
$stmt = $db->prepare("SELECT 
  m.id,
  m.status,
  m.dt_cadastro,
  m.nome,
  m.descricao,
  m.pasta,
  m.caminho
  FROM seg_modulo AS m
  ORDER BY m.nome");
$stmt->execute();
$rsRegistros = $stmt->fetchAll(PDO::FETCH_ASSOC);
//Consulta para DataTable - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Listagem de Modulos";
$descricaoPagina          = "Informações de modulos";
$tituloFormulario1        = "Tabela com listagem de Modulos";
$descricaoFormulario1     = "Dados de identificação de modulos";
$tituloImpressao          = "Relatório de modulos cadastradas no sistema conectaideal";
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Modulo</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- div Título página e links de navegação - END -->
    <!-- div de listagem/dataTable - BEGIN -->
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <div class="row">
              <div class="col-md-8">
                <!-- Título da div de cadastro - BEGIN -->
                <h5><?= $tituloFormulario1;?></h5>
                <small><?= $descricaoFormulario1;?></small>
                <!-- Título da div de cadastro - END -->
                <input type="hidden" id="titulo_impressao" value="<?= $tituloImpressao;?>">
                <!-- Título da div de cadastro - END -->
              </div>
              <div class="col-md-4">
                <!-- div row buttons - BEGIN -->
                <div class="text-end">
                  <button type="button" id="btn_novo" class="btn btn-outline-info waves-light b-r-22" data-bs-custom-class="custom-light-info" data-bs-toggle="tooltip" title="Cadastrar novo registro" onclick="btnNovo();">
                    <i class="ti ti-writing"></i> Cadastar Novo
                  </button>
                </div>
                <!-- div row buttons - END -->
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
              <h6 class="card-header">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
              <!-- <table id="table_modelo_01" class="display app-data-table default-data-table"> -->
                <table id="table_listar" class="table table-striped display app-data-table">
                  <thead class="bg-inverse">
                    <tr>
                      <th>#</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th>Pasta</th>
                      <th>Caminho</th>
                      <th>Status</th>
                      <th class="no-print" width="120px !important">Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($rsRegistros as $kObj => $vObj) {
                      // $btnExcluirOnClick  = $vObj['qtd_uo_id'] > 0 ? 'negado="true" data-toggle="tooltip" title="Este registro não pode ser exlcuido pois está vinculado a outras informações!" onclick="return false;"' : 'onclick="btnExcluir(this)"';
                      $btnExcluirOnClick  = 'onclick="btnExcluir(this)"';
                      ?>
                      <tr>
                        <input type="hidden" id="td_id" value="<?= $vObj['id']; ?>">
                        <td id="td_count"><?= $kObj+1; ?></td>
                        <td id="td_nome"><?= $vObj['nome']; ?></td>
                        <td id="td_descricao"><?= $vObj['descricao']; ?></td>
                        <td id="td_pasta"><?= $vObj['pasta']; ?></td>
                        <td id="td_caminho"><?= $vObj['caminho']; ?></td>
                        <td id="td_status" value="<?= $vObj['status'];?>"><span class="badge <?= $vObj['status'] == 1 ? 'text-light-primary' : 'text-light-warning'; ?> "><?= $vObj['status'] == 1 ? 'Ativo' : 'Inativo'; ?></span></td>
                        <td class="text-center">
                          <button type="button" id="btn_visualizar" class="btn_visualizar_registro btn btn-light-info icon-btn-conectaideal b-r-4" data-bs-custom-class="custom-light-info" data-bs-toggle="tooltip" title="Visualizar este registro" onclick="btnVisualizar(this);">
                            <i class="ti ti-report-search"></i>
                          </button>
                          <button type="button" id="btn_editar" class="btn_editar_registro btn btn-light-warning icon-btn-conectaideal b-r-4" data-bs-custom-class="custom-light-warning" data-bs-toggle="tooltip" title="Editar este registro" onclick="btnEditar(this);">
                            <i class="ti ti-edit"></i>
                          </button>
                          <button type="button" id="btn_excluir" class="btn_excluir_registro btn btn-light-danger icon-btn-conectaideal b-r-4" data-bs-custom-class="custom-light-danger" data-bs-toggle="tooltip" title="Excluir este registro" <?= $btnExcluirOnClick; ?>>
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
<!-- Main Section - END-->
<?php
include_once ('template/footer.php');
include_once ('template/rodape.php');
?>
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/eo/seg_modulo/listar.js"></script>