$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/sme/rh_serv_tipo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/sme/rh_serv_tipo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/sme/rh_serv_tipo/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/sme/rh_serv_tipo/excluir',
    urlToGo:        'view/sme/rh_serv_tipo/listar'
  };
  ajaxSendExcluir(params);
}
