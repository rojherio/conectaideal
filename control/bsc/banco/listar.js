$(document).ready(function () {
});

function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/banco/visualizar/' + id);
};

function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/banco/cadastrar', {id: id});
};

//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/banco/excluir',
    urlToGo:        'view/bsc/banco/listar'
  };
  ajaxSendExcluir(params);
}
