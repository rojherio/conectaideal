$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/bsc/uo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/uo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/uo/cadastrar', {id: id});
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/uo/excluir',
    urlToGo:        'view/bsc/uo/listar'
  };
  ajaxSendExcluir(params);
}
