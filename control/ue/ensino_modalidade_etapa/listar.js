$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/bsc/ensino_modalidade_etapa/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/ensino_modalidade_etapa/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/ensino_modalidade_etapa/cadastrar', {id: id});
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/ensino_modalidade_etapa/excluir',
    urlToGo:        'view/bsc/ensino_modalidade_etapa/listar'
  };
  ajaxSendExcluir(params);
}
