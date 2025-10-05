$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/eo/seg_modulo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_modulo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_modulo/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/eo/seg_modulo/excluir',
    urlToGo:        'view/eo/seg_modulo/listar'
  };
  ajaxSendExcluir(params);
}
