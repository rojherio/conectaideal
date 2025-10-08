$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/sme/serv_situacao/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/sme/serv_situacao/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/sme/serv_situacao/cadastrar/' + id);
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/sme/serv_situacao/excluir',
    urlToGo:        'view/sme/serv_situacao/listar'
  };
  ajaxSendExcluir(params);
}
