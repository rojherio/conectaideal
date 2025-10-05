$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/eo/seg_acao/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_acao/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_acao/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/eo/seg_acao/excluir',
    urlToGo:        'view/eo/seg_acao/listar'
  };
  ajaxSendExcluir(params);
}
