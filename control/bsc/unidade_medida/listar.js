$(document).ready(function () {
});

function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/unidade_medida/visualizar/' + id);
};

function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/unidade_medida/cadastrar', {id: id});
};

//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/unidade_medida/excluir',
    urlToGo:        'view/bsc/unidade_medida/listar'
  };
  ajaxSendExcluir(params);
}
