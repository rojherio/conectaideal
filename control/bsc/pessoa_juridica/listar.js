$(document).ready(function () {
});

function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/pessoa_juridica/visualizar/' + id);
};

function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/pessoa_juridica/cadastrar', {id: id});
};

//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/pessoa_juridica/excluir',
    urlToGo:        'view/bsc/pessoa_juridica/listar'
  };
  ajaxSendExcluir(params);
}
