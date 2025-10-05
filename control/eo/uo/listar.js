$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/eo/uo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/uo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/uo/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/eo/uo/excluir',
    urlToGo:        'view/eo/uo/listar'
  };
  ajaxSendExcluir(params);
}
