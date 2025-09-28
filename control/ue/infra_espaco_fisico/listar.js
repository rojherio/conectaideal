$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/ue/infra_espaco_fisico/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_espaco_fisico/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/infra_espaco_fisico/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/ue/infra_espaco_fisico/excluir',
    urlToGo:        'view/ue/infra_espaco_fisico/listar'
  };
  ajaxSendExcluir(params);
}
