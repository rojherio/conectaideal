$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/sme/rh_serv_situacao/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/sme/rh_serv_situacao/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/sme/rh_serv_situacao/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/sme/rh_serv_situacao/excluir',
    urlToGo:        'view/sme/rh_serv_situacao/listar'
  };
  ajaxSendExcluir(params);
}
