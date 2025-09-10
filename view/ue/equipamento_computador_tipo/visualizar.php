<?php
include_once ('template/topo.php');
include_once ('template/sidebar.php');
include_once ('template/header.php');
$id = empty($parametromodulo) ? 0 : $parametromodulo;
if (empty($id)) {
  header('Location: '.PORTAL_URL.'view/ue/equipamento_computador_tipo/listar');
}
$db = Conexao::getInstance();
//Consulta para Visualizar - BEGIN
$stmt = $db->prepare("SELECT 
  ect.id,
  ect.status,
  ect.dt_cadastro,
  ect.nome,
  ect.descricao
  FROM ue_equip_comput_tipo AS ect
  WHERE ect.id = ? ;");
$stmt->bindValue(1, $id);
$stmt->execute();
$rsRegistro = $stmt->fetch(PDO::FETCH_ASSOC);
//Consulta para Visualizar - END
//Parámetros de títutlos - BEGIN
$tituloPagina             = "Listagem do Tipo de Equipamento/Computador para o Aluno";
$descricaoPagina          = "Informações do tipo de equipamento/computador para o aluno";
$tituloFormulario1        = "Tabela informações do Tipo de Equipamento/Computador para o Aluno";
$descricaoFormulario1     = "Dados de informações do tipo de equipamento/computador para o aluno cadastrada no sistema DELFOS";
$tituloImpressao          = "Relatório de informações do tipo de equipamento/computador para o aluno cadastrada no sistema DELFOS";
//Parámetros de títutlos - NED
?>
<!--Main Section - BEGIN -->
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
            <a href="<?= PORTAL_URL; ?>" class="f-s-14 f-w-500">Tipo de Equipamento/Computador para o Aluno</a>
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
                  <input type="hidden" id="edit_id" value="<?= $rsRegistro['id']; ?>">
                  <button type="button" id="btn_editar" class="btn btn-outline-warning waves-light b-r-22" data-bs-custom-class="custom-light-warning" data-bs-toggle="tooltip" title="Editar este registro" onclick="btnEditar();">
                    <i class="ti ti-writing"></i> Editar Registro
                  </button>
                </div>
                <!-- div row buttons - END -->
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="app-datatable-default overflow-auto">
              <h6 class="card-header">Copiar, Exportar (CVS, EXCEL, PDF) ou Imprimir a tabela.</h6>
              <table id="table_visualizar" class="table table-striped display app-data-table">
                <thead class="bg-inverse">
                  <tr>
                    <th>Descrição</th>
                    <th>Registro Informado</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Nome</td>
                    <td><?= $rsRegistro['nome']; ?></td>
                  </tr>
                  <tr>
                    <td>Descrição</td>
                    <td><?= $rsRegistro['descricao']; ?></td>
                  </tr>
                </tbody>
                  <!-- <td><span class="badge text-light-primary">System Architect</span></td>
                  <td><span class="badge text-light-success">Accountant</span></td>
                  <td><span class="badge text-light-secondary">Junior Technical Author</span></td>
                  <td><span class="badge text-light-info">Senior Javascript Developer</span></td>
                  <td><span class="badge text-light-danger"> Integration Specialist</span></td>
                  <td><span class="badge text-light-dark">Sales Assistant</span></td>
                  <td><span class="badge text-light-light">Integration Specialist</span></td>
                  <td><span class="badge text-light-warning">Marketing Designer</span></td> -->
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
<script type="text/javascript" src="<?= PORTAL_URL; ?>control/ue/equipamento_computador_tipo/visualizar.js"></script>