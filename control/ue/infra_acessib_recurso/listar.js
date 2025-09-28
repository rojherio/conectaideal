$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/ue/infra_acessib_recurso/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_acessib_recurso/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_acessib_recurso/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/ue/infra_acessib_recurso/excluir',
    urlToGo:        'view/ue/infra_acessib_recurso/listar'
  };
  ajaxSendExcluir(params);
}
