$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/bsc/porte/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/porte/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/porte/cadastrar', {id: id});
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/porte/excluir',
    urlToGo:        'view/bsc/porte/listar'
  };
  ajaxSendExcluir(params);
}
