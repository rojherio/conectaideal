$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/bsc/uo_tipo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/uo_tipo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/uo_tipo/cadastrar', {id: id});
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/uo_tipo/excluir',
    urlToGo:        'view/bsc/uo_tipo/listar'
  };
  ajaxSendExcluir(params);
}
