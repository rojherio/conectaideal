$(document).ready(function () {
});

function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/parentesco_grau/visualizar/' + id);
};

function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/bsc/parentesco_grau/cadastrar', {id: id});
};

//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    id:             id,
    urlToSend:      'model/bsc/parentesco_grau/excluir',
    urlToGo:        'view/bsc/parentesco_grau/listar'
  };
  ajaxSendExcluir(params);
}
