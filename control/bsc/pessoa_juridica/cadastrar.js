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
      urlToSend:      'model/bsc/pessoa_juridica/salvar_pessoa',
      urlToGo:        'view/bsc/pessoa_juridica/listar'
    };
    ajaxSendCadastrar(params);
  });
});