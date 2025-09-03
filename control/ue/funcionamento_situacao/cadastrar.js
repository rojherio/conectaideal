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
      formId:         'form_funcionamento_situacao',
      urlToSend:      'model/ue/funcionamento_situacao/salvar_funcionamento_situacao',
      urlToGo:        'view/ue/funcionamento_situacao/listar'
    };
    ajaxSendCadastrar(params);
  });
});