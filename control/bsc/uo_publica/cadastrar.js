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
      formId:         'form_uo_publica',
      urlToSend:      'model/bsc/uo_publica/salvar_uo_publica',
      urlToGo:        'view/bsc/uo_publica/listar'
    };
    ajaxSendCadastrar(params);
  });
});