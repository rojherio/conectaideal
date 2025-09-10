$(document).ready(function () {
});
function btnNovo(){
  postToURL(PORTAL_URL + 'view/ue/equip_rede_local_tipo/cadastrar/');
};
function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/equip_rede_local_tipo/visualizar/' + id);
};
function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/ue/equip_rede_local_tipo/cadastrar', {id: id});
};
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/ue/equip_rede_local_tipo/excluir',
    urlToGo:        'view/ue/equip_rede_local_tipo/listar'
  };
  ajaxSendExcluir(params);
}
