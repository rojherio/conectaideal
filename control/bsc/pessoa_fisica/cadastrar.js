//MENSAGEM PERGUNTANDO SE O USUÁRIO DESEJA MESMO SAIR DO FORMULÁRIO
// window.onbeforeunload = function (e) {
//   if ($('#nome_uo').val() == '') {
//     window.onbeforeunload = null;
//   } else {
//     return true;
//   }
// };
$(document).ready(function () {
  //SALVANDO DADOS DO FORMULÁRIO DE PROJETO
  $('#submit').on('click', function () {
    let params = {
      formId:         'form_pessoa',
      urlToSend:      'model/bsc/pessoa_fisica/salvar_pessoa',
      urlDashboard:   'view/bsc/pessoa_fisica/listar'
    };
    ajaxSend(params);
  });
});