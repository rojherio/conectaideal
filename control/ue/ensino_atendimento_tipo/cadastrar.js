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
      formId:         'form_ensino_atendimento_tipo',
      urlToSend:      'model/bsc/ensino_atendimento_tipo/ensino_atendimento_tipo',
      urlToGo:        'view/bsc/ensino_atendimento_tipo/listar'
    };
    ajaxSendCadastrar(params);
  });
});