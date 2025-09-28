$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/ue/turno/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/turno/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/turno/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/ue/turno/excluir',
    urlToGo:        'view/ue/turno/listar'
  };
  ajaxSendExcluir(params);
}
