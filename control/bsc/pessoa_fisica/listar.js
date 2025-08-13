$(document).ready(function () {
});

function btnVisualizar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/rh/servidor/visualizar', {id: id});
};

function btnEditar(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  postToURL(PORTAL_URL + 'view/rh/servidor/cadastrar', {id: id});
};

//SALVANDO DADOS DO FORMULÁRIO DE PROJETO
function btnExcluir(elem){
  let id = $(elem).parents('tr').children('input#td_id').val();
  let params = {
    formId:         'form_pessoa',
    urlToSend:      'model/bsc/pessoa_fisica/dashboard',
    urlDashboard:   'view/bsc/pessoa_fisica/dashboard'
  };
  ajaxSend(params);
}
