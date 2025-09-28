$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/ue/equipamento_tecnologico_administrativo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/equipamento_tecnologico_administrativo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/equipamento_tecnologico_administrativo/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/ue/equipamento_tecnologico_administrativo/excluir',
    urlToGo:        'view/ue/equipamento_tecnologico_administrativo/listar'
  };
  ajaxSendExcluir(params);
}
