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
      formId:         'form_infra_acessib_recurso',
      urlToSend:      'model/ue/infra_acessib_recurso/salvar_infra_acessib_recurso',
      urlToGo:        'view/ue/infra_acessib_recurso/listar'
    };
    ajaxSendCadastrar(params);
  });
});