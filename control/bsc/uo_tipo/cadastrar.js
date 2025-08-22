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
      formId:         'form_uo_tipo',
      urlToSend:      'model/bsc/uo_tipo/salvar_uo_tipo',
      urlToGo:        'view/bsc/uo_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});