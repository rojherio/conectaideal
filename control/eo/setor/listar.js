$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/eo/cargo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/cargo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/cargo/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/eo/cargo/excluir',
    urlToGo:        'view/eo/cargo/listar'
  };
  ajaxSendExcluir(params);
}
