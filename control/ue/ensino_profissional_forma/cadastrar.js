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
      formId:         'form_ensino_profissional_forma',
      urlToSend:      'model/ue/ensino_profissional_forma/salvar_ensino_profissional_forma',
      urlToGo:        'view/ue/ensino_profissional_forma/listar'
    };
    ajaxSendCadastrar(params);
  });
});