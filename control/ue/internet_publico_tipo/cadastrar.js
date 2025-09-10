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
      formId:         'form_internet_publico_tipo',
      urlToSend:      'model/ue/internet_publico_tipo/salvar_internet_publico_tipo',
      urlToGo:        'view/ue/internet_publico_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});