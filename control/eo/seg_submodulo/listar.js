$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/eo/seg_submodulo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_submodulo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/eo/seg_submodulo/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/eo/seg_submodulo/excluir',
    urlToGo:        'view/eo/seg_submodulo/listar'
  };
  ajaxSendExcluir(params);
}
