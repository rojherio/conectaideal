$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/bsc/infraestrutura/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/infraestrutura/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/infraestrutura/cadastrar', {id: id});
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/infraestrutura/excluir',
    urlToGo:        'view/bsc/infraestrutura/listar'
  };
  ajaxSendExcluir(params);
}
